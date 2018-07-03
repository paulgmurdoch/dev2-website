<?php
/**
 * Create meta boxes
 */
class Content_Experiments_Meta_Boxes {

	private $data;
	protected $_meta_box;

	// create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;
		
		$this->_meta_box = $meta_box;
		//add_action('admin_menu', array(&$this, 'add'));
		add_action ( 'add_meta_boxes', array(&$this, 'add' ) );
		//$this->add();
		
		//add_action('pre_post_update', array(&$this, 'my_test'));
		add_action('admin_notices', array(&$this, 'my_admin_notice'));
		add_action('save_post', array(&$this, 'save'));
	}


	// Add meta boxes
	function add() {
		// Default post types
		$post_types = array( 'post', 'page' );
		
		// Add custom post types to the array
		$custom_types = get_post_types( array( 'public' => true, '_builtin' => false ) );
		foreach( $custom_types as $custom_post_type ) {
			$post_types[] = $custom_post_type;	
		}
		//start the enclosing form tag
		echo '<form method="POST" action="'.$_SERVER['REQUEST_URI'].'">';
		// Add meta box to each post type
		foreach( $post_types as $post_type )
		{
		    add_meta_box($this->_meta_box['id'], $this->_meta_box['title'],
    				array(&$this, 'display_meta_boxes'), $post_type,
    					$this->_meta_box['context'], $this->_meta_box['priority']
    		);
		}
		//close the form tag
		echo '</form>';
	}

	public function display_meta_boxes() {
		$output = '';
		// Use nonce for verification
		wp_nonce_field( plugin_basename( __FILE__ ), 'content_experiments' );
		
		if ($this->_meta_box['id'] == 'experiments-meta'){
			//display the google experiments meta-box
			$output = $this->render_experiments_meta_box_content();
			echo $output;
		} else if ($this->_meta_box['id'] == 'eventtracking-meta') {
			//display the event tracking meta-box
			$output = $this->render_event_tracking_meta_box();
			echo $output;
		}
	}	

	public function render_experiments_meta_box_content() {
		global $post;
		$experiments_active = get_post_meta( $post->ID, '_experiments_wp_active', true );
		$experiments_code = get_post_meta( $post->ID, '_experiments_wp_code', true );
		
		// Checkbox to activate google experiments on this page
		$output .= '<label for="experiments_active">';
		$output .= 'Enable Content Experiments for this page';
		$output .= '</label> ';
		$output .= '<input id="experiments_active" name="_experiments_wp_active" type="checkbox" value="1" '.checked( $experiments_active, 1, false ).'>';
		
		// Content Experiment control code will go in this textbox
		if( $experiments_active != 1 ) $display = "display:none;";
		$output .= '<div class="contexpcode" style="margin-top:10px;'.$display.'">';
		$output .= '<label for="experiments_code">';
		$output .= 'Paste your content experiments control code here if this is your "original page" (see note below):';
		$output .= '</label><br />';
		$output .= '<textarea id="experiments_code" name="_experiments_wp_code" cols="70" rows="10">'.$experiments_code.'</textarea>';
		$output .= '<p class="description">Note: The content experiments control code must be pasted in your "original page" 
		which you designated when setting up your experiment from your google analytics account.
		<br />Do not paste your control code here if you defined this page as a "variation page" in your experiment setup.
		<br />Please see the google help pages about how to <a href="https://support.google.com/analytics/bin/answer.py?hl=en&answer=1745216" target="_blank">set up and run an experiment.</a></p>';
		$output .= '</div>';
		return $output;
	}
	
	public function render_event_tracking_meta_box() {
		global $post;
		$event_tracking_active = get_post_meta( $post->ID, '_wpgce_event_tracking_active', true );
		$event_track_code = get_post_meta( $post->ID, '_wpgce_event_tracking_code', true );
		$jquery_event_track_code = get_post_meta( $post->ID, '_wpgce_event_tracking_jquery_code', true );
		
		$event_category = get_post_meta( $post->ID, '_wpgce_event_tracking_category', true );
		$event_action = get_post_meta( $post->ID, '_wpgce_event_tracking_action', true );
		$event_label = get_post_meta( $post->ID, '_wpgce_event_tracking_label', true );
		$event_track_css_id = get_post_meta( $post->ID, '_wpgce_event_tracking_css_id', true );
		$event_track_css_class = get_post_meta( $post->ID, '_wpgce_event_tracking_css_class', true );
		
		// Checkbox to activate event tracking on this page
		$output .= '<label for="event_tracking_active">';
		$output .= 'Enable Event Tracking for this page';
		$output .= '</label> ';
		$output .= '<input id="event_tracking_active" name="_wpgce_event_tracking_active" type="checkbox" value="1" '.checked( $event_tracking_active, 1, false ).'>';
		$output .= '<p>To do event tracking you need to have configured some goals in your Google analytics account.
					<br />Please see Google\'s help page for <a href="http://support.google.com/analytics/bin/answer.py?hl=en&answer=1032415" target="_blank">how to set up goals</a>.</p>';
		
		// TODO: Event tracking stuff here
		if( $event_tracking_active != 1 ) $display = "display:none;";
		$output .= '<div class="eventtrackcode" style="margin-top:10px;'.$display.'">';
		$output .= '<table class="widefat">';
		$output .= '<tr valign="top">
					<th scope="row"><label for="Category">Category</label></th>
					<td><input size="20" name="_wpgce_event_tracking_category" value="'.$event_category.'"/>
					<p class="description">Enter the Category name of your Google anaytics event goal (Mandatory)<br /></p>
					</td>
					</tr>';
		$output .= '<tr valign="top">
					<th scope="row"><label for="Action">Action</label></th>
					<td><input size="20" name="_wpgce_event_tracking_action" value="'.$event_action.'"/>
					<p class="description">Enter the Action name of your Google anaytics event goal (Mandatory)<br /></p>
					</td>
					</tr>';
		$output .= '<tr valign="top">
					<th scope="row"><label for="Label">Label</label></th>
					<td><input size="20" name="_wpgce_event_tracking_label" value="'.$event_label.'"/>
					<p class="description">Enter the Label name of your Google anaytics event goal (Optional)<br /></p>
					</td>
					</tr>';
		$output .= '<tr valign="top">
					<th scope="row"><label for="ElementID">Element ID</label></th>
					<td><input id="cewp_id" name="_wpgce_event_tracking_css_id" value="'.$event_track_css_id.'"/>
					<p class="description">Enter the unique CSS ID of the element you wish to track</p>
					</td>
					</tr>';
		$output .= '<tr valign="top">
					<th scope="row"><label for="ElementClass">Element Classname</label></th>
					<td><input id="cewp_class" name="_wpgce_event_tracking_css_class" value="'.$event_track_css_class.'"/>
					<p class="description">Enter the CSS classname of the element(s) you wish to track</p>
					</td>
					</tr>';
		$output .= '</table>';

		$output .= '</div>';
		
		return $output;
	}
	
	function construct_event_jquery_code() {
		//this function creates a snippet of jquery code which can add the event tracking code to an element
		$class = $_POST['_wpgce_event_tracking_css_class'];
		$id = $_POST['_wpgce_event_tracking_css_id'];
		$cat = $_POST['_wpgce_event_tracking_category'];
		$action = $_POST['_wpgce_event_tracking_action'];
		$label = $_POST['_wpgce_event_tracking_label'];
		
		if ($id && $class){
			$selector_string = "#".$id.".".$class;
		} else if ($id == '') {
			$selector_string = ".".$class;
		} else if ($class == '') {
			$selector_string = "#".$id;
		}
		
		$code = '<script type="text/javascript">
				jQuery.noConflict();
				jQuery(document).ready(function($) {
					$("'.$selector_string.'").attr("onClick", "_gaq.push([\'_trackEvent\', \''.$cat.'\', \''.$action.'\', \''.$label.'\']);");
				});
				</script>';
		return $code;
	}

	function my_admin_notice() {
		global $post;
		$error_msg = get_option('wpce_errors');
		if (empty($error_msg)) return '';
		foreach($error_msg as $pid => $m){
	        if ($post->ID == $pid ){
	            echo '<div id="message" class="error"><p>'.$m.'</p></div>';
	            //make sure to remove notice after its displayed so its only displayed when needed.
	            unset($error_msg[$pid]);
	            update_option('wpce_errors',$error_msg);
	            break;
	        }
		}
	}
	// Save data from meta box
	function save($post_id) {
		// Don't save data on auto save
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return;

		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( !wp_verify_nonce( $_POST['content_experiments'], plugin_basename( __FILE__ ) ) )
			return;


		// Check permissions
		if ( 'page' == $_POST['post_type'] )
		{
			if ( !current_user_can( 'edit_page', $post_id ) )
				return;
		}
		else
		{
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
		}

		if ($_POST['_wpgce_event_tracking_active'] == '1') {
			$error_str = '';
			// If value was not set, build an error message
			if ($_POST['_wpgce_event_tracking_category'] == '') {
				$error_str .= 'Please enter a value in the "Category" field of the "Event Tracking" section.<br />';
			}
			
			if ($_POST['_wpgce_event_tracking_action'] == '') {
				$error_str .= 'Please enter a value in the "Action" field of the "Event Tracking" section.<br />';
			}
			
			if ($_POST['_wpgce_event_tracking_css_id'] == '' && $_POST['_wpgce_event_tracking_css_class'] == '') {
				$error_str .= 'Please enter a value in at least one of the "Element ID" or "Element Classname" fields of the "Event Tracking" section.<br />';
			}
			if (strlen($error_str) > 0){
				$error_notice = get_option('wpce_errors');
				$error_notice[$post_id] = $error_str;
				update_option('wpce_errors', $error_notice);
			}
		}
		
		// Save the data
		foreach ($this->_meta_box['fields'] as $field) {
			if ($field['id'] == '_wpgce_event_tracking_jquery_code') {
				//we want to construct our jquery event code based on user metabox input
				$mycode = $this->construct_event_jquery_code();
				$res = update_post_meta($post_id, '_wpgce_event_tracking_jquery_code', $mycode);
			} else {
				$res = update_post_meta($post_id, $field['id'], $_POST[$field['id']]);
			}
		}
	}
}