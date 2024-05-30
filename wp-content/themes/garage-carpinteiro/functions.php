<?php
add_theme_support('post-thumbnails');

add_action( 'wp_enqueue_scripts', 'my_assets' );

function display_voitures_posts($atts) {
    ob_start();

    // Récupérer le nombre de posts à afficher depuis les options
    $posts_per_page = get_option('voitures_posts_per_page', 10);

    $query = new WP_Query(array(
        'post_type' => 'voitures',
        'posts_per_page' => $posts_per_page,
        'meta_query' => array(
            array(
                'key' => '_display_on_homepage',
                'value' => '1',
                'compare' => '='
            )
        )
    ));

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_post_thumbnail() ?>
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
                </div>
                <div style="margin-top: 24px"><a href=<?php the_permalink(); ?>>En savoir plus</a></div>
            </article>
        <?php }
        wp_reset_postdata();
    } else {
        echo '<p>Aucune voiture trouvée.</p>';
    }

    return ob_get_clean();
}
add_shortcode('voitures', 'display_voitures_posts');

function voitures_settings_init() {
    // Ajouter une section dans les réglages
    add_settings_section(
        'voitures_settings_section',
        'Paramètres des Voitures',
        'voitures_settings_section_cb',
        'reading'
    );

    // Ajouter le champ de saisie
    add_settings_field(
        'voitures_posts_per_page',
        'Nombre de Voitures à Afficher',
        'voitures_posts_per_page_cb',
        'reading',
        'voitures_settings_section'
    );

    // Enregistrer le réglage
    register_setting('reading', 'voitures_posts_per_page', array(
        'type' => 'integer',
        'sanitize_callback' => 'absint',
        'default' => 3,
    ));
}
add_action('admin_init', 'voitures_settings_init');

// Callback pour la section
function voitures_settings_section_cb() {
    echo '<p>Paramètres pour les Custom Post Types Voitures.</p>';
}

// Callback pour le champ de saisie
function voitures_posts_per_page_cb() {
    $value = get_option('voitures_posts_per_page', 3);
    echo '<input type="number" id="voitures_posts_per_page" name="voitures_posts_per_page" value="' . esc_attr($value) . '" />';
}
function my_assets() {
    wp_register_style( 'archive', get_template_directory_uri().'/assets/css/archive.css');
    wp_enqueue_style( 'archive' );
    wp_register_style( 'single', get_template_directory_uri().'/assets/css/single.css');
    wp_enqueue_style( 'single' );
    wp_enqueue_script('archive-script', get_template_directory_uri() . '/assets/js/archive.js', array('jquery'), '1.0.0', true);
}

