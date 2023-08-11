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

function devnodes_wp_dashboard_setup()
{
    // Widget slug., Widget Title, function
    wp_add_dashboard_widget('devnodes_dash_user_info', esc_html__('User Information | Devnodes.in', 'devnodes'), 'func_devnodes_dash_user_info');
    wp_add_dashboard_widget('devnodes_dash_order_search', esc_html__('Search Orders | Devnodes.in', 'devnodes'), 'devnodes_dash_order_search');
}
add_action('wp_dashboard_setup', 'devnodes_wp_dashboard_setup');



/**
 * Create the function to output the content of our Dashboard Widget.
 */
function func_devnodes_dash_user_info()
{
    // Display whatever you want to show.
    $user_count_data = count_users();

    $html = '<b>Total Users: </b>' . $user_count_data['total_users'] . '<br><hr>';
    foreach ($user_count_data['avail_roles'] as $role => $count) {
        $html .= '<b>' . $role . ': </b>' . $count . '<br>';
    }

    // Get the users with the administrator role
    $args = array(
        'role' => 'administrator',
        'orderby' => 'user_login',
        'order' => 'ASC'
    );
    $users = get_users($args);

    $html .= '<hr><b>Admin users:</b><br>';
    // Loop through the users and display their information
    foreach ($users as $user) {
        $html .= $user->user_login . '[' . $user->user_email . ']<br>';
    }

    echo $html;
}



function devnodes_dash_order_search()
{
    //http://wp.localhost/wp-admin/edit.php?s=FDW230007&post_status=all&post_type=shop_order
    ?>
    <form action="<?php echo admin_url('edit.php'); ?>" method="get">
        <input type="search" name="s" placeholder="Order ID, Tracking ID, etc." />
        <input type="hidden" name="post_type" value="shop_order" />
        <input type="hidden" name="post_status" value="all" />
        <input class="button button-primary" type="submit" value="Search" />
    </form>
    <?php
}