<?php
// Theme Setup //
	$themename = "CleanSpace";
$shortname = "cs";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category"); 
	if (!isset($content_width))
		$content_width = 980;

			
		
		
		if (function_exists('add_theme_support')) {
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		
	}
	if(!function_exists("get_custom_body_classes")) {
	function get_custom_body_classes() {
		$classes = array();

	}}



/*--------------------------*
/* Image Sizes
/*--------------------------*/

add_image_size('Blog Pic', 555, 242, true);
add_image_size('Home Pic', 280, 120, true);
add_image_size('Client Pic', '', 50, true);
add_image_size('Portfolio Pic', 379, 183, true);
add_image_size('Portfolio 3 Pic', 280, 150, true);
add_image_size('Portfolio Overlay', 600, 500, true);
add_image_size('Home Small', 52, 52, true);
add_image_size('Slider Pic', 764, 236, true);

/*--------------------------*
/*  Register Sidebars
/*--------------------------*/

if ( function_exists('register_sidebar') )
register_sidebar(array(
        'name' => 'Home',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
));
register_sidebar(array(
        'name' => 'Sidebar',
        'before_widget' => '',
        'after_widget' => '<img src="'.get_template_directory_uri().'/images/divline.png" />',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
));
register_sidebar(array(
        'name' => 'Tour',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
));
register_sidebar(array(
        'name' => 'Contact',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
));
register_sidebar(array(
'name' => 'Footer',
'before_widget' => '<div class="box">',
'after_widget' => '</div>',
'before_title' => '<h5>',
'after_title' => '</h5>',
));

/*--------------------------*
/*  Register Post Types
/*--------------------------*/

register_post_type('slider', array(
  'label' => __('Slider', 'cs'),
  'singular_label' => __('Slider', 'cs'),
  'public' => true,
  'show_ui' => true,
  'capability_type' => 'post',
  'hierarchical' => false,
  'rewrite' => array('slug' => 'slider'),
  'query_var' => false,
  'menu_icon' => get_template_directory_uri(). '/functions/images/slide-ico.png',
  'supports' => array('title', 'editor', 'author', 'custom-fields','thumbnail')
));

register_post_type('tour', array(
  'label' => __('Tour', 'cs'),
  'singular_label' => __('Tour Page', 'cs'),
  'public' => true,
  'show_ui' => true,
  'capability_type' => 'post',
  'hierarchical' => false,
  'rewrite' => array('slug' => 'tour'),
  'query_var' => false,
  'menu_icon' => get_template_directory_uri(). '/functions/images/tour-ico.png',
  'supports' => array('title', 'editor', 'author','thumbnail')
));

register_post_type('clients', array(
  'label' => __('Clients', 'cs'),
  'singular_label' => __('Client Logos', 'cs'),
  'public' => true,
  'show_ui' => true,
  'capability_type' => 'post',
  'hierarchical' => false,
  'rewrite' => array('slug' => 'clients'),
  'query_var' => false,
  'menu_icon' => get_template_directory_uri(). '/functions/images/clients-ico.png',
  'supports' => array('title', 'editor', 'author','thumbnail')
));

register_post_type('testimonials', array(
  'label' => __('Testimonials', 'cs'),
  'singular_label' => __('Testimonials', 'cs'),
  'public' => true,
  'show_ui' => true,
  'capability_type' => 'post',
  'hierarchical' => false,
  'rewrite' => array('slug' => 'testimonials'),
  'query_var' => false,
  'menu_icon' => get_template_directory_uri(). '/functions/images/testimonials-ico.png',
  'supports' => array('title', 'editor', 'author')
));

register_post_type('portfolio', array(
  'label' => __('Portfolio', 'cs'),
  'singular_label' => __('Portfolio', 'cs'),
  'public' => true,
  'show_ui' => true,
  'capability_type' => 'post',
  'hierarchical' => false,
  'rewrite' => array('slug' => 'portfolio'),
  'query_var' => false,
  'menu_icon' => get_template_directory_uri(). '/functions/images/port-ico.png',
  'supports' => array('title', 'editor', 'author','thumbnail','custom-fields','excerpt'),
  'taxonomies' => array('category', 'post_tag')
  
  
));


