<!DOCTYPE html>
<html>
    <head>
        <title>The Good Man Kitchen商城</title>
        <meta charset="<?php bloginfo('charset'); ?> ">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/assets/icons/touch-icon-ipad.png">
        <link rel="shortcut icon" type="image/png" href="<?php bloginfo('template_url'); ?>/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_url'); ?>/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="167x167" href="<?php bloginfo('template_url'); ?>/touch-icon-ipad-retina.png">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="The Good Man Kitchen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="777466033779-aqoescfjf02irih7re4dji1e0mund0fd.apps.googleusercontent.com">
        <?php wp_head(); ?> 
    </head>

    <body <?php body_class(); ?>>
        <nav class="navbar navbar-expand-md bg-dark sticky-top shadow-sm ">
            <div class="container-fluid">

                <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
                    <img src="<?php bloginfo('template_url'); ?>/assets/images/thegoodmanlogo.svg'" class="d-inline-block mx-auto" alt=""><span class="navbrand-name">The Good Man Kitchen</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>


                <div class="collapse navbar-collapse text-center justify-content-end" id="navbarToggler">
                    <?php
                            wp_nav_menu([
                                'menu'            => 'top',
                                'theme_location'  => 'top',
                                'container'       => 'div',
                                'container_id'    => 'bs4navbar',
                                'container_class' => 'ml-auto',
                                'menu_id'         => false,
                                'menu_class'      => 'navbar-nav',
                                'depth'           =>  2,
                                'fallback_cb'     => 'bs4navwalker::fallback',
                                'walker'          => new bs4navwalker()
                            ]);
                    ?>
                    
                </div>
               
                <?php echo do_shortcode("[woo_cart_but]"); ?>  
            </div>
        </nav>