function add_voitures_meta_box() {
    add_meta_box(
        'voitures_meta_box',
        'Afficher sur la page d\'accueil',
        'display_voitures_meta_box',
        'voitures',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_voitures_meta_box');

function display_voitures_meta_box($post) {
    $value = get_post_meta($post->ID, '_display_on_homepage', true);
    wp_nonce_field('save_voitures_meta_box_data', 'voitures_meta_box_nonce');
    ?>
    <label for="display_on_homepage">
        <input type="checkbox" name="display_on_homepage" id="display_on_homepage" value="1" <?php checked($value, '1'); ?> />
        Afficher cet article sur la page d'accueil
    </label>
    <?php
}

// Sauvegarder les données de la meta box
function save_voitures_meta_box_data($post_id) {
    if (!isset($_POST['voitures_meta_box_nonce']) || !wp_verify_nonce($_POST['voitures_meta_box_nonce'], 'save_voitures_meta_box_data')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (!isset($_POST['display_on_homepage'])) {
        return;
    }

    $display_on_homepage = sanitize_text_field($_POST['display_on_homepage']);
    update_post_meta($post_id, '_display_on_homepage', $display_on_homepage);
}
add_action('save_post', 'save_voitures_meta_box_data');

add_action('init', function () {
    $labels = array(
        'name' => __("Voitures"),
        'all_items' => __("Toutes les Voitures"),
        'singular_name' => __('Voiture'),
        'add_new_item' => __('Ajouter une voiture'),
        'add_new' => __('Ajouter une voiture'),
        'edit_item' => __('Modifier la voiture'),
        'menu_name' => __('Voitures')
    );

    $args = array(
        'labels' => $labels,
        'supports'     => array(
            'title',
            'thumbnail',
        ),
        'show_in_rest' => true,
        'hierarchical' => false,
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array('slug' => 'voitures'),
        'show_in_nav_menus' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-car',
    );

    register_post_type("voitures", $args);
});

function voiture_meta_box() {
    add_meta_box(
        'voiture_details',
        __('Détails de la voiture'),
        'voiture_meta_box_callback',
        'voitures',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'voiture_meta_box');

function voiture_meta_box_callback($post) {
    wp_nonce_field('voiture_save_meta_box_data', 'voiture_meta_box_nonce');

    $marque = get_post_meta($post->ID, 'marque', true);
    $vendue = get_post_meta($post->ID, 'vendue', true);
    $modele = get_post_meta($post->ID, 'modele', true);
    $classe = get_post_meta($post->ID, 'classe', true);
    $puissance_fiscale = get_post_meta($post->ID, 'puissance_fiscale', true);
    $puissance_din = get_post_meta($post->ID, 'puissance_din', true);
    $motorisation = get_post_meta($post->ID, 'motorisation', true);
    $annee = get_post_meta($post->ID, 'annee', true);
    $km = get_post_meta($post->ID, 'km', true);
    $boite = get_post_meta($post->ID, 'boite', true);
    $carburant = get_post_meta($post->ID, 'carburant', true);
    $prix = get_post_meta($post->ID, 'prix', true);
    $portes = get_post_meta($post->ID, 'portes', true);
    $places = get_post_meta($post->ID, 'places', true);
    $consommation = get_post_meta($post->ID, 'consommation', true);
    $critair = get_post_meta($post->ID, 'critair', true);

    echo '<label for="vendue">' . __('Vendue') . '</label>';
    echo '<input type="checkbox" id="vendue" name="vendue" value="1"' . checked($vendue, true, false) . '></br></br>';

    echo '<label for="modele">' . __('Modèle') . '</label>';
    echo '<input type="text" id="modele" name="modele" value="' . esc_attr($modele) . '"></br></br>';


    echo '<label for="marque">' . __('Marque') . '</label>';
    echo '<input type="text" id="marque" name="marque" value="' . esc_attr($marque) . '"></br></br>';

    echo '<label for="classe">' . __('Classe') . '</label>';
    echo '<input type="text" id="classe" name="classe" value="' . esc_attr($classe) . '"></br></br>';

    echo '<label for="motorisation">' . __('Motorisation') . '</label>';
    echo '<input type="text" id="motorisation" name="motorisation" value="' . esc_attr($motorisation) . '"></br></br>';

    echo '<label for="puissance_fiscale">' . __('Puissance fiscale (cv) ') . '</label>';
    echo '<input type="number" id="puissance_fiscale" name="puissance_fiscale" value="' . esc_attr($puissance_fiscale) . '"></br></br>';

    echo '<label for="puissance_din">' . __('Puissance DIN (cv) ') . '</label>';
    echo '<input type="number" id="puissance_din" name="puissance_din" value="' . esc_attr($puissance_din) . '"></br></br>';

    echo '<label for="annee">' . __('Année') . '</label>';
    echo '<input type="text" id="annee" name="annee" value="' . esc_attr($annee) . '"></br></br>';

    echo '<label for="km">' . __('Kilometrage') . '</label>';
    echo '<input type="number" id="km" name="km" value="' . esc_attr($km) . '"></br></br>';

    echo '<label for="boite">' . __('boite') . '</label>';
    echo '
    <select name="boite" id="boite">
        <option value="'. esc_attr($boite).'">';
        if($boite){
            echo $boite;
        }else{
            echo "-- Choisir une option --";
        }
        echo'</option>
        <option value="Manuelle">Manuelle</option>
        <option value="Automatique">Automatique</option>
    </select></br></br>';

    echo '<label for="carburant">' . __('Carburant') . '</label>';
    echo '    <select name="carburant" id="carburant">
        <option value="'. esc_attr($carburant).'">';
    if($carburant){
        echo $carburant;
    }else{
        echo "-- Choisir une option --";
    }
    echo'</option>
        <option value="Essence">Essence</option>
        <option value="Diesel">Diesel</option>
        <option value="Électrique">Electrique</option>
        <option value="Hybride">Hybride</option>
        <option value="Gaz">Gaz</option>
    </select></br></br>';

    echo '<label for="prix">' . __('Prix (euros)') . '</label>';
    echo '<input type="number" id="prix" name="prix" value="' . esc_attr($prix) . '"></br></br>';

    echo '<label for="portes">' . __('Portes') . '</label>';
    echo '<input type="number" id="portes" name="portes" value="' . esc_attr($portes) . '"></br></br>';

    echo '<label for="places">' . __('Places') . '</label>';
    echo '<input type="number" id="places" name="places" value="' . esc_attr($places) . '"></br></br>';

    echo '<label for="consommation">' . __('Consommation (L/100km)') . '</label>';
    echo '<input type="number" id="consommation" name="consommation" value="' . esc_attr($consommation) . '"></br></br>';

    echo'<label for="critair">' . __('Critair') . '</label>';
    echo '
    <select name="critair" id="critair">
        <option value="'. esc_attr($critair).'">';
    if($critair){
        echo $critair;
    }else{
        echo "-- Choisir une option --";
    }
    echo'</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select></br></br>';
}

function voiture_save_meta_box_data($post_id) {
    if (!isset($_POST['voiture_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['voiture_meta_box_nonce'], 'voiture_save_meta_box_data')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        'marque',
        'vendue',
        'modele',
        'classe',
        'puissance_fiscale',
        'puissance_din',
        'motorisation',
        'annee',
        'km',
        'boite',
        'carburant',
        'prix',
        'portes',
        'places',
        'consommation',
        'critair'
    ];    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }

}
add_action('save_post', 'voiture_save_meta_box_data');

function property_gallery_add_metabox(){
    add_meta_box(
        'post_custom_gallery',
        'Gallery',
        'property_gallery_metabox_callback',
        'voitures',
        'normal',
        'core'
    );
}
add_action( 'admin_init', 'property_gallery_add_metabox' );

function property_gallery_metabox_callback(){
    wp_nonce_field( basename(__FILE__), 'sample_nonce' );
    global $post;
    $gallery_data = get_post_meta( $post->ID, 'gallery_data', true );
    ?>
    <div id="gallery_wrapper">
        <div id="img_box_container">
            <?php
            if ( isset( $gallery_data['image_url'] ) ){
            for( $i = 0; $i < count( $gallery_data['image_url'] ); $i++ ){
            ?>
            <div class="gallery_single_row dolu">
                <div class="gallery_area image_container ">
                    <img class="gallery_img_img" src="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
                    <input type="hidden"
                           class="meta_image_url"
                           name="gallery[image_url][]"
                           value="<?php esc_html_e( $gallery_data['image_url'][$i] ); ?>"
                    />
                </div>
                <div class="gallery_area">
                    <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="fas fa-trash-alt"></i></span>
                </div>
                <div class="clear" />
            </div>
        </div>
        <?php
        }
        }
        ?>
    </div>
    <div style="display:none" id="master_box">
        <div class="gallery_single_row">
            <div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
                <input class="meta_image_url" value="" type="hidden" name="gallery[image_url][]" />
            </div>
            <div class="gallery_area">
                <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="fas fa-trash-alt"></i></span>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="add_gallery_single_row">
        <input class="button add" type="button" value="+" onclick="open_media_uploader_image_plus();" title="Add image"/>
    </div>
    </div>
    <?php
}

function property_gallery_styles_scripts(){
    global $post;
    if( 'voitures' != $post->post_type )
        return;
    ?>
    <style type="text/css">
        .gallery_area {
            float:right;
        }
        .image_container {
            float:left!important;
            width: 100px;
            background: url('https://i.hizliresim.com/dOJ6qL.png');
            height: 100px;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 3px;
            cursor: pointer;
        }
        .image_container img{
            height: 100px;
            width: 100px;
            border-radius: 3px;
        }
        .clear {
            clear:both;
        }
        #gallery_wrapper {
            width: 100%;
            height: auto;
            position: relative;
            display: inline-block;
        }
        #gallery_wrapper input[type=text] {
            width:300px;
        }
        #gallery_wrapper .gallery_single_row {
            float: left;
            display:inline-block;
            width: 100px;
            position: relative;
            margin-right: 8px;
            margin-bottom: 20px;
        }
        .dolu {
            display: inline-block!important;
        }
        #gallery_wrapper label {
            padding:0 6px;
        }
        .button.remove {
            background: none;
            color: #f1f1f1;
            position: absolute;
            border: none;
            top: 4px;
            right: 7px;
            font-size: 1.2em;
            padding: 0px;
            box-shadow: none;
        }
        .button.remove:hover {
            background: none;
            color: #fff;
        }
        .button.add {
            background: #c3c2c2;
            color: #ffffff;
            border: none;
            box-shadow: none;
            width: 100px;
            height: 100px;
            line-height: 100px;
            font-size: 4em;
        }
        .button.add:hover, .button.add:focus {
            background: #e2e2e2;
            box-shadow: none;
            color: #0f88c1;
            border: none;
        }
    </style>
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
    <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript">
        function remove_img(value) {
            var parent=jQuery(value).parent().parent();
            parent.remove();
        }
        var media_uploader = null;
        function open_media_uploader_image(obj){
            media_uploader = wp.media({
                frame:    "post",
                state:    "insert",
                multiple: false
            });
            media_uploader.on("insert", function(){
                var json = media_uploader.state().get("selection").first().toJSON();
                var image_url = json.url;
                var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
                console.log(image_url);
                jQuery(obj).append(html);
                jQuery(obj).find('.meta_image_url').val(image_url);
            });
            media_uploader.open();
        }
        function open_media_uploader_image_this(obj){
            media_uploader = wp.media({
                frame:    "post",
                state:    "insert",
                multiple: false
            });
            media_uploader.on("insert", function(){
                var json = media_uploader.state().get("selection").first().toJSON();
                var image_url = json.url;
                console.log(image_url);
                jQuery(obj).attr('src',image_url);
                jQuery(obj).siblings('.meta_image_url').val(image_url);
            });
            media_uploader.open();
        }

        function open_media_uploader_image_plus(){
            media_uploader = wp.media({
                frame:    "post",
                state:    "insert",
                multiple: true
            });
            media_uploader.on("insert", function(){

                var length = media_uploader.state().get("selection").length;
                var images = media_uploader.state().get("selection").models

                for(var i = 0; i < length; i++){
                    var image_url = images[i].changed.url;
                    var box = jQuery('#master_box').html();
                    jQuery(box).appendTo('#img_box_container');
                    var element = jQuery('#img_box_container .gallery_single_row:last-child').find('.image_container');
                    var html = '<img class="gallery_img_img" src="'+image_url+'" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>';
                    element.append(html);
                    element.find('.meta_image_url').val(image_url);
                    console.log(image_url);
                }
            });
            media_uploader.open();
        }
        jQuery(function() {
            jQuery("#img_box_container").sortable();
        });
    </script>
    <?php
}
add_action( 'admin_head-post.php', 'property_gallery_styles_scripts' );
add_action( 'admin_head-post-new.php', 'property_gallery_styles_scripts' );

function property_gallery_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sample_nonce' ] ) && wp_verify_nonce( $_POST[ 'sample_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ($_POST && 'voitures' != $_POST['post_type'] )
        return;

    if ($_POST && $_POST['gallery'] ){
        $gallery_data = array();
        for ($i = 0; $i < count( $_POST['gallery']['image_url'] ); $i++ ){
            if ( '' != $_POST['gallery']['image_url'][$i]){
                $gallery_data['image_url'][]  = $_POST['gallery']['image_url'][ $i ];
            }
        }

        if ( $gallery_data )
            update_post_meta( $post_id, 'gallery_data', $gallery_data );
        else
            delete_post_meta( $post_id, 'gallery_data' );
    }
    // Nothing received, all fields are empty, delete option
    else{
        delete_post_meta( $post_id, 'gallery_data' );
    }
}
add_action( 'save_post', 'property_gallery_save' );

