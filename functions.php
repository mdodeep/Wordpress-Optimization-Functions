<?php
/**
 * MDWP Optimize
 * MDWP Optimize is code created to help optimize websites using the WordPress CMS to make them faster and improve their performance.
 * Author: Muhammad Dody P. <https://github.com/mdodeep>
 */

/**
 * Disable XML-RPC functionality.
 *
 * @param bool $enabled Indicates whether XML-RPC is enabled or not.
 * @return bool False to disable XML-RPC.
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove WordPress version from the header for security reasons.
 */
remove_action('wp_head', 'wp_generator');

/**
 * Disable ping-backs from XML-RPC to enhance security.
 *
 * @param array $methods Array of XML-RPC methods.
 * @return array Modified array of XML-RPC methods.
 */
add_filter('xmlrpc_methods', function ($methods) {
    unset($methods['pingback.ping']);
    return $methods;
});

/**
 * Set the maximum number of revisions to keep for posts.
 */
if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', 5);

/**
 * Optimize all database tables automatically.
 *
 * Utilizes the wpdb object to execute an OPTIMIZE TABLE command on each table.
 */
function optimize_database()
{
    global $wpdb;
    $tables = $wpdb->get_results("SHOW TABLES");
    foreach ($tables as $table) {
        $table_name = array_values(get_object_vars($table))[0];
        $wpdb->query("OPTIMIZE TABLE $table_name");
    }
}
add_action('wp_scheduled_delete', 'optimize_database');

/**
 * Remove query strings from static resources to enhance loading speed.
 */
function remove_query_strings()
{
    if (!is_admin()) {
        add_filter('script_loader_src', 'remove_query_strings_split', 15);
        add_filter('style_loader_src', 'remove_query_strings_split', 15);
    }
}

/**
 * Split the source URL to remove query strings for caching improvements.
 *
 * @param string $src The source URL of the script or style.
 * @return string Modified URL without query strings.
 */
function remove_query_strings_split($src)
{
    $output = preg_split("/(&ver|\?ver)/", $src);
    return $output[0];
}
add_action('init', 'remove_query_strings');

/**
 * Disable the WordPress Heartbeat API except on admin pages.
 *
 * Reduces server load by deregistering the heartbeat script on the frontend.
 */
function disable_heartbeat()
{
    global $pagenow;
    if ($pagenow != 'admin.php' && $pagenow != 'post.php' && $pagenow != 'post-new.php') {
        wp_deregister_script('heartbeat');
    }
}
add_action('init', 'disable_heartbeat', 1);

/**
 * Disable oEmbed functionality for improved performance.
 *
 * Removes oEmbed discovery links and host JS from the head.
 */
function disable_oembed()
{
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'disable_oembed', 9999);

/**
 * Optimize WP-Cron by disabling it to prevent scheduled tasks from running.
 */
function optimize_wp_cron()
{
    if (!defined('DISABLE_WP_CRON')) {
        define('DISABLE_WP_CRON', true);
    }
}
add_action('init', 'optimize_wp_cron');

/**
 * Customize login error messages for enhanced security.
 *
 * @return string Custom error message.
 */
function no_wordpress_errors()
{
    return 'Something is wrong!';
}
add_filter('login_errors', 'no_wordpress_errors');

/**
 * Optimize admin-ajax requests by skipping jQuery on non-admin pages.
 */
function optimize_admin_ajax()
{
    if (!is_admin() && !in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'))) {
        wp_deregister_script('jquery');
    }
}
add_action('init', 'optimize_admin_ajax');

/**
 * Schedule a daily database optimization event.
 */
function schedule_database_optimization()
{
    if (!wp_next_scheduled('database_optimization_event')) {
        wp_schedule_event(time(), 'daily', 'database_optimization_event');
    }
}
add_action('wp', 'schedule_database_optimization');
add_action('database_optimization_event', 'optimize_database');

/**
 * Disable emoji support in WordPress.
 *
 * Removes emoji scripts and styles from the head and content feeds.
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', 'disable_emojis');

/**
 * Remove query strings from static resources for better caching.
 *
 * @param string $src The source URL of the resource.
 * @return string Modified source URL without query strings.
 */
function remove_query_strings_from_static_resources($src)
{
    if (strpos($src, '?ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}
add_filter('style_loader_src', 'remove_query_strings_from_static_resources', 10, 2);
add_filter('script_loader_src', 'remove_query_strings_from_static_resources', 10, 2);

/**
 * Disable self-pingbacks for blog posts.
 *
 * @param array $links Array of URLs that are being pinged.
 */
function disable_self_pingbacks(&$links)
{
    foreach ($links as $l => $link)
        if (0 === strpos($link, get_option('home')))
            unset($links[$l]);
}
add_action('pre_ping', 'disable_self_pingbacks');

/**
 * Remove RSD (Really Simple Discovery) link from head for security.
 */
remove_action('wp_head', 'rsd_link');

/**
 * Remove wlwmanifest link from head for security.
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Disable Dashicons on the frontend for non-logged-in users.
 */
function dequeue_dashicons()
{
    if (!is_user_logged_in()) {
        wp_deregister_style('dashicons');
    }
}
add_action('wp_enqueue_scripts', 'dequeue_dashicons');

/**
 * Perform weekly database optimization.
 *
 * Optimizes specified tables to improve performance.
 */
function weekly_database_optimization()
{
    global $wpdb;
    $wpdb->query("OPTIMIZE TABLE $wpdb->posts");
    $wpdb->query("OPTIMIZE TABLE $wpdb->postmeta");
    $wpdb->query("OPTIMIZE TABLE $wpdb->options");
    $wpdb->query("OPTIMIZE TABLE $wpdb->comments");
    $wpdb->query("OPTIMIZE TABLE $wpdb->commentmeta");
}
if (!wp_next_scheduled('weekly_db_optimization')) {
    wp_schedule_event(time(), 'weekly', 'weekly_db_optimization');
}
add_action('weekly_db_optimization', 'weekly_database_optimization');

/**
 * Disable autosave feature in the admin area.
 */
function disable_autosave()
{
    wp_deregister_script('autosave');
}
add_action('admin_init', 'disable_autosave');

/**
 * Optimize wp_head by removing unnecessary elements.
 */
remove_action('wp_head', 'wp_shortlink_wp_head', 10);
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');

/**
 * Disable the REST API for non-logged-in users.
 *
 * @param mixed $access The current access status.
 * @return mixed Updated access status.
 */
function disable_rest_api($access)
{
    if (!is_user_logged_in()) {
        return new WP_Error('rest_forbidden', __('REST API restricted.', 'my-text-domain'), array('status' => 401));
    }
    return $access;
}
add_filter('rest_authentication_errors', 'disable_rest_api');

/**
 * Limit login attempts to prevent brute force attacks.
 */
function limit_login_attempts()
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $login_attempts = get_transient($ip_address);

    if ($login_attempts >= 3) { // Limit to 3 attempts
        wp_die('Too many login attempts. Please try again later.');
    }
}
add_action('wp_login_failed', 'limit_login_attempts');
