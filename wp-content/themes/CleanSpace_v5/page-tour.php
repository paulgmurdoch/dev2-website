<?php
/*
Template Name: Tour
*/


?>
<?php get_header();?>
</div>
</div>

<div class="block block-pager">
  <div class="holder">
    <div class="frame">
      <h1><span>
        <?php the_title();?>
        </span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
  
</div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div id="main" class="main-inner">
  <div id="content" class="content-inner">
    <?php the_content();?>
    <?php endwhile; endif;?>
    <div class="main-holder tabs-area">
      <div class="post">
  
        <?php
		
 for ($i = 0; $i <= "\n"; $i++) ;
query_posts(array('post_type' => 'tour'));
if (have_posts()) : while (have_posts()) : the_post();

?>
        <div class="post tab-content" id="tab-1<?php echo $i ?>">
          <div class="top">
            <h3 class="entry-title">
              <?php the_title(); ?>
            </h3>
          </div>
          <div class="img-frame">
            <?php the_post_thumbnail('Blog Pic'); ?>
          </div>
          
            <?php the_content(); ?>
         
        </div>
        <?php
$i++;
endwhile;
?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
      </div>
    </div>
  </div>
  <?php get_sidebar('tour');?>
</div>
</div>
<?php get_footer();?>
