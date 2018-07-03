<?php
/**
 * The template for displaying all single posts.
 */
get_header(); 
?>

<style>
    header .header-blog .h-blog-text {
        margin-top: 100px;
    }
    .plug, .running-plug {
        display: none !important;
    }
    header {
        height: 450px !important;
    }
    .postsWrapper a {
        color: #20913B !important;
    }
    .postsWrapper a:hover {
        color: #208538 !important;
    }
    .cat-item {
        list-style: none;
    }
</style>

<div class="container" style="padding-bottom: 0px; padding-top: 15px;">
    <div class="row">
        <a href="/blog" class="button-center"><button class="btn btn-primary button-center">Back to posts</button></a>
    </div>
</div>

<div class="container post-single">
    <div class="row">
        <div class="col-xs-8 col-md-8">
            <?php
                while ( have_posts() ) : the_post();
                    $post_id = get_the_ID();
                    $queried_post = get_post( $post_id );
                    $cat = get_the_category( $post_id );
                    $post_date = $queried_post->post_date;
                    $args = array(
                        'status' => 'approve',
                        'post_id' => $post_id, // use post_id, not post_ID
                    );
                    $comments = get_comments($args);
            ?>
            <h1 class="single-blog-title"><?php echo $queried_post->post_title; ?></h1>
            
            <div class="postsWrapper addthis-share">
                <?php the_post_thumbnail( 'large' ); ?>
                <div class="date-section">
                    <i class="fa fa-calendar-o"></i>&nbsp;<?php echo date("j F", strtotime($post_date)); ?>
                </div>
                <div class="cat-section">
                    <strong>Category</strong>&nbsp;&nbsp;<?php echo $cat[0]->name; ?>
                </div>
                <div class="content">
                    <?php echo $queried_post->post_content; ?>
                </div>
                <div class="sharethis-inline-share-buttons" style="margin-top: 20px;"></div>
                
            </div>
            <hr style="margin-top: 25px;" />
            <?php
            if ( $comments ) {
                foreach ( $comments as $comment ) {
                    echo '<h4 style="padding-top: 10px; padding-bottom: 0px; margin-bottom: 0px;">' . $comment->comment_author . '</h4>';
                    echo '<span>' . date('F j, Y', strtotime($comment->comment_date_gmt)) . '</span>';
                    echo '<p style="padding-left: 15px;">' . $comment->comment_content . '</p>';
                    // var_dump($comment);
                    echo '<hr style="border-color: #E8E8E8;" />';
                }
            } else {
                echo 'No comments found.';
            }
            ?>
            <?php comment_form(); ?>.
            <?php endwhile; ?>
        </div>
        <div class="col-xs-4 col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>
<section class="contact-us" id="contact-us">
  <div class="container">
      <div class="row text-center">
          <?php echo do_shortcode("[contact-form-7 id='11']"); ?>
      </div>
  </div>
</section>

<?php get_footer(); ?>