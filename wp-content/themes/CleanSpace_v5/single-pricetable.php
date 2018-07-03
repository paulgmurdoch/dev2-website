<?php get_header();?>
</div>
</div>

<div class="block block-pager">
  <div class="holder">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="frame">
      <h1><span>
        <?php the_title();?>
        </span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
  
</div>
<div id="main" class="main-inner">
  <div id="content" class="content-inner-full">
    <?php the_content();?>
  </div>
  <?php endwhile; endif;?>
</div>
</div>
</div>
<?php get_footer();?>
