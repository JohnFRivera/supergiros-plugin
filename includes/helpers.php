<?php
function set_image_optimizer($max_width = 1200, $max_height = 1200){
    add_action('wp_handle_upload', 'image_optimizer');
    function image_optimizer($file){
        // Verificar formato
        if($file['type'] === 'image/jpeg' || $file['type'] === 'image/webp'){
            // Llamar editor de imagenes
            $image_editor = wp_get_image_editor($file['file']);
            if(!is_wp_error($image_editor)){
                // Cambiar tamaños
                $file_sizes = $image_editor->get_size();
                if($file_sizes['width'] > $max_width || $file_sizes['height'] > $max_height){
                    $image_editor->resize($max_width, $max_height, false);
                }
                // Bajar calidad
                $image_editor->set_quality(60);
                // Guardar imagen
                $file_saved = $image_editor->save($file['file']);
            }
        }
        return $file;
    }
}
