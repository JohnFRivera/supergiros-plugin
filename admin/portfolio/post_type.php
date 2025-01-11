<?php
add_action('init', 'register_post_type_portfolio');

function register_post_type_portfolio(){
    $labels = array(
        'name'                  => _x( 'Portafolio', 'Post Type General Name', 'supergiros' ),
        'singular_name'         => _x( 'Portafolio', 'Post Type Singular Name', 'supergiros' ),
        'menu_name'             => __( 'Portafolio', 'supergiros' ),
        'archives'              => __( 'Lista de elementos', 'supergiros' ),
        'all_items'             => __( 'Todo el portafolio', 'supergiros' ),
        'add_new_item'          => __( 'Añadir nuevo elemento', 'supergiros' ),
        'add_new'               => __( 'Añadir nuevo', 'supergiros' ),
        'new_item'              => __( 'Nuevo elemento', 'supergiros' ),
        'edit_item'             => __( 'Editar elemento', 'supergiros' ),
        'update_item'           => __( 'Actualizar elemento', 'supergiros' ),
        'view_item'             => __( 'Ver elemento', 'supergiros' ),
        'view_items'            => __( 'Ver elementos', 'supergiros' ),
        'search_items'          => __( 'Buscar elementos', 'supergiros' ),
        'not_found'             => __( 'No se han encontrado elementos', 'supergiros' ),
        'not_found_in_trash'    => __( 'No se han encontrado elementos en la papelera', 'supergiros' ),
        'featured_image'        => __( 'Logo del elemento', 'supergiros' ),
        'set_featured_image'    => __( 'Establecer logo', 'supergiros' ),
        'remove_featured_image' => __( 'Eliminar logo', 'supergiros' ),
        'use_featured_image'    => __( 'Usar como logo', 'supergiros' ),
        'insert_into_item'      => __( 'Insertar en el elemento', 'supergiros' ),
        'uploaded_to_this_item' => __( 'Subido a este elemento', 'supergiros' ),
        'items_list'            => __( 'Lista de elementos', 'supergiros' ),
        'items_list_navigation' => __( 'Navegación por la lista de elementos', 'supergiros' ),
        'filter_items_list'     => __( 'Filtrar la lista de elementos', 'supergiros' ),
    );
    $supports = array(
        'title',
        'excerpt',
        'editor',
        'thumbnail',
        'author',
        'revisions',
    );
    $rewrite = array(
        'slug'					=> 'portafolio/%taxonomy_portfolio%',
        'with_front'			=> false,
    );
    $args = array(
        'public'                => true,
        'label'                 => __( 'Portafolio', 'supergiros' ),
        'description'           => __( 'Este tipo de contenido es para almacenar todos los elementos del portafolio de la empresa, ya sea productos, servicios, etc', 'supergiros' ),
        'labels'                => $labels,
        'supports'              => $supports,
        'rewrite'				=> $rewrite,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'show_in_nav_menus'     => false,
    );
    register_post_type('portfolio', $args);
}