register_post_type('pricetable',array(
	'labels' => array(
	'name' => __('Price Tables', 'pricetable'),
	'singular_name' => __('Price Table', 'pricetable'),
	'add_new' => __('Add New', 'book', 'pricetable'),
	'add_new_item' => __('Add New Price Table', 'pricetable'),
	'edit_item' => __('Edit Price Table', 'pricetable'),
	'new_item' => __('New Price Table', 'pricetable'),
	'all_items' => __('All Price Tables', 'pricetable'),
	'view_item' => __('View Price Table', 'pricetable'),
	'search_items' => __('Search Price Tables', 'pricetable'),
	'not_found' =>  __('No Price Tables found', 'pricetable'),
	'not_found' =>  __('No price tables found', 'pricetable'),
	),
	'public' => true,
	'has_archive' => false,
	'supports' => array( 'title', 'editor', 'revisions', 'thumbnail', 'excerpt' ),
	'menu_icon' => get_template_directory_uri(). '/shortcodes/ptable/images/icon.png', __FILE__,
	));

add_action('init', 'portfolio_add_default_boxes');

function portfolio_add_default_boxes() {
   
    register_taxonomy_for_object_type('post_tag', 'portfolio');
	register_taxonomy("portfolio_categories", array("portfolio"), array("hierarchical" => true, "label" => "Portfolio Categories", "rewrite" => true));
}
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('post','portfolio','nav_menu_item'); // replace cpt to your custom post type
    $query->set('post_type',$post_type);
	return $query;
    }
}

/*--------------------------*
/* Update jQuery
/*--------------------------*/

function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
 
add_action('wp_enqueue_scripts', 'my_scripts_method');


/*--------------------------*
/* Register Scripts
/*--------------------------*/
if(!function_exists("cs_scripts")) {
	function cs_scripts() {
		 if( is_admin() )
        return;
		$script_directory = get_template_directory_uri();
	
		wp_register_script( 'easing', $script_directory. '/js/jquery.easing.1.3.js',  array( 'jquery') );
		wp_register_script( 'asyncslider-min', $script_directory. '/js/jquery.asyncslider.min.js',  array( 'jquery') );
		wp_register_script( 'asyncslider', $script_directory. '/js/jquery.asyncslider.js',  array( 'jquery' ) );
		wp_register_script( 'tweet', $script_directory. '/js/jquery.tweet.js',  array( 'jquery' ) );
		wp_register_script( 'tabs', $script_directory. '/js/tabs.js',  array( 'jquery' ) );
		wp_register_script( 'isotope', $script_directory. '/js/jquery.isotope.min.js',  array( 'jquery' ) );
		wp_register_script( 'custom', $script_directory. '/js/jquery.custom.js', 'jquery' );
		
		wp_enqueue_script('easing');
		wp_enqueue_script('asyncslider-min');
		wp_enqueue_script('asyncslider');
		wp_enqueue_script('tweet');
		wp_enqueue_script('tabs');
		wp_enqueue_script('isotope');
		wp_enqueue_script('custom');
	}
}
add_action('init', 'cs_scripts');


/**

/*--------------------------*
/*  Register Menus
/*--------------------------*/


add_action( 'init', 'register_my_menus' );
 
function register_my_menus() {
	register_nav_menus(
		array(
			'menu-main' => __( 'Main Menu', 'cs' ),
			'footer-menu' => __( 'Footer Menu', 'cs' ),
		)
	);
} 

// remove menu container div
function my_wp_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

require("breadcrumbs.php");


/*--------------------------*
/*  Widgets
/*--------------------------*/


