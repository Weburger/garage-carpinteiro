<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while (have_posts()) :
            the_post();
            $modele = get_post_meta(get_the_ID(), 'modele', true);
            $classe = get_post_meta(get_the_ID(), 'classe', true);
            $motorisation = get_post_meta(get_the_ID(), 'motorisation', true);
            $annee = get_post_meta(get_the_ID(), 'annee', true);
            $km = get_post_meta(get_the_ID(), 'km', true);
            $transmission = get_post_meta(get_the_ID(), 'transmission', true);
            $carburant = get_post_meta(get_the_ID(), 'carburant', true);
            $prix = get_post_meta(get_the_ID(), 'prix', true);
            $photos = get_post_meta(get_the_ID(), 'photos', true);

            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
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

                    <?php if (!empty($photos)) : ?>
                        <div class="voiture-photos">
                            <?php foreach ($photos as $photo_id) :
                                $photo_url = wp_get_attachment_url($photo_id);
                                if ($photo_url) : ?>
                                    <img src="<?php echo esc_url($photo_url); ?>" style="max-width: 200px; height: auto; margin-bottom: 10px;">
                                <?php endif;
                            endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endwhile; ?>
    </main>
</div>
ùon
<?php get_footer(); ?>
