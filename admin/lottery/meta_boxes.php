<?php
add_action( 'admin_init', 'add_form_fields_lottery' );
add_action('admin_enqueue_scripts', 'add_upload_img_script');
add_action('saved_term', 'saved_term_metabox_lottery', 10, 2);
add_action('edit_term', 'edit_term_metabox_lottery', 10, 2);

// Agregar casillas al formulario de agregar o editar taxonomia
function add_form_fields_lottery(){
    add_action(
        'category_lottery_add_form_fields',
        'cb_add_form_field_lottery',
    );
    add_action(
        'category_lottery_edit_form_fields',
        'cb_edit_form_field_lottery',
        10,
        2,
    );
}
function cb_add_form_field_lottery($taxonomy){
    // Traer datos de la imagen si se está editando
    // HTML
    ?>
    <div class="form-field form-required term-image-wrap">
        <label for="logo_lottery">Logo de la lotería</label>
        <div id="logo_lottery_preview" style="margin-bottom: 10px;"></div>
        <button type="button" class="button" id="upload_logo_btn">Subir logo</button>
        <button type="button" class="button" style="color: #b32d2e;border-color: #b32d2e;" id="remove_logo_btn">Eliminar logo</button>
        <p id="logo-description">El logo es la imagen que se mostrará en representación de la lotería</p>
        <input type="hidden" id="_logo_lottery" name="_logo_lottery" />
    </div>
    <?php
}
function cb_edit_form_field_lottery($term, $taxonomy){
    // Traer datos de la imagen si se está editando
    $meta_img_id = get_term_meta($term->term_id, '_logo_lottery', true);
    $img_url = $meta_img_id ? wp_get_attachment_url($meta_img_id) : '';
    // HTML
    ?>
    <tr class="form-field term-image-wrap">
        <th scope="row">
            <label for="logo_lottery">Logo de la lotería</label>
        </th>
        <td>
            <input type="hidden" id="_logo_lottery" name="_logo_lottery" value="<?php echo esc_attr($meta_img_id); ?>" />
            <div id="logo_lottery_preview" style="margin-bottom: 10px;">
                <?php
                if($img_url){
                    echo '<img height="80px" src="'.esc_url($img_url).'" alt="Logo de lotería '.$term->name.'" />';
                };
                ?>
            </div>
            <button type="button" class="button" id="upload_img_btn">Subir logo</button>
            <button type="button" class="button" style="color: #b32d2e;border-color: #b32d2e;" id="remove_img_btn">Eliminar logo</button>
            <p class="description" id="logo-description"></p>
        </td>
    </tr>
    <?php
}
// Cargar script manejador de la biblioteca
function add_upload_img_script($hook){
    if($hook === 'edit-tags.php' || $hook === 'term.php'){
        if($_GET['taxonomy'] === 'category_lottery'){
            // Cargar el script solo en la página de edición de documentos
            wp_enqueue_script(
                'supergiros-lottery-upload-img',
                plugin_dir_url(__FILE__).'js/upload_img.js',
                array('jquery'),
                null,
                true
            );
        }
    }
}
// Guardar o editar el metabox
function saved_term_metabox_lottery($term_id, $tt_id){
    // Verifica si se ha enviado el logo
    if (isset($_POST['_logo_lottery'])) {
        // Guarda el valor del campo
        add_term_meta($term_id, '_logo_lottery', sanitize_text_field($_POST['_logo_lottery']));
    }
}
function edit_term_metabox_lottery($term_id, $tt_id){
    // Verifica si se ha enviado el logo
    if (isset($_POST['_logo_lottery'])) {
        // Guarda el valor del campo
        update_term_meta($term_id, '_logo_lottery', sanitize_text_field($_POST['_logo_lottery']));
    }
}
