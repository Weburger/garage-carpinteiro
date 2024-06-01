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
    <script src="<?php echo get_template_directory_uri(); ?>/js/menucolor.js"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="header" data-default-color="white">
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
            <nav><?php wp_nav_menu( array(
                'menu' => 'Menu principal',
            )); ?>
            </nav>
            <svg onclick=openBurger() id="burger" width="33" height="34" viewBox="0 0 33 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="ico / 24 / ui / menu_hamburger">
                    <path id="Icon color" fill-rule="evenodd" clip-rule="evenodd" d="M28.1875 10.125H4.8125C4.4328 10.125 4.125 9.8172 4.125 9.4375V8.0625C4.125 7.6828 4.4328 7.375 4.8125 7.375H28.1875C28.5672 7.375 28.875 7.6828 28.875 8.0625V9.4375C28.875 9.8172 28.5672 10.125 28.1875 10.125ZM28.875 17.6875V16.3125C28.875 15.9328 28.5672 15.625 28.1875 15.625H4.8125C4.4328 15.625 4.125 15.9328 4.125 16.3125V17.6875C4.125 18.0672 4.4328 18.375 4.8125 18.375H28.1875C28.5672 18.375 28.875 18.0672 28.875 17.6875ZM28.875 24.5625V25.9375C28.875 26.3172 28.5672 26.625 28.1875 26.625H4.8125C4.4328 26.625 4.125 26.3172 4.125 25.9375V24.5625C4.125 24.1828 4.4328 23.875 4.8125 23.875H28.1875C28.5672 23.875 28.875 24.1828 28.875 24.5625Z" fill="black"/>
                </g>
            </svg>
            <div id="sidenav" class="sidenav">
                <nav>
                    <?php wp_nav_menu( array(
                        'menu' => 'Menu principal',
                    )); ?>
                </nav>
                <div>
                    <svg onclick=closeBurger() width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32.0998 27.84C32.3522 28.0904 32.4942 28.4312 32.4942 28.7867C32.4942 29.1422 32.3522 29.483 32.0998 29.7333L30.2331 31.6C29.9827 31.8524 29.642 31.9944 29.2864 31.9944C28.9309 31.9944 28.5901 31.8524 28.3398 31.6L16.4998 19.76L4.65977 31.6C4.40941 31.8524 4.06862 31.9944 3.7131 31.9944C3.35759 31.9944 3.01679 31.8524 2.76644 31.6L0.899769 29.7333C0.647352 29.483 0.505371 29.1422 0.505371 28.7867C0.505371 28.4312 0.647352 28.0904 0.899769 27.84L12.7398 16L0.899769 4.16001C0.647352 3.90966 0.505371 3.56886 0.505371 3.21335C0.505371 2.85783 0.647352 2.51704 0.899769 2.26668L2.76644 0.400013C3.01679 0.147596 3.35759 0.00561523 3.7131 0.00561523C4.06862 0.00561523 4.40941 0.147596 4.65977 0.400013L16.4998 12.24L28.3398 0.400013C28.5901 0.147596 28.9309 0.00561523 29.2864 0.00561523C29.642 0.00561523 29.9827 0.147596 30.2331 0.400013L32.0998 2.26668C32.3522 2.51704 32.4942 2.85783 32.4942 3.21335C32.4942 3.56886 32.3522 3.90966 32.0998 4.16001L20.2598 16L32.0998 27.84Z" fill="white"/>
                    </svg>
                </div>
            </div>
        </nav>
    </header>
    <script>
        function openBurger(){
            document.getElementById("sidenav").classList.add("MenuOpen")
            document.getElementById("sidenav").style.top = 0
        }

        function closeBurger(){
            document.getElementById("sidenav").classList.remove("MenuOpen")
            document.getElementById("sidenav").style.left = "0"
            document.getElementById("sidenav").style.top = "-100vh"
        }
    </script>
