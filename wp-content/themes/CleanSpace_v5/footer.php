<div id="footer">
<div class="holder">
  <div class="frame">
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
