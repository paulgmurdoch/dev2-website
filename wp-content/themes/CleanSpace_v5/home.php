<?php get_header();?>
<meta name="google-site-verification" content="vRvw9ZS97Dp0DJYd43oWFZXdwjAAu5iHC5QjSIpHGqM" />
<div class="clouds"> <img src="<?php echo get_template_directory_uri(); ?>/images/clouds.png" /> </div>
<div class="slider">
  <div class="holder">
    <ul class="my_asyncslider">
      <?php
$count = 1;

query_posts(array('post_type' => 'slider', 'posts_per_page' => 10));
if (have_posts()) : while (have_posts()) : the_post();
$urlbox = get_url_desc_box();
?>


      <li>
        
		<div style="margin: 0 auto;"><?php if (function_exists( 'muneeb_ssp_slider')) {muneeb_ssp_slider(1624);} ?></div>
        <div class="text">
          <h1><span>
            <a href="<?php echo $urlbox[0];?>"><?php the_title(); ?></a>
            </span></h1>
          <div class="holder">
            <?php the_excerpt(); ?>
          </div>
        </div>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </ul>
  </div>
  <div>
    <ul class="switcher">
      <li id="asyncslider_links"></li>
    </ul>
  </div>
</div>
</div>
</div>
<div class="block">
  <div class="holder">
    <div class="frame"> <span class="easy"><?php echo get_option('cs_textbar'); ?></span> <a href="<?php echo get_option('cs_start_button_link'); ?>" <?php if (get_option('cs_include_button')) {	
		echo 'class="start-btn"';} ?>><span><?php echo get_option('cs_start_button'); ?></span></a> </div>
  </div>
</div>
<div id="main" class="home">
  <div id="content">
    <?php $homebox = get_option('cs_box_cat');  ?>
    <?php $boxposts = get_option('cs_box_number');  ?>
    <?php query_posts( array ( 'category_name' => $homebox, 'posts_per_page' => $boxposts ) ); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
    <div class="homebox">
      <div class="text">
        <h4><a href="<?php the_permalink() ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h4>
        <?php the_content(); ?>
      </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>
  </div>
  <?php get_sidebar('home');?>
  <?php $featured = get_option('cs_featured_cat');  ?>
  <?php query_posts( array ( 'category_name' => $featured, 'posts_per_page' => -3 ) ); ?>
  <div class="block-features">
    <div class="holder">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
      <div class="box">
        <?php if( has_post_thumbnail() ) {?>
        <div class="img-frame"> <a href="<?php the_permalink() ?>">
          <?php the_post_thumbnail('Home Pic'); ?>
          </a></div>
        <?php } else { echo '<div class="img-frame"><img src="'.get_bloginfo("template_url").'/images/img-default.png" /></div>';
}?>
        <h4><a href="<?php the_permalink() ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h4>
        <?php the_excerpt(); ?>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>
  <div class="block-features"> </div>
</div>
<?php get_sidebar('home');?>
</div>
<?php get_footer('home');?>
