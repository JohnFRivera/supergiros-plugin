<?php
add_action('init', 'register_post_type_news');

function register_post_type_news(){
    $labels = array(
        'name'                  => _x( 'Noticias', 'Post Type General Name', 'supergiros' ),
        'singular_name'         => _x( 'Noticia', 'Post Type Singular Name', 'supergiros' ),
        'menu_name'             => __( 'Noticias', 'supergiros' ),
        'archives'              => __( 'Lista de noticias', 'supergiros' ),
        'all_items'             => __( 'Todas las noticias', 'supergiros' ),
        'add_new_item'          => __( 'Añadir nueva noticia', 'supergiros' ),
        'add_new'               => __( 'Añadir nueva', 'supergiros' ),
        'new_item'              => __( 'Nueva noticia', 'supergiros' ),
        'edit_item'             => __( 'Editar noticia', 'supergiros' ),
        'update_item'           => __( 'Actualizar noticia', 'supergiros' ),
        'view_item'             => __( 'Ver noticia', 'supergiros' ),
        'view_items'            => __( 'Ver noticias', 'supergiros' ),
        'search_items'          => __( 'Buscar noticias', 'supergiros' ),
        'not_found'             => __( 'No se han encontrado noticias', 'supergiros' ),
        'not_found_in_trash'    => __( 'No se han encontrado noticias en la papelera', 'supergiros' ),
        'featured_image'        => __( 'Miniatura de la Noticia', 'supergiros' ),
        'set_featured_image'    => __( 'Establecer miniatura', 'supergiros' ),
        'remove_featured_image' => __( 'Eliminar miniatura', 'supergiros' ),
        'use_featured_image'    => __( 'Usar como miniatura', 'supergiros' ),
        'insert_into_item'      => __( 'Insertar en la noticia', 'supergiros' ),
        'uploaded_to_this_item' => __( 'Subido a esta noticia', 'supergiros' ),
        'items_list'            => __( 'Lista de noticias', 'supergiros' ),
        'items_list_navigation' => __( 'Navegación por la lista de noticias', 'supergiros' ),
        'filter_items_list'     => __( 'Filtrar la lista de noticias', 'supergiros' ),
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
        'slug'					=> 'noticias/%taxonomy_news%',
        'with_front'			=> false,
    );
    $args = array(
        'public'                => true,
        'label'                 => __( 'Noticia', 'supergiros' ),
        'description'           => __( 'Este tipo de contenido es para informar sobre novedades y noticias de la empresa para mantener a todos los usuarios informados', 'supergiros' ),
        'labels'                => $labels,
        'supports'              => $supports,
        'rewrite'				=> $rewrite,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-welcome-widgets-menus',
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'show_in_nav_menus'     => false,
    );
    register_post_type('news', $args);
}
