<?php
add_action('init', 'register_post_type_documents');

function register_post_type_documents(){
    $labels = array(
        'name'                  => _x( 'Documentos', 'Post Type General Name', 'supergiros' ),
        'singular_name'         => _x( 'Documento', 'Post Type Singular Name', 'supergiros' ),
        'menu_name'             => __( 'Documentos', 'supergiros' ),
        'archives'              => __( 'Lista de documentos', 'supergiros' ),
        'all_items'             => __( 'Todos los documentos', 'supergiros' ),
        'add_new_item'          => __( 'Añadir nuevo documento', 'supergiros' ),
        'add_new'               => __( 'Añadir nuevo', 'supergiros' ),
        'new_item'              => __( 'Nuevo documento', 'supergiros' ),
        'edit_item'             => __( 'Editar documento', 'supergiros' ),
        'update_item'           => __( 'Actualizar documento', 'supergiros' ),
        'view_item'             => __( 'Ver documento', 'supergiros' ),
        'view_items'            => __( 'Ver documentos', 'supergiros' ),
        'search_items'          => __( 'Buscar documentos', 'supergiros' ),
        'not_found'             => __( 'No se han encontrado documentos', 'supergiros' ),
        'not_found_in_trash'    => __( 'No se han encontrado documentos en la papelera', 'supergiros' ),
        'featured_image'        => __( 'Portada del documento', 'supergiros' ),
        'set_featured_image'    => __( 'Establecer portada', 'supergiros' ),
        'remove_featured_image' => __( 'Eliminar portada', 'supergiros' ),
        'use_featured_image'    => __( 'Usar como portada', 'supergiros' ),
        'insert_into_item'      => __( 'Insertar en la documento', 'supergiros' ),
        'uploaded_to_this_item' => __( 'Subido a esta documento', 'supergiros' ),
        'items_list'            => __( 'Lista de documentos', 'supergiros' ),
        'items_list_navigation' => __( 'Navegación por la lista de documentos', 'supergiros' ),
        'filter_items_list'     => __( 'Filtrar la lista de documentos', 'supergiros' ),
    );
    $supports = array(
        'title',
        'thumbnail',
        'author',
        'revisions',
    );
    $rewrite = array(
        'slug'					=> 'documentos/%taxonomy_documents%',
        'with_front'			=> false,
    );
    $args = array(
        'public'                => true,
        'label'                 => __( 'Documento', 'supergiros' ),
        'description'           => __( 'Este tipo de contenido es para almacenar todos los documentos informativos de la empresa', 'supergiros' ),
        'labels'                => $labels,
        'supports'              => $supports,
        'rewrite'				=> $rewrite,
        'menu_position'         => 8,
        'menu_icon'             => 'dashicons-media-document',
        'map_meta_cap'          => true,
        'show_in_rest'          => true,
        'show_in_nav_menus'     => false,
    );
    register_post_type('documents', $args);
}
