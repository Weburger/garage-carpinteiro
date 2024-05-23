<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php if (have_posts()) : ?>
            <header class="page-header">
                <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
            </header>

            <?php
            // Start the Loop.
            while (have_posts()) : the_post();
                $modele = get_post_meta(get_the_ID(), 'modele', true);
                $classe = get_post_meta(get_the_ID(), 'classe', true);
                $motorisation = get_post_meta(get_the_ID(), 'motorisation', true);
                $annee = get_post_meta(get_the_ID(), 'annee', true);
                $km = get_post_meta(get_the_ID(), 'km', true);
                $transmission = get_post_meta(get_the_ID(), 'transmission', true);
                $carburant = get_post_meta(get_the_ID(), 'carburant', true);
                $prix = get_post_meta(get_the_ID(), 'prix', true);
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                        </h2>
                    </header>

                    <div class="entry-content">
                        <p><strong><?php _e('Modèle:', 'textdomain'); ?></strong> <?php echo esc_html($modele); ?></p>
                        <p><strong><?php _e('Classe:', 'textdomain'); ?></strong> <?php echo esc_html($classe); ?></p>
                        <p><strong><?php _e('Motorisation:', 'textdomain'); ?></strong> <?php echo esc_html($motorisation); ?></p>
                        <p><strong><?php _e('Année:', 'textdomain'); ?></strong> <?php echo esc_html($annee); ?></p>
                        <p><strong><?php _e('Nombre de km:', 'textdomain'); ?></strong> <?php echo esc_html($km); ?></p>
                        <p><strong><?php _e('Transmission:', 'textdomain'); ?></strong> <?php echo esc_html($transmission); ?></p>
                        <p><strong><?php _e('Carburant:', 'textdomain'); ?></strong> <?php echo esc_html($carburant); ?></p>
                        <p><strong><?php _e('Prix:', 'textdomain'); ?></strong> <?php echo esc_html($prix); ?></p>
                    </div>
                </article>
            <?php endwhile; ?>

            <?php
            // Pagination.
            the_posts_pagination(array(
                'prev_text'          => __('Previous page', 'textdomain'),
                'next_text'          => __('Next page', 'textdomain'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'textdomain') . ' </span>',
            ));
            ?>

        <?php else : ?>
            <p><?php _e('No cars found.', 'textdomain'); ?></p>
        <?php endif; ?>
    </main>
</div>
<?php get_footer(); ?>
