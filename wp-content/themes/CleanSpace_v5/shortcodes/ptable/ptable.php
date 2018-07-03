<?php

/*
Author: Greg Priday
Version: 0.1.3
Author URI: http://siteorigin.com/
License: GPL
*/

define('PRICETABLE_FEATURED_WEIGHT', 1.175);

/**
 * Register the price table post type
 */
function siteorigin_pricetable_register(){
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
		'menu_icon' => get_template_directory_uri() . '/shortcodes/ptable/images/icon.png', __FILE__,
	));
}
add_action( 'init', 'siteorigin_pricetable_register');

// Custom columns for the pricetable
function siteorigin_pricetable_register_custom_columns($cols){
	unset($cols['title']);
	unset($cols['date']);
	
	$cols['title'] = __('Title', 'pricetable');
	$cols['options'] = __('Options', 'pricetable');
	$cols['features'] = __('Features', 'pricetable');
	$cols['featured'] = __('Featured Option', 'pricetable');
	$cols['date'] = __('Date', 'pricetable');
	return $cols;
}
add_filter( 'manage_pricetable_posts_columns', 'siteorigin_pricetable_register_custom_columns');

function siteorigin_pricetable_custom_column($column_name){
	global $post;
	switch($column_name){
	case 'options' :
		$table = get_post_meta($post->ID, 'price_table', true);
		print count($table);
		break;
	case 'features' :
	case 'featured' :
		$table = get_post_meta($post->ID, 'price_table', true);
		foreach($table as $col){
		if(!empty($col['featured']) && $col['featured'] == 'true'){
			if($column_name == 'featured') print $col['title'];
			else print count($col['features']);
			break;
		}
		}
		break;
	}
}
add_action( 'manage_pricetable_posts_custom_column', 'siteorigin_pricetable_custom_column');

/**
 * Enqueue the pricetable scripts
 */
function siteorigin_pricetable_scripts(){
	global $post;
	if(is_singular() && (($post->post_type == 'pricetable') || ($post->post_type != 'pricetable' && preg_match( '#\[ *price_table([^\]])*\]#i', $post->post_content )))){
		wp_enqueue_script('jquery');
		wp_enqueue_style('pricetable',  get_template_directory_uri() . '/shortcodes/ptable/css/pricetable.css', __FILE__, null, null);
	}
}
add_action('wp_enqueue_scripts', 'siteorigin_pricetable_scripts');

/**
 * Add administration scripts
 */
function siteorigin_pricetable_admin_scripts($page){
	if($page == 'post-new.php' || $page == 'post.php'){
		global $post;
		
		if(!empty($post) && $post->post_type == 'pricetable'){
			// Scripts for building the pricetable
			wp_enqueue_script('placeholder', get_template_directory_uri() . '/shortcodes/ptable/js/placeholder.jquery.js', __FILE__, array('jquery'), '1.1.1', true);
			wp_enqueue_script('jquery-ui');
			wp_enqueue_script('pricetable-admin', get_template_directory_uri() . '/shortcodes/ptable/js/pricetable.build.js', __FILE__, array('jquery'), null, true);
			
			wp_localize_script('pricetable-admin', 'pt_messages', array(
				'delete_column' => __('Are you sure you want to delete this column?', 'pricetable'),
				'delete_feature' => __('Are you sure you want to delete this feature?', 'pricetable'),
			));
			
			wp_enqueue_style('pricetable-admin',  get_template_directory_uri() . '/shortcodes/ptable/css/pricetable.admin.css', __FILE__, array(), null);
			wp_enqueue_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.0/themes/base/jquery-ui.css', array(), '1.7.0');
		}
	}
}
add_action('admin_enqueue_scripts', 'siteorigin_pricetable_admin_scripts');

/**
 * Metaboxes because we're boss
 */
function siteorigin_pricetable_meta_boxes(){
	add_meta_box('pricetable', __('Price Table', 'pricetable'), 'siteorigin_pricetable_metabox', 'pricetable', 'normal', 'high');
	add_meta_box('pricetable-shortcode', __('Shortcode', 'pricetable'), 'siteorigin_pricetable_metabox_shortcode', 'pricetable', 'side', 'low');
}
add_action( 'add_meta_boxes', 'siteorigin_pricetable_meta_boxes' );

/**
 * Display the price table building interface
 */
function siteorigin_pricetable_metabox($post, $metabox){
	wp_nonce_field( plugin_basename( __FILE__ ), 'siteorigin_pricetable_nonce' );
	
	$table = get_post_meta($post->ID, 'price_table', true);
	if(empty($table)) $table = array();
	
	include(dirname(__FILE__).'/pricetable.build.phtml');
}

function siteorigin_pricetable_metabox_shortcode($post, $metabox){
	?>
		<code>[price_table id=<?php print $post->ID ?>]</code>
		<small class="description"><?php _e('Displays price table on another page.', 'pricetable') ?></small>
	<?php
}

