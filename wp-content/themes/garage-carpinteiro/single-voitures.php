<?php get_header(); ?>

<div id="primary" class="content-area single-voitures">
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
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php the_post_thumbnail(); ?>
                    <div class="car-details">
                        <p><strong><?php _e('Modèle:', 'textdomain'); ?></strong> <?php echo esc_html($modele); ?></p>
                        <p><strong><?php _e('Classe:', 'textdomain'); ?></strong> <?php echo esc_html($classe); ?></p>
                        <p><strong><?php _e('Motorisation:', 'textdomain'); ?></strong> <?php echo esc_html($motorisation); ?></p>
                        <p><strong><?php _e('Année:', 'textdomain'); ?></strong> <?php echo esc_html($annee); ?></p>
                        <p><strong><?php _e('Nombre de km:', 'textdomain'); ?></strong> <?php echo esc_html($km); ?></p>
                        <p><strong><?php _e('Transmission:', 'textdomain'); ?></strong> <?php echo esc_html($transmission); ?></p>
                        <p><strong><?php _e('Carburant:', 'textdomain'); ?></strong> <?php echo esc_html($carburant); ?></p>
                        <p class="price"><strong><?php _e('Prix:', 'textdomain'); ?></strong> <?php echo esc_html($prix); ?></p>
                        <a href="mailto:contact@example.com" class="contact-btn">Contactez-nous</a>
                    </div>
                </div>

                <div class="gallery">
                    <h2 class="gallery-title">Photos supplémentaires</h2>
                    <?php
                    $postData = get_post_meta(get_the_ID());
                    $photos_query = $postData['gallery_data'][0];
                    $photos_array = unserialize($photos_query);
                    $url_array = $photos_array['image_url'];
                    $count = sizeof($url_array);
                    for ($i = 0; $i < $count; $i++) {
                        echo '<img class="img-fluid gallery-img" src="' . $url_array[$i] . '" alt=""/>';
                    }
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    </main>
</div>

<?php get_footer(); ?>
