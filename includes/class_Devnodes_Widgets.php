<?php

/**
 * The Devnodes_Widgets class.
 * Collection of useful dash board widgets for woocommerce shop
 */
class Devnodes_Widgets
{
  public function __construct()
  {
    add_action('wp_dashboard_setup', array($this, 'dashboard_widget_init'));
  }

  public function dashboard_widget_init()
  {
    wp_add_dashboard_widget(
      'devnodes_dash_user_info',
      esc_html__('User Information | Devnodes.in', 'devnodes'),
      array($this, 'widget_user_stats')
    );

    wp_add_dashboard_widget(
      'devnodes_dash_order_search',
      esc_html__('Search Orders | Devnodes.in', 'devnodes'),
      array($this, 'widget_order_search')
    );
  }
  /**
   * Creates an admin dashboard widget that gives quick view of user stats.
   * 
   * This widget displays total users, and user count for each role.
   * and a list of all users with the administrator role. 
   * This makes it easy to monitor the admin user list and check for 
   * any suspicious activity, such as role elevation or unauthorized access.
   */
  public function widget_user_stats()
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

  /**
   * Creates a admin dashboard widget that allows users to search for shop orders
   * This function can be used by shop admins who need to search for orders in their WooCommerce store. 
   * It is a quick and easy way to find orders by order ID, tracking ID, or other criteria.
   * 
   * http://wp.localhost/wp-admin/edit.php?s=FDW230007&post_status=all&post_type=shop_order
   */
  public function widget_order_search()
  {
    ?>
    <form action="<?php echo admin_url('edit.php'); ?>" method="get">
      <input type="search" name="s" placeholder="Order ID, Tracking ID, etc." />
      <input type="hidden" name="post_type" value="shop_order" />
      <input type="hidden" name="post_status" value="all" />
      <input class="button button-primary" type="submit" value="Search" />
    </form>
    <?php
  }
}