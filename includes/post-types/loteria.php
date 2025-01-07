<?php
function cpt_planes_de_premios() {

    $labels = array(
        'name'                  => _x( 'Loterías', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Lotería', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Planes de premios', 'text_domain' ),
        'archives'              => __( 'Lista de premios', 'text_domain' ),
        'attributes'            => __( 'Atributos', 'text_domain' ),
        'parent_item_colon'     => __( 'Plan de premio superior:', 'text_domain' ),
        'all_items'             => __( 'Todas las Loterías', 'text_domain' ),
        'add_new_item'          => __( 'Añadir una nueva lotería con plan de premio', 'text_domain' ),
        'add_new'               => __( 'Añadir nuevo', 'text_domain' ),
        'new_item'              => __( 'Nuevo plan de premio', 'text_domain' ),
        'edit_item'             => __( 'Editar plan de premio', 'text_domain' ),
        'update_item'           => __( 'Actualizar plan de premio', 'text_domain' ),
        'view_item'             => __( 'Ver plan de premio', 'text_domain' ),
        'view_items'            => __( 'Ver planes de premios', 'text_domain' ),
        'search_items'          => __( 'Buscar loterías', 'text_domain' ),
        'not_found'             => __( 'No se han encontrado loterías', 'text_domain' ),
        'not_found_in_trash'    => __( 'No se han encontrado loterías en la papelera', 'text_domain' ),
        'featured_image'        => __( 'Logo de la Lotería', 'text_domain' ),
        'set_featured_image'    => __( 'Establecer logo de la Lotería', 'text_domain' ),
        'remove_featured_image' => __( 'Eliminar logo', 'text_domain' ),
        'use_featured_image'    => __( 'Usar como logo', 'text_domain' ),
        'insert_into_item'      => __( 'Insertar en el plan de premio', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Subido a este plan de premio', 'text_domain' ),
        'items_list'            => __( 'Lista de planes de premios', 'text_domain' ),
        'items_list_navigation' => __( 'Navegación por la lista de planes de premios', 'text_domain' ),
        'filter_items_list'     => __( 'Filtrar la lista de planes de premios', 'text_domain' ),
    );

    $supports = array(
        'thumbnail',
        'title',
        'editor',
        'author',
        'revisions',
    );

    $rewrite = array(
        'slug'					=> 'loterias/planes-de-premios',
        'with_front'			=> false,
    );

    $args = array(
        'label'                 => __( 'Lotería', 'text_domain' ),
        'description'           => __( 'Este tipo de contenido es para almacenar las loterías y a su vez, los planes de premios que tienen estas', 'text_domain' ),
        'labels'                => $labels,
        'hierarchical'          => true,
        'supports'              => $supports,
        'public'                => true,
        'rewrite'               => $rewrite,
        'show_ui'               => true,
        'show_in_menu'          => 'loterias_menu',
        'show_in_nav_menus'     => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'can_export'            => true,
        'has_archive'           => 'loterias/planes-de-premios',
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );

    register_post_type( 'planes_de_premios', $args );

}

function cpt_resultados_y_secos() {

    $labels = array(
        'name'                  => _x( 'Resultados y Secos', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Resultado y Seco', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Resultados y Secos', 'text_domain' ),
        'archives'              => __( 'Lista de Resultados', 'text_domain' ),
        'attributes'            => __( 'Atributos', 'text_domain' ),
        'parent_item_colon'     => __( 'Plan de Resultado superior:', 'text_domain' ),
        'all_items'             => __( 'Todos los Resultados y Secos', 'text_domain' ),
        'add_new_item'          => __( 'Añadir un nuevo resultado y seco', 'text_domain' ),
        'add_new'               => __( 'Añadir nuevo', 'text_domain' ),
        'new_item'              => __( 'Nuevo resultado y seco', 'text_domain' ),
        'edit_item'             => __( 'Editar resultado y seco', 'text_domain' ),
        'update_item'           => __( 'Actualizar resultado y seco', 'text_domain' ),
        'view_item'             => __( 'Ver resultado y seco', 'text_domain' ),
        'view_items'            => __( 'Ver resultados y secos', 'text_domain' ),
        'search_items'          => __( 'Buscar resultados y secos', 'text_domain' ),
        'not_found'             => __( 'No se han encontrado resultados y secos', 'text_domain' ),
        'not_found_in_trash'    => __( 'No se han encontrado resultados y secos en la papelera', 'text_domain' ),
        'featured_image'        => __( 'Imagen del Resultado', 'text_domain' ),
        'set_featured_image'    => __( 'Establecer imagen', 'text_domain' ),
        'remove_featured_image' => __( 'Eliminar imagen', 'text_domain' ),
        'use_featured_image'    => __( 'Usar como imagen', 'text_domain' ),
        'insert_into_item'      => __( 'Insertar en el resultado y seco', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Subido a esta resultado y seco', 'text_domain' ),
        'items_list'            => __( 'Lista de resultados y secos', 'text_domain' ),
        'items_list_navigation' => __( 'Navegación por la lista de resultados y secos', 'text_domain' ),
        'filter_items_list'     => __( 'Filtrar la lista de resultados y secos', 'text_domain' ),
    );

    $supports = array(
        'title',
        'author',
        'revisions',
    );

    $rewrite = array(
        'slug'					=> 'loterias/resultados-y-secos',
        'with_front'			=> false,
    );

    $args = array(
        'label'                 => __( 'Resultado y Seco', 'text_domain' ),
        'description'           => __( 'Este tipo de contenido es para almacenar los resultados generados por las distintas loterías', 'text_domain' ),
        'labels'                => $labels,
        'hierarchical'          => true,
        'supports'              => $supports,
        'public'                => true,
        'rewrite'               => $rewrite,
        'show_ui'               => true,
        'show_in_menu'          => 'loterias_menu',
        'show_in_nav_menus'     => false,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-calendar-alt',
        'can_export'            => true,
        'has_archive'           => 'loterias/resultados-y-secos',
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );

    register_post_type( 'resultados_y_secos', $args );

}

function registrar_loterias() {
    cpt_planes_de_premios();
    cpt_resultados_y_secos();
}

add_action( 'init', 'registrar_loterias', 0 );
