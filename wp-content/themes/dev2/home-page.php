
<?php
    /*
     * Template name: Home Page template
     */
get_header(); ?>
<!-- TOP WHITE SECTION -->

        <div class="container">
            <div class="row text-center" id="about-us">
                <h2 class="para">ABOUT US</h2>
                <div style="width:100%;"><?php echo the_field('about_us'); ?></div>
            </div>
            <div class="row text-center" id="our-services">
                <h2 class="para">OUR SERVICES</h2>
                <div style="width:100%;"><?php the_field('our_services'); ?></div>  
                <div class="buttons">
                    <button class="btn btn-primary button-center" id="contact" ><?php echo the_field('our_services_button'); ?></button>
                </div>
            </div>
        </div>

        <!-- END OF WHITE SECTION -->

        <!-- CAREERS SECTION -->

        <section class="green-background careers" id="careers">
            <div class="container">
                <div class="row">
                    <h2 class="para text-center">CAREERS</h2>
                        <div class="col-xs-6 col-md-6">
                            <p class="para"><span class="width-60"><?php echo the_field('careers'); ?></span></p>
                            <div class="buttons">
                                <button class="btn btn-inverse button-center" id="good-fit"><?php echo the_field('careers_button'); ?></button>
                            </div>
                        </div>
                </div>
            </div>
            <img src="/wp-content/themes/dev2/images/careers-ipad.png" alt="Careers logo" class="hands">
        </section>

        <section class="clients" id="our-clients">
            <div class="container">
                <div class="row text-center">
                    <h2 class="para">OUR VALUED CLIENTS</h2>
                    <div class="para" style="margin-bottom: 20px;" ><p class="width-60" style="margin: 0 auto;">We're picky about who we work with. These are the companies that we've developed for or worked alongside to deliver exceptional solutions. </p></div>
                    
                    <div class="col-xs-3 col-md-3">
                        <a href="<?php the_field('valued_client_1_url'); ?>" target="_blank">
                            <img src="<?php the_field('valued_client_1'); ?>" alt="Valued Client" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="<?php the_field('valued_client_2_url'); ?>" target="_blank">
                            <img src="<?php the_field('valued_client_2'); ?>" alt="Valued Client" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="<?php the_field('valued_client_3_url'); ?>" target="_blank">
                            <img src="<?php the_field('valued_client_3'); ?>" alt="Valued Client" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="<?php the_field('valued_client_4_url'); ?>" target="_blank">
                            <img src="<?php the_field('valued_client_4'); ?>" alt="Valued Client" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="row text-center">
                    
                    <div class="col-xs-3 col-md-3">
                        <a href="<?php the_field('valued_client_5_url'); ?>" target="_blank">
                            <img src="<?php the_field('valued_client_5'); ?>" alt="" style="max-height: 110px;width: auto;" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="<?php the_field('valued_client_6_url'); ?>" target="_blank">
                            <img src="<?php the_field('valued_client_6'); ?>" alt="Valued Client" style="max-height: 110px;width: auto;" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="<?php the_field('valued_client_7_url'); ?>" target="_blank">
                            <img src="<?php the_field('valued_client_7'); ?>" alt="Valued Client" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="<?php the_field('valued_client_8_url'); ?>" target="_blank">
                            <img src="<?php the_field('valued_client_8'); ?>" alt="" style="max-height: 110px;width: auto;" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
        <style>
        .wpcf7-submit {
            float: left;
        }
        .wpcf7-response-output {
            color: #ffffff;
            margin: -36px 0 0 0 !important;
            padding: 0 !important;
            position: absolute;
        }
        @media screen and (max-width: 398px) {
            .wpcf7-submit {
                width: 100%;
            }
            .btn-inverse {
                width: 100%;
                margin-top: 10px !important;
                margin-left: 0px !important;
                text-align: center;
            }
        }
        </style>

        <section class="events green-background" id="events">
            <div class="container">
                <div class="row">
                    <h2 class="para text-center">EVENTS</h2>
                    <div class="col-xs-6 col-md-6">
                        <p class="para roboto-light"><?php the_field('events'); ?></p>
                        <p class="para roboto-medium"><?php the_field('events_2'); ?></p>
                        <?php echo do_shortcode("[contact-form-7 id='10']"); ?>
                        <?php
                            if (get_field('events_url') != "") {
                        ?>
                        <a href="<?php the_field('events_url'); ?>" class="btn btn-inverse button-center" style="margin-top: -6px;margin-left: 10px;padding: 8px 15px;" target="_blank">Register for Dev Evening</a>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="col-xs-6 col-md-6" >
                        
                        <div class="latest-event">
                            <!-- <img src="/wp-content/uploads/2017/09/sprint-115-placeholder-02-01.png" alt="Latest event image" class="full-logo">    -->
                            <?php 
                            
                                if (get_field('events_url') != "") {
                                    ?>
                                    <a href="<?php the_field('events_url'); ?>" target="_blank">
                                        <img src="<?php the_field('events_image'); ?>" alt="Latest event image" class="full-logo">
                                    </a> 
                                    <?php
                                } else {
                                    ?> 
                                    <img src="http://dev2.co.za/wp-content/uploads/2017/09/sprint-115-placeholder-02-01.png" alt="Latest event image" class="full-logo">  
                                    <?php
                                }

                            ?> 

                            <!--<h2 class="roboto-medium green para">
                                Catherine Bracy: Why good hackers make good citizens
                            </h2>
                            <div class="padding-40" style="padding-top: 0px;">
                                <span class="calendar"></span>
                                <span class="roboto-light">21 February</span><br>
                                <span class="map-marker"></span>
                                <span class="roboto-light">32 Smith Street, Durban</span>
                            </div>-->
                        </div>
                        
                    </div>
                    <img src="/wp-content/themes/dev2/images/events.png" alt="events image" class="events-image">
                </div>
            </div>
        </section>

        <section class="contact-us" id="contact-us">
            <div class="container">
                <div class="row text-center">
                    <?php echo do_shortcode("[contact-form-7 id='11']"); ?>
                </div>
            </div>
        </section>
        
<script language="JavaScript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>

            var url = window.location.href;
            var newUrl;
            if(url.includes('#')) {
                if (url.endsWith('/')) {
                    newUrl = url.slice(0, -1);
                    window.location = newUrl;
                }
            }
            if (url.includes('#')) {
                var point = newUrl.substr(newUrl.indexOf("#") + 1);
                console.log(point);
                goToScroll(point);
            }
            function goToScroll(id) {
                console.log('scroll');
                $('html,body').animate({scrollTop: $("#"+id).offset().top},2000);
            }
            $("#contact").click(function() {
                $('html,body').animate({
                    scrollTop: $("#contact-us").offset().top
                }, 2000);
            });

            $("#good-fit").click(function() {
                $('html,body').animate({
                    scrollTop: $("#contact-us").offset().top
                }, 2000);
            });

            $("#work-with").click(function() {
                $('html,body').animate({
                    scrollTop: $("#contact-us").offset().top
                }, 2000);
            });

            $("#work-for").click(function() {
                $('html,body').animate({
                    scrollTop: $("#careers").offset().top
                }, 2000);
            });

            $(".menu-header-menu li a").on('click', function(event){
                event.preventDefault();
                var goTo = $.attr(this, 'href');
                console.log(goTo);
                var s = "0000test";
                while(goTo.charAt(0) === '/') {
                    goTo = goTo.substr(1);
                }
                if (goTo == "blog") {
                    window.location = "http://dev2.co.za/" + goTo;
                } else {
                    $('html, body').animate({
                        scrollTop: $( goTo ).offset().top
                    }, 2000);
                }
            });
            
                            

        </script>
<?php get_footer(); ?>
