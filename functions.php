<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'streamline', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'streamline' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Streamline Pro Theme', 'streamline' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/streamline/' );
define( 'CHILD_THEME_VERSION', '3.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'streamline_load_scripts' );
function streamline_load_scripts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Covered+By+Your+Grace|Handlee|Bitter:400,400italic,700', array(), CHILD_THEME_VERSION );

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'streamline-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

}

//* Add custom shortcodes
include('lib/shortcodes.php');

//* Add custom post type
include('lib/post-types.php');

//* Add new image sizes
add_image_size( 'post-image', 760, 360, TRUE );
add_image_size( 'widget-image', 295, 100, TRUE );

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

/**
 * Remove Genesis Page Templates
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function be_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'be_remove_genesis_page_templates' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header_image'    => '',
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 75,
	'width'           => 576,
) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'streamline_secondary_menu_args' );
function streamline_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );

//* Customize breadcrumbs display
add_filter( 'genesis_breadcrumb_args', 'streamline_breadcrumb_args' );
function streamline_breadcrumb_args( $args ) {
	$args['home'] = __( 'Home', 'streamline' );
	$args['sep'] = ' ';
	$args['list_sep'] = ', '; // Genesis 1.5 and later
	$args['prefix'] = '<div class="breadcrumb">';
	$args['suffix'] = '</div>';
	$args['labels']['prefix'] = '<span class="home-icon"></span>';
	return $args;
}

//* Remove default post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Add post image above post title
add_action( 'genesis_entry_header', 'streamline_post_image', 1 );
function streamline_post_image() {

	if ( is_page() || ! genesis_get_option( 'content_archive_thumbnail' ) )
		return;
	
	if ( $image = genesis_get_image( array( 'format' => 'url', 'size' => genesis_get_option( 'image_size' ) ) ) ) {
		printf( '<a href="%s" rel="bookmark"><img class="post-photo" src="%s" alt="%s" /></a>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}
	
}

//* Reposition the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 2 );

//* Customize the post info function
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter( $post_info ) {

	if ( !is_page() ) {
    	$post_info = '[post_author_posts_link] [post_date] [post_comments] [post_edit]';
    	return $post_info;
	}
	
}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'streamline_author_box_gravatar_size' );
function streamline_author_box_gravatar_size( $size ) {

    return '80';
    
}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'streamline_remove_comment_form_allowed_tags' );
function streamline_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;
	
}

//* Remove Post Titles from all pages
add_action( 'get_header', 'remove_titles_all_single_pages' );
function remove_titles_all_single_pages() {
    if ( is_singular('page') ) {
        remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
    }
}

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_entry_footer', 'genesis_after_entry_widget_area' );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-featured-1',
	'name'        => __( 'Home - Featured', 'streamline' ),
	'description' => __( 'This is the main homepage featured section. Intended to be used with "Image Slider Lite" plugin.', 'streamline' ),
) );

//* Modify Footer Copyright Text
add_filter( 'genesis_footer_creds_text', 'custom_footer_kan' );
function custom_footer_kan() {

	return '<div class="custom-footer-text">
	Find us on <a href="https://www.instagram.com/drivingmizdaisy/">Instagram</a> & <a href="https://www.facebook.com/drivingmizdaisy">Facebook</a>
	<hr>
	Managed with <span style="color:#ff6b50;">&hearts;</span> by Char & Shelly
	</div>';
}

//* Stop Contact Form 7 CSS from loading
//* Styles are inside of theme's style.css instead
add_filter( 'wpcf7_load_css', '__return_false' );