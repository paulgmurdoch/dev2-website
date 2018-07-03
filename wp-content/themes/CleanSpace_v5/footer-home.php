
<div id="footer">
<div class="holder">
  <div class="frame">
    <div class="clients">
      <div class="hold">
        <?php query_posts(array('post_type' => 'clients', 'posts_per_page' => 10));
if (have_posts()) : while (have_posts()) : the_post(); 
$urlbox2 = get_url_desc_box();?>
       <a href="<?php echo $urlbox2[0];?>"> <?php the_post_thumbnail('Client Pic'); ?></a>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
      </div>
    </div>
    <div class="section-1">
      <div class="inner">
        <?php get_sidebar('footer');?>
        <div class="clear"></div>
        <div class="section-2">
          <div class="inner">
            <ul class="nav">
              <?php wp_nav_menu( array( 'theme_location' => 'footer-menu','items_wrap' => '%3$s','fallback_cb' => false ) ); ?>
            </ul>
            <span class="copyright"><?php echo stripslashes(get_option('cs_footer_text')); ?></span> </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo get_option("cs_ga_code"); ?> 
<script type="text/javascript">
$('a[data-rel]').each(function() {
    $(this).attr('rel', $(this).attr('data-rel')).removeAttr('data-rel');
});
</script>
<?php wp_footer(); ?>

</body>
</html>
