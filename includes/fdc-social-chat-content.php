<?php

/**
 *
 * Created by Filippo Di Costanzo
 * Generate Content
 *
 */


/**
 * Exit if Accessed Directly
 */

if (!defined('ABSPATH')) exit;

/**
 * If Not Class Exist
 */

if (!class_exists('fsc_generate_content')) :

    /**
     * Create Class
     */

    class fsc_generate_content
    {


        public $whatsapp_options;
        public $messenger_options;
        public $mail_options;
        public $layout_options;
        public $order_options;

        /**
         * Class Constructor
         */


        public function __construct()
        {


            $this->includes();
            $this->init();
            add_action('wp_footer', array($this, 'generate_content'));


        }


        /**
         * Require a Partial Scripts
         */

        public function includes()
        {
            require_once('partial/fdc-social-chat-whastapp.php');
            require_once('partial/fdc-social-chat-messenger.php');
            require_once('partial/fdc-social-chat-mail.php');
            require_once('partial/fdc-social-chat-layout.php');
            require_once('partial/fdc-social-chat-order.php');
        }

        /**
         * Init Variables
         */

        public function init()
        {


            $fsc_whatsapp = new fsc_whatsapp_options();
            $fsc_messenger_options = new fsc_messenger_options();
            $fsc_mail_options = new fsc_mail_options();
            $fsc_layout_options = new fsc_layout_options();
            $fsc_order_options = new fsc_order_options();

            $this->whatsapp_options = $fsc_whatsapp->get_options_value();
            $this->messenger_options = $fsc_messenger_options->get_options_value();
            $this->mail_options = $fsc_mail_options->get_options_value();
            $this->layout_options = $fsc_layout_options->get_options_value();
            $this->order_options = $fsc_order_options->get_options_value();

        }


        /**
         * Generate Front End Content
         */

        public function generate_content()
        {


            $whatsapp = (object)[
                'enable' => $this->whatsapp_options['whatsapp_enable'],
                'image' => plugins_url() . '/fdc-social-chat/assets/images/' . $this->whatsapp_options['whatsapp_icon'] . '.png',
                'url' => 'https://api.whatsapp.com/send?phone=' . $this->whatsapp_options['whatsapp_number'] . '&text=' . $this->whatsapp_options['whatsapp_message']
            ];

            $messenger = (object)[
                'enable' => $this->messenger_options['messenger_enable'],
                'image' => plugins_url() . '/fdc-social-chat/assets/images/' . $this->messenger_options['messenger_icon'] . '.png',
                'url' => 'https://m.me/' . $this->messenger_options['messenger_id']


            ];


            $mail = (object)[
                'enable' => $this->mail_options['mail_enable'],
                'image' => plugins_url() . '/fdc-social-chat/assets/images/' . $this->mail_options['mail_icon'] . '.png',
                'url' => 'mailto:' . $this->mail_options['mail_address'] . '?subject=' . $this->mail_options['mail_subject']
            ];


            $order = explode(',', $this->order_options['order_icon']);


            $container = (object)[
                'whatsapp' => $whatsapp,
                'messenger' => $messenger,
                'mail' => $mail
            ];

            $position = '';
            $margin = $this->layout_options['layout_margin'];
            $size = $this->layout_options['layout_size'];
            $mobile = $this->layout_options['layout_mobile_enable'];
            $mobile_size = $this->layout_options['layout_size_mobile'];
            $mobile_margin = $this->layout_options['layout_margin_mobile'];


            if ($this->layout_options['layout_position'] == 'top_left') {
                $position = 'style="top:0; left:0; margin:' . $margin . 'px; display:none"';
            } else if ($this->layout_options['layout_position'] == 'top_right') {
                $position = 'style="top:0; right:0; margin:' . $margin . 'px; display:none"';
            } else if ($this->layout_options['layout_position'] == 'bottom_left') {
                $position = 'style="bottom:0; left:0; margin:' . $margin . 'px; display:none"';
            } else {
                $position = 'style="bottom:0; right:0; margin:' . $margin . 'px; display:none"';
            }

            $whatsapp_render = '<a href="' . $whatsapp->url . '" target="_blank"><img src="' . $whatsapp->image . '" width="' . $size . 'px"></a>';
            $messenger_render = '<a href="' . $messenger->url . '" target="_blank"><img src="' . $messenger->image . '" width="' . $size . 'px"></a>';
            $mail_render = '<a href="' . $mail->url . '"><img src="' . $mail->image . '" width="' . $size . 'px"></a>';

            $html = '';

            if ($whatsapp->enable || $messenger->enable || $mail->enable) :

                $html .= '<div class="fsc-container"' . $position . '>';

                foreach ($order as $key => $value) {
                    foreach ($container as $k => $v) {
                        if ($value == $k) {

                            switch ($value) {
                                case 'whatsapp':
                                    if ($v->enable)
                                        $html .= $whatsapp_render;
                                    break;
                                case 'messenger':
                                    if ($v->enable)
                                        $html .= $messenger_render;
                                    break;
                                case 'mail':
                                    if ($v->enable)
                                        $html .= $mail_render;
                                    break;
                                default:
                                    exit();

                            }


                        }
                    }
                }
                $html .= '</div>';


                ?>
                <script>

                    jQuery(document).ready(function ($) {

                        var size = "<?php echo $size ?>";
                        var margin = "<?php echo $margin ?>";
                        var mobile_enable = "<?php echo $mobile ?>";
                        var mobile_size = "<?php echo $mobile_size?>";
                        var mobile_margin = "<?php echo $mobile_margin?>";
                        var width = $(window).width();
                        var mobile_endpoint = false;


                        if (width < 768) {
                            mobile_endpoint = true;
                            if (mobile_enable) {
                                size_mobile();
                                $(".fsc-container").show();
                            }
                            else {
                                $(".fsc-container").hide();
                            }
                        }

                        else {
                            $(".fsc-container").show();
                        }

                        $(window).resize(function () {

                            width = $(window).width();

                            console.log(width);
                            console.log(mobile_endpoint);

                            if (width < 768 && !mobile_endpoint) {
                                mobile_endpoint = true;
                                console.log(mobile_endpoint);
                                if (mobile_enable) {
                                    size_mobile();
                                }
                                else {
                                    $(".fsc-container").hide();
                                }
                            }
                            if (width >= 768 && mobile_endpoint) {
                                mobile_endpoint = false;
                                $(".fsc-container").show();
                                size_desktop();
                            }

                        });


                        function size_mobile() {
                            $(".fsc-container").css({'margin': mobile_margin + 'px'});
                            $(".fsc-container a img").each(function () {
                                $(this).width(mobile_size);

                            });
                        }

                        function size_desktop() {
                            $(".fsc-container").css({'margin': margin + 'px'});
                            $(".fsc-container a img").each(function () {
                                $(this).width(size);
                            });
                        }

                    });

                </script>

                <?php

                echo $html;

            endif;

        }


    }

endif;

/**
 * Create a Instance Of Class
 */

$fsc_generate_content = new fsc_generate_content();



