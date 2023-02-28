<?php

include('includes/functions.php');

/*
 * Removing actions that activates with wp_head Function
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head',      'rest_output_link_wp_head');
remove_action('wp_head',      'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11);

/*
 * IF you are NOT using Woocommerce, you may disable this.
 */
// Remove the REST API endpoint.
remove_action('rest_api_init', 'wp_oembed_register_route');
// Turn off oEmbed auto discovery.
add_filter('embed_oembed_discover', '__return_false');
// Don't filter oEmbed results.
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
// Remove oEmbed discovery links.
remove_action('wp_head', 'wp_oembed_add_discovery_links');
// Remove oEmbed-specific JavaScript from the front-end and back-end.
remove_action('wp_head', 'wp_oembed_add_host_js');
// Remove all embeds rewrite rules.
//add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites');

/*
 * Register my Menu
 */
function register_my_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu'),
        )
    );
}
add_action('init', 'register_my_menus');

/*
* Create a new roll call developer
*/
add_role('developer', 'Developer', get_role('administrator')->capabilities);

function get_poster_avatar()
{
    return get_template_directory_uri() . "/img/Sin_datos.jpg";
}
