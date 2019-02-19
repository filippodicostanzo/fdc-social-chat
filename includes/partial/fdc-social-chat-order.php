<?php


/**
 *
 * Created by Filippo Di Costanzo
 * Order Options Sections
 *
 */


class fsc_order_options
{
    private $options;
    private $order;
    private $description;
    private $default;


    /**
     * Class Constructor
     */

    public function __construct()
    {
        add_action('admin_init', array($this, 'fsc_order_options_init'));
        add_action('wp_ajax_fsc_order_ajax_response', array($this, 'fsc_order_ajax_response'));
        add_action('wp_ajax_nopriv_fsc_order_ajax_response', array($this, 'fsc_order_ajax_response'));
        $this->options = get_option('fsc_order_options');
    }

    /**
     * Initialize Variables
     */
    public function initialize_variable()
    {
        $this->order = "whatsapp,messenger,mail";
        $this->description = 'Choose the order of Social Chat';
        $this->default = ['order_icon' => 'whatsapp,messenger,mail'];
    }


    /**
     * Create Settings Section e Settings Fields
     */

    public function fsc_order_options_init()
    {

        $this->initialize_variable();

        if (false == get_option('fsc_order_options')) {
            add_option('fsc_order_options', $this->default);
        }

        if (get_option('fsc_order_options') == '') {
            update_option('fsc_order_options', $this->default);
        }

        add_settings_section(
            'order_settings_section',
            'Order Options',
            array($this, 'fsc_order_options_callback'),
            'fsc_order_options'
        );


        add_settings_field(
            'order_icon',
            'Icon Order',
            array($this, 'order_icon_callback'),
            'fsc_order_options',
            'order_settings_section'
        );


        register_setting(
            'fsc_order_options',
            'fsc_order_options'
        );


    }


    /**
     * Callback Function For Description
     */

    public function fsc_order_options_callback()
    {
        echo $this->description;
    }

    /**
     * Ajax Request For Order Options
     */

    public function fsc_order_ajax_response()
    {
        ob_clean();

        $orderarray = $_POST['order'];

        update_option('fsc_temp_array', $orderarray);

        wp_die();
    }

    /**
     * Callback Function For Order Icon
     */

    public function order_icon_callback()
    {
        ?>

        <script>

            jQuery(document).ready(function ($) {


                $("#itemsort").sortable({
                    update: function () {
                        var neworder = new Array();
                        $('#itemsort li').each(function () {
                            var id = $(this).attr("id");
                            var obj = {};
                            obj = id;
                            neworder.push(obj);
                        });

                        var data = {
                            'action': 'fsc_order_ajax_response',
                            'order_icon': neworder
                        };


                        $.post(ajaxurl, data, function (response) {

                            $('.neworder').attr('value', data.order_icon);

                        }).done(function () {
                            $('.message').animate({opacity: 1}, 100).delay(1000).animate({opacity: 0}, 1000)
                        })
                            .fail(function () {
                                alert("Error Occurred");
                            });

                    }
                });
            })
        </script>

        <?php

        if (isset($this->options['order_icon']) && $this->options['order_icon'] != '') {
            $this->order = $this->options['order_icon'];
        }


        $order_array = $this->order;

        $array = explode(',', $order_array);

        $html = '';

        $html .= '<div class="order-container"> <ul id="itemsort">';

        foreach ($array as $key => $value) {
            $html .= '<li id="' . $array[$key] . '" class="sortable_row"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/' . $array[$key] . '_icon_1.png" width="100px" class="sort_handle"></li>';
        }

        $html .= '</ul></div>';

        $html .= '<input type="hidden" class="neworder" name="fsc_order_options[order_icon]">';
        $html .= '<div class="message" style="opacity: 0">Modified Order <br> Save to Consolidate the Changes </div>';


        echo($html);


    }

    /**
     * Get Options Function
     */

    public function get_options_value()
    {
        return $this->options;
    }
}


/**
 * Create a Instance Of Class
 */

$fsc_order_options = new fsc_order_options();






