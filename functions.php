<?php

function remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}

add_theme_support('post-thumbnails');

add_action('get_header', 'remove_admin_login_header');

function isa_remove_jquery(&$scripts)
{
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array(
            'jquery-core'
        ), '1.12.4');
    }
}
add_filter('wp_default_scripts', 'isa_remove_jquery');

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
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('material');
    wp_enqueue_script('flex_menu');
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
 
    $words = str_word_count( strip_tags( $post->post_content ) );
    $minutes = floor( $words / 220 );
    
    $estimated_time = $minutes . ' минут' . (((substr($minutes, -1) == 1) && (substr($minutes, -2, 1) > 1)) ? 'а' : '') . (((2 <= substr($minutes, -1)) && (substr($minutes, -1) <= 4) && (substr($minutes, -2, 1) > 1)) ? 'ы':'');    
 
    return $estimated_time;
}

function load_more_js(){
    wp_enqueue_script( 'myloadmore', get_template_directory_uri() . '/assets/js/myloadmore.js' );     
    $ajaxData = array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'noposts' => __('No older posts found', 'yo')
    );
    wp_localize_script( 'myloadmore', 'php_vars', $ajaxData );
}
add_action('wp_enqueue_scripts', 'load_more_js', 4, 1);

function more_post_ajax(){

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    header("Content-Type: text/html");

    $args = array(
        'suppress_filters' => true,
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'paged'    => $page,
    );

    $loop = new WP_Query($args);

    $out = '';

    if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
        $out .=  '<article class="article-item"><div class="article__thumb" style="background-image:url(' . get_the_post_thumbnail_url() . ');"></div><h2 class="article__title">' . get_the_title() . '</h2><div class="article__excerpt">' . get_the_excerpt() . '</div><div class="article__controls"><span class="date"><i class="material-icons">&#xE916;</i><span>' . get_the_date() . '</span></span><span class="views"><i class="material-icons">&#xE417;</i><span>' . getPostViews(get_the_ID()) . '</span></span><span class="comments"><i class="material-icons">&#xE24C;</i><span>' . get_comments_number( '0', '1', '%' ) . '</span></span></div><div class="article__tags"><i class="material-icons">&#xE892;</i>' . get_the_tag_list() . '</div></article>';

    endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}


add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

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
?>