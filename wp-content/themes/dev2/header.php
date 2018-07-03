<!DOCTYPE html>
<html>

<head>
    <title>Dev2 Website Strategy / Architecture / Copywriting</title>
    <link href="<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700|Roboto:300,400,700' rel='stylesheet'>" rel="stylesheet">
    <?php wp_head(); ?>
    <meta name="google-site-verification" content="vRvw9ZS97Dp0DJYd43oWFZXdwjAAu5iHC5QjSIpHGqM" />
    <meta name="viewport" content="width=device-width">
    <script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=59a67c07c772ca00122051aa&product=inline-share-buttons"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-32929828-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-32929828-1');
    </script>
</head>

<?php
  $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  if (strpos($url,'blog') !== false) {
?>
    <body class="blog">
<?php
  } else {
?>
  <body>
<?php
  }
?>

<script>
  function myFunction() {
    var x = document.getElementById("responsiveNav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>

  <header>
      <div class="stars"></div>
      <?php if (is_front_page()) { ?>
        <div class="clouds-back"></div>
        <div class="jetpacks">
            <div class="image-container"></div>
        </div>
        <div class="clouds-front"></div>
      <?php } ?>
      <a href="/"><img src="<?php echo bloginfo('template_url'); ?>/images/logo.png" alt="" class="logo"></a>
        <nav>
            <a href="javascript:void(0);" class="icon hamburger" style="font-size: 26px;" onclick="myFunction()">&#9776;</a>
            
            
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
              echo '<div class="topnav" id="responsiveNav">';
              foreach ($items as $item) {
                //print_r( $item->post_title . ' - ' . $item->post_name );

                if ($item->post_title === "Blog") {
                  $item->post_name = "/blog";
                } else if ($item->post_title === "Home") {
                  $item->post_name = "/";
                } else {
                  $item->post_name = "/#" . $item->post_name;
                }

                echo '<a href="' . $item->post_name . '">' . $item->post_title . '</a>';
              }
              echo '</div>'

              // print_r($items);


            ?>


            <?php 
            // wp_nav_menu( array(
            //           'theme_location'  => 'primary-mobile',
            //           'menu_class'      => 'topnav',
            //           'menu_id'         => 'responsiveNav',
            //           'container'       => 'div',
            //           'contianer_class' => 'topnav',
            //           'container_id'    => 'responsiveNav',
            //           'items_wrap'      => '%3$s'

            //         ) 
            //       );
            ?>
            <?php 
              $slash = '';
              if (!is_front_page()) {
                $slash = '/';
              }
            ?>
            <?php 
              $dom = wp_nav_menu( array(
                'theme_location'  => 'header',
                'menu_class'      => 'menu-header-menu',
                'echo'            => 0
              ) );

              $new_menu = str_replace('#', '/#', $dom);
              
              echo $new_menu;


             
            
            
            
            // wp_nav_menu( array( 
            //         'theme_location' => 'header',
            //         'menu_class'     => 'menu-header-menu',
            //         'echo'           => 0
            //       ) 
            //     );
            ?> 
            <?php //wp_nav_menu( array( 
                    //'theme_location' => 'Responsive Menu',
                  //  'menu_class' => 'mobile-menu'
                 // ) 
              //  ); 
            ?>
        </nav>
      <?php if (is_front_page()) { ?>
        <div class="header-content">
            <h1>WE HELP COMPANIES</h1>
            <img src="<?php echo bloginfo('template_url'); ?>/images/take-off.png" alt="" style="margin-top: -20px">
            <p class="font-weight-400" style="margin-top: -20px;">Solving the problems of the development world with our unique custom software solutions.</p>
            <div class="button-section">
              <button class="btn btn-primary" id="work-for">Work for Dev2</button>
              <button class="btn btn-primary btn-margin-left" id="work-with">Work with Dev2</button>
            </div>
        </div>
      <?php } else if(strpos($_SERVER['REQUEST_URI'], "map") > 0) { ?>
        <style>
          header {
            height: 115px !important;
          }
        </style>
      <?php } else { ?>
        <div class="header-blog">
          <div class="h-blog-text">
            <img class="blog-text" src="<?php echo bloginfo('template_url'); ?>/images/blog.png" alt="">
          </div>
          <img class="plug" src="<?php echo bloginfo('template_url'); ?>/images/plug.png" alt="">
          <img class="running-plug" src="<?php echo bloginfo('template_url'); ?>/images/running-plug.png" alt="">
        </div>
      <?php } ?>
  </header>
