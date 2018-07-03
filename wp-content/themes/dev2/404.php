<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _s
 */

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dev2 Website Strategy / Architecture / Copywriting</title>
    <link href="<link href='https://fonts.googleapis.com/css?family=Lato:300,400,700|Roboto:300,400,700' rel='stylesheet'>"
          rel="stylesheet">
	<?php wp_head(); ?>
    <meta name="google-site-verification" content="vRvw9ZS97Dp0DJYd43oWFZXdwjAAu5iHC5QjSIpHGqM"/>
    <meta name="viewport" content="width=device-width">
    <script type="text/javascript"
            src="//platform-api.sharethis.com/js/sharethis.js#property=59a67c07c772ca00122051aa&product=inline-share-buttons"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-32929828-1"></script>
    <script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}

		gtag('js', new Date());

		gtag('config', 'UA-32929828-1');
    </script>
    <style>
        .container-404 {
            max-width: 650px;
            margin: 0 auto;
            color: #97C061;
        }

        .container-404 img {
            max-width: 100%;
        }

        .container-404 h2 {
            font-size: 4rem;
        }

        .container-404 p {
            color: #97C061;
        }

        .btn-404 {
            background-color: transparent;
            border: 1px solid  #97C061;
            border-radius: 100px;
            color: #97C061;
            cursor: pointer;
            display: inline-block;
            margin-top: 20px;
            padding: 10px 35px;
            text-decoration: none;
        }


    </style>
</head>

<body>
<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <section class="error-404 not-found">
            <div class="container-404 text-center">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/dev2-404.png">
                <h2 class="para">404 ERROR</h2>
                <p>Oops! Sorry, we could not find the page...</p>
                <div class="buttons">
                    <a class="btn btn-404 button-center" href="<?php echo site_url(); ?>">Home, James!</a>
                </div>
            </div>
        </section><!-- .error-404 -->

    </main><!-- #main -->
</div><!-- #primary -->

</body>
</html>
