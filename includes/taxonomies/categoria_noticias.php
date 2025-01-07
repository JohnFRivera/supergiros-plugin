<?php
function registrar_categoria_noticias() {

    $labels = array(
        'name'                       => _x( 'Categorías de las Noticias', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Categoría de la Noticia', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Categorías', 'text_domain' ),
        'all_items'                  => __( 'Todas las categorías', 'text_domain' ),
        'parent_item'                => __( 'Categoría superior', 'text_domain' ),
        'parent_item_colon'          => __( 'Categoría superior:', 'text_domain' ),
        'new_item_name'              => __( 'Nueva categoría', 'text_domain' ),
        'add_new_item'               => __( 'Añadir nueva categoría', 'text_domain' ),
        'edit_item'                  => __( 'Editar categoría', 'text_domain' ),
        'update_item'                => __( 'Actualizar categoría', 'text_domain' ),
        'view_item'                  => __( 'Ver categoría', 'text_domain' ),
        'search_items'               => __( 'Buscar categorías', 'text_domain' ),
        'not_found'                  => __( 'No se han encontrado categorías', 'text_domain' ),
        'no_terms'                   => __( 'No hay categorías', 'text_domain' ),
        'items_list'                 => __( 'Lista de categorías', 'text_domain' ),
        'items_list_navigation'      => __( 'Navegación por la lista de categorías', 'text_domain' ),
    );

    $rewrite = array(
        'slug'                       => 'noticias',
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'rewrite'					 => $rewrite,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
    );

    register_taxonomy( 'categoria_noticias', array( 'noticias' ), $args );

}

add_action( 'init', 'registrar_categoria_noticias', 0 );
