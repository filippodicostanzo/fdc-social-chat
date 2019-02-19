<?php
/**
 *
 * Created by Filippo Di Costanzo
 * Load Scripts for FDC Social Chat
 *
 */


/**
 * Exit if Accessed Directly
 */

if (!defined('ABSPATH')) exit;

/**
 * If Class Not Exist
 */

if (!class_exists('fsc_add_styles_scripts')) :

    class fsc_add_styles_scripts
    {

        /**
         * Class Constructor
         */

        public function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'fsc_admin_script'));
            add_action('wp_enqueue_scripts', array($this, 'fsc_front_scripts'));
        }

        /**
         * Add Scripts Front End
         */

        public function fsc_front_scripts()
        {
            wp_enqueue_style('fsc-main-style', plugins_url() . '/fdc-social-chat/assets/scss/style.css');
            wp_enqueue_script('fsc-main-script', plugins_url() . '/fdc-social-chat/assets/js/script.js');
        }

        /**
         * Add Scripts Back End
         */

        public function fsc_admin_script()
        {
            wp_enqueue_style('fsc-admin-style', plugins_url() . '/fdc-social-chat/assets/scss/admin.css');
            wp_enqueue_style('fsc-fontawesome-style', 'https://use.fontawesome.com/releases/v5.7.1/css/all.css');
            wp_enqueue_script('fsc-validate-script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js');
            wp_enqueue_script('fsc-admin-script', plugins_url() . '/fdc-social-chat/assets/js/admin.js');
        }
    }

endif;

/**
 * Create a Instance Of Class
 */


$fsc_add_styles_scripts = new fsc_add_styles_scripts();