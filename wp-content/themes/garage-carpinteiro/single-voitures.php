<?php get_header(); ?>

<div id="primary" class="content-area single-voitures">
    <main id="main" class="site-main">
        <?php
        while (have_posts()) :
            the_post();
            $marque = get_post_meta(get_the_ID(), 'marque', true);
            $modele = get_post_meta(get_the_ID(), 'modele', true);
            $classe = get_post_meta(get_the_ID(), 'classe', true);
            $puissance_fiscale = get_post_meta(get_the_ID(), 'puissance_fiscale', true);
            $puissance_din = get_post_meta(get_the_ID(), 'puissance_din', true);
            $motorisation = get_post_meta(get_the_ID(), 'motorisation', true);
            $annee = get_post_meta(get_the_ID(), 'annee', true);
            $km = get_post_meta(get_the_ID(), 'km', true);
            $boite = get_post_meta(get_the_ID(), 'boite', true);
            $carburant = get_post_meta(get_the_ID(), 'carburant', true);
            $prix = get_post_meta(get_the_ID(), 'prix', true);
            $portes = get_post_meta(get_the_ID(), 'portes', true);
            $places = get_post_meta(get_the_ID(), 'places', true);
            $consommation = get_post_meta(get_the_ID(), 'consommation', true);
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php the_post_thumbnail(); ?>
                    <div class="car-details">
                        <div class="main_infos">
                            <p><strong><?php _e('Marque', 'textdomain'); ?></strong> <?php echo esc_html($marque); ?></p>
                            <p><strong><?php _e('Modèle', 'textdomain'); ?></strong> <?php echo esc_html($modele); ?></p>
                            <p><strong><?php _e('Classe', 'textdomain'); ?></strong> <?php echo esc_html($classe); ?></p>
                        </div>
                        <div class="sub_infos">
                            <p><img src="<?php echo get_template_directory_uri() ?>/assets/images/date_range.svg" alt="date_range"><?php echo esc_html($annee); ?></p>
                            <p><img src="<?php echo get_template_directory_uri() ?>/assets/images/car.svg" alt="car"><?php echo esc_html($km); ?> km</p>
                            <p><img src="<?php echo get_template_directory_uri() ?>/assets/images/manual-gear.svg" alt="manual_gear"><?php echo esc_html($boite); ?></p>
                        </div>
                        <p class="price"> <?php echo esc_html($prix); ?> €</p>
                        <a href="mailto:contact@example.com" class="contact-btn">Contactez-nous</a>
                    </div>
                </div>

                <h2 class="gallery-title">Photos supplémentaires</h2>
                <div class="gallery">
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
