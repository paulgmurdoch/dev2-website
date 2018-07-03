<?php get_header(); ?>

<div class="container posts">
  <div class="row">
    <div class="col-xs-8 col-md-8">
      <?php
        $args = array (
          'post-type' => 'post'
        );

        $url = $_SERVER['REQUEST_URI'];
        if( strpos($url, "blog") > 0 ) {
        // if (substr($url,-4)=="blog") {
          $post_query = new WP_Query($args);
          if ($post_query->have_posts())
            while ($post_query->have_posts()) {
              $post_query->the_post();
                
      ?>
      <div class="post">
        <?php
          echo '<a href="' . get_permalink() . '" target="_blank">';
          the_title('<h2>', '</h2>');
          echo '</a>';
          the_post_thumbnail( 'large' );  
          the_excerpt();
          echo '<br/>';
          echo do_shortcode( "[icon name='fa-calendar-o']" ) . " ";
          the_date("d F");
        ?>
      </div>
      <?php
          }
        } else if(strpos($_SERVER['REQUEST_URI'], "map") > 0) { ?>
        
        <h1>Dev2 - Sitemap</h1>
        <br>
        <?php 
              $theme_locations = get_nav_menu_locations();

              $menu_obj = get_term( $theme_locations['primary-mobile'], 'nav_menu');

              $menu_name = $menu_obj->name;

              $menu = wp_get_nav_menu_object( $menu_name );
              $items = get_objects_in_term( $menu->term_id, 'nav_menu' );

              $defaults = array( 'order' => 'ASC', 'orderby' => 'menu_order', 'post_type' => 'nav_menu_item',
                'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true );
              $args = wp_parse_args( $args, $defaults );
              $args['include'] = $items;
          
              if ( ! empty( $items ) ) {
                  $items = get_posts( $args );
              } else {
                  $items = array();
              }
              echo '<div class="row"><div class="col-sm-6"><h3>Pages</h3>';
              foreach ($items as $item) {
                //print_r( $item->post_title . ' - ' . $item->post_name );

                if ($item->post_title === "Blog") {
                  $item->post_name = "/blog";
                } else if ($item->post_title === "Home") {
                  $item->post_name = "/";
                } else {
                  $item->post_name = "/#" . $item->post_name;
                }

                echo '<a href="' . $item->post_name . '"><p>' . $item->post_title . '</p></a>';
              }
              echo '</div>';

              // print_r($items);

            ?>
            <div class="col-sm-6"><h3>Posts</h3>
              <?php 
              $args = array (
                'post-type' => 'post'
              );
              $post_query = new WP_Query($args);
              if ($post_query->have_posts()) {
                while ($post_query->have_posts()) {
                  $post_query->the_post();
                  echo '<a href="' . get_permalink() . '">';
                  echo the_title('<p>', '</p>');
                  echo '</a>';
                }
              }
              ?>
              
            </div>
            </div>

        <?php } else {
          if (have_posts())
          while (have_posts()) {
            the_post();
            ?>
              <div class="post">
                <?php
                  the_post_thumbnail( 'large' );  
                  echo '<a href="' . get_permalink() . '" target="_blank">';
                  the_title('<h2>', '</h2>');
                  echo '</a>';
                  the_excerpt();
                  echo do_shortcode( "[icon name='fa-calendar-o']" ) . " ";
                  the_date("d F");
                ?>
              </div>
            <?php
          }
        }
      ?>
    </div>
    <div class="col-xs-4 col-md-4">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>

<section class="contact-us" id="contact-us">
  <div class="container">
      <div class="row text-center">
          <?php echo do_shortcode("[contact-form-7 id='11']"); ?>
      </div>
  </div>
</section>
<script>
  var url = window.location.href;
  var newUrl;
  // if(url.endsWith('/')) {
  //   newUrl = url.slice(0, -1);
  //   window.location = newUrl;
  // }
</script>

<?php get_footer(); ?>
