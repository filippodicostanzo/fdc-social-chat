<?php

/**
 *
 * Created by Filippo Di Costanzo
 * Layout Options Sections
 *
 */

/**
 * Create Class
 */
class fsc_layout_options
{

    private $options;
    private $position;
    private $size;
    private $margin;
    private $enable_mobile;
    private $size_mobile;
    private $margin_mobile;
    private $description;
    private $default_value;


    /**
     * Class Constructor
     */

    public function __construct()
    {
        add_action('admin_init', array($this, 'fsc_layout_options_init'));

        $this->position = 'bottom_left';
        $this->size = 128;
        $this->margin = 10;
        $this->enable_mobile = false;
        $this->size_mobile = 48;
        $this->margin_mobile = 10;
        $this->description = 'The settings of Layout Social Chat';
        $this->default_value = [
            'layout_size' => $this->size,
            'layout_margin' => $this->margin,
            'layout_position' => $this->position,
            'layout_mobile_enable' => $this->enable_mobile,
            'layout_size_mobile' => $this->size_mobile,
            'layout_margin_mobile' => $this->margin_mobile

        ];

        $this->options = get_option('fsc_layout_options', $this->default_value);
    }


    /**
     * Initialize Variables
     */

    public function initialize_variable()
    {
        $this->position = 'bottom_left';
        $this->size = 128;
        $this->margin = 10;
        $this->enable_mobile = false;
        $this->size_mobile = 48;
        $this->margin_mobile = 10;
        $this->description = 'The settings of Layout Social Chat';

    }

    public function save_initial_variable()
    {

        update_option('fsc_layout_options[\'layout_size\']', $this->size);

    }


    /**
     * Create Settings Section e Settings Fields
     */

    public function fsc_layout_options_init()
    {

        $this->initialize_variable();

        if (false == $this->options) {
            add_option('fsc_layout_options');
        }


        add_settings_section(
            'layout_settings_section',
            'Layout Options',
            array($this, 'fsc_layout_options_callback'),
            'fsc_layout_options'
        );

        add_settings_field(
            'layout_size',
            'Size',
            array($this, 'layout_size_callback'),
            'fsc_layout_options',
            'layout_settings_section'
        );


        add_settings_field(
            'layout_position',
            'Position',
            array($this, 'layout_position_callback'),
            'fsc_layout_options',
            'layout_settings_section'
        );

        add_settings_field(
            'layout_margin',
            'Margin',
            array($this, 'layout_margin_callback'),
            'fsc_layout_options',
            'layout_settings_section'
        );

        add_settings_field(
            'layout_mobile_enable',
            'Enable Mobile',
            array($this, 'mobile_enable_callback'),
            'fsc_layout_options',
            'layout_settings_section',
            array(
                'Activate this setting to display on Mobile.'
            )
        );

        add_settings_field(
            'layout_size_mobile',
            'Mobile Size',
            array($this, 'layout_size_mobile_callback'),
            'fsc_layout_options',
            'layout_settings_section'
        );

        add_settings_field(
            'layout_margin_mobile',
            'Mobile Margin',
            array($this, 'layout_margin_mobile_callback'),
            'fsc_layout_options',
            'layout_settings_section'
        );

        register_setting(
            'fsc_layout_options',
            'fsc_layout_options',
            'sanitize_text_input'
        );

    }


    /**
     * Callback Function For Description
     */

    public function fsc_layout_options_callback()
    {
        echo $this->description;
    }


    /**
     * Callback Function For Layout Size
     */

    function layout_size_callback()
    {
        if (isset($this->options['layout_size'])) {
            $this->size = $this->options['layout_size'];
        }


        echo '<input type="text" id="layout_size" name="fsc_layout_options[layout_size]" value="' . $this->size . '" placeholder="128" />';
    }


    /**
     * Callback Function For Layout Position
     */

    public function layout_position_callback()
    {

        if (isset($this->options['layout_position'])) {
            $this->position = $this->options['layout_position'];
        }

        $html = '';
        $html .= '<div class="radio-position">';
        $html .= '<label> <input type="radio" name="fsc_layout_options[layout_position]" value="top_left"' . checked('top_left', $this->position, false) . '/> <div class="radio-box"><span>Top Left</span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_layout_options[layout_position]" value="top_right"' . checked('top_right', $this->position, false) . '/><div class="radio-box"><span>Top Right</span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_layout_options[layout_position]" value="bottom_left"' . checked('bottom_left', $this->position, false) . '/><div class="radio-box"><span>Bottom Left</span></div></label>';
        $html .= '<label> <input type="radio" name="fsc_layout_options[layout_position]" value="bottom_right"' . checked('bottom_right', $this->position, false) . '/><div class="radio-box"><span>Bottom Right</span></div></label>';
        $html .= '</div>';

        echo $html;

    }


    /**
     * Callback Function For Layout Margin
     */

    public function layout_margin_callback()
    {
        if (isset($this->options['layout_margin'])) {
            $this->margin = $this->options['layout_margin'];
        }

        echo '<input type="text" id="layout_margin" name="fsc_layout_options[layout_margin]" value="' . $this->margin . '" placeholder="10" />';
    }


    /**
     * Callback Function For Mobile Enable
     */

    public function mobile_enable_callback($args)
    {

        if (isset($this->options['layout_mobile_enable'])) {
            $this->enable = $this->options['layout_mobile_enable'];
        }

        $html = '<input type="checkbox" id="layout_mobile_enable" name="fsc_layout_options[layout_mobile_enable]" value="1" ' . checked(1, $this->enable, false) . '/>';

        $html .= '<label for="layout_mobile_enable"> ' . $args[0] . '</label>';

        echo $html;

    }


    /**
     * Callback Function For Mobile Size
     */

    public function layout_size_mobile_callback()
    {
        if (isset($this->options['layout_size_mobile'])) {
            $this->size_mobile = $this->options['layout_size_mobile'];
        }

        echo '<input type="text" id="layout_size_mobile" name="fsc_layout_options[layout_size_mobile]" value="' . $this->size_mobile . '" placeholder="48" />';
    }


    /**
     * Callback Function For Mobile Margin
     */

    public function layout_margin_mobile_callback()
    {
        if (isset($this->options['layout_margin_mobile'])) {
            $this->margin_mobile = $this->options['layout_margin_mobile'];
        }

        echo '<input type="text" id="layout_margin_mobile" name="fsc_layout_options[layout_margin_mobile]" value="' . $this->margin_mobile . '" placeholder="10" />';
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

$fsc_layout_options = new fsc_layout_options();


