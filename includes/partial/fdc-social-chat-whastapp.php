<?php

/**
 *
 * Created by Filippo Di Costanzo
 * Whatsapp Options Sections
 *
 */


/**
 * Create Class
 */
class fsc_whatsapp_options
{

    private $options;
    private $enable;
    private $number;
    private $message;
    private $icon;
    private $description;
    private $default;

    /**
     * Class Constructor
     */

    public function __construct()
    {
        add_action('admin_init', array($this, 'fsc_whatsapp_options_init'));
        $this->options = get_option('fsc_whatsapp_options');

    }

    /**
     * Initialize Variables
     */

    public function initialize_variable()
    {
        $this->enable = false;
        $this->number = '';
        $this->message = '';
        $this->icon = 'whatsapp_icon_1';
        $this->description = 'The settings of Whatsapp Social Chat';
        $this->default = array([
            'whatsapp_enable' => false,
            'whatsapp_number' => '',
            'whatsapp_message' => '',
            'whatsapp_icon' => 'whatsapp_icon_1'

        ]);
    }


    /**
     * Create Settings Section e Settings Fields
     */

    public function fsc_whatsapp_options_init()
    {


        $this->initialize_variable();


        if (false == get_option('fsc_whatsapp_options')) {
            add_option('fsc_whatsapp_options');
        }

        if (get_option('fsc_whatsapp_options') == '') {
            update_option('fsc_whatsapp_options', $this->default);
        }


        add_settings_section(
            'whatsapp_settings_section',
            'Whatsapp Options',
            array($this, 'fsc_whatsapp_options_callback'),
            'fsc_whatsapp_options'
        );


        add_settings_field(
            'whatsapp_enable',
            'Enable',
            array($this, 'whatsapp_enable_callback'),
            'fsc_whatsapp_options',
            'whatsapp_settings_section',
            array(
                'Activate this setting to display Whatsapp Icon.'
            )
        );

        add_settings_field(
            'whatsapp_number',
            'Whatsapp Number',
            array($this, 'whatsapp_number_callback'),
            'fsc_whatsapp_options',
            'whatsapp_settings_section'
        );

        add_settings_field(
            'whatsapp_message',
            'Whatsapp Message',
            array($this, 'whatsapp_message_callback'),
            'fsc_whatsapp_options',
            'whatsapp_settings_section'
        );

        add_settings_field(
            'whatsapp_icon',
            'Whatsapp Icon',
            array($this, 'whatsapp_icon_callback'),
            'fsc_whatsapp_options',
            'whatsapp_settings_section'
        );


        register_setting(
            'fsc_whatsapp_options',
            'fsc_whatsapp_options',
            'sanitize_text_input'
        );

    }


    /**
     * Callback Function For Description
     */

    public function fsc_whatsapp_options_callback()
    {

        echo $this->description;
    }


    /**
     * Callback Function For Whatsapp Enable
     */

    public function whatsapp_enable_callback($args)
    {


        if (isset($this->options['whatsapp_enable'])) {
            $this->enable = $this->options['whatsapp_enable'];
        }

        $html = '<input type="checkbox" id="whatsapp_enable" name="fsc_whatsapp_options[whatsapp_enable]" value="1" ' . checked(1, $this->enable, false) . '/>';


        $html .= '<label for="whatsapp_enable"> ' . $args[0] . '</label>';

        echo $html;

    }


    /**
     * Callback Function For Whatsapp Number
     */

    public function whatsapp_number_callback()
    {

        if (isset($this->options['whatsapp_number'])) {
            $this->number = $this->options['whatsapp_number'];
        }

        echo '<input type="text" id="whatsapp_number" name="fsc_whatsapp_options[whatsapp_number]" value="' . $this->number . '" placeholder="393333333333" />';

    }

    /**
     * Callback Function For Whatsapp Message
     */
    public function whatsapp_message_callback()
    {

        if (isset($this->options['whatsapp_message'])) {
            $this->message = $this->options['whatsapp_message'];
        }
        echo '<textarea id="whatsapp_message" name="fsc_whatsapp_options[whatsapp_message]" placeholder="Text to send" rows="4" cols="50">' . $this->message . '</textarea>';

    }

    /**
     * Callback Function For Whatsapp Icon
     */
    public function whatsapp_icon_callback()
    {

        if (isset($this->options['whatsapp_icon'])) {
            $this->icon = $this->options['whatsapp_icon'];
        }

        $html = '';
        $html .= '<div class="icon-position">';
        $html .= '<label> <input type="radio" name="fsc_whatsapp_options[whatsapp_icon]" value="whatsapp_icon_1"' . checked('whatsapp_icon_1', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/whatsapp_icon_1.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_whatsapp_options[whatsapp_icon]" value="whatsapp_icon_2"' . checked('whatsapp_icon_2', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/whatsapp_icon_2.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_whatsapp_options[whatsapp_icon]" value="whatsapp_icon_3"' . checked('whatsapp_icon_3', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/whatsapp_icon_3.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_whatsapp_options[whatsapp_icon]" value="whatsapp_icon_4"' . checked('whatsapp_icon_4', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/whatsapp_icon_4.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '</div>';

        echo $html;

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

$fsc_whatsapp_options = new fsc_whatsapp_options();
