function filter_voitures_query($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('voitures')) {
        $meta_query = array();
        if (isset($_GET['km']) && !empty($_GET['km'])) {
            $meta_query[] = array(
                'key' => 'km',
                'value' => $_GET['km'],
                'compare' => '<=',
                'type' => 'NUMERIC'
            );
        }

        if (isset($_GET['modele']) && !empty($_GET['modele'])) {
            $meta_query[] = array(
                'key' => 'modele',
                'value' => $_GET['modele'],
                'compare' => 'LIKE'
            );
        }

        if (isset($_GET['prix']) && !empty($_GET['prix'])) {
            $meta_query[] = array(
                'key' => 'prix',
                'value' => $_GET['prix'],
                'compare' => '<=',
                'type' => 'NUMERIC'
            );
        }

        if (isset($_GET['carburant']) && !empty($_GET['carburant'])) {
            $meta_query[] = array(
                'key' => 'carburant',
                'value' => $_GET['carburant'],
                'compare' => 'LIKE'
            );
        }

        if (isset($_GET['boite']) && !empty($_GET['boite'])) {
            $meta_query[] = array(
                'key' => 'boite',
                'value' => $_GET['boite'],
                'compare' => 'LIKE'
            );
        }

        if (!empty($meta_query)) {
            $query->set('meta_query', $meta_query);
        }
    }
}
add_action('pre_get_posts', 'filter_voitures_query');

