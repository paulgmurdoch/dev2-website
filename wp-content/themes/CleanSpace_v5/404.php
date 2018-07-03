<?php get_header();?>
</div>
</div>

<div class="block block-pager">
  <div class="holder">
    <div class="frame">
      <h1><span>
        Oops! 404 Error
        </span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
  
</div>
<div id="main" class="main-inner">
  <div id="content" class="content-inner">
    <p>
      <?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps one of the links below, can help.', 'cs' ); ?>
    </p>
    <p class="404">oops</p>
    <?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>
    <div class="widget">
      <h2 class="widgettitle">
        <?php _e( 'Most Used Categories', 'cs' ); ?>
      </h2>
      <ul>
        <?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
      </ul>
    </div>
    <?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'cs' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
					?>
    <?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
  </div>
  <?php get_sidebar();?>
</div>
</div>
<?php get_footer();?>