/**
 * Save the price table
 */
function siteorigin_pricetable_save($post_id){
	// Authorization, verification this is my vocation 
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( !wp_verify_nonce( @$_POST['siteorigin_pricetable_nonce'], plugin_basename( __FILE__ ) ) ) return;
	if ( !current_user_can( 'edit_post', $post_id ) ) return;
	
	// Create the price table from the post variables
	$table = array();
	foreach($_POST as $name => $val){
		if(substr($name,0,6) == 'price_'){
			$parts = explode('_', $name);
			
			$i = intval($parts[1]);
			if(@$parts[2] == 'feature'){
				// Adding a feature
				$fi = intval($parts[3]);
				$fn = $parts[4];
				
				if(empty($table[$i]['features'])) $table[$i]['features'] = array();
				$table[$i]['features'][$fi][$fn] = $val;
			}
			elseif(isset($parts[2])){
				// Adding a field
				$table[$i][$parts[2]] = $val;
			}
		}
	}
	
	// Clean up the features
	foreach($table as $i => $col){
		if(empty($col['features'])) continue;
		
		foreach($col['features'] as $fi => $feature){
			if(empty($feature['title']) && empty($feature['sub']) && empty($feature['description'])){
				unset($table[$i]['features'][$fi]);
			}
		}
		$table[$i]['features'] = array_values($table[$i]['features']);
	}
	
	if(isset($_POST['price_recommend'])){
		$table[intval($_POST['price_recommend'])]['featured'] = 'true';
	}
	
	$table = array_values($table);
	
	update_post_meta($post_id,'price_table', $table);
}
add_action( 'save_post', 'siteorigin_pricetable_save' );

/**
 * The price table shortcode.
 */
function siteorigin_pricetable_shortcode($atts = array()) {
	global $post;
	
	extract( shortcode_atts( array(
		'id' => null,
		'width' => 100,
	), $atts ) );
	
	if($id == null) $id = $post->ID;
	
	$table = get_post_meta($id , 'price_table', true);
	if(empty($table)) $table = array();
	
	// Set all the classes
	$featured_index = null;
	foreach($table as $i => $column) {
		$table[$i]['classes'] = array('column');
		$table[$i]['classes'][] = (@$table[$i]['featured'] === 'true') ? 'featured' : 'standard';
		
		if(@$table[$i]['featured'] == 'true') $featured_index = $i;
		if(@$table[$i+1]['featured'] == 'true') $table[$i]['classes'][] = 'before-featured';
		if(@$table[$i-1]['featured'] == 'true') $table[$i]['classes'][] = 'after-featured';
	}
	$table[0]['classes'][] = 'first';
	$table[count($table)-1]['classes'][] = 'last';
	
	// Calculate the widths
	$width_total = 0;
	foreach($table as $i => $column){
		if(@$column['featured'] === 'true') $width_total += PRICETABLE_FEATURED_WEIGHT;
		else $width_total++;
	}
	$width_sum = 0;
	foreach($table as $i => $column){
		if(@$column['featured'] === 'true'){
			// The featured column takes any width left over after assigning to the normal columns
			$table[$i]['width'] = 100 - (floor(100/$width_total) * ($width_total-PRICETABLE_FEATURED_WEIGHT));
		}
		else{
			$table[$i]['width'] = floor(100/$width_total);
		}
		$width_sum += $table[$i]['width'];
	}
	
	// Create fillers
	if(!empty($table[0]['features'])){
		for($i = 0; $i < count($table[0]['features']); $i++){
			$has_title = false;
			$has_sub = false;
			
			foreach($table as $column){
				$has_title = ($has_title || !empty($column['features'][$i]['title']));
				$has_sub = ($has_sub || !empty($column['features'][$i]['sub']));
			}
			
			foreach($table as $j => $column){
				if($has_title && empty($table[$j]['features'][$i]['title'])) $table[$j]['features'][$i]['title'] = '&nbsp;';
				if($has_sub && empty($table[$j]['features'][$i]['sub'])) $table[$j]['features'][$i]['sub'] = '&nbsp;';
			}
		}
	}
	
	ob_start();
	include(dirname(__FILE__).'/pricetable.phtml');
	$pricetable = ob_get_clean();
	
	if($width != 100){
		$pricetable = '<div style="width:'.$width.'%; margin: 0 auto;">'.$pricetable.'</div>';
	}
	
	$post->pricetable_inserted = true;
	
	return $pricetable;
}
add_shortcode( 'price_table', 'siteorigin_pricetable_shortcode' );

function siteorigin_pricetable_the_content_filter($the_content){
	global $post;
	
	if(is_single() && $post->post_type == 'pricetable' && empty($post->pricetable_inserted)){
		$the_content = siteorigin_pricetable_shortcode().$the_content;
	}
	return $the_content;
}
// Filter the content after WordPress has had a chance to do shortcodes (priority 10)
add_filter('the_content', 'siteorigin_pricetable_the_content_filter',11);