<?php

/**
 * Plugin Name: FDC Social Chat
 * Description: Add a button for social chat like Whatsapp, Messenger, Email
 * Version: 1.0
 * Author: Filippo Di Costanzo
 *
 */

/**
 * Exit if Accessed Directly
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load Scripts
 */
require_once(plugin_dir_path(__FILE__) . 'includes/fdc-social-chat-scripts.php');

/**
 * Load Content
 */

require_once(plugin_dir_path(__FILE__) . 'includes/fdc-social-chat-content.php');

/**
 * Load Settings
 */

if (is_admin()) {
    require_once(plugin_dir_path(__FILE__) . 'includes/fdc-social-chat-settings.php');
}
