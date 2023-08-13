<?php
/**
 * Plugin Name:       Devnodes Dashboard Widget
 * Plugin URI:        https://github.com/thalib/woocommerce-devnodes-dashboard
 * Description:       Open Source Custom Dashboard Status Widget
 * Version:           1.3.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Devnodes.in
 * Author URI:        https://devnodes.in
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://github.com/thalib/woocommerce-devnodes-dashboard
 * Text Domain:       devnodes
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

if (is_admin() && !function_exists('devnodes_dashboard_widget')) {
    // we are in admin mode //only on Backend UI

    require_once plugin_dir_path(__FILE__) . 'includes/class_Devnodes_Widgets.php';

    function devnodes_dashboard_widget()
    {
        $plugin = new Devnodes_Widgets();
    }

    devnodes_dashboard_widget();
}