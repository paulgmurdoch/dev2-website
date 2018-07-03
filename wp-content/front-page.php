
<?php get_header(); ?>
<!-- TOP WHITE SECTION -->

        <div class="container">
            <div class="row text-center" id="about-us">
                <h2 class="para">ABOUT US</h2>
                <p class="para">Since 2011 our main focus is keeping our clients at the forefront of software solutions and developments.</p>
                <p class="para">We take pride in our work and consider ourselves to be a really unique company. Our team of software developers is small, but effective - you know what they say, dynamite comes in small packages.</p>
                <p class="para">Before taking on new projects and clients, we like to carefully consider the work required. That way, we know we’ll only deliver the best.</p>
            </div>
            <div class="row text-center" id="our-services">
                <h2 class="para">OUR SERVICES</h2>
                <p class="para">We love making businesses more successful because of intelligent software solutions in the background. We specialize in enabling disparate systems to communicate via data and systems integration and orchestration.</p>
                <p class="para">To keep us ahead of the game we work exclusively with .Net technologies and <a href="http://warewolf.io/" class="inline-link"><strong style="font-weight: bold; font-family: 'Roboto-medium';">Warewolf</strong> - a leading data and systems integration tool.</a></p>
                <div class="buttons">
                    <button class="btn btn-primary button-center" id="contact" >Get in touch</button>
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
                            <p class="para"><span class="width-60">We’re a tight-knit team of developers in Durban who really love what we do. We work hard, always pushing ourselves to raise the bar in software development, but don’t get us wrong, we like to have fun - think, the Big Rush at Moses Mabida (yes, we did that), St Paddy’s Day celebrations and team curry lunches. Balancing work and play is really important to us.</span></p>
                            <div class="buttons">
                                <button class="btn btn-inverse button-center" id="good-fit">I'd be a good fit</button>
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
                        <a href="https://www.lexisnexis.com/" target="_blank">
                            <img src="/wp-content/uploads/2017/09/LexisNexis-color.png" alt="Lexis Nexis logo" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="http://theunlimited.co.za/" target="_blank">
                            <img src="/wp-content/uploads/2017/09/TU-Logo.png" alt="Lexis Nexis logo" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="http://www.synerics.com/" target="_blank">
                            <img src="/wp-content/uploads/2017/09/Synerics-color.png" alt="Lexis Nexis logo" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="https://warewolf.io/" target="_blank">
                            <img src="/wp-content/uploads/2017/09/warewolf-logo.png" alt="Lexis Nexis logo" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="row text-center">
                    
                    <div class="col-xs-3 col-md-3">
                        
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="http://www.dmasa.org/" target="_blank">
                            <img src="/wp-content/uploads/2017/09/dma-logo.jpg" alt="Lexis Nexis logo" style="max-height: 110px;width: auto;" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <a href="http://www.theunlimited.pl/" target="_blank">
                            <img src="/wp-content/uploads/2017/09/tupl.png" alt="Lexis Nexis logo" class="full-logo" style="margin-top: 20px;">
                        </a>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        
                    </div>
                </div>
            </div>
        </section>
        
        <style>
        /* .wpcf7-submit {
            float: left;
        } */
        .wpcf7-response-output {
            color: #ffffff;
            margin: -10px 0 0 0 !important;
            padding: 0 !important;
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
                        <p class="para roboto-light">To stay at the cutting edge of the software game, we regularly hold free events for software developers. We’ve hosted a wide range of dynamic and influential speakers from community heroes to Microsoft employees and University professors.</p>
                        <p class="para roboto-medium">Leave your details and we’ll notify you of our next Dev Evening</p>
                        <?php echo do_shortcode("[contact-form-7 id='10']"); ?>
                    </div>
                    <div class="col-xs-6 col-md-6" >
                        
                        <div class="latest-event">
                            <!-- <img src="/wp-content/uploads/2017/09/sprint-115-placeholder-02-01.png" alt="Latest event image" class="full-logo">    -->
                            <a href="https://www.eventbrite.com/e/dev2-dev-evening-16-nov-6pm-registration-37754975147" target="_blank">
                                <img src="/wp-content/uploads/2017/10/sprint-115-placeholder-02-02.png" alt="Latest event image" class="full-logo">
                            </a>    
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
