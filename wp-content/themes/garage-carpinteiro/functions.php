<?php
add_theme_support('post-thumbnails');

add_action( 'wp_enqueue_scripts', 'my_assets' );
function my_assets() {
    wp_register_style( 'archive', get_template_directory_uri().'./assets/css/archive.css');
    wp_enqueue_style( 'archive' );
}

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
    $modele = get_post_meta($post->ID, 'modele', true);
    $classe = get_post_meta($post->ID, 'classe', true);
    $puissance_fiscale = get_post_meta($post->ID, 'puissance_fiscale', true);
    $puissance_din = get_post_meta($post->ID, 'puissance_din', true);
    $motorisation = get_post_meta($post->ID, 'motorisation', true);
    $annee = get_post_meta($post->ID, 'annee', true);
    $km = get_post_meta($post->ID, 'km', true);
    $transmission = get_post_meta($post->ID, 'transmission', true);
    $carburant = get_post_meta($post->ID, 'carburant', true);
    $prix = get_post_meta($post->ID, 'prix', true);
    $portes = get_post_meta($post->ID, 'portes', true);
    $places = get_post_meta($post->ID, 'places', true);
    $consommation = get_post_meta($post->ID, 'consommation', true);


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

    echo '<label for="transmission">' . __('Transmission') . '</label>';
    echo '
    <select name="transmission" id="transmission">
        <option value="'. esc_attr($transmission).'">';
        if($transmission){
            echo $transmission;
        }else{
            echo "-- Choisir une option --";
        }
        echo'</option>
        <option value="manuelle">Manuelle</option>
        <option value="automatique">Automatique</option>
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
        <option value="essence">Essence</option>
        <option value="diesel">Diesel</option>
        <option value="electrique">Electrique</option>
        <option value="hybride">Hybride</option>
        <option value="gaz">Gaz</option>
    </select></br></br>';

    echo '<label for="prix">' . __('Prix (euros)') . '</label>';
    echo '<input type="number" id="prix" name="prix" value="' . esc_attr($prix) . '"></br></br>';

    echo '<label for="portes">' . __('Portes') . '</label>';
    echo '<input type="number" id="portes" name="portes" value="' . esc_attr($portes) . '"></br></br>';

    echo '<label for="places">' . __('Places') . '</label>';
    echo '<input type="number" id="places" name="places" value="' . esc_attr($places) . '"></br></br>';

    echo '<label for="consommation">' . __('Consommation (L/100km)') . '</label>';
    echo '<input type="number" id="consommation" name="consommation" value="' . esc_attr($consommation) . '"></br></br>';
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
        'modele',
        'classe',
        'puissance_fiscale',
        'puissance_din',
        'motorisation',
        'annee',
        'km',
        'transmission',
        'carburant',
        'prix',
        'portes',
        'places',
        'consommation'
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
?>