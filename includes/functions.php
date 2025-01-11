<?php
add_action('restrict_manage_posts', 'add_manage_posts');
add_action('pre_get_posts', 'pre_get_posts_per_category');
add_filter('post_type_link', 'modify_post_type_links', 10, 2);
add_filter('intermediate_image_sizes_advanced', 'remove_image_sizes');

// Habilitar filtrado por categoría a los post types
function add_manage_posts(){
    global $typenow;
    // Solo entrar si estoy en los post types
    if ($typenow === 'news' || $typenow === 'portfolio' || $typenow === 'documents') {
        $terms = get_terms('category_'.$typenow);
        $label_all_items = get_taxonomy('category_'.$typenow)->labels->all_items;
        // Verificar que no esté vacío o haya errores
        if (!empty($terms) && !is_wp_error($terms)) {
            echo '<select class="postform" name="filter-by-category" id="filter-by-category">';
            echo "<option value=''>$label_all_items</option>";
            foreach ($terms as $term) {
                $selected = isset($_GET['filter-by-category']) && $_GET['filter-by-category'] == $term->term_id ? 'selected="selected"' : '';
                echo "<option $selected value='$term->term_id'>$term->name</option>";
            }
            echo '</select>';
        }
    }
}
function pre_get_posts_per_category($query) {
    global $typenow;
    global $pagenow;
    if($typenow === 'news' || $typenow === 'portfolio' || $typenow === 'documents'){
        // Solo aplicar el filtro cuando estamos en la pantalla de edición de los post types
        if ($pagenow == 'edit.php' && isset($_GET['filter-by-category']) && !empty($_GET['filter-by-category'])) {
            $query->query_vars['tax_query'] = array(
                array(
                    'taxonomy' => 'category_'.$typenow,
                    'field'    => 'id',
                    'terms'    => $_GET['filter-by-category'],
                    'operator' => 'IN',
                ),
            );
        }
    }
}
function modify_post_type_links($url, $post) {
    $post_type = $post->post_type;
    if($post_type === 'news' || $post_type === 'portfolio' || $post_type === 'documents'){
        // Obtener el término de la taxonomía asociada
        $terms = wp_get_post_terms($post->ID, 'category_'.$post_type);
        if($terms){
            // Reemplazar el marcador de posición en la URL por el término
            $url = str_replace('%taxonomy_'.$post_type.'%', $terms[0]->slug, $url);
        }
    }
    return $url;
}
function remove_image_sizes($sizes) {
    // Elimina todos los tamaños de imagen adicionales generados por WordPress
    return array();
}
