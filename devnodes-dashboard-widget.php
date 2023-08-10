<?php
/**
 * Plugin Name:       Devnodes Dashboard Widget
 * Plugin URI:        https://github.com/thalib/woocommerce-devnodes-dashboard
 * Description:       Open Source Custom Dashboard Status Widget
 * Version:           1.0.0
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

function devnodes_wp_dashboard_setup() {
	
	// Widget slug., Widget Title, function
	wp_add_dashboard_widget('devnodes_dash_welcome', esc_html__( 'User Information | Devnodes.in', 'devnodes' ),'func_devnodes_dash_widget_user' ); 
}
add_action( 'wp_dashboard_setup', 'devnodes_wp_dashboard_setup' );


/**
 * Create the function to output the content of our Dashboard Widget.
 */
function func_devnodes_dash_widget_user() {
	// Display whatever you want to show.
    $user_count_data = count_users();

    $html = '<b>Total Users: </b>' . $user_count_data['total_users'] . '<br><hr>';
    foreach ($user_count_data['avail_roles'] as $role => $count) {
        $html .= '<b>' . $role . ': </b>' . $count . '<br>';
    }

    // Get the users with the administrator role
    $args = array(
        'role'    => 'administrator',
        'orderby' => 'user_login',
        'order'   => 'ASC'
    );
    $users = get_users( $args );

    $html .= '<hr><b>Admin users:</b><br>';
    // Loop through the users and display their information
    foreach ( $users as $user ) {   
        $html .= $user->user_login . '[' . $user->user_email . ']<br>';
    }

    echo $html;
}