class twitter_widget extends WP_Widget {


function twitter_widget() {

$widget_ops = array('description' => 'Adds recent tweet');

$this->WP_Widget('twitter_widget', 'CS Tweet', $widget_ops);

}

function form($instance) {

$title = esc_attr($instance['title']); ?>

<label for="<?php echo $this->get_field_id('title'); ?>">Title:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"

name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</label>
</p>
<?php

} //ending form creation

function update($new_instance, $old_instance) {

$instance = $old_instance;

$instance['title'] = strip_tags($new_instance['title']);

return $instance;

} //ending update

function widget($args, $instance) {

extract($args, EXTR_SKIP);

echo $before_widget;

$title = apply_filters('widget_title', $instance['title']);

if (!empty($title)) { echo $before_title . $after_title; };

//*********************************
?>
<div class="twitter">
  <p class="tweet"></p>
</div>
<?php

//*********************************

echo $after_widget;

} //ending function widget

} //ending class extension

register_widget('twitter_widget');



class search_widget extends WP_Widget {


function search_widget() {

$widget_ops = array('description' => 'Adds custom search to sidebar');

$this->WP_Widget('search_widget', 'CS Search', $widget_ops);

}

function form($instance) {

$title = esc_attr($instance['title']); ?>
<label for="<?php echo $this->get_field_id('title'); ?>">Title:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"

name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</label>
</p>
<?php

} //ending form creation

function update($new_instance, $old_instance) {

$instance = $old_instance;

$instance['title'] = strip_tags($new_instance['title']);

return $instance;

} //ending update

function widget($args, $instance) {

extract($args, EXTR_SKIP);

echo $before_widget;

$title = apply_filters('widget_title', $instance['title']);

if (!empty($title)) { echo ''; };

//*********************************
?>
<div class="search">
  <form action="<?php bloginfo('url'); ?>">
    <div class="area">
      <input type="text" value="search..." name="s"/>
    </div>
    <input type="submit" value="Search" class="submit" />
  </form>
</div>
<?php

//*********************************

echo $after_widget;

} //ending function widget

} //ending class extension

register_widget('search_widget');

class social_widget extends WP_Widget {


function social_widget() {

$widget_ops = array('description' => 'Adds social icons to footer');
$control_ops = array('width' => 400, 'height' => 350);		
$this->WP_Widget('social_widget', 'CS Social', $widget_ops, $control_ops);

		
		
}

function form($instance) {
$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$text = esc_textarea($instance['text']);
?>
<p>
  <label for="<?php echo $this->get_field_id('title'); ?>">Title:
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"

name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
</p>
<p>
  <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
</p>
<p>
  <input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />
  &nbsp;
  <label for="<?php echo $this->get_field_id('filter'); ?>">
    <?php _e('Automatically add paragraphs', 'cs'); ?>
  </label>
</p>
<?php
} //ending form creation

function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;
	}
//ending update

function widget($args, $instance) {
extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );


?>
<?php echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>
<p>Stay in touch with us:</p>
<p>
  <?php $twitter  = get_option("cs_twitname"); ?>
  <?php $facebook  = get_option("cs_facebook"); ?>
  <?php $rss  = get_option("cs_rss"); ?>
  <?php $googleplus  = get_option("cs_plus1"); ?>
  <?php $linkedin  = get_option("cs_linkedin"); ?>
<ul class="social">
  <?php if(!empty($twitter)){?>
  <li class="tw"><a href="http://www.twitter.com/<?php echo $twitter; ?>">Twitter</a></li>
  <?php } ?>
  <?php if(!empty($facebook)){?>
  <li class="fb"><a href="http://www.facebook.com/<?php echo $facebook; ?>">Facebook</a></li>
  <?php } ?>
  <?php if(!empty($rss)){?>
  <li class="rs"><a href="<?php echo $rss; ?>">RSS</a></li>
  <?php } ?>
  <?php if(!empty($googleplus)){?>
  <li class="gp"><a href="<?php echo $googleplus; ?>">Google Plus</a></li>
  <?php } ?>
  <?php if(!empty($linkedin)){?>
  <li class="in"><a href="<?php echo $linkedin; ?>">In</a></li>
  <?php } ?>
