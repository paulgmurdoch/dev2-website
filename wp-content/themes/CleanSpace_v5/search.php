<?php get_header();?>
</div>
</div>
<div class="block block-pager">
  <div class="holder">
    <div class="frame">
      <h1><span>Search Results</span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
  
</div>
<div id="main" class="main-inner">
  <div id="content" class="content-inner">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <a href="<?php the_permalink();?>">
    <h4>
      - <?php the_title();?>
    </h4>
    </a>
    <?php the_excerpt();?>
    <br/>
    <?php endwhile; ?>
    <?php else : ?>
    <article id="post-0" class="post no-results not-found">
      <h4>
        <?php _e( 'Nothing Found', 'CleanSpace' ); ?>
      </h4>
        <p>
        <?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'SupportBit' ); ?>
      </p>
    </article>
    <?php endif; ?>
  </div>
  <?php get_sidebar();?>
</div>
</div>
<?php get_footer();?>
