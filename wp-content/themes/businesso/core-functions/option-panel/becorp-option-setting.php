<?php add_action('admin_menu','businesso_add_opiotn_page');
function businesso_add_opiotn_page(){
$page = add_theme_page( __('businesso','businesso'), __('About Theme','businesso'), 'edit_theme_options', 'businesso', 'businesso_option_panal_function' );
add_action('admin_print_styles-'.$page, 'businesso_admin_enqueue_scripts');
} 

 function businesso_admin_enqueue_scripts()
{
		/*====businesso Option Panel Style====*/
		wp_enqueue_style('thickbox');	
		wp_enqueue_style('businesso-style', ASIATHEMES_TEMPLATE_DIR_URI.'/core-functions/option-panel/css/style.css');//enqueu 
		wp_enqueue_style('businesso-bootstrap', ASIATHEMES_TEMPLATE_DIR_URI.'/core-functions/option-panel/css/bootstrap.css');//enqueu option panel bootstrap
		wp_enqueue_style('businesso-font-awesome-4.2.0', ASIATHEMES_TEMPLATE_DIR_URI.'/core-functions/option-panel/css/font-awesome-4.2.0/css/font-awesome.min.css');//enqueu option panel font-awesome-4.2.0
}
 
function businesso_option_panal_function()
{ $theme_data = wp_get_theme();	 ?>
<div class="wrapper">
	<div class="at-notify" id="at-notify">
		  <div class="col-md-3">
				<h1><?php _e('businesso','businesso');?> <span> <?php _e('Premium','businesso');?></span></h1>
				<h4><a href="http://asiathemes.asia/?item=businesso" target="_blank"><?php _e('Get Our','businesso'); ?> <span><?php _e('Premium Theme','businesso'); ?></span></a></h4>
				<div class="about-image">
				<a href="https://asiathemes.com/businessodetail/" target="_blank"><img src="<?php echo get_template_directory_uri();?>/screenshot.png"></a>
				</div>
			</div>
            <div class="col-md-6">
			  <h3><?php _e('Our Latest Features','businesso'); ?></h3>
			  <div class="col-md-6">
					<ul>
						<li> <?php _e('18 Templates pages','businesso'); ?> </li>						
						<li><?php _e('8 types Colours Schemes','businesso'); ?>  </li>
						<li><?php _e('6 types Awesome Portfolio &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Page Templates','businesso'); ?>  </li>
						<li><?php _e('Portfolio Page Templates &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; with awesome Photo-box &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Slider','businesso'); ?>  </li>
						<li><?php _e('One Most GALLERY page &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; portfolio template','businesso'); ?>  </li>
						<li><?php _e('One most new feature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Enable/Disable animation','businesso'); ?>  </li>
						<li><?php _e('Two variation with Latest &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; feature Dark & Light &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; variation','businesso'); ?>  </li>
						<li><?php _e('3 types Awesome Home &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pages Templates','businesso'); ?>  </li>
						<li><?php _e('Latest Team page Template','businesso'); ?>  </li>
						<li><?php _e('2 types Awesome Contact &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pages Templates','businesso'); ?>  </li>
						
						
					</ul>
				</div>
				<div class="col-md-6">
					<ul>
						<li><?php _e('2 types Awesome Service &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pages Templates','businesso'); ?>  </li>
						<li> <?php _e('7 Types Of Blog  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Templates','businesso'); ?> </li>
						<li><?php _e('One Year Free Support','businesso'); ?> </li>
						<li> <?php _e('Google Fonts','businesso'); ?>  </li>
						<li> <?php _e('Bootstrap Slider','businesso'); ?>  </li>
						<li> <?php _e('Ultimate Portfolio layout &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; with Taxonomy Tab effect','businesso'); ?>  </li>
						<li> <?php _e('Translation Ready','businesso'); ?> </li>
						<li> <?php _e('Coming Soon Mode','businesso'); ?>  </li>
						<li><?php _e('Responsive Design','businesso'); ?> </li>
						<li><?php _e('Patterns Background','businesso'); ?>   </li>
						<li><?php _e('Full Width & Boxed Layout','businesso'); ?>  </li>
						<li><?php _e('Woo-commerce Plug-in &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; compatible is coming &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; soon','businesso'); ?>  </li>
						<li><?php _e('Awesome Shortcodes is &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; coming soon ','businesso'); ?>  </li>
						
						
					</ul>
				</div>	
             </div>				
			<div class="col-md-3 notify-btn">
					<a href="http://asiathemes.asia/?item=businesso" target="_blank" class="btn btn-success btn-lg"><?php _e('View businesso Pro Demo','businesso'); ?> </a>
					<a href="https://asiathemes.com/businessodetail/" target="_blank" class="btn btn-primary btn-lg" ><?php _e('Upgrade to businesso Pro','businesso'); ?></a>
			</div>
	</div>
<div class="clearfix"></div>


<!-------Header------------>
<div class="header1">
  <div class="logo">
	<h1><?php printf(__('Welcome to %1s %2s', 'businesso'), $theme_data->Name, $theme_data->Version ); ?></h1>
	<h2><?php printf(__('Getting Started with %s', 'businesso'), $theme_data->Name); ?>:</h2>
	<p class="faq-text"><?php printf('How to set-up Home page ?.','businesso'); ?></p>
	<p class="page-text"><?php printf('1. Go to Admin Dashboard >> Pages >> Add new Page. Now select the <b style="color:#a0ce4e;"> " Home-page " </b>template from right sidebar Template select option and publish the page.', 'businesso'); ?></p>
	<p class="page-text"><?php printf('2. After that Go to Admin Dashboard >> Settings >> Reading. Now select Static Page and set Front Page and Post Page as your choice.', 'businesso'); ?></p>
	<p class="page-text"><?php printf(__('3. %s Theme Customizer for all settings of theme . Click <b style="color:#a0ce4e;"> "Customize Theme" </b> or Click on given below strip <b style="color:#a0ce4e;">"View Customizer"</b> Button to open the Customizer now.',  'businesso'), $theme_data->Name); ?></p>
	<h2><?php printf('FAQ.','businesso'); ?></h2>
	<p class="page-text"><?php printf('1. Child Theme:','businesso'); ?></p>
	<p class="page-text"><?php printf('If you modify the theme and it upgrade with next updated version. Then your modifications will be lost. <br>If you want to protect your modifications then you create child theme. Child theme you will ensure your modifications and speed up your development time ','businesso'); ?></p>
	<p class="page-text"><?php printf('For child theme to click on' ,'businesso'); ?> <a href="https://codex.wordpress.org/Child_Themes" target="_blank" class="min-button">  <?php _e(' Child Theme', 'businesso'); ?></a>  <?php printf('Button.','businesso'); ?></p>
  </div>
</div>
<br />

<div class="header1">
  <div class="logo">
    <h2><?php _e('We have add all the option Settings inside the customiser, this is powerfull utility of WordPress, with the help of this you can create your site with live preview, ie customizer will provide you the current time preview. We have not changed any structure so you will still be able to access the previously configured data.','businesso');?></h2> 
   </div>
</div>
<br />
<div class="clearfix"></div>
<div class="header1">
  <div class="logo">
    <h2><a href="<?php bloginfo ( 'url' );?>/wp-admin/customize.php" target="_blank" class="min-button-custom pull-right"><?php _e('View Customizer','businesso'); ?></a></h2> 
	<h2><a href="https://asiathemes.com"><img src="<?php echo get_template_directory_uri();?>/core-functions/option-panel/images/asialogo.png"></a></h2>
	
   </div>
</div>
<div class="clearfix"></div>
</div>

<?php }
?>