</ul>
</p>
<div class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>

<?php
echo $after_widget;
} //ending function widget
} //ending class extension
register_widget('social_widget');
class tour_widget extends WP_Widget {
function tour_widget() {
$widget_ops = array('description' => 'Adds tour headings to sidebar');

$this->WP_Widget('tour_widget', 'CS Tour', $widget_ops);

}

function form($instance) {

$title = esc_attr($instance['title']); ?>
<label for="<?php echo $this->get_field_id('title'); ?>">Title:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"

name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</label>
<?php
} //ending form creation

function update($new_instance, $old_instance) {

$instance = $old_instance;

$instance['title'] = strip_tags($new_instance['title']);

return $instance;

} 
//ending update

function widget($args, $instance) {

extract($args, EXTR_SKIP);

echo $before_widget;

$title = apply_filters('widget_title', $instance['title']);




//*********************************
?>
<?php echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
<?php
 for ($i = 0; $i <= "\n"; $i++) ;
query_posts(array('post_type' => 'tour'));
if (have_posts()) : while (have_posts()) : the_post();

?>
<ul class="tour-wid tabset">
  <li><a class="tab <?php if ($post != 'set') { echo 'active'; $post='set'; } ?>" href="#tab-1<?php echo $i ?>  ">
    <h5>
      <?php the_title(); ?>
    </h5>
    </a></li>
</ul>
<?php
$i++;
endwhile;
?>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php

//*********************************

echo $after_widget;

} //ending function widget

} //ending class extension


register_widget('tour_widget');

class thumbnails_widget extends WP_Widget {


function thumbnails_widget() {

$widget_ops = array('description' => 'Adds recent posts with thumbnails');

$this->WP_Widget('thumbnails_widget', 'CS Thumbnails', $widget_ops);

}

function form($instance) {
$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'postno' => '' ) );
		$title = strip_tags($instance['title']);
		$postno = strip_tags($instance['postno']);
?>
<label for="<?php echo $this->get_field_id('title'); ?>">Title:
  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"

name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</label>
<p>
  <label for="<?php echo $this->get_field_id('postno'); ?>">
    <?php _e('Number of posts to show:', 'cs'); ?>
  </label>
  <input id="<?php echo $this->get_field_id('postno'); ?>" name="<?php echo $this->get_field_name('postno'); ?>" type="text" value="<?php echo $postno; ?>" size="3" />
</p>
<?php
} //ending form creation

function update($new_instance, $old_instance) {

$instance = $old_instance;

$instance['title'] = strip_tags($new_instance['title']);
$instance['postno'] = (int) $new_instance['postno'];
return $instance;

} 
//ending update


function widget($args, $instance) {
extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$postno = isset($instance['postno']) ? absint($instance['postno']) : 5;


//*********************************
?>
<?php echo $before_widget;
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } ?>
<?php
							$the_query = new  WP_Query(array('posts_per_page' => $postno, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
							while ($the_query->have_posts()) : $the_query->the_post(); ?>
<div class="latest-post"> <a href="<?php the_permalink() ?>" rel="bookmark">
  <?php the_post_thumbnail(array(50,50), array ('class' => 'alignleft')); ?>
  </a>
  <h6><a href="<?php the_permalink() ?>" rel="bookmark">
    <?php the_title(); ?>
    </a> </h6>
  <em class="date">
  <?php the_time(get_option('date_format')); ?>
  </em>
  <div class="clear"></div>
</div><br/>
<?php endwhile; ?>

<?php wp_reset_query(); ?>
<?php
echo $after_widget;

} //ending function widget

} //ending class extension

register_widget('thumbnails_widget');

/*remove admin bar*/

/*function my_function_admin_bar(){ return false; }
add_filter( 'show_admin_bar' , 'my_function_admin_bar');*/

