<?php

/**
 *
 * Created by Filippo Di Costanzo
 * Mail Options Sections
 *
 */


/**
 * Create Class
 */

class fsc_mail_options
{

    private $options;
    private $enable;
    private $address;
    private $message;
    private $icon;
    private $description;
    private $default;


    /**
     * Class Constructor
     */

    public function __construct()
    {
        add_action('admin_init', array($this, 'fsc_mail_options_init'));
        $this->options = get_option('fsc_mail_options');
    }


    /**
     * Initialize Variables
     */

    public function initialize_variable()
    {

        $this->enable = false;
        $this->address = '';
        $this->message = '';
        $this->icon = 'mail_icon_1';
        $this->description = 'The settings of Mail Social Chat';
        $this->default = array([
            'mail_enable'=>false,
            'mail_address'=>'',
            'mail_subject'=>'',
            'mail_icon'=>'mail_icon_1',
        ]);

    }


    /**
     * Create Settings Section e Settings Fields
     */

    public function fsc_mail_options_init()
    {

        $this->initialize_variable();

        if (false == get_option('fsc_mail_options')) {
            add_option('fsc_mail_options',$this->default);
        }

        if (get_option('fsc_mail_options')=='') {
            update_option('fsc_mail_options', $this->default);
        }


        add_settings_section(
            'mail_settings_section',
            'Mail Options',
            array($this, 'fsc_mail_options_callback'),
            'fsc_mail_options'
        );


        add_settings_field(
            'mail_enable',
            'Enable',
            array($this, 'mail_enable_callback'),
            'fsc_mail_options',
            'mail_settings_section',
            array(
                'Activate this setting to display mail Icon.'
            )
        );

        add_settings_field(
            'mail_address',
            'Mail Address',
            array($this, 'mail_address_callback'),
            'fsc_mail_options',
            'mail_settings_section'
        );

        add_settings_field(
            'mail_subject',
            'Mail Subject Message',
            array($this, 'mail_subject_callback'),
            'fsc_mail_options',
            'mail_settings_section'
        );

        add_settings_field(
            'mail_icon',
            'Mail Icon',
            array($this, 'mail_icon_callback'),
            'fsc_mail_options',
            'mail_settings_section'
        );


        register_setting(
            'fsc_mail_options',
            'fsc_mail_options',
            'sanitize_text_input'
        );


    }

    /**
     * Callback Function For Description
     */


    public function fsc_mail_options_callback()
    {
        echo $this->description;
    }

    /**
     * Callback Function For Mail Enable
     */

    public function mail_enable_callback($args)
    {

        if (isset($this->options['mail_enable'])) {
            $this->enable = $this->options['mail_enable'];
        }


        $html = '<input type="checkbox" id="mail_enable" name="fsc_mail_options[mail_enable]" value="1" ' . checked(1, $this->enable, false) . '/>';


        $html .= '<label for="mail_enable"> ' . $args[0] . '</label>';

        echo $html;

    }


    /**
     * Callback Function For Mail Address
     */

    public function mail_address_callback()
    {
        if (isset($this->options['mail_address'])) {
            $this->address = $this->options['mail_address'];
        }
        echo '<input type="text" id="mail_address" name="fsc_mail_options[mail_address]" value="' . $this->address . '" placeholder="info@domain.ext" />';

    }


    /**
     * Callback Function For Mail Subject
     */
    public function mail_subject_callback()
    {

        if (isset($this->options['mail_subject'])) {
            $this->message = $this->options['mail_subject'];
        }

        echo '<input type="text" id="mail_subject" name="fsc_mail_options[mail_subject]" value="' . $this->message . '" placeholder="subject" />';


    }

    /**
     * Callback Function For Mail Icon
     */
    public function mail_icon_callback()
    {


        if (isset($this->options['mail_icon'])) {
            $this->icon = $this->options['mail_icon'];
        }


        $html = '';
        $html .= '<div class="icon-position">';
        $html .= '<label> <input type="radio" name="fsc_mail_options[mail_icon]" value="mail_icon_1"' . checked('mail_icon_1', $this->icon, false) . '/> <div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/mail_icon_1.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_mail_options[mail_icon]" value="mail_icon_2"' . checked('mail_icon_2', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/mail_icon_2.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_mail_options[mail_icon]" value="mail_icon_3"' . checked('mail_icon_3', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/mail_icon_3.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_mail_options[mail_icon]" value="mail_icon_4"' . checked('mail_icon_4', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/mail_icon_4.png" alt="FDC Social Chat"></span></div></label>';
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

$fsc_mail_options = new fsc_mail_options();







