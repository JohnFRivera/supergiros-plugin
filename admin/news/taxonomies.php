<?php
add_action('init', 'register_taxonomies_news');

function register_taxonomies_news(){
    add_category_news();
    add_tag_news();
}

function add_category_news(){
    $labels = array(
        'name'                       => _x( 'Tipos de noticia', 'Taxonomy General Name', 'supergiros' ),
        'singular_name'              => _x( 'Tipo de noticia', 'Taxonomy Singular Name', 'supergiros' ),
        'menu_name'                  => __( 'Tipos', 'supergiros' ),
        'all_items'                  => __( 'Todos los tipos', 'supergiros' ),
        'parent_item'                => __( 'Tipo superior', 'supergiros' ),
        'parent_item_colon'          => __( 'Tipo superior:', 'supergiros' ),
        'new_item_name'              => __( 'Nuevo tipo', 'supergiros' ),
        'add_new_item'               => __( 'Añadir nuevo tipo', 'supergiros' ),
        'edit_item'                  => __( 'Editar tipo', 'supergiros' ),
        'update_item'                => __( 'Actualizar tipo', 'supergiros' ),
        'view_item'                  => __( 'Ver tipo', 'supergiros' ),
        'search_items'               => __( 'Buscar tipos', 'supergiros' ),
        'not_found'                  => __( 'No se han encontrado tipos', 'supergiros' ),
        'no_terms'                   => __( 'No hay tipos', 'supergiros' ),
        'items_list'                 => __( 'Lista de tipos', 'supergiros' ),
        'items_list_navigation'      => __( 'Navegación por la lista de tipos', 'supergiros' ),
    );
    $rewrite = array(
        'slug'                       => 'noticias',
    );
    $args = array(
        'public'                     => true,
        'labels'                     => $labels,
        'rewrite'					 => $rewrite,
        'hierarchical'               => true,
        'show_in_rest'               => true,
        'show_admin_column'          => true,
    );
    register_taxonomy('category_news', array('news'), $args);
}
function add_tag_news(){
    $labels = array(
        'name'                       => _x( 'Etiquetas', 'Taxonomy General Name', 'supergiros' ),
        'singular_name'              => _x( 'Etiqueta', 'Taxonomy Singular Name', 'supergiros' ),
        'menu_name'                  => __( 'Etiquetas', 'supergiros' ),
        'all_items'                  => __( 'Todas las etiquetas', 'supergiros' ),
        'parent_item'                => __( 'etiqueta superior', 'supergiros' ),
        'parent_item_colon'          => __( 'etiqueta superior:', 'supergiros' ),
        'new_item_name'              => __( 'Nueva etiqueta', 'supergiros' ),
        'add_new_item'               => __( 'Añadir nueva etiqueta', 'supergiros' ),
        'edit_item'                  => __( 'Editar etiqueta', 'supergiros' ),
        'update_item'                => __( 'Actualizar etiqueta', 'supergiros' ),
        'view_item'                  => __( 'Ver etiqueta', 'supergiros' ),
        'search_items'               => __( 'Buscar etiquetas', 'supergiros' ),
        'not_found'                  => __( 'No se han encontrado etiquetas', 'supergiros' ),
        'no_terms'                   => __( 'No hay etiquetas', 'supergiros' ),
        'items_list'                 => __( 'Lista de etiquetas', 'supergiros' ),
        'items_list_navigation'      => __( 'Navegación por la lista de etiquetas', 'supergiros' ),
    );
    $rewrite = array(
        'slug'                       => 'noticias',
    );
    $args = array(
        'public'                     => true,
        'labels'                     => $labels,
        'rewrite'					 => $rewrite,
        'show_in_rest'               => true,
        'show_in_nav_menus'          => false,
        'show_admin_column'          => false,
    );
    register_taxonomy('tag_news', array('news'), $args);
}
