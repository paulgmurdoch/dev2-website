<?php

get_header(); 

?>

   </div></div>
    <div class="block block-pager">
    
				<div class="holder">
                
					<div class="frame">
						<h1><span><?php
$category = get_the_category();
echo $category[0]->cat_name;
?></span></h1>
						<?php echo cleanspace_breadcrumbs(); ?>
				</div>
				</div>
				
			</div>
			<div id="main" class="main-inner">
				<div id="content" class="content-inner">
               <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<div class="post">
						<div class="top">
							<h3 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3></div>
						<div class="post-detail">
							<div class="entry-contentmain">
						<a href="<?php the_permalink();?>"><?php the_excerpt();?></a>
						</div></div>
					</div>
                   <?php endwhile; endif;?></div>
					<?php get_sidebar();?>
    
		</div>
	</div>
    <?php get_footer();?>