/*--------------------------*
/*  Theme Admin
/*--------------------------*/



$options = array (
 
array( "name" => $themename." Options",
	"type" => "title"),
 

array( "name" => "General",
	"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Color Scheme",
	"desc" => "Select the header background",
	"id" => $shortname."_color_scheme",
	"type" => "select",
	"options" => array("default", "pattern2", "pattern3", "pattern4", "pattern5"),
	"std" => "default"),
	
array( "name" => "Logo URL",
	"desc" => "Enter the link to your logo image (max 60px height) http://yoursite.com/images/logo/png" ,
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => ""),
	
array( "type" => "close"),
array( "name" => "Homepage",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Slider Direction",
	"desc" => "",
	"id" => $shortname."_slide_direction",
	"type" => "select",
	"options" => array("vertical", "horizontal"),
	"std" => "vertical"),
	
	array( "name" => "Slider Speed",
	"desc" => "Select the slide delay time / 1000 = 1 second",
	"id" => $shortname."_slide_speed",
	"type" => "select",
	"options" => array("2800", "3800", "4800", "5800", "6800", "7800"),
	"std" => "4800"),
	
	array( "name" => "Written Text Bar",
	"desc" => "Enter the call-to-action text",
	"id" => $shortname."_textbar",
	"type" => "text",
	"std" => "Easy + Scalable + Affordable"),
	
	array( "name" => "Show main button",
	"desc" => "Show large call to action button",
	"id" => $shortname."_include_button",
	"type" => "checkbox",
	"std" => ""),
	
	array( "name" => "Main button text",
	"desc" => "Enter the button text",
	"id" => $shortname."_start_button",
	"type" => "text",
	"std" => "Get Started"),
	
	array( "name" => "Main button link",
	"desc" => "Enter the button link",
	"id" => $shortname."_start_button_link",
	"type" => "text",
	"std" => ""),
	
	array( "name" => "Homepage main posts",
	"desc" => "Choose a category from which main posts are drawn",
	"id" => $shortname."_box_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"),
	
	array( "name" => "Number of main posts",
	"desc" => "Enter number of posts to display",
	"id" => $shortname."_box_number",
	"type" => "text",
	"std" => "4"),
	
	array( "name" => "Homepage bottom featured category",
	"desc" => "Choose a category from which featured posts are drawn",
	"id" => $shortname."_featured_cat",
	"type" => "select",
	"options" => $wp_cats,
	"std" => "Choose a category"),
	
	
		array( "type" => "close"),
array( "name" => "Social",
	"type" => "section"),
array( "type" => "open"),

array( "name" => "Twitter",
	"desc" => "Enter your Twitter username",
	"id" => $shortname."_twitname",
	"type" => "text",
	"std" => ""),
	
	
array( "name" => "Facebook",
	"desc" => "Enter your Facebook username",
	"id" => $shortname."_facebook",
	"type" => "text",
	"std" => ""),
	
	
array( "name" => "RSS Link",
	"desc" => "Enter your Rss Feed Link",
	"id" => $shortname."_rss",
	"type" => "text",
	"std" => ""),
	
	
array( "name" => "Google Plus1",
	"desc" => "Enter your Plus1 account url",
	"id" => $shortname."_plus1",
	"type" => "text",
	"std" => ""),
	
	
array( "name" => "Linkedin",
	"desc" => "Enter your Linkedin account url",
	"id" => $shortname."_linkedin",
	"type" => "text",
	"std" => ""),
	
array( "type" => "close"),
array( "name" => "Footer",
	"type" => "section"),
array( "type" => "open"),
	
array( "name" => "Footer copyright text",
	"desc" => "Enter copyright text used in the right side of the footer.",
	"id" => $shortname."_footer_text",
	"type" => "text",
	"std" => " Copyright &copy; 2012 CleanSpace by Eggbit "),
	
array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => ""),	
	
