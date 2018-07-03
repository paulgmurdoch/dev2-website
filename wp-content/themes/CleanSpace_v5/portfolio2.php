<?php
/*
Template Name: Portfolio Two Column
*/


?>
<?php get_header();?>
</div>
</div>

<div class="block block-pager">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="holder">
    <div class="frame">
      <h1><span>
        <?php the_title();?>
        </span></h1>
      <?php echo cleanspace_breadcrumbs(); ?> </div>
  </div>
  
</div>
<div id="main" class="work-main">
  <div id="content" class="content-inner">
    <?php the_content();?>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
  </div>
  
  <!-- BEGIN FILTERS -->
  <ul id="filters">
    
    <!-- BEGIN FILTER -->
    <li id="filter-title"> Filter 
      
      <!-- END FILTER --> 
    </li>
    
    <!-- LI -->
    <li id="all"><a class="active" href="#" data-filter="*">All</a></li>
    <?php 
			$terms = get_terms("portfolio_categories");
			$count = count($terms);
			if ( $count > 0 ){
			$sPattern = '/\s*/m';
			$sReplace = '';
			foreach ( $terms as $term ) {
			$isoTax = preg_replace( $sPattern, $sReplace, $term->name);
			echo '<li><a href="#" data-filter=".' . $isoTax . '">' . $term->name . '</a></li>';
				}
			} 
			?>
    
    <!-- END FILTERS -->
  </ul>
  <div id="work-outer">
    <?php
$count = 1;

query_posts(array('post_type' => 'portfolio',  'posts_per_page'=>30));
if (have_posts()) : while (have_posts()) : the_post();
?>
    <?php $terms_l = get_the_terms ($post->ID, 'portfolio_categories'); ?>
    <div class="work-box2 itope <?php unset($term_links);
					$sPattern = '/\s*/m';
					$sReplace = '';
					foreach ($terms_l as $term) {
					$term_links[] = preg_replace( $sPattern, $sReplace, $term->name); }
					$on_draught = join(" ", $term_links);
					echo $on_draught; 
					?>">
      <?php if( has_post_thumbnail() ) {?>
      <div class="img-frame"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" data-rel="#olay<?php echo $count; ?>">
        <?php the_post_thumbnail('Portfolio Pic'); ?>
        </a></div>
      <?php } else { echo '<div class="img-frame"><img src="'.get_bloginfo("template_url").'/images/img-portfolio-default.png" /></div>';
}?>
      <h4><a href="<?php the_permalink(); ?>" title="Permalink to <?php the_title_attribute(); ?>" data-rel="#olay<?php echo $count; ?>">
        <?php the_title(); ?>
        </a></h4>
      <?php cs_the_excerpt('15'); ?>
    </div>
    <!-- LOOP FOR OVERLAY -->
    <div id="olay<?php echo $count; ?>" class="overlay">
    <div class="olay-image">
       
        <?php if(get_post_meta($post->ID, "meta_box_video_embed", true)) {
	echo '<div class="video">';
	echo stripslashes(get_post_meta($post->ID, "meta_box_video_embed", true));
	echo '</div>';       

                                                     } else { ?>
                    <?php the_post_thumbnail('Portfolio Overlay'); ?>
                    <?php } ?>
   </div>
      <div class="olay-content">
        <h2>
          <?php the_title(); ?>
        </h2>
        <?php the_content(); ?>
      </div>
    </div>
    <!-- END LOOP FOR OVERLAY -->
    <?php $count++; endwhile; endif; ?>
  </div>
 </div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('.close').bind('clickoutside', function(){
		videoWrap = $('.video');
   videoWrap.html( videoWrap.html() );
});
});
</script>
<?php get_footer();?>
<?php wp_footer(); ?>
