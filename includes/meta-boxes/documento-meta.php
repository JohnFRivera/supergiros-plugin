<?php
function add_documento_meta_box() {

    add_meta_box(
        'documento_pdf',             // ID del meta box
        'Detalles del documento',    // Título del meta box
        'documento_pdf_meta_box',    // Función de callback que genera el campo
        'documentos',                // El CPT donde se mostrará
        'normal',                    // Contexto (donde se colocará el meta box)
        'high'                       // Prioridad
    );

}

function documento_pdf_meta_box($post) {

    // Obtén el valor guardado si existe
    $pdf_url = get_post_meta($post->ID, '_documento_pdf', true);

    ?>
    <label style="display: block;font-weight: 600;margin-bottom: 6px;" for="ip_documento_pdf">Documento:</label>
    <input style="width: 50%;" placeholder="URL" type="text" name="ip_documento_pdf" id="ip_documento_pdf" value="<?php echo esc_attr($pdf_url); ?>" />
    <input type="button" id="upload_pdf_button" class="button" value="Seleccionar documento" />
    <script>
    // Script para abrir el selector de medios
    jQuery(document).ready(function($){
        $('#upload_pdf_button').click(function(e) {
            e.preventDefault();
            var mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Selecciona un PDF',
                button: {
                    text: 'Seleccionar PDF'
                },
                multiple: false,
                library: {
                    type: 'application/pdf' // Filtrar para mostrar solo PDFs
                }
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#ip_documento_pdf').val(attachment.url); // Establecer la URL en el campo de texto
            });

            mediaUploader.open();
        });
    });
    </script>
    <?php

}

function save_documento_pdf_meta($post_id) {

    // Verifica si estamos guardando el Custom Post Type correcto
    if (get_post_type($post_id) === 'documentos') {
        // Verifica si se ha enviado el archivo PDF
        if (isset($_POST['ip_documento_pdf'])) {
            // Guarda el valor del campo
            update_post_meta($post_id, '_documento_pdf', sanitize_text_field($_POST['ip_documento_pdf']));
        }
    }

}

add_action('add_meta_boxes', 'add_documento_meta_box');
add_action('save_post', 'save_documento_pdf_meta');
