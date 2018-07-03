<?php
	/* Template Name: Contact */
?>
<?php 
//If the form is submitted
if(isset($_POST['submitted'])) {

	//Check to see if the honeypot captcha field was filled in
	if(trim($_POST['checking']) !== '') {
		$captchaError = true;
	} else {
	
		//Check to make sure that the name field is not empty
		if(trim($_POST['contactName']) === '') {
			$nameError = 'You forgot to enter your name.';
			$hasError = true;
		} else {
			$name = trim($_POST['contactName']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$emailError = 'You forgot to enter your email address.';
			$hasError = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$emailError = 'You entered an invalid email address.';
			$hasError = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		//Check to make sure comments were entered	
		if(trim($_POST['comments']) === '') {
			$commentError = 'You forgot to enter your comments.';
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['comments']));
			} else {
				$comments = trim($_POST['comments']);
			}
		}
			
		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = ''. get_bloginfo('admin_email') .'';
			$subject = 'Support Request from '.$name;
			$sendCopy = trim($_POST['sendCopy']);
			$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
			$headers = 'From: '.$name.'<'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			if($sendCopy == true) {
				$subject = 'You sent a support request';
				$headers = 'From: ' . get_bloginfo('name') . ' <'. get_bloginfo('admin_email') .'>';
				mail($email, $subject, $body, $headers);
			}

			$emailSent = true;

		}
	}
} ?>
<?php get_header();?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/contact-form.js"></script>
</div>
</div>

<div class="block block-pager">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="holder">
    <div class="frame">
      <h1><span>
        <?php the_title();?>
        </span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
  
</div>
<div id="main" class="main-inner">
  <div id="content" class="content-inner">
    <?php the_content();?>


  </div>
  <?php endwhile; endif;?>
  <?php get_sidebar('contact');?>

</div>
</div>
<?php get_footer();?>
