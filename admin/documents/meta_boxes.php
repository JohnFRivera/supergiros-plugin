<?php
add_action( 'add_meta_boxes', 'add_meta_box_documents' );
add_action('admin_enqueue_scripts', 'add_upload_pdf_script');
add_action('save_post', 'save_post_meta_box_document');

function add_meta_box_documents(){
    add_meta_box(
        'meta_box_documents',       // ID del meta box
        'Documento PDF',                      // Título del meta box
        'cb_meta_box_documents',    // Callback
        'documents',                // Post type padre
        'normal',                   // Contexto (donde se colocará el meta box)
        'high'                      // Prioridad
    );
}
function cb_meta_box_documents($post){
    // Traer PDF si se está editando
    $meta_pdf_url = get_post_meta($post->ID, '_document_pdf_url', true);
    // Botón subir documento
    echo '<p class="hide-if-no-js"><a href="#" id="upload-pdf-url">Subir documento</a></p>';
    echo '<input type="hidden" id="_document_pdf_url" name="_document_pdf_url" value="'.esc_attr($meta_pdf_url).'" data-name="'.esc_attr(array_pop(explode('/', $meta_pdf_url))).'">';
}
// Cargar script manejador de la biblioteca
function add_upload_pdf_script($hook){
    if($hook === 'post.php' || $hook === 'post-new.php'){
        if(get_post_type() === 'documents'){
            // Cargar el script solo en la página de edición de documentos
            wp_enqueue_script(
                'supergiros-document-upload-pdf',
                plugin_dir_url(__FILE__).'js/upload_pdf.js',
                array('jquery'),
                null,
                true
            );
        }
    }
}
function save_post_meta_box_document($post_id){
    if (get_post_type($post_id) === 'documents') {
        // Verifica si se ha enviado el archivo PDF
        if (isset($_POST['_document_pdf_url'])) {
            // Guarda el valor del campo
            update_post_meta($post_id, '_document_pdf_url', sanitize_text_field($_POST['_document_pdf_url']));
        }
    }
}
