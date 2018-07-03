<?php
/* The template for displaying Comments. */
 
?>

<div class="comments">
  <?php if ( post_password_required() ) : ?>
  <p class="nopassword">
    <?php _e( 'This post is password protected. Enter the password to view any comments.', 'CS' ); ?>
  </p>
</div>
<!-- #comments -->
<?php
		
		return;
	endif;
?>
<?php
	// You can start editing here -- including this comment!
?>
<?php if ( have_comments() ) : ?>
<h6 id="comments-title"><?php echo get_comments_number();?> Comment(s)</h6>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
<div class="navigation">
  <div class="nav-previous">
    <?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'CS' ) ); ?>
  </div>
  <div class="nav-next">
    <?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'CS' ) ); ?>
  </div>
</div>
<!-- .navigation -->
<?php endif; // check for comment navigation ?>
<ol class="comment-list">
  <?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use cs_comment() to format the comments.
					 */
					wp_list_comments( array( 'callback' => 'cs_comment' ) );
				?>
</ol>
<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
<div class="navigation">
  <div class="nav-previous">
    <?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'CS' ) ); ?>
  </div>
  <div class="nav-next">
    <?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'CS' ) ); ?>
  </div>
</div>
<!-- .navigation -->
<?php endif; // check for comment navigation ?>
<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
<p class="nocomments">
  <?php _e( 'Comments are closed.', 'CS' ); ?>
</p>
<?php endif; // end ! comments_open() ?>
<?php endif; // end have_comments() ?>
<?php comment_form(); ?>
</div>
<!-- #comments --> 
