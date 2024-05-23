<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <header class="page-header">
            <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
        </header>

        <form method="GET" class="filter-form">
            <div class="filter-group">
                <label for="km"><?php _e('Kilométrage:', 'textdomain'); ?></label>
                <input type="number" id="km" name="km" value="<?php echo isset($_GET['km']) ? esc_attr($_GET['km']) : ''; ?>">
            </div>
            <div class="filter-group">
                <label for="prix"><?php _e('Prix:', 'textdomain'); ?></label>
                <input type="number" id="prix" name="prix" value="<?php echo isset($_GET['prix']) ? esc_attr($_GET['prix']) : ''; ?>">
            </div>
            <div class="filter-group">
                <label for="carburant"><?php _e('Carburant:', 'textdomain'); ?></label>
                <input type="text" id="carburant" name="carburant" value="<?php echo isset($_GET['carburant']) ? esc_attr($_GET['carburant']) : ''; ?>">
            </div>
            <div class="filter-group">
                <label for="boite"><?php _e('Boîte de vitesse:', 'textdomain'); ?></label>
                <select name="boite" id="boite">
                    <option value="<?php echo isset($_GET['boite']) ? esc_attr($_GET['boite']) : ''; ?> "> <?php echo isset($_GET['boite']) ? esc_attr($_GET['boite']) : '-- Choisir une option --'; ?> </option>
                    <option value="manuelle">Manuelle</option>
                    <option value="automatique">Automatique</option>
                </select>
            </div>
            <div class="filter-group">
                <button type="submit"><?php _e('Filtrer', 'textdomain'); ?></button>
            </div>
        </form>

        <?php if (have_posts()) : ?>
        <div class="archive_voitures">
            <?php
            while (have_posts()) : the_post();
                $modele = get_post_meta(get_the_ID(), 'modele', true);
                $classe = get_post_meta(get_the_ID(), 'classe', true);
                $motorisation = get_post_meta(get_the_ID(), 'motorisation', true);
                $annee = get_post_meta(get_the_ID(), 'annee', true);
                $km = get_post_meta(get_the_ID(), 'km', true);
                $boite = get_post_meta(get_the_ID(), 'boite', true);
                $carburant = get_post_meta(get_the_ID(), 'carburant', true);
                $prix = get_post_meta(get_the_ID(), 'prix', true);
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class("archive_voiture_card"); ?>>
                    <?php the_post_thumbnail(); ?>
                    <div class="entry-content">
                        <h2 class="entry-title"><?php the_title(); ?></h2>
                        <p class="entry-price"><?php echo esc_html($prix); ?> €</p>
                        <div class="sub-infos">
                            <div class="sub-title">
                                <p><?php echo esc_html($classe); ?></p>
                                <p><?php echo esc_html($carburant); ?></p>
                            </div>
                            <div class="pictos">
                                <p><img src="<?php echo get_template_directory_uri() ?>/assets/images/date_range.svg" alt="date_range"><?php echo esc_html($annee); ?></p>
                                <p><img src="<?php echo get_template_directory_uri() ?>/assets/images/car.svg" alt="car"><?php echo esc_html($km); ?> km</p>
                                <p><img src="<?php echo get_template_directory_uri() ?>/assets/images/manual-gear.svg" alt="manual_gear"><?php echo esc_html($boite); ?></p>
                            </div>
                        </div>
                        <p><strong><?php _e('Modèle:', 'textdomain'); ?></strong> <?php echo esc_html($modele); ?></p>
                        <p><strong><?php _e('Motorisation:', 'textdomain'); ?></strong> <?php echo esc_html($motorisation); ?></p>
                        <a href="<?php the_permalink(); ?>" rel="bookmark">En savoir plus</a>
                    </div>
                </article>
            <?php endwhile; ?>

            <?php
            the_posts_pagination(array(
                'prev_text'          => __('Previous page', 'textdomain'),
                'next_text'          => __('Next page', 'textdomain'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'textdomain') . ' </span>',
            ));
            ?>

            <?php else : ?>
                <p><?php _e('Aucun vehicule trouvé.', 'textdomain'); ?></p>
            <?php endif; ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>
