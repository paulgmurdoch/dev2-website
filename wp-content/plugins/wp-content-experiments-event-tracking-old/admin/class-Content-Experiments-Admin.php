<?php
//Admin class for this plugin

class Content_Experiments_WP_Admin {
	//private $data;
	
	public function __construct() {
		$this->experiments_meta_box(); //let's start constructing our meta-boxes
		add_action('admin_enqueue_scripts', array(&$this, 'experiments_admin_scripts') );
	}
	
	public function experiments_meta_box() {
		$meta_boxes = array();
		// first meta box
		$meta_boxes[] = array(
			'id' => 'experiments-meta',
			'title' => 'Content Experiments For WP Settings',
			'display_meta' => 'render_meta_box_content',
			'fields' => array(
				array(
				'id' => '_experiments_wp_active',
				'type' => 'checkbox',
				),
				array(
				'id' => '_experiments_wp_code',
				'type' => 'textbox',
				)
			),
			'context' => 'normal', // normal, advanced, side (optional)
			'priority' => 'high' // high, low (optional)
		);
		
		$meta_boxes[] = array(
			'id' => 'eventtracking-meta',
			'title' => 'Event Tracking',
			'display_meta' => 'render_event_tracking_meta_box',
			'fields' => array(
				array(
				'id' => '_wpgce_event_tracking_active',
				'type' => 'checkbox',
				),
				array(
				'id' => '_wpgce_event_tracking_code',
				'type' => 'textbox',
				),
				array(
				'id' => '_wpgce_event_tracking_jquery_code',
				'type' => 'textbox',
				),
				array(
				'id' => '_wpgce_event_tracking_category',
				'type' => 'textbox',
				),
				array(
				'id' => '_wpgce_event_tracking_action',
				'type' => 'textbox',
				),
				array(
				'id' => '_wpgce_event_tracking_label',
				'type' => 'textbox',
				),
				array(
				'id' => '_wpgce_event_tracking_css_id',
				'type' => 'textbox',
				),
				array(
				'id' => '_wpgce_event_tracking_css_class',
				'type' => 'textbox',
				)
			),
			'context' => 'normal', // normal, advanced, side (optional)
			'priority' => 'high' // high, low (optional)
		);
		include_once( CONTENT_EXPERIMENTS_WP_PATH . "admin/content-experiments-metaboxes.php");
		foreach ($meta_boxes as $meta_box) {
			$my_meta_box = new Content_Experiments_Meta_Boxes($meta_box);
		}
	}

	public function experiments_admin_scripts() {
	   wp_register_script( 'gwe-meta-box', plugins_url( 'js/wpgce_admin.js' , dirname(__FILE__) ), array('jquery'), null, true );
	   wp_enqueue_script( 'gwe-meta-box' );
	}
	
}
?>