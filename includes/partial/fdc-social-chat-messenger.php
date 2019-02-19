<?php

/**
 *
 * Created by Filippo Di Costanzo
 * Messenger Options Sections
 *
 */


/**
 * Create Class
 */

class fsc_messenger_options
{

    private $options;
    private $enable;
    private $pageid;
    private $icon;
    private $description;
    private $default;


    /**
     * Class Constructor
     */

    public function __construct()
    {
        add_action('admin_init', array($this, 'fsc_messenger_options_init'));
        $this->options = get_option('fsc_messenger_options');
    }


    /**
     * Initialize Variables
     */

    public function initialize_variable()
    {

        $this->enable = false;
        $this->pageid = '';
        $this->icon = 'messenger_icon_1';
        $this->description = 'The settings of Facebook Messenger Social Chat';
        $this->default = array([
            'messenger_enable'=>false,
            'messenger_id'=> '',
            'messenger_icon' => 'messenger_icon_1'

        ]);
    }


    /**
     * Create Settings Section e Settings Fields
     */

    public function fsc_messenger_options_init()
    {

        $this->initialize_variable();

        if (false == get_option('fsc_messenger_options')) {
            add_option('fsc_messenger_options');
        }

        if (get_option('fsc_messenger_options')=='') {
            update_option('fsc_messenger_options', $this->default);
        }




        add_settings_section(
            'messenger_settings_section',
            'Messenger Options',
            array($this, 'fsc_messenger_options_callback'),
            'fsc_messenger_options'
        );


        add_settings_field(
            'messenger_enable',
            'Enable',
            array($this, 'messenger_enable_callback'),
            'fsc_messenger_options',
            'messenger_settings_section',
            array(
                'Activate this setting to display Messenger Icon.'
            )
        );

        add_settings_field(
            'messenger_id',
            'Messenger Id',
            array($this, 'messenger_id_callback'),
            'fsc_messenger_options',
            'messenger_settings_section'

        );

        add_settings_field(
            'messenger_icon',
            'Messenger Icon',
            array($this, 'messenger_icon_callback'),
            'fsc_messenger_options',
            'messenger_settings_section'

        );

        register_setting(
            'fsc_messenger_options',
            'fsc_messenger_options',
            'sanitize_text_input'
        );

    }

    /**
     * Callback Function For Description
     */

    public function fsc_messenger_options_callback()
    {
        echo $this->description;
    }

    /**
     * Callback Function For Messenger Enable
     */

    public function messenger_enable_callback($args)
    {


        if (isset($this->options['messenger_enable'])) {
            $this->enable = $this->options['messenger_enable'];
        }

        $html = '<input type="checkbox" id="messenger_enable" name="fsc_messenger_options[messenger_enable]" value="1" ' . checked(1, $this->enable, false) . '/>';

        $html .= '<label for="messenger_enable"> ' . $args[0] . '</label>';

        echo $html;

    }

    /**
     * Callback Function For Messenger Id
     */

    public function messenger_id_callback()
    {

        if (isset($this->options['messenger_id'])) {
            $this->pageid = $this->options['messenger_id'];
        }

        echo '<input type="text" id="messenger_id" name="fsc_messenger_options[messenger_id]" value="' . $this->pageid . '" placeholder="Facebook Page Id" />';
    }


    /**
     * Callback Function For Messenger Icon
     */

    public function messenger_icon_callback()
    {


        if (isset($this->options['messenger_icon'])) {
            $this->icon = $this->options['messenger_icon'];
        }


        $html = '';
        $html .= '<div class="icon-position">';
        $html .= '<label> <input type="radio" name="fsc_messenger_options[messenger_icon]" value="messenger_icon_1"' . checked('messenger_icon_1', $this->icon, false) . '/> <div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/messenger_icon_1.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_messenger_options[messenger_icon]" value="messenger_icon_2"' . checked('messenger_icon_2', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/messenger_icon_2.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_messenger_options[messenger_icon]" value="messenger_icon_3"' . checked('messenger_icon_3', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/messenger_icon_3.png" alt="FDC Social Chat"></span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_messenger_options[messenger_icon]" value="messenger_icon_4"' . checked('messenger_icon_4', $this->icon, false) . '/><div class="radio-box"><img src="' . plugins_url() . '/fdc-social-chat/assets/images/messenger_icon_4.png" alt="FDC Social Chat"></span></div></label>';        $html .= '</div>';

        echo $html;

    }

    /**
     * Get Options Function
     */

    public function get_options_value() {
        return $this->options;
    }
}

/**
 * Create a Instance Of Class
 */

$fsc_messegner_options = new fsc_messenger_options();





