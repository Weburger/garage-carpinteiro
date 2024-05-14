<?php ?>

<footer id="footer">
    <div class="footer-widgets">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
                        <div class="footer-widget">
                            <?php dynamic_sidebar( 'footer-widget-1' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
                        <div class="footer-widget">
                            <?php dynamic_sidebar( 'footer-widget-2' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-4">
                    <?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
                        <div class="footer-widget">
                            <?php dynamic_sidebar( 'footer-widget-3' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

