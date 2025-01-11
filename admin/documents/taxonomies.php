<?php
add_action('init', 'register_taxonomies_documents');

function register_taxonomies_documents(){
    add_category_documents();
}

function add_category_documents(){
    $labels = array(
        'name'                       => _x( 'Clasificación de documentos', 'Taxonomy General Name', 'supergiros' ),
        'singular_name'              => _x( 'Clasificación del documento', 'Taxonomy Singular Name', 'supergiros' ),
        'menu_name'                  => __( 'Clasificaciones', 'supergiros' ),
        'all_items'                  => __( 'Todas las clasificaciones', 'supergiros' ),
        'parent_item'                => __( 'Clasificación superior', 'supergiros' ),
        'parent_item_colon'          => __( 'Clasificación superior:', 'supergiros' ),
        'new_item_name'              => __( 'Nueva clasificación', 'supergiros' ),
        'add_new_item'               => __( 'Añadir nueva clasificación', 'supergiros' ),
        'edit_item'                  => __( 'Editar clasificación', 'supergiros' ),
        'update_item'                => __( 'Actualizar clasificación', 'supergiros' ),
        'view_item'                  => __( 'Ver clasificación', 'supergiros' ),
        'search_items'               => __( 'Buscar clasificaciones', 'supergiros' ),
        'not_found'                  => __( 'No se han encontrado clasificaciones', 'supergiros' ),
        'no_terms'                   => __( 'No hay clasificaciones', 'supergiros' ),
        'items_list'                 => __( 'Lista de clasificaciones', 'supergiros' ),
        'items_list_navigation'      => __( 'Navegación por la lista de clasificaciones', 'supergiros' ),
    );
    $rewrite = array(
        'slug'                       => 'documentos',
    );
    $args = array(
        'public'                     => true,
        'labels'                     => $labels,
        'rewrite'					 => $rewrite,
        'hierarchical'               => true,
        'show_in_rest'               => true,
        'show_admin_column'          => true,
    );
    register_taxonomy('category_documents', array('documents'), $args);
}
