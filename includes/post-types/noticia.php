<?php
function registrar_cpt_noticias() {

    $labels = array(
        'name'                  => _x( 'Noticias', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Noticia', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Noticias', 'text_domain' ),
        'archives'              => __( 'Lista de noticias', 'text_domain' ),
        'all_items'             => __( 'Todas las noticias', 'text_domain' ),
        'add_new_item'          => __( 'Añadir una nueva noticia', 'text_domain' ),
        'add_new'               => __( 'Añadir nueva', 'text_domain' ),
        'new_item'              => __( 'Nueva noticia', 'text_domain' ),
        'edit_item'             => __( 'Editar noticia', 'text_domain' ),
        'update_item'           => __( 'Actualizar noticia', 'text_domain' ),
        'view_item'             => __( 'Ver noticia', 'text_domain' ),
        'view_items'            => __( 'Ver noticias', 'text_domain' ),
        'search_items'          => __( 'Buscar noticias', 'text_domain' ),
        'not_found'             => __( 'No se han encontrado noticias', 'text_domain' ),
        'not_found_in_trash'    => __( 'No se han encontrado noticias en la papelera', 'text_domain' ),
        'featured_image'        => __( 'Miniatura de la Noticia', 'text_domain' ),
        'set_featured_image'    => __( 'Establecer miniatura', 'text_domain' ),
        'remove_featured_image' => __( 'Eliminar miniatura', 'text_domain' ),
        'use_featured_image'    => __( 'Usar como miniatura', 'text_domain' ),
        'insert_into_item'      => __( 'Insertar en la noticia', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Subido a esta noticia', 'text_domain' ),
        'items_list'            => __( 'Lista de noticias', 'text_domain' ),
        'items_list_navigation' => __( 'Navegación por la lista de noticias', 'text_domain' ),
        'filter_items_list'     => __( 'Filtrar la lista de noticias', 'text_domain' ),
    );

    $supports = array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'revisions',
    );

    $rewrite = array(
        'slug'					=> 'noticias/%categoria_noticias%',
        'with_front'			=> false,
    );

    $args = array(
        'label'                 => __( 'Noticia', 'text_domain' ),
        'description'           => __( 'Este tipo de contenido es para informar a los usuarios sobre novedades y noticias de la empresa para mantener a todos los usuarios informados', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => $supports,
        'public'                => true,
        'rewrite'				=> $rewrite,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => false,
        'menu_position'         => 4,
        'menu_icon'             => 'dashicons-welcome-widgets-menus',
        'can_export'            => true,
        'has_archive'           => 'noticias',
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );

    register_post_type( 'noticias', $args );

}

add_action( 'init', 'registrar_cpt_noticias', 0 );