array( "type" => "close"));
function mytheme_add_admin() {
global $themename, $shortname, $options;
if (isset($_GET['page']) && $_GET['page'] == basename(__FILE__) )  {
if(isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
 	foreach ($options as $value) {
		if (isset($value['id']) && isset($_REQUEST[$value['id']])) {
			update_option( $value['id'], $_REQUEST[$value['id']] );
	}
}
foreach ($options as $value) {
	if (isset($value['id']) &&isset($_REQUEST[$value['id']])) {
    update_option( $value['id'], $_REQUEST[$value['id']] );
  }
 else {
    if (isset($value['id'])) 
		delete_option( $value['id'] ); 
 } 
}
	header("Location: admin.php?page=functions.php&saved=true");
die;
} 
else if(isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {
 	foreach ($options as $value) 
	{
		if (isset($value['id'])) 
			delete_option( $value['id'] ); 
	}
 	header("Location: admin.php?page=functions.php&reset=true");
die;
}
}
 
add_theme_page($themename, $themename, 'administrator', basename(__FILE__), 'mytheme_admin');
}

function mytheme_add_init() {

$file_dir=get_template_directory_uri('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_script("cs_script", $file_dir."/functions/cs_script.js", false, "1.0");

}
function mytheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
if (isset( $_REQUEST['saved'] )) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
if (isset( $_REQUEST['reset'] )) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>
<div class="wrap cs_wrap">
<h2><?php echo $themename; ?> Settings</h2>
<div class="cs_opts">
<form method="post">
  <?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
  <?php break;
 
case "close":
?>
  </div>
  </div>
  <br />
  <?php break;
 
case "title":
?>
  <p>To customize the <?php echo $themename;?> theme, please use the menu below.</p>
  <?php break;
 
case 'text':
?>
  <div class="cs_input cs_text">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
    <small><?php echo $value['desc']; ?></small>
    <div class="clearfix"></div>
  </div>
  <?php
break;
 
case 'textarea':
?>
  <div class="cs_input cs_textarea">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?>
</textarea>
    <small><?php echo $value['desc']; ?></small>
    <div class="clearfix"></div>
  </div>
  <?php
break;
 
case 'select':
?>
  <div class="cs_input cs_select">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
      <?php foreach ($value['options'] as $option) { ?>
      <option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>
      <?php } ?>
    </select>
    <small><?php echo $value['desc']; ?></small>
    <div class="clearfix"></div>
  </div>
  <?php
break;
 
case "checkbox":
?>
  <div class="cs_input cs_checkbox">
    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
    <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
    <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
    <small><?php echo $value['desc']; ?></small>
    <div class="clearfix"></div>
  </div>
  <?php break; 
case "section":

$i++;

?>
  <div class="cs_section">
  <div class="cs_title">
   <h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3>
    <span class="submit">
    <input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
    </span>
    <div class="clearfix"></div>
  </div>
  <div class="cs_options">
  <?php break;
 
}
}
?>
  <input type="hidden" name="action" value="save" />
</form>
<form method="post">
  <p class="submit">
    <input name="reset" type="submit" value="Reset" />
    <input type="hidden" name="action" value="reset" />
  </p>
</form>
</div>
<?php
}
?>
<?php

/*--------------------------*
/* Shortcodes
/*--------------------------*/

function my_formatter($content) {
		$new_content = '';
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		foreach ($pieces as $piece) {
			if (preg_match($pattern_contents, $piece, $matches)) {
				$new_content .= $matches[1];
			} else {
				$new_content .= wptexturize(wpautop($piece));
			}
		}

		return $new_content;
	}

	remove_filter('the_content', 'wpautop');
	remove_filter('the_content', 'wptexturize');

	add_filter('the_content', 'my_formatter', 99);
	
	// quotes code
	include "shortcodes/quotes/quotes.php";	
		
	// columns code
	include "shortcodes/columns/columns.php";
	
	// video code
	include "shortcodes/video/video.php";
	
	// gchart shortcode
	include "shortcodes/gchart/gchart.php";
	
	// ptable shortcode
	include "shortcodes/ptable/ptable.php";
	
	// social shortcode
	include "shortcodes/social/social.php";
	
	// gmap shortcode
	include "shortcodes/gmap/gmap.php";
	
	add_filter('widget_text', 'do_shortcode');
	

