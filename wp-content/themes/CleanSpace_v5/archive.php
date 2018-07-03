<?php get_header();?>
</div>
</div>
<div class="block block-pager">
  <div class="holder">
    <div class="frame">
      <h1><span>Archives</span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
  
</div>
<div id="main" class="main-inner">
  <div id="content" class="content-inner"> <br/>
    <?php the_post(); ?>
    <?php get_search_form(); ?>
    <h2>Archives by Month:</h2>
    <ul>
      <?php wp_get_archives('type=monthly'); ?>
    </ul>
    <h2>Archives by Subject:</h2>
    <ul>
      <?php wp_list_categories(); ?>
    </ul>
  </div>
  <?php get_sidebar();?>
</div>
</div>
<?php get_footer();?>
