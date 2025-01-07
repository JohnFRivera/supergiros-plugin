<?php
function registrar_cpt_documentos() {

    $labels = array(
        'name'                  => _x( 'Documentos', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Documento', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Documentos', 'text_domain' ),
        'archives'              => __( 'Lista de documentos', 'text_domain' ),
        'all_items'             => __( 'Todas las documentos', 'text_domain' ),
        'add_new_item'          => __( 'Añadir una nueva documento', 'text_domain' ),
        'add_new'               => __( 'Añadir nueva', 'text_domain' ),
        'new_item'              => __( 'Nueva documento', 'text_domain' ),
        'edit_item'             => __( 'Editar documento', 'text_domain' ),
        'update_item'           => __( 'Actualizar documento', 'text_domain' ),
        'view_item'             => __( 'Ver documento', 'text_domain' ),
        'view_items'            => __( 'Ver documentos', 'text_domain' ),
        'search_items'          => __( 'Buscar documentos', 'text_domain' ),
        'not_found'             => __( 'No se han encontrado documentos', 'text_domain' ),
        'not_found_in_trash'    => __( 'No se han encontrado documentos en la papelera', 'text_domain' ),
        'featured_image'        => __( 'Portada del Documento', 'text_domain' ),
        'set_featured_image'    => __( 'Establecer portada', 'text_domain' ),
        'remove_featured_image' => __( 'Eliminar portada', 'text_domain' ),
        'use_featured_image'    => __( 'Usar como portada', 'text_domain' ),
        'insert_into_item'      => __( 'Insertar en la documento', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Subido a esta documento', 'text_domain' ),
        'items_list'            => __( 'Lista de documentos', 'text_domain' ),
        'items_list_navigation' => __( 'Navegación por la lista de documentos', 'text_domain' ),
        'filter_items_list'     => __( 'Filtrar la lista de documentos', 'text_domain' ),
    );

    $supports = array(
        'title',
        'author',
        'thumbnail',
        'revisions',
    );

    $rewrite = array(
        'slug'					=> 'documentos/%categoria_documentos%',
        'with_front'			=> false,
    );

    $args = array(
        'label'                 => __( 'Documento', 'text_domain' ),
        'description'           => __( 'Este tipo de contenido es para almacenar los distintos documentos relacionados con la empresa', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => $supports,
        'public'                => true,
        'rewrite'				=> $rewrite,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => false,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-media-document',
        'can_export'            => true,
        'has_archive'           => 'documentos',
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );

    register_post_type( 'documentos', $args );

}

add_action( 'init', 'registrar_cpt_documentos', 0 );
