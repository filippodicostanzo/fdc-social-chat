<?php

/**
 *
 * Created by Filippo Di Costanzo
 * Global Setting of FDC Social Chat
 *
 */


/**
 * Exit if Accessed Directly
 */

if (!defined('ABSPATH')) exit;


/**
 * If Not Class Exist
 */

if (!class_exists('fsc_settings')) :

    /**
     * Create Class
     */

    class fsc_settings
    {
        /**
         * Class Constructor
         */

        public function __construct()
        {
            $this->includes();
            add_action('admin_menu', array($this, 'fsc_options_menu_link'));

        }

        /**
         * Require a Partial Scripts
         */

        private function includes()
        {
            require_once('partial/fdc-social-chat-whastapp.php');
            require_once('partial/fdc-social-chat-messenger.php');
            require_once('partial/fdc-social-chat-mail.php');
            require_once('partial/fdc-social-chat-layout.php');
            require_once('partial/fdc-social-chat-order.php');
        }

        /**
         * Create a Menu Link
         */

        public function fsc_options_menu_link()
        {
            add_options_page(
                'FDC Social Chat',
                'FDC Social Chat',
                'manage_options',
                'fsc_options',
                array($this, 'fsc_options_content')
            );
        }

        /**
         * General Page Options
         */

        public function fsc_options_content()
        {
            ob_start();


            ?>

            <div class="wrap">

                <div id="icon-themes" class="icon32"></div>
                <h2>FDC Social Chat</h2>
                <?php settings_errors(); ?>

                <?php
                $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'whatsapp_options';
                ?>

                <h2 class="nav-tab-wrapper">
                    <a href="?page=fsc_options&tab=whatsapp_options"
                       class="nav-tab <?php echo $active_tab == 'whatsapp_options' ? 'nav-tab-active' : ''; ?>">Whatsapp
                        Options</a>
                    <a href="?page=fsc_options&tab=messenger_options"
                       class="nav-tab <?php echo $active_tab == 'messenger_options' ? 'nav-tab-active' : ''; ?>">Messenger
                        Options</a>

                    <a href="?page=fsc_options&tab=mail_options"
                       class="nav-tab <?php echo $active_tab == 'mail_options' ? 'nav-tab-active' : ''; ?>">Mail
                        Options</a>

                    <a href="?page=fsc_options&tab=layout_options"
                       class="nav-tab <?php echo $active_tab == 'layout_options' ? 'nav-tab-active' : ''; ?>">Layout
                        Options</a>

                    <a href="?page=fsc_options&tab=order_options"
                       class="nav-tab <?php echo $active_tab == 'order_options' ? 'nav-tab-active' : ''; ?>">Order
                        Options</a>
                </h2>

                <form method="post" action="options.php" id="fsc_form">
                    <?php

                    if ($active_tab == 'whatsapp_options') {
                        settings_fields('fsc_whatsapp_options');
                        do_settings_sections('fsc_whatsapp_options');
                    } else if ($active_tab == 'messenger_options') {
                        settings_fields('fsc_messenger_options');
                        do_settings_sections('fsc_messenger_options');
                    }
                    else if ($active_tab == 'mail_options') {
                        settings_fields('fsc_mail_options');
                        do_settings_sections('fsc_mail_options');
                    }
                    else if ($active_tab == 'layout_options') {
                        settings_fields('fsc_layout_options');
                        do_settings_sections('fsc_layout_options');
                    }
                    else {
                        settings_fields('fsc_order_options');
                        do_settings_sections('fsc_order_options');
                    }

                    submit_button();

                    ?>
                </form>

            </div>
            <?php
            echo ob_get_clean();
        }


        /**
         * Sanitize Function for Sanitize Data
         */

        public function sanitize_text_input($input)
        {

            $output = array();

            foreach ($input as $key => $val) {

                if (isset ($input[$key])) {
                    $output[$key] = _sanitize_text_fields($input[$key], true);
                }

            }

            return apply_filters('sanitize_text_input', $output, $input);
        }

    }

endif;


/**
 * Create a Instance Of Class
 */

$fsc_settings = new fsc_settings();


?>
