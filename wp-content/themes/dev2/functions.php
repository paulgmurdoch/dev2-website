<?php
/* Remove Contact Form 7 Links from dashboard menu items if not admin */
    if (!(current_user_can('administrator'))) {
	function remove_wpcf7() {
	    remove_menu_page( 'wpcf7' ); 
	}

	add_action('admin_menu', 'remove_wpcf7');
     }
// Register Custom Navigation Walker

// Stop wordpress creating extra markup
remove_filter( 'the_content', 'wpautop' ); 
remove_filter( 'the_excerpt', 'wpautop' );

add_theme_support( 'post-thumbnails' );

function bs_categories_list_group_filter ($variable) {
   $variable = str_replace('(', '<span class="count"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
add_filter('wp_list_categories','bs_categories_list_group_filter');

function add_theme_scripts() {
  wp_enqueue_style( 'style', get_stylesheet_uri() );

  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );

  wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/custom.css');
  

  //wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array ( 'jquery' ), 1.1, true);
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

add_filter('posts_orderby', 'posts_orderby');

  function posts_orderby($orderby_for_query) {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $orderby_for_query = "LEFT(" . $prefix . "posts.post_date, 10) DESC, " . $orderby_for_query;
        return $orderby_for_query;
    }   

function register_menus() {
  register_nav_menus(
    array(
      'header'          => __( 'Header' ),
      'footer'          => __( 'Footer' ),
      'primary-mobile'  => __('Primary Mobile Menu')
    )
  );
}
add_action( 'init', 'register_menus' );

function widgets_init() {

	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar',
		'before_widget' => '<div class="sidebar-item">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );
  

}
add_action( 'widgets_init', 'widgets_init' );
 
function wp_post_thumbnail( $html, $post_id, $post_image_id ) {
  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
  return $html;
}
add_filter( 'post_thumbnail_html', 'wp_post_thumbnail', 10, 3 );

 /*
  *
  * The below section is in need of ACF PRO
  * to be a function section in this project
  *
  */

// if( function_exists('acf_add_options_page') ) {
	
//   acf_add_options_page();
//   acf_add_options_page(array(
//         'page_title'   => 'Home Page Settings',
//         'menu_title'   => 'Home Page',
//         'menu_slug'    => 'theme-home-page-edit',
//         'capability'   => 'edit_posts',
//         'position'     => null,
//         'redirect'     => false
//   ));
// }

