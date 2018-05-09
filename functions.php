<?php


define('THEME_NAME', 'YottosBlog');
define('THEME_INFO', 'http://yottos.com/');

add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_action('after_setup_theme', function(){
	if ( ! is_admin() && ! current_user_can('manage_options') )
		show_admin_bar( false );
});

// include Admin Files
locate_template('/includes/admin/theme-settings.php', true);
locate_template('/includes/admin/theme-admin.php', true);

function enqueue_styles()
{
    wp_enqueue_style('yo-style', get_stylesheet_uri());
    wp_register_style('font-style', 'http://fonts.googleapis.com/css?family=Roboto:700,600,400,300');
    wp_register_style('bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    wp_enqueue_style('font-style');
    wp_enqueue_style('bootstrap-style');
}

add_action('wp_enqueue_scripts', 'enqueue_load_fa');
function enqueue_load_fa()
{
    wp_enqueue_style('load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}

add_action('wp_enqueue_scripts', 'enqueue_material_icons');
function enqueue_material_icons()
{
    wp_enqueue_style('load-material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
}

add_action('wp_enqueue_scripts', 'enqueue_styles');

function enqueue_scripts()
{
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(), null, true);
    wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
    wp_register_script('material', 'https://code.getmdl.io/1.3.0/material.min.js');
    wp_register_script('flex_menu', 'https://cdnjs.cloudflare.com/ajax/libs/flexMenu/1.4.2/flexmenu.min.js');
    wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js');
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('material');
    wp_enqueue_script('flex_menu');
    wp_enqueue_script('recaptcha');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts', 2, 1);

function yo_scripts()
{
    wp_register_script('yo-script', get_template_directory_uri() . '/assets/js/main.js');
    wp_enqueue_script('yo-script');
    wp_register_script('yo-popups', get_template_directory_uri() . '/assets/js/popups.js');
    wp_enqueue_script('yo-popups');
}
add_action('wp_enqueue_scripts', 'yo_scripts', 3, 1);

// function to display number of posts.
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}

// function to count views.
function setPostViews($postID)
{
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views', 5, 2);
function posts_column_views($defaults)
{
    $defaults['post_views'] = __('Views');
    return $defaults;
}
function posts_custom_column_views($column_name, $id)
{
    if ($column_name === 'post_views') {
        echo getPostViews(get_the_ID());
    }
}
function wpb_move_comment_field_to_bottom($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'wpb_move_comment_field_to_bottom');

function estimated_reading_time() { 
    $post = get_post();
    $words = substr_count( "( strip_tags( $post->post_content ) ) ", ' ' );
    $minutes = round( $words / 190);    
    $estimated_time = $minutes . ' мин.';
    return $estimated_time;
}


function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}
 
add_filter('pre_get_posts','SearchFilter');


function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'top_dropdown' => __( 'Top dropdown menu' ),
      'main_nav' => __( 'Main navigation' )
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );


function social_media_icons( $contactmethods ) {
    // Add social media
    $contactmethods['vkontakte'] = 'VKontakte link';
    $contactmethods['facebook'] = 'Facebook link';
    $contactmethods['linkedin'] = 'Linkedin link';

    return $contactmethods;
}
add_filter('user_contactmethods','social_media_icons',10,1);


function new_excerpt_more($more) {
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');


function add_async_defer_attribute($tag, $handle) {
	return str_replace( ' src', ' async defer src', $tag );
}
?>