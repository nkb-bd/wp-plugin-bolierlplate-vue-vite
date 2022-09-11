<?php
/**
 * Plugin Name: Lite Plugin Test
 * Version: 1.0.0
 * Plugin URI: #
 * Description: This is your starter template for your next WordPress plugin.
 * Author: KingsOofLeon
 * Author URI: #
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: wordpress-plugin-template
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Hugh Lashbrooke
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}


define('LITE_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('LITE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('LITE_PLUGIN_BASE', plugin_basename(__FILE__));
define('IS_VITE_DEVELOPMENT', true);

require_once plugin_dir_path(__FILE__) . 'loader.php';





