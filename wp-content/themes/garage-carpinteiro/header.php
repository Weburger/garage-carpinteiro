<?php ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="header">
        <nav id="main-navigation">
            <div class="logo-header"><svg width="49" height="53" viewBox="0 0 49 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_45_3)">
                        <path d="M0 39.9173V44.3464H16.8478V48.8112H0V53.2402H18.6037C18.79 53.2493 18.9762 53.2183 19.1488 53.1493C19.3214 53.0803 19.4762 52.975 19.602 52.841L24.5 48.2054L29.398 52.841C29.5241 52.9753 29.6792 53.0807 29.8521 53.1497C30.0251 53.2187 30.2117 53.2496 30.3984 53.2402H49V48.8112H32.1522V44.3464H49V39.9173H30.3963C30.21 39.9082 30.0238 39.9392 29.8512 40.0082C29.6786 40.0773 29.5238 40.1825 29.398 40.3166L24.5 44.9521L19.602 40.3166C19.4759 40.1823 19.3208 40.0768 19.1479 40.0078C18.9749 39.9388 18.7883 39.9079 18.6016 39.9173H0Z" fill="white"/>
                    </g>
                    <g clip-path="url(#clip1_45_3)">
                        <path d="M22.9051 28.9786L30.5694 14.5L25.6452 5.1932L24.5503 7.26073L28.3796 14.5L21.8102 26.911L15.2408 14.5L22.9051 0.0214539H20.7153L13.051 14.5L20.7153 28.9786H22.9051Z" fill="white"/>
                        <path d="M27.2847 28.9786L34.949 14.5L27.2847 0.0214539H25.0949L17.4306 14.5L22.3605 23.8068L23.4554 21.7393L19.6204 14.5L26.1898 2.08899L32.7592 14.5L25.0949 28.9786H27.2847Z" fill="white"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_45_3">
                            <rect width="49" height="13" fill="white" transform="translate(0 40)"/>
                        </clipPath>
                        <clipPath id="clip1_45_3">
                            <rect width="22" height="29" fill="white" transform="translate(13)"/>
                        </clipPath>
                    </defs>
                </svg>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">GARAGE CARPINTEIRO</a></div>
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_id' => 'main-menu',
                    'menu_class' => 'menu'
                ));
            ?>
        </nav>
    </header>
