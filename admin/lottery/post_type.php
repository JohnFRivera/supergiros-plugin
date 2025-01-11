<?php
add_action('init', 'register_post_type_lottery');

function register_post_type_lottery(){
    add_post_type_lottery_prizes();
    add_post_type_lottery_results();
}

function add_post_type_lottery_prizes(){
    $labels = array(
        'name'                  => _x( 'Planes de premios', 'Post Type General Name', 'supergiros' ),
        'singular_name'         => _x( 'Plan de premio', 'Post Type Singular Name', 'supergiros' ),
        'menu_name'             => __( 'Planes de premios', 'supergiros' ),
        'archives'              => __( 'Lista de planes', 'supergiros' ),
        'all_items'             => __( 'Planes de premios', 'supergiros' ),
        'add_new_item'          => __( 'Añadir nuevo plan de premio', 'supergiros' ),
        'add_new'               => __( 'Añadir nuevo', 'supergiros' ),
        'new_item'              => __( 'Nuevo plan de premio', 'supergiros' ),
        'edit_item'             => __( 'Editar plan de premio', 'supergiros' ),
        'update_item'           => __( 'Actualizar plan de premio', 'supergiros' ),
        'view_item'             => __( 'Ver plan de premio', 'supergiros' ),
        'view_items'            => __( 'Ver plan de premios', 'supergiros' ),
        'search_items'          => __( 'Buscar plan de premios', 'supergiros' ),
        'not_found'             => __( 'No se han encontrado plan de premios', 'supergiros' ),
        'not_found_in_trash'    => __( 'No se han encontrado plan de premios en la papelera', 'supergiros' ),
        'insert_into_item'      => __( 'Insertar en el plan de premio', 'supergiros' ),
        'uploaded_to_this_item' => __( 'Subido a este plan de premio', 'supergiros' ),
        'items_list'            => __( 'Lista de plan de premios', 'supergiros' ),
        'items_list_navigation' => __( 'Navegación por la lista de plan de premios', 'supergiros' ),
        'filter_items_list'     => __( 'Filtrar la lista de plan de premios', 'supergiros' ),
    );
    $supports = array(
        'title',
        'editor',
        'author',
        'revisions',
    );
    $rewrite = array(
        'slug'					=> 'loterias/planes-de-premios/',
        'with_front'			=> false,
    );
    $args = array(
        'public'                => true,
        'label'                 => __( 'Planes de premios', 'supergiros' ),
        'description'           => __( 'Este tipo de contenido es para almacenar todos los planes de premios con los que cuenta una lotería', 'supergiros' ),
        'labels'                => $labels,
        'supports'              => $supports,
        'rewrite'				=> $rewrite,
        'menu_icon'             => 'dashicons-',
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'show_in_menu'          => 'menu_lotteries',
        'show_in_nav_menus'     => false,
    );
    register_post_type('lottery_prizes', $args);
}
function add_post_type_lottery_results(){
    $labels = array(
        'name'                  => _x( 'Resultados y secos', 'Post Type General Name', 'supergiros' ),
        'singular_name'         => _x( 'Resultado y seco', 'Post Type Singular Name', 'supergiros' ),
        'menu_name'             => __( 'Resultados y secos', 'supergiros' ),
        'archives'              => __( 'Lista de resultados y secos', 'supergiros' ),
        'all_items'             => __( 'Resultados y secos', 'supergiros' ),
        'add_new_item'          => __( 'Añadir nuevo resultado y seco', 'supergiros' ),
        'add_new'               => __( 'Añadir nuevo', 'supergiros' ),
        'new_item'              => __( 'Nuevo resultado y seco', 'supergiros' ),
        'edit_item'             => __( 'Editar resultado y seco', 'supergiros' ),
        'update_item'           => __( 'Actualizar resultado y seco', 'supergiros' ),
        'view_item'             => __( 'Ver resultado y seco', 'supergiros' ),
        'view_items'            => __( 'Ver resultados y secos', 'supergiros' ),
        'search_items'          => __( 'Buscar resultados y secos', 'supergiros' ),
        'not_found'             => __( 'No se han encontrado resultados y secos', 'supergiros' ),
        'not_found_in_trash'    => __( 'No se han encontrado resultados y secos en la papelera', 'supergiros' ),
        'insert_into_item'      => __( 'Insertar en el resultado y seco', 'supergiros' ),
        'uploaded_to_this_item' => __( 'Subido a este resultado y seco', 'supergiros' ),
        'items_list'            => __( 'Lista de resultados y secos', 'supergiros' ),
        'items_list_navigation' => __( 'Navegación por la lista de resultados y secos', 'supergiros' ),
        'filter_items_list'     => __( 'Filtrar la lista de resultados y secos', 'supergiros' ),
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
        'slug'					=> 'loterias/resultados-y-secos/',
        'with_front'			=> false,
    );
    $args = array(
        'public'                => true,
        'label'                 => __( 'Resultados y secos', 'supergiros' ),
        'description'           => __( 'Este tipo de contenido es para almacenar todos los resultados diarios de las distintas loterías del sistema', 'supergiros' ),
        'labels'                => $labels,
        'supports'              => $supports,
        'rewrite'				=> $rewrite,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'show_in_menu'          => 'menu_lotteries',
        'show_in_nav_menus'     => false,
    );
    register_post_type('lottery_results', $args);
}
