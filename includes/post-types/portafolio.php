<?php
function registrar_cpt_portafolio() {

    $labels = array(
        'name'                  => _x( 'Portafolio', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Portafolio', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Portafolio', 'text_domain' ),
        'archives'              => __( 'Lista del portafolio', 'text_domain' ),
        'all_items'             => __( 'Todo el portafolio', 'text_domain' ),
        'add_new_item'          => __( 'Añadir un nuevo elemento', 'text_domain' ),
        'add_new'               => __( 'Añadir nueva', 'text_domain' ),
        'new_item'              => __( 'Nuevo elemento', 'text_domain' ),
        'edit_item'             => __( 'Editar elemento', 'text_domain' ),
        'update_item'           => __( 'Actualizar elemento', 'text_domain' ),
        'view_item'             => __( 'Ver elemento', 'text_domain' ),
        'view_items'            => __( 'Ver el portafolio', 'text_domain' ),
        'search_items'          => __( 'Buscar en el portafolio', 'text_domain' ),
        'not_found'             => __( 'No se han encontrado elementos', 'text_domain' ),
        'not_found_in_trash'    => __( 'No se han encontrado elementos en la papelera', 'text_domain' ),
        'featured_image'        => __( 'Logo del elemento', 'text_domain' ),
        'set_featured_image'    => __( 'Establecer logo del elemento', 'text_domain' ),
        'remove_featured_image' => __( 'Eliminar logo', 'text_domain' ),
        'use_featured_image'    => __( 'Usar como logo', 'text_domain' ),
        'insert_into_item'      => __( 'Insertar en la elemento', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Subido a esta elemento', 'text_domain' ),
        'items_list'            => __( 'Lista del portafolio', 'text_domain' ),
        'items_list_navigation' => __( 'Navegación por la lista del portafolio', 'text_domain' ),
        'filter_items_list'     => __( 'Filtrar la lista del portafolio', 'text_domain' ),
    );

    $supports = array(
        'thumbnail',
        'title',
        'excerpt',
        'editor',
        'author',
        'revisions',
    );

    $rewrite = array(
        'slug'					=> 'portafolio/%categoria_portafolio%',
        'with_front'			=> false,
    );

    $args = array(
        'label'                 => __( 'Portafolio', 'text_domain' ),
        'description'           => __( 'Este tipo de contenido es para informar a los usuarios sobre novedades y noticias de la empresa para mantener a todos los usuarios informados', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => $supports,
        'public'                => true,
        'rewrite'				=> $rewrite,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => false,
        'menu_position'         => 4,
        'menu_icon'             => 'dashicons-portfolio',
        'can_export'            => true,
        'has_archive'           => 'portafolio',
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );

    register_post_type( 'portafolio', $args );

}

add_action( 'init', 'registrar_cpt_portafolio', 0 );
