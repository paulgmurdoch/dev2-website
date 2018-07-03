<?php get_header();?>
</div>
</div>

<div class="block block-pager">
  <div class="holder">
    <div class="frame">
      <h1><span> Tag Archive </span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
</div>
<div id="main" class="main-inner">
  <div id="content" class="content-inner">
    <div class="navigation">
      <div class="alignleft">
        <?php next_posts_link('« Older Entries') ?>
      </div>
      <div class="alignright">
        <?php previous_posts_link('Newer Entries »') ?>
      </div>
    </div>
    <br/>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
    <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
      <?php the_title(); ?>
      </a></h3>
    <div class="entry">
      <?php the_content('Read the rest of this entry »'); ?>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <?php get_sidebar();?>
</div>
</div>
<?php get_footer();?>
