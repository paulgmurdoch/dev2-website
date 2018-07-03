<?php
/* 
Plugin Name: WP Content Experiments & Event Tracking
Plugin URI: http://wpsolutions-hq.com/google-content-experiments-for-wordpress/
Description: Allows easy insertion of control code for Google Content Experiments and/or event tracking on your WP pages/posts.
Author: WP Solutions HQ
Version: 1.0
Author URI: http://wpsolutions-hq.com
*/

if ( !defined('CONTENT_EXPERIMENTS_WP_PATH') )
	define( 'CONTENT_EXPERIMENTS_WP_PATH', plugin_dir_path( __FILE__ ) );

	
if ( is_admin() && ( !defined('DOING_AJAX') || !DOING_AJAX ) && !class_exists( 'Content_Experiments_WP_Admin' ) ) {
	include_once( CONTENT_EXPERIMENTS_WP_PATH . "admin/class-Content-Experiments-Admin.php");
	add_action('plugins_loaded', 'content_experiments_execute_plugins_loaded_operations');	
	
	// Load the Admin class when inside the post/page editor
	add_action( 'load-post.php', 'load_Content_Experiments_WP_Admin' );
	add_action( 'load-post-new.php', 'load_Content_Experiments_WP_Admin' );
}

function content_experiments_execute_plugins_loaded_operations(){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active('google-analytics-for-wordpress/googleanalytics.php')) {
   		//google analytics for wordpress plugin is activated
		return;
	} else {
		add_action('admin_notices', 'content_experiments_conflict_check');		
		return;
	}
}

function content_experiments_conflict_check(){
	echo '<div class="error fade"><p>Attention! You do not have the <a href="http://wordpress.org/extend/plugins/google-analytics-for-wordpress/" target="_blank">Google Analytics For WordPress</a> active! The WP Content Experiments plugin can only work if Google Analytics For WordPress is active.</p></div>';
}


function load_Content_Experiments_WP_Admin() 
{
	return new Content_Experiments_WP_Admin;
}

if ( !class_exists( 'Content_Experiments_WP' ) ) {
	include_once( CONTENT_EXPERIMENTS_WP_PATH . "class-Content-Experiments.php");
	if( !is_admin() )
		$experiments_wp = new Content_Experiments_WP();
}
?>