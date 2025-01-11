<?php
add_action('init', 'register_taxonomies_portfolio');

function register_taxonomies_portfolio(){
    add_category_portfolio();
}

function add_category_portfolio(){
    $labels = array(
        'name'                       => _x( 'Categorías del portafolio', 'Taxonomy General Name', 'supergiros' ),
        'singular_name'              => _x( 'Categoría del portafolio', 'Taxonomy Singular Name', 'supergiros' ),
        'menu_name'                  => __( 'Categorías', 'supergiros' ),
        'all_items'                  => __( 'Todas las categorías', 'supergiros' ),
        'parent_item'                => __( 'Categoría superior', 'supergiros' ),
        'parent_item_colon'          => __( 'Categoría superior:', 'supergiros' ),
        'new_item_name'              => __( 'Nuevo categoría', 'supergiros' ),
        'add_new_item'               => __( 'Añadir nuevo categoría', 'supergiros' ),
        'edit_item'                  => __( 'Editar categoría', 'supergiros' ),
        'update_item'                => __( 'Actualizar categoría', 'supergiros' ),
        'view_item'                  => __( 'Ver categoría', 'supergiros' ),
        'search_items'               => __( 'Buscar categorías', 'supergiros' ),
        'not_found'                  => __( 'No se han encontrado categorías', 'supergiros' ),
        'no_terms'                   => __( 'No hay categorías', 'supergiros' ),
        'items_list'                 => __( 'Lista de categorías', 'supergiros' ),
        'items_list_navigation'      => __( 'Navegación por la lista de categorías', 'supergiros' ),
    );
    $rewrite = array(
        'slug'                       => 'portafolio',
    );
    $args = array(
        'public'                     => true,
        'labels'                     => $labels,
        'rewrite'					 => $rewrite,
        'hierarchical'               => true,
        'show_in_rest'               => true,
        'show_admin_column'          => true,
    );
    register_taxonomy('category_portfolio', array('portfolio'), $args);
}