/*--------------------------*
/*  Excerpt Fix
/*--------------------------*/

function cs_the_excerpt($words = 40,  $allowed_tags = '', $container = 'p', $smileys = 'no' )
{
global $post;
 
if ( $allowed_tags == 'all' ) $allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<span>,<blockquote>,<img>';
 
$text = preg_replace('/\[.*\]/', '', strip_tags($post->post_content, $allowed_tags));
 $output = '';
$text = explode(' ', $text);
$tot = count($text);
 
for ( $i=0; $i<$words; $i++ ) : $output .= $text[$i] . ' '; endfor;
 
if ( $smileys == "yes" ) $output = convert_smilies($output);
 
?>
<p><?php echo force_balance_tags($output) ?>
  <?php if ( $i < $tot ) : ?>
  ...
  <?php else : ?>
</p>
<?php endif; ?>
<?php if ( $i < $tot ) :
if ( $container == 'p' || $container == 'div' ) : ?>
</p>
<?php endif;
if ( $container != 'plain' ) : ?>
<<?php echo $container; ?> class="more">
<?php if ( $container == 'div' ) : ?>
<p>
  <?php endif; endif; ?>
  <?php
 
if ( $container == 'div' ) : ?>
</p>
<?php endif; if ( $container != 'plain' ) : ?>
</<?php echo $container; ?>>
<?php endif;
 
if ( $container == 'plain' || $container == 'span' ) : ?>
</p>
<?php endif;
endif;
 
}

function cs_trim_excerpt($text) {
        global $post;
        if ( '' == $text ) {
                $text = get_the_content('');
                $text = apply_filters('the_content', $text);
                $text = str_replace('\]\]\>', ']]&gt;', $text);
                $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
                $text = strip_tags($text, '<p><strong><blockquote><q><span><h2><h3><h4><h5><h6>');
                $excerpt_length = 55;
                $words = explode(' ', $text, $excerpt_length + 1);
                if (count($words)> $excerpt_length) {
                        array_pop($words);
                        array_push($words, '[...]');
                        $text = implode(' ', $words);
                }
        }
        return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'cs_trim_excerpt');
?>
<?php
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');

/*--------------------------*
/*  Comments
/*--------------------------*/

if ( ! function_exists( 'cs_comment' ) ) :
function cs_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
<li> <?php echo get_avatar( $comment, 40 ); ?>
  <div class="text-holder"> <span class="comment-title"><a class="name" href="#"><?php echo get_comment_author_link(); ?></a>
    <?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'cs' ), get_comment_date(),  get_comment_time() ); ?>
    </a></span>
    <div class="comment-holder">
      <p>
        <?php comment_text(); ?>
      </p>
    </div>
    <div class="holder">
      <?php comment_reply_link( array_merge( $args, array( 'class'=>'text-reply', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
  </div>
</li>
<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'cs'); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __( '(Edit)', 'cs' ), ' ' ); ?>
  </p>
  <?php
			break;
	endswitch;
}
endif;

/**
 * THB Pagination
 */
function thb_get_navigation_link($linkText, $query, $type)
{
	$numPages = $query->max_num_pages;
	if( empty($numPages) )
		$numPages = 1;
	
	// Current page
	$currentPage = 1;
	if (get_query_var('paged'))
		$currentPage = get_query_var('paged');
	elseif (get_query_var('page'))
		$currentPage = get_query_var('page');
	
	// Show condition
	$show = false;

	// Type
	switch($type) {
		case 'next':
			$linkPage = $currentPage - 1;
			$show = !( $currentPage == 1 );
			break;
		case 'prev':
			$linkPage = $currentPage + 1;
			$show = !( $numPages == 1 || $currentPage >= $numPages );
			break;
	}

	if( $show ) {
		$url = thb_get_page_link($linkPage);
		$link = "<a href=\"{$url}\">{$linkText}</a>";
		echo $link;
	}
}

