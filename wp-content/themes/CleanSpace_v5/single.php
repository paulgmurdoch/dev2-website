<?php

get_header(); 

?>

</div>
</div>

<div class="block block-pager">
  <div class="holder">
    <div class="frame">
      <h1><span><?php single_post_title(); ?> </span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
</div>
<div id="main" class="main-inner">
  <div id="content" class="content-inner">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="post <?php post_class(); ?>"  >
      <div class="top">
        <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark">
          </a></h3>
        <em class="date">
        
        </em> </div>
      
      <div class="img-frame">
        <?php if(get_post_meta($post->ID, "meta_box_video_embed", true)) {
	echo '<div class="video">';
	echo stripslashes(get_post_meta($post->ID, "meta_box_video_embed", true));
	echo '</div>';       

                                                     } else { ?>
                    <?php the_post_thumbnail('Blog Pic'); ?>
                    <?php } ?>
      </div>
      
      <div class="post-detail">
        <div class="entry-contentmain">
          <?php the_content();?>
          <?php wp_link_pages(array('before' => '<p>Pages:','after' => '</p>', 'next_or_number' => 'number'));  ?>
        </div>
      </div>
    </div>
    <?php endwhile; endif;?>
  </div>
  <?php get_sidebar();?>
</div>
</div>
<?php get_footer();?>
