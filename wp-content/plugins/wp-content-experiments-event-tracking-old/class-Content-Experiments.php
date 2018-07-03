<?php
/** 
 * Content Experiments For WP Class
 */
class Content_Experiments_WP {

	public function __construct() {
		add_action( 'wp', array( $this, 'setup' ) );
	}
	
	/** 
	 * Function executed at start
	 */
	public function setup() {
		// Don't output the experiments control code on the homepage when displaying all posts
		if ( is_home() )
			return;
		
		global $post;
		$experiments_active = get_post_meta($post->ID, '_experiments_wp_active', TRUE);
		$event_tracking_active = get_post_meta($post->ID, '_wpgce_event_tracking_active', TRUE);
		
		// Check if Content Experiment enabled and add control code for post/page
		if( isset($experiments_active) && $experiments_active == '1' ) {
			add_action( 'wp', array( &$this, 'prepare_output' ), 0 );
		}
		
		// Check if event tracking enabled for the page and add the code in post/page
		if( isset($event_tracking_active) && $event_tracking_active == '1' ) {
			add_action( 'wp', array( &$this, 'prepare_jquery_output' ), 0 );
		}
		
	}

	/** 
	 * Checks how to insert the event jquery code
	 */
	public function prepare_jquery_output() {
		// Add event jquery code using filter
			add_filter( 'the_content', array( &$this, 'output_event_jquery_code' ));
	}
	
	/** 
	 * Checks how to insert the code
	 */
	public function prepare_output() {
		// Add experiment code to head using hook
		add_action( 'wp_head', array( &$this, 'output_code' ), 0 );
	}
	
	/** 
	 *  This function will output the control code inside the <head> tag
	 */
	public function output_code() {
		global $post;
		$experiments_code = get_post_meta($post->ID, '_experiments_wp_code', TRUE);
		echo $experiments_code.PHP_EOL;;
	}

	/** 
	 *  This function will output the jquery code to insert event tracking code
	 */
	public function output_event_jquery_code($content) {
		global $post;
		//$event_jquery_code = get_post_meta($post->ID, '_event_tracking_jquery_code', TRUE);
		$event_jquery_code = get_post_meta( $post->ID, '_wpgce_event_tracking_jquery_code', true );
		$content = $content.$event_jquery_code.PHP_EOL;;
		return $content;
	}
}
	
?>