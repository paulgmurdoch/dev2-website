<?php
/*
 *  Plugin Name: Site Plugin for dev2.co.za
 *  Description: Site specific code and plugin for dev2.co.za
 */

 /* Begin cool stuff below this line */



$page_title = 'Front page';
$menu_title = 'Front Page';
$menu_slug  = 'front-page';
$capability = 'development';













 /* Custom mailer widget */

// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wp_dev2_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// Crafting the widget
class wp_dev2_widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            // Base ID of your widget
            'wpb-widget',
            __('Custom dev2 Mailer', 'wp_dev2_widget_domain'),
            // Widget description
            array( 'description' => __( 'Simple widget to show a mailer form', 'wp_dev2_widget_domain'), )
        );
    }

    

    // Crafting widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $body = apply_filters( 'widget_body', $instance['body'] );
        $editboxname = apply_filters( 'widget_form_personname', $instance['personname'] );
        $editboxemail = apply_filters( 'widget_form_email', $instance['personemail'] );


        // Before and after widget arguments are defined by themes
        $body = 'If you’d like to keep up to date with all our software adventures and goings-on at Dev2, sign up for our Blog.';
?> 

    <style>
        .input-tag {
            width: 94%;
            background-color: #1F8437;
            border: 0;
            color: #fff;
            display: block;
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            /* height: 30px; */
            margin-bottom: 20px;
            padding: 5px 20px;
        }
        .input-tag:placeholder {
            color: #fff;
        }
        .mailer-button {
            color: #fff;
            background-color: transparent;
            border: 1px solid #fff;
            border-radius: 100px;
            padding: 10px 15px;
            cursor: pointer;
        }
    </style>
    <div class="sidebar-item">
        
    </div>

<?php
        // if ( ! empty($title) )  
            // echo $args['before_title'] . $title . $args['after_title'];
        // if ( ! empty($editboxname) )

            // echo $args['before_name'] . $editboxname . $args['after_name'];

        // echo $args['before_email'] . $editboxemail . $args['after_email'];

        // This is where you run the code and display the output
        // echo __( 'Hello, World!', 'wp_dev2_widget_domain' );
        // echo $args['after_widget'];
    }   

    //Widget Backend
    public function form( $instance ) {
        if ( isset( $instance['title'] ) ) {
            $title = $instance['title'];
        } else {
            $title = __( 'New title', 'wp_dev2_widget_domain');
        }
/*
    *  Widget admin form
    */


?>
<p>
    <script type='text/javascript'>
        function showDiv(elem) {
            if (elem.value == 1) {
                document.getElementById('mailchimp').style.display = "block";
            }
        }
    </script>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" 
            type="text" name="<?php echo $this->get_field_id( 'title' ); ?>" 
            value="<?php echo esc_attr( $title ); ?>">
    <label for="<?php echo $this->get_field_id( 'body' ); ?>"></label>
    <input type="text" name="<?php echo $this->get_field_id( 'body' ); ?>" value="<?php echo $this->get_field_id( 'body' ); ?>"
            class="widefat" id="<?php echo $this->get_field_id( 'body' ); ?>" >
    <label for="typeOfMailer">Select your mailer:</label>
    <select id="typeOfMailer" class="widefat" onchange="showDiv(this)">
        <option value="0">Custom</option>
        <option value="1">MailChimp</option>
    </select>
    
    <div id="mailchimp" style="display: none;">
        <label for="mailchimpServer">Mailchimp Server:</label>
        <input type="text" name="mailchimpServer" value="MailChimp Server">

        <label for="mailchimpApi">Mailchimp API Key:</label>
        <input type="text" name="mailchimpApi" value="MailChimp API Key">
    </div>
    <br>
    <input type="checkbox" name="name" value="Name"> Accept users name
    
</p>
<?php
    }
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // End of the class

/* End of Customer mailer widget */



 /* End of the cool stuf, awww sad face */


?>