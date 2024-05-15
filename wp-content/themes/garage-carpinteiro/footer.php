<?php if (!defined('ABSPATH')) exit; ?>

<footer id="footer">
    <div class="footer-top">
        <div class="container text-center">
            <div class="footer-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/renault.svg" alt="<?php bloginfo('name'); ?> Logo"> Garage Carpinteiro
            </div>
            <p class="slogan-bottom">Pensez à covoiturer. #SeDéplacerMoinsPolluer</p>
            <p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>, tous droits réservés.</p>
        </div>
    </div>
    <div class="footer-middle">
        <div class="container text-center">
            <div class="footer-contact-icons">
                <a href="tel:your-phone-number"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/phone.svg" alt="Phone Icon"></a>
                <a href="mailto:your-email-address"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/email.svg" alt="Email Icon"></a>
                <a href="https://www.facebook.com/your-facebook-url"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg" alt="Facebook Icon"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container text-center">
	        <?php
	        wp_nav_menu(array(
		        'theme_location' => 'primary',
		        'container' => false,
		        'menu_id' => 'main-menu',
		        'menu_class' => 'menu'
	        ));
	        ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
