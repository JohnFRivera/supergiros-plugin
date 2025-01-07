<?php
function agregar_metabox_loteria_resultados() {

    add_meta_box(
        'loteria_resultados',                   // ID del metabox
        'Detalles del resultado y seco',                              // Título del metabox
        'mostrar_metabox_loteria_resultados',   // Función para mostrar el contenido del metabox
        'resultados_y_secos',                   // Post type al que se le agrega el metabox
        'normal',                               // Ubicación en la pantalla (normal)
        'high'                                  // Prioridad
    );

}

add_action( 'add_meta_boxes', 'agregar_metabox_loteria_resultados' );

// Mostrar el campo select en el metabox
function mostrar_metabox_loteria_resultados( $post ) {
    
    $args = array(
        'post_type' => 'planes_de_premios', // El CPT padre
        'posts_per_page' => -1,             // Obtener todos los posts
        'post_status' => 'publish',         // Solo los publicados
    );
    $loterias = get_posts( $args );
    
    // Valor actual del campo (si existe)
    $selected_loteria_id = get_post_meta( $post->ID, '_loteria_id', true );
    $image_url = get_post_meta($post->ID, '_resultado_image', true);

    // Mostrar el campo select
    ?>
    <label style="display: block;font-weight: 600;margin-bottom: 6px;" for="sl_loteria_id">Lotería:</label>
    <select style="margin-bottom: 6px;" name="sl_loteria_id" id="sl_loteria_id">
        <option value="">Selecciona una lotería...</option>
        <?php
        foreach ( $loterias as $loteria ) {
            echo '<option value="' . $loteria->ID . '" ' . selected( $selected_loteria_id, $loteria->ID, false ) . '>' . esc_html( $loteria->post_title ) . '</option>';
        }
        ?>
    </select>
    <label style="display: block;font-weight: 600;margin-bottom: 6px;" for="ip_resultado_image">Resultado:</label>
    <input style="width: 50%;" placeholder="URL" type="text" name="ip_resultado_image" id="ip_resultado_image" value="<?php echo esc_attr($image_url); ?>" />
    <input type="button" id="upload_pdf_button" class="button" value="Seleccionar imagen" />
    <script>
    // Script para abrir el selector de medios
    jQuery(document).ready(function($){
        $('#title-prompt-text').prop('innerText', '');
        $('#title').prop('readOnly', true);
        $('#sl_loteria_id').change(function(e) {
            var loteria_option = e.target.selectedOptions.item(0).innerText;
            if (loteria_option !== 'Selecciona una lotería...') {
                $('#title').val(e.target.selectedOptions.item(0).innerText);
            } else {
                $('#title').val('');
            }
        });
        $('#upload_pdf_button').click(function(e) {
            e.preventDefault();
            var mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Selecciona un Resultado',
                button: {
                    text: 'Seleccionar Resultado'
                },
                multiple: false,
                library: {
                    type: 'image' // Filtrar para mostrar solo imagenes
                }
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#ip_resultado_image').val(attachment.url); // Establecer la URL en el campo de texto
            });

            mediaUploader.open();
        });
    });
    </script>
    <?php

}

function save_loteria_resultados_meta($post_id) {

    // Verifica si estamos guardando el Custom Post Type correcto
    if (get_post_type($post_id) === 'resultados_y_secos') {
        if (isset($_POST['sl_loteria_id'])) {
            // Guarda el valor del campo
            update_post_meta($post_id, '_loteria_id', sanitize_text_field($_POST['sl_loteria_id']));
        }
        // Verifica si se ha enviado el archivo
        if (isset($_POST['ip_resultado_image'])) {
            // Guarda el valor del campo
            update_post_meta($post_id, '_resultado_image', sanitize_text_field($_POST['ip_resultado_image']));
        }
    }

}

add_action('add_meta_boxes', 'agregar_metabox_loteria_resultados');
add_action('save_post', 'save_loteria_resultados_meta');