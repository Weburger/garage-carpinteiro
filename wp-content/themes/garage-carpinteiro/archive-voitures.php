<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="titre">
            <h1>Nos offres d'occasions</h1>
            <p>Nous proposons de la vente d’occasion, et reprenons votre voiture peu importe le modèle.</p>
        </div>

        <?php
        $max_price = get_max_car_price();
        $min_price = get_min_car_price();
        ?>

        <form method="GET" class="filter-form" onsubmit="preventDefault()">
            <input type="hidden" name="action" value="filter_voitures">

            <div class="filter-group">
                <label for="modele"><?php _e('Modèle:', 'textdomain'); ?></label>
                <input type="text" id="modele" name="modele" value="<?php echo isset($_GET['modele']) ? esc_attr($_GET['modele']) : ''; ?>">
            </div>
            <div class="range-filter">
                <label for="prix_min"><?php _e('Prix:', 'textdomain'); ?></label>
                <div class="range_container">
                    <div class="sliders_control">
                        <input id="fromSlider" type="range" name="prix_min" value="<?php echo isset($_GET['prix_min']) ? esc_html($_GET['prix_min']) : $min_price; ?>" min="<?php echo isset($_GET['prix_min']) ? esc_html($_GET['prix_min']) : $min_price; ?>" max="<?php echo isset($_GET['prix_max']) ? esc_html($_GET['prix_max']) : $max_price; ?>"/>
                        <input id="toSlider" type="range" name="prix_max" value="<?php echo isset($_GET['prix_max']) ? esc_html($_GET['prix_max']) : $max_price; ?>" min="<?php echo isset($_GET['prix_min']) ? esc_html($_GET['prix_min']) : $min_price; ?>" max="<?php echo isset($_GET['prix_max']) ? esc_html($_GET['prix_max']) : $max_price; ?>"/>
                    </div>
                    <div class="form_control">
                        <div class="form_control_container">
                            <div class="form_control_container__time">Min</div>
                            <input class="form_control_container__time__input" type="number" id="fromInput" value="<?php echo isset($_GET['prix_min']) ? esc_html($_GET['prix_min']) : $min_price; ?>" min="<?php echo isset($_GET['prix_min']) ? esc_html($_GET['prix_min']) : $min_price; ?>" max="<?php echo isset($_GET['prix_max']) ? esc_html($_GET['prix_max']) : $max_price; ?>"/>
                        </div>
                        <div class="form_control_container">
                            <div class="form_control_container__time">Max</div>
                            <input class="form_control_container__time__input" type="number" id="toInput" value="<?php echo isset($_GET['prix_max']) ? esc_html($_GET['prix_max']) : $max_price; ?>" min="<?php echo isset($_GET['prix_min']) ? esc_html($_GET['prix_min']) : $min_price; ?>" max="<?php echo isset($_GET['prix_max']) ? esc_html($_GET['prix_max']) : $max_price; ?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="moreFilters">
                <div class="filter-group kilometreFilter">
                    <label for="km"><?php _e('Kilométrage:', 'textdomain'); ?></label>
                    <input type="number" id="km" name="km" value="<?php echo isset($_GET['km']) ? esc_attr($_GET['km']) : ''; ?>">
                </div>
                <div class="filter-group carburantFilter selectOption">
                    <label for="carburant"><?php _e('Carburant:', 'textdomain'); ?></label>
                    <select name="carburant" id="carburant">
                        <option value=""><?php _e('-- Choisir une option --', 'textdomain'); ?></option>
                        <option value="Essence" <?php isset($_GET['carburant']) ? selected($_GET['carburant'], 'Essence') : "" ?>>Essence</option>
                        <option value="Diesel" <?php isset($_GET['carburant']) ? selected($_GET['carburant'], 'Diesel') : "" ?>>Diesel</option>
                        <option value="Électrique" <?php isset($_GET['carburant']) ? selected($_GET['carburant'], 'Électrique') : "" ?>>Electrique</option>
                        <option value="Hybride" <?php isset($_GET['carburant']) ? selected($_GET['carburant'], 'Hybride') : "" ?>>Hybride</option>
                        <option value="Gaz" <?php isset($_GET['carburant']) ? selected($_GET['carburant'], 'Gaz') : "" ?>>Gaz</option>
                    </select>
                </div>
                <div class="filter-group boiteFilter selectOption">
                    <label for="boite"><?php _e('Boîte de vitesse:', 'textdomain'); ?></label>
                    <select name="boite" id="boite">
                        <option value=""><?php _e('-- Choisir une option --', 'textdomain'); ?></option>
                        <option value="manuelle" <?php isset($_GET['boite']) ? selected($_GET['boite'], 'manuelle') : "" ?>><?php _e('Manuelle', 'textdomain'); ?></option>
                        <option value="Automatique" <?php isset($_GET['boite']) ? selected($_GET['boite'], 'Automatique') : "" ?>><?php _e('Automatique', 'textdomain'); ?></option>
                    </select>
                </div>
            </div>
            <p class="seeMore">Voir plus</p>
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
                    <div class="img-car"><?php the_post_thumbnail(); ?>
                        <?php if($vendue) echo "<div class='car-vendue'><h3>VENDUE</h3></div>" ?></div>
                    <?php the_title('<h3 class="entry-title">', '</h3>');?>
                    <h4><?php echo get_post_meta(get_the_ID(), 'prix', true); ?> €</h4>
                    <div class="voiture-type">
                        <p><?php echo get_post_meta(get_the_ID(), 'classe', true); ?></p>
                        <p><?php echo get_post_meta(get_the_ID(), 'carburant', true); ?></p>
                    </div>
                    <div class="voiture-infos">
                        <p><svg style="padding-right: 4px" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.8333 3.33329C16.7538 3.33329 17.5 4.07948 17.5 4.99996V15.8333C17.5 16.7538 16.7538 17.5 15.8333 17.5H4.16667C3.24619 17.5 2.5 16.7538 2.5 15.8333V4.99996C2.5 4.07948 3.24619 3.33329 4.16667 3.33329H5V2.08329C5 1.85317 5.18655 1.66663 5.41667 1.66663H6.25C6.48012 1.66663 6.66667 1.85317 6.66667 2.08329V3.33329H13.3333V2.08329C13.3333 1.85317 13.5199 1.66663 13.75 1.66663H14.5833C14.8135 1.66663 15 1.85317 15 2.08329V3.33329H15.8333ZM4.16667 15.8333H15.8333V6.66663H4.16667V15.8333ZM9.58333 8.33329C9.35321 8.33329 9.16667 8.51984 9.16667 8.74996V9.58329C9.16667 9.81341 9.35321 9.99996 9.58333 9.99996H13.75C13.9801 9.99996 14.1667 9.81341 14.1667 9.58329V8.74996C14.1667 8.51984 13.9801 8.33329 13.75 8.33329H9.58333ZM7.5 9.58329C7.5 9.81341 7.31345 9.99996 7.08333 9.99996H6.25C6.01988 9.99996 5.83333 9.81341 5.83333 9.58329V8.74996C5.83333 8.51984 6.01988 8.33329 6.25 8.33329H7.08333C7.31345 8.33329 7.5 8.51984 7.5 8.74996V9.58329ZM10.4167 13.3333C10.6468 13.3333 10.8333 13.1467 10.8333 12.9166V12.0833C10.8333 11.8532 10.6468 11.6666 10.4167 11.6666H6.25C6.01988 11.6666 5.83333 11.8532 5.83333 12.0833V12.9166C5.83333 13.1467 6.01988 13.3333 6.25 13.3333H10.4167ZM12.9167 13.3333C12.6865 13.3333 12.5 13.1467 12.5 12.9166V12.0833C12.5 11.8532 12.6865 11.6666 12.9167 11.6666H13.75C13.9801 11.6666 14.1667 11.8532 14.1667 12.0833V12.9166C14.1667 13.1467 13.9801 13.3333 13.75 13.3333H12.9167Z" fill="#999999"/>
                            </svg>
                            <?php echo get_post_meta(get_the_ID(), 'annee', true); ?></p>
                        <p><svg style="padding-right: 4px" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.375 8.71671C17.4579 9.0152 17.5 9.32357 17.5 9.63337V15.8334C17.5 16.2936 17.1269 16.6667 16.6667 16.6667H15.8333C15.3731 16.6667 15 16.2936 15 15.8334V15H5.00001V15.8334C5.00001 16.2936 4.62691 16.6667 4.16668 16.6667H3.33334C2.87311 16.6667 2.50001 16.2936 2.50001 15.8334V9.63337C2.49927 9.32078 2.54133 9.00956 2.62501 8.70837L3.82501 4.54171C4.02761 3.83318 4.67147 3.34182 5.40834 3.33337H14.575C15.3204 3.33551 15.9738 3.83232 16.175 4.55004L17.375 8.71671ZM5.42501 4.79171C5.33242 4.79171 5.25094 4.85282 5.22501 4.94171L4.25834 8.33337H15.7417L14.7917 4.94171C14.7658 4.85282 14.6843 4.79171 14.5917 4.79171H5.42501ZM6.66668 11.6667C6.66668 12.1269 6.29358 12.5 5.83334 12.5H5.00001C4.53977 12.5 4.16668 12.1269 4.16668 11.6667V10.8334C4.16668 10.3731 4.53977 10 5.00001 10H5.83334C6.29358 10 6.66668 10.3731 6.66668 10.8334V11.6667ZM15 12.5C15.4602 12.5 15.8333 12.1269 15.8333 11.6667V10.8334C15.8333 10.3731 15.4602 10 15 10H14.1667C13.7064 10 13.3333 10.3731 13.3333 10.8334V11.6667C13.3333 12.1269 13.7064 12.5 14.1667 12.5H15Z" fill="#999999"/>
                            </svg>
                            <?php echo get_post_meta(get_the_ID(), 'km', true); ?> kms</p>
                        <p><svg style="padding-right: 4px" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_293_330)">
                                    <path d="M16.6666 5V10H3.33331M9.99998 5V15M3.33331 5V15" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18.3333 3.33329C18.3333 3.77532 18.1577 4.19924 17.8452 4.5118C17.5326 4.82436 17.1087 4.99996 16.6667 4.99996C16.2246 4.99996 15.8007 4.82436 15.4881 4.5118C15.1756 4.19924 15 3.77532 15 3.33329C15 2.89127 15.1756 2.46734 15.4881 2.15478C15.8007 1.84222 16.2246 1.66663 16.6667 1.66663C17.1087 1.66663 17.5326 1.84222 17.8452 2.15478C18.1577 2.46734 18.3333 2.89127 18.3333 3.33329ZM11.6667 3.33329C11.6667 3.77532 11.4911 4.19924 11.1785 4.5118C10.8659 4.82436 10.442 4.99996 9.99999 4.99996C9.55796 4.99996 9.13404 4.82436 8.82148 4.5118C8.50892 4.19924 8.33332 3.77532 8.33332 3.33329C8.33332 2.89127 8.50892 2.46734 8.82148 2.15478C9.13404 1.84222 9.55796 1.66663 9.99999 1.66663C10.442 1.66663 10.8659 1.84222 11.1785 2.15478C11.4911 2.46734 11.6667 2.89127 11.6667 3.33329ZM4.99999 3.33329C4.99999 3.77532 4.8244 4.19924 4.51183 4.5118C4.19927 4.82436 3.77535 4.99996 3.33332 4.99996C2.8913 4.99996 2.46737 4.82436 2.15481 4.5118C1.84225 4.19924 1.66666 3.77532 1.66666 3.33329C1.66666 2.89127 1.84225 2.46734 2.15481 2.15478C2.46737 1.84222 2.8913 1.66663 3.33332 1.66663C3.77535 1.66663 4.19927 1.84222 4.51183 2.15478C4.8244 2.46734 4.99999 2.89127 4.99999 3.33329ZM11.6667 16.6666C11.6667 17.1087 11.4911 17.5326 11.1785 17.8451C10.8659 18.1577 10.442 18.3333 9.99999 18.3333C9.55796 18.3333 9.13404 18.1577 8.82148 17.8451C8.50892 17.5326 8.33332 17.1087 8.33332 16.6666C8.33332 16.2246 8.50892 15.8007 8.82148 15.4881C9.13404 15.1756 9.55796 15 9.99999 15C10.442 15 10.8659 15.1756 11.1785 15.4881C11.4911 15.8007 11.6667 16.2246 11.6667 16.6666ZM4.99999 16.6666C4.99999 17.1087 4.8244 17.5326 4.51183 17.8451C4.19927 18.1577 3.77535 18.3333 3.33332 18.3333C2.8913 18.3333 2.46737 18.1577 2.15481 17.8451C1.84225 17.5326 1.66666 17.1087 1.66666 16.6666C1.66666 16.2246 1.84225 15.8007 2.15481 15.4881C2.46737 15.1756 2.8913 15 3.33332 15C3.77535 15 4.19927 15.1756 4.51183 15.4881C4.8244 15.8007 4.99999 16.2246 4.99999 16.6666ZM16.6667 18.3333C17.1087 18.3333 17.5326 18.1577 17.8452 17.8451C18.1577 17.5326 18.3333 17.1087 18.3333 16.6666C18.3333 16.2246 18.1577 15.8007 17.8452 15.4881C17.5326 15.1756 17.1087 15 16.6667 15C16.2246 15 15.8007 15.1756 15.4881 15.4881C15.1756 15.8007 15 16.2246 15 16.6666C15 17.1087 15.1756 17.5326 15.4881 17.8451C15.8007 18.1577 16.2246 18.3333 16.6667 18.3333Z" stroke="#999999" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_293_330">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                            <?php echo get_post_meta(get_the_ID(), 'boite', true); ?></p>
                </article>
            <?php endwhile; ?>

            <?php
            the_posts_pagination(array(
                'prev_text' => __('Previous page', 'textdomain'),
                'next_text' => __('Next page', 'textdomain'),
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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.filter-form');
        const resultsContainer = document.querySelector('.archive_voitures');
        const ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>";

        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        const sendAjaxRequest = debounce(function () {
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
        }, 500);

        form.addEventListener('input', function() {
            sendAjaxRequest();
        });
    });


</script>
