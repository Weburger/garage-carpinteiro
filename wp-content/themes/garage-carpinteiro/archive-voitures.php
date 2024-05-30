<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <header class="page-header">
            <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
        </header>

        <?php
        $max_price = get_max_car_price();
        ?>

        <form method="GET" class="filter-form">
            <input type="hidden" name="action" value="filter_voitures">
            <div class="filter-group">
                <label for="modele"><?php _e('Modèle:', 'textdomain'); ?></label>
                <input type="text" id="modele" name="modele" value="<?php echo isset($_GET['modele']) ? esc_attr($_GET['modele']) : ''; ?>">
            </div>
            <div class="filter-group">
                <label for="km"><?php _e('Kilométrage:', 'textdomain'); ?></label>
                <input type="number" id="km" name="km" value="<?php echo isset($_GET['km']) ? esc_attr($_GET['km']) : ''; ?>">
            </div>
            <div class="filter-group">
                <label for="prix"><?php _e('Prix:', 'textdomain'); ?></label>
                <input type="range" id="prix" name="prix" min="0" max="<?php echo esc_attr($max_price); ?>" step="10" value="<?php echo isset($_GET['prix']) ? esc_attr($_GET['prix']) : $max_price / 2; ?>">
                <div class="price-range-value">
                    <span id="price-value"><?php echo isset($_GET['prix']) ? esc_html($_GET['prix']) : $max_price / 2; ?></span> €
                </div>
            </div>
            <div class="filter-group">
                <label for="carburant"><?php _e('Carburant:', 'textdomain'); ?></label>
                <select name="carburant" id="carburant">
                    <option value=""><?php _e('-- Choisir une option --', 'textdomain'); ?></option>
                    <option value="Essence"  <?php isset($_GET['carburant']) ? selected( $_GET['carburant'], 'Essence' ): "" ?>>Essence</option>
                    <option value="Diesel"  <?php isset($_GET['carburant']) ? selected( $_GET['carburant'], 'Diesel' ): "" ?>>Diesel</option>
                    <option value="Électrique"  <?php isset($_GET['carburant']) ? selected( $_GET['carburant'], 'Électrique' ): "" ?>>Electrique</option>
                    <option value="Hybride"  <?php isset($_GET['carburant']) ? selected( $_GET['carburant'], 'Hybride' ): "" ?>>Hybride</option>
                    <option value="Gaz"  <?php isset($_GET['carburant']) ? selected( $_GET['carburant'], 'Gaz' ): "" ?>>Gaz</option>
                </select>
                </select>
            </div>
            <div class="filter-group">
                <label for="boite"><?php _e('Boîte de vitesse:', 'textdomain'); ?></label>
                <select name="boite" id="boite">
                    <option value=""><?php _e('-- Choisir une option --', 'textdomain'); ?></option>
                    <option value="manuelle" <?php isset($_GET['boite']) ? selected( $_GET['boite'], 'manuelle' ): "" ?>><?php _e('Manuelle', 'textdomain'); ?></option>
                    <option value="automatique" <?php isset($_GET['boite']) ? selected( $_GET['boite'], 'automatique' ): "" ?>><?php _e('Automatique', 'textdomain'); ?></option>
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
                $vendue = get_post_meta(get_the_ID(), "vendue", true);
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class("archive_voiture_card" . ($vendue ? " vendue" : "")); ?> >
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
                        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php _e('En savoir plus', 'textdomain'); ?></a>
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

<script>
    document.getElementById('prix').addEventListener('input', function() {
        document.getElementById('price-value').innerText = this.value;
    });

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.filter-form');
        const resultsContainer = document.querySelector('.archive_voitures');
        const priceInput = document.getElementById('prix');
        const priceValue = document.getElementById('price-value');
        const ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";
        priceInput.addEventListener('input', function() {
            priceValue.innerText = this.value;
        });

        const sendAjaxRequest = function () {
            console.log("test")
            const formData = new FormData(form);
            formData.append('action', 'filter_voitures');
            fetch(ajax_url, {
                method: 'POST',
                body: new URLSearchParams(formData)
            })
                .then(response => response.text())
                .then(data => {
                    resultsContainer.innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        };
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        function throttle(callback, delay) {
            var last;
            var timer;
            return function () {
                var context = this;
                var now = +new Date();
                var args = arguments;
                if (last && now < last + delay) {
                    clearTimeout(timer);
                    timer = setTimeout(function () {
                        last = now;
                        callback.apply(context, args);
                    }, delay);
                } else {
                    last = now;
                    callback.apply(context, args);
                }
            };
        }
        priceInput.addEventListener('input', function() {
            throttle(sendAjaxRequest, 500);
        });
    });


</script>

