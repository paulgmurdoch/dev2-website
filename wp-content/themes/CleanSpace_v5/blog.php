<?php
/*
Template Name: Blog
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
<div id="main" class="main-inner">
  <div id="content" class="content-inner">
    <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $the_query = query_posts(
        array(
            
            'posts_per_page'=>3,
            'orderby'=>'date',
			 'paged'=>$paged
			
        )
    );
    
?>
    <?php if (have_posts()) :
   while (have_posts()) :
       the_post(); ?>
    <?php $exclude = get_option('cs_box_cat');  ?>
    <?php if ( in_category($exclude) && !is_single() ) continue; ?>
    <div class="post">
      <div class="top">
        <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h3>
        <em class="date">
        <?php the_time(get_option('date_format')); ?>
        </em> </div>
      
      <div class="img-frame"> <a href="<?php the_permalink() ?>">
        <?php if(get_post_meta($post->ID, "meta_box_video_embed", true)) {
	echo '<div class="video">';
	echo stripslashes(get_post_meta($post->ID, "meta_box_video_embed", true));
	echo '</div>';       

                                                     } else { ?>
                    <?php the_post_thumbnail('Blog Pic'); ?>
                    <?php } ?>
        </a></div>
      
      <div class="post-detail">
        <div class="entry-content">
          <?php the_excerpt(); ?>
        </div>
       </div>
    </div>
    <?php endwhile;
endif;
?>
<br/>
    <?php posts_nav_link(); ?>
  </div>
  <?php get_sidebar();?>
   
  
</div>

    
     </div>
 

<?php get_footer();?>
