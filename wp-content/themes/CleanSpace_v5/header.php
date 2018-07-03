<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta name="google-site-verification" content="vRvw9ZS97Dp0DJYd43oWFZXdwjAAu5iHC5QjSIpHGqM" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=1000, user-scalable=yes" />
<title>
<?php wp_title(''); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css"  href="<?php echo get_template_directory_uri(); ?>/css/<?php echo get_option("cs_color_scheme"); ?>.css" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="shortcut icon" type="image/x-icon" href="http://dev2.co.za/favicon.ico">

<!--[if gte IE 8]><link href="<?php echo get_template_directory_uri(); ?>/css/ie.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->
  
<?php wp_enqueue_script("jquery"); ?>
<?php    if( is_page_template('portfolio.php') || is_page_template('portfolio2.php') ) 
    wp_enqueue_script('jTools', 'http://cdn.jquerytools.org/1.2.5/all/jquery.tools.min.js', array('jquery'), '1.2.5');
	 ?>
<?php wp_head(); ?>
<?php
//loads comment reply JS on single posts and pages
if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' ); ?>
<script type='text/javascript'>
    jQuery(function($){
	 <?php $twitter = get_option("cs_twitname"); 
	if( !empty($twitter) )
	{
 ?>
        $(".tweet").tweet({
            username: "<?php echo get_option("cs_twitname"); ?>",
            join_text: "auto",
            count: 1,
            auto_join_text_default: "we said,", 
            auto_join_text_ed: "we",
            auto_join_text_ing: "we were",
            auto_join_text_reply: "we replied to",
            auto_join_text_url: "we were checking out",
            loading_text: "loading tweets..."
        });

<?php } ?>
		$(window).load(function(){
		// Setup Slider
		$(".my_asyncslider").asyncSlider({
			keyboardNavigate: true,
			easing: 'easeInOutSine',
			random: false,
			minTime: 600,
			maxTime: 900,
			slidesNav: $("#asyncslider_links"),
			autoswitch: <?php echo get_option("cs_slide_speed"); ?>,
			direction: '<?php echo get_option("cs_slide_direction"); ?>'
			});
		
	
	});
    });
	</script>
<?php
if( is_page_template('portfolio.php') || is_page_template('portfolio2.php') ) {
?>
<script type="text/javascript">
jQuery(function($) {
    $('a[rel^="#olay"]').overlay({ mask: '#999999' });
});
</script>
<?php
}
?>
<script type='text/javascript'>
$(document).ready(function() {
     $(".slider").hide();
     $(".slider").slideUp(1).delay(1400).slideDown('slow');
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('#menu>li>a').click(function(event) {
    if ($(this).parent().children('ul').length) {
      event.preventDefault();
    }
  });
});
</script>
</head>
<?php
		$class = get_custom_body_classes();
	?>
<body <?php body_class($class); ?>>
<div id="wrapper">
<div class="w1">
<div class="navbar-bg">
  <div id="navbar">
    <div class="wrapper clearfix"></div>

    <!-- BEGIN: menu -->
    <?php wp_nav_menu( array( 'theme_location' => 'menu-main','sort_column' => 'menu_order', 'menu_id' => 'menu','fallback_cb' => false ) ); ?>
  </div>
</div>
  <meta name="google-site-verification" content="vRvw9ZS97Dp0DJYd43oWFZXdwjAAu5iHC5QjSIpHGqM" />
<!-- END: header -->

<div class="w1-holder">
<div id="header">
<div class="holder">
