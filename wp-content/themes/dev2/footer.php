    <footer id="contact-us">
        <div class="footer-container container">
            <div class="social">
                <div class="social-items">
                    <a href="https://www.facebook.com/Dev2Technologies" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/Dev2_ZA" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/company/dev2" target="_blank"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
            <div class="copyright">
                Copyright © <?php echo date('Y'); ?> Dev 2 
                <?php 
                $theme_locations = get_nav_menu_locations();

                $menu_obj = get_term( $theme_locations['footer'], 'nav_menu');

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
                foreach ($items as $item) {
                    //print_r( $item->post_title . ' - ' . $item->post_name );

                    if ($item->post_title === "Blog") {
                    $item->post_name = "/blog";
                    } else if ($item->post_title === "Homepage") {
                    $item->post_name = "/";
                    } else if ($item->post_title === "Website Map") {
                    $item->post_name = "/sitemap_index.xml";
                    } else {
                    $item->post_name = "/#" . $item->post_name;
                    }

                    echo '/ <a href="' . $item->post_name . '"">' . $item->post_title . '</a>&nbsp;';
                }
            ?>
            </div>
            
        </div>
        <div class="clear"></div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