function thb_previous_posts_link($linkText, $query)
{
	thb_get_navigation_link($linkText, $query, "prev");
}

function thb_next_posts_link($linkText, $query)
{
	thb_get_navigation_link($linkText, $query, "next");
}

/**
 * Gets a page link
 */
function thb_get_page_link($link)
{
	global $page_id, $post;
	$post = get_post( $page_id );

	if( $page_id == 0 ) {
		// Static home page
		$url = add_query_arg( 'page', $link, home_url() );
		if( $link == 1 )
			$url = remove_query_arg('page', $url);
	} else {
		$url =  preg_replace('!">$!','',_wp_link_page($link));
		$url =  preg_replace('!^<a href="!','',$url);
	}

	return $url;
}
 
/*--------------------------*
/*  MetaBox
/*--------------------------*/
add_action( 'admin_init', 'add_custom_metabox' );
add_action( 'save_post', 'save_custom_url' );

function add_custom_metabox() {
	add_meta_box( 'custom-metabox', __( 'URL slide links to' ), 'url_custom_metabox', 'clients', 'side' );
	add_meta_box( 'custom-metabox', __( 'URL slide links to' ), 'url_custom_metabox', 'slider', 'side' );
	
}

function url_custom_metabox() {
	global $post;
	$urllink = get_post_meta( $post->ID, 'urllink', true );
	

	if ( !preg_match( "/http(s?):\/\//", $urllink )) {
		$errors = 'Url not valid';
		$urllink = 'http://';
	} 

	// output invlid url message and add the http:// to the input field
	if( $errors ) { echo $errors; } ?>

	<p><label for="siteurl">Url:<br />
		<input id="siteurl" size="27" name="siteurl" value="<?php if( $urllink ) { echo $urllink; } ?>" /></label></p>
        
        
	
<?php
}




/**
 * Process the custom metabox fields
 */
function save_custom_url( $post_id ) {
	global $post;	

	if( $_POST ) {
		update_post_meta( $post->ID, 'urllink', $_POST['siteurl'] );
		
	}
}

/**
 * Get and return the values for the URL
 */
function get_url_desc_box() {
	global $post;
	$urllink = get_post_meta( $post->ID, 'urllink', true );
	

	return array( $urllink, $urldesc );
}


add_action( 'add_meta_boxes', 'meta_box_video' );
function meta_box_video()
{
    add_meta_box( 'video-meta-box', 'Video Embed', 'meta_box_callback', 'post', 'normal', 'high' );
	 add_meta_box( 'video-meta-box', 'Video Embed', 'meta_box_callback', 'portfolio', 'normal', 'high' );
}

function meta_box_callback( $post )
{
    $values = get_post_custom( $post->ID );
    $selected = isset( $values['meta_box_video_embed'] ) ? $values['meta_box_video_embed'][0] : '';

    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="meta_box_video_embed"><p>Video Embed</p></label>
        <textarea name="meta_box_video_embed" id="meta_box_video_embed" cols="62" rows="5" ><?php echo $selected; ?></textarea>
    </p>
    <p>Leave it Empty ( if you want to use an image thumbnail ) .</p>
    <?php   
}

add_action( 'save_post', 'meta_box_video_save' );
function meta_box_video_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );

    // Probably a good idea to make sure your data is set

    if( isset( $_POST['meta_box_video_embed'] ) )
        update_post_meta( $post_id, 'meta_box_video_embed', $_POST['meta_box_video_embed'] );

}
?>
<?php 
if ( get_magic_quotes_gpc() ) {
    $_POST      = array_map( 'stripslashes_deep', $_POST );
    $_GET       = array_map( 'stripslashes_deep', $_GET );
    $_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
    $_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
}
?>