function get_max_car_price() {
    global $wpdb;

    $result = $wpdb->get_var("
        SELECT MAX(CAST(meta_value AS UNSIGNED)) 
        FROM $wpdb->postmeta 
        WHERE meta_key = 'prix'
    ");

    return $result ? $result : 100000;
}

function get_min_car_price() {
    global $wpdb;

    $result = $wpdb->get_var("
        SELECT MIN(CAST(meta_value AS UNSIGNED)) 
        FROM $wpdb->postmeta 
        WHERE meta_key = 'prix'
    ");

    return $result ? $result : 1000;
}


function enqueue_filter_scripts() {
    wp_enqueue_script('filter-script', get_template_directory_uri() . '/js/filters.js', array('jquery'), null, true);

    // Localisation du script pour y accéder dans le JavaScript
    wp_localize_script('filter-script', 'ajax_url', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_filter_scripts');

function filter_voitures_ajax_handler() {
    if (defined('DOING_AJAX') && DOING_AJAX) {
        $args = array(
            'post_type' => 'voitures',
            'post_status' => 'publish',
            'meta_query' => array()
        );

        if (isset($_POST['km']) && !empty($_POST['km'])) {
            $args['meta_query'][] = array(
                'key' => 'km',
                'value' => $_POST['km'],
                'compare' => '<=',
                'type' => 'NUMERIC'
            );
        }

        if (isset($_POST['modele']) && !empty($_POST['modele'])) {
            $args['meta_query'][] = array(
                'key' => 'modele',
                'value' => $_POST['modele'],
                'compare' => 'LIKE'
            );
        }

        if (isset($_POST['prix_min']) && !empty($_POST['prix_min'])) {
            $args['meta_query'][] = array(
                'key' => 'prix',
                'value' => $_POST['prix_min'],
                'compare' => '>=',
                'type' => 'NUMERIC'
            );
        }

        if (isset($_POST['prix_max']) && !empty($_POST['prix_max'])) {
            $args['meta_query'][] = array(
                'key' => 'prix',
                'value' => $_POST['prix_max'],
                'compare' => '<=',
                'type' => 'NUMERIC'
            );
        }

        if (isset($_POST['carburant']) && !empty($_POST['carburant'])) {
            $args['meta_query'][] = array(
                'key' => 'carburant',
                'value' => $_POST['carburant'],
                'compare' => 'LIKE'
            );
        }

        if (isset($_POST['boite']) && !empty($_POST['boite'])) {
            $args['meta_query'][] = array(
                'key' => 'boite',
                'value' => $_POST['boite'],
                'compare' => 'LIKE'
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) : $query->the_post();
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
            <?php
            endwhile;
            wp_reset_postdata();
        } else {
            echo '<p>' . __('Aucun vehicule trouvé.', 'textdomain') . '</p>';
        }
        wp_die(); // Ceci est crucial pour terminer proprement et retourner la réponse
    }
}
add_action('wp_ajax_filter_voitures', 'filter_voitures_ajax_handler'); // Si l'utilisateur est connecté
add_action('wp_ajax_nopriv_filter_voitures', 'filter_voitures_ajax_handler'); // Si l'utilisateur est déconnecté
