<!DOCTYPE html>
<!--[if IE 8]><html <?php language_attributes(); ?> class="ie8"><![endif]-->
<!--[if lte IE 9]><html <?php language_attributes(); ?> class="ie9"><![endif]-->
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="dns-prefetch" href="//google-analytics.com">
    <?php wp_head(); ?>
    <!--[if lt IE 10]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script>
        <![endif]-->
    <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
        <![endif]-->
</head>

<body <?php body_class(); ?>>
    <header id="header" class="site-header">
        <div class="header-wrap">
            <div class="header-inner">
                <div class="header-content">
                    <div class="header-content-inner container">
                        <div class="header-logo">
                            <div class="logo"><span class="custom-logo-link"><img width="256" height="75" src="https://sagahouses.com/wp-content/uploads/2024/03/izobrazhenie_2024-03-01_231013029.png" class="custom-logo" alt="" decoding="async"></span></div>
                        </div>

                        <div class="header-navigation">
                            <div class="header-navigation-button">
                                <button type="button" role="button" aria-label="Header Menu"></button>
                            </div>

                            <div class="header-navigation-content">
                                <div class="nav-top">
                                </div>

                                <div class="nav-primary">
                                    <nav id="primary-navigation" aria-label="Primary Menu">
                                        <?php
                                        $menus = wp_get_nav_menus();

                                        foreach ($menus as $menu) {
                                            // You can then call wp_nav_menu() for each menu ID if needed
                                            wp_nav_menu(
                                                [
                                                    'theme_location' => 'header', 
                                                    'menu_class' => 'primary-navigation-list',
                                                    'link_before' => '<span>'
                                                ]
                                                ) ;
                                        }
                                        ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>