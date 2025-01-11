<?php
add_action('init', 'register_taxonomies_lottery');

function register_taxonomies_lottery(){
    add_category_lottery();
}

function add_category_lottery(){
    $labels = array(
        'name'                       => _x( 'Loterías', 'Taxonomy General Name', 'supergiros' ),
        'singular_name'              => _x( 'Lotería', 'Taxonomy Singular Name', 'supergiros' ),
        'menu_name'                  => __( 'Loterías', 'supergiros' ),
        'all_items'                  => __( 'Todas las loterías', 'supergiros' ),
        'parent_item'                => __( 'Lotería superior', 'supergiros' ),
        'parent_item_colon'          => __( 'Lotería superior:', 'supergiros' ),
        'new_item_name'              => __( 'Nuevo lotería', 'supergiros' ),
        'add_new_item'               => __( 'Añadir nuevo lotería', 'supergiros' ),
        'edit_item'                  => __( 'Editar lotería', 'supergiros' ),
        'update_item'                => __( 'Actualizar lotería', 'supergiros' ),
        'view_item'                  => __( 'Ver lotería', 'supergiros' ),
        'search_items'               => __( 'Buscar loterías', 'supergiros' ),
        'not_found'                  => __( 'No se han encontrado loterías', 'supergiros' ),
        'no_terms'                   => __( 'No hay loterías', 'supergiros' ),
        'items_list'                 => __( 'Lista de loterías', 'supergiros' ),
        'items_list_navigation'      => __( 'Navegación por la lista de loterías', 'supergiros' ),
    );
    $rewrite = array(
        'slug'                       => 'loterias',
    );
    $args = array(
        'public'                     => true,
        'labels'                     => $labels,
        'rewrite'					 => $rewrite,
        'hierarchical'               => true,
        'show_in_rest'               => true,
        'show_in_nav_menus'          => false,
        'show_admin_column'          => true,
    );
    register_taxonomy('category_lottery', array('lottery_prizes', 'lottery_results'), $args);
}
