<?php
function agregar_filtros_documentos() {

    global $typenow;

    if ($typenow === 'documentos') {
        $terms = get_terms('categoria_documentos');
    
        if (!empty($terms) && !is_wp_error($terms)) {
            ?>
            <select class="postform" name="filter-by-category" id="filter-by-category">
                <option value="">Todas las categorías</option>
                <?php
                foreach ($terms as $term) {
                    $selected = isset($_GET['filter-by-category']) && $_GET['filter-by-category'] == $term->term_id ? ' selected="selected"' : '';
                    ?>
                    <option value="<?php echo $term->term_id ?>" <?php echo $selected ?>>
                        <?php echo $term->name ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <?php
        }
    }

}

function filtrar_documentos($query) {

    global $typenow;
    global $pagenow;

    if ($typenow === 'documentos') {
        // Solo aplicar el filtro cuando estamos en la pantalla de edición de los post types
        if ($pagenow == 'edit.php' && isset($_GET['filter-by-category']) && !empty($_GET['filter-by-category'])) {
            $query->query_vars['tax_query'] = array(
                array(
                    'taxonomy' => 'categoria_documentos',
                    'field'    => 'id',
                    'terms'    => $_GET['filter-by-category'],
                    'operator' => 'IN',
                ),
            );
        }
    }

}

function modificar_url_documentos($url, $post) {

    if ($post->post_type === 'documentos') {
        // Obtener el término de la taxonomía asociada
        $terms = wp_get_post_terms($post->ID, 'categoria_documentos');
        if ($terms) {
            // Reemplazar el marcador de posición en la URL por el término
            $url = str_replace('%categoria_documentos%', $terms[0]->slug, $url);
        }
    }
    return $url;

}

add_action('restrict_manage_posts', 'agregar_filtros_documentos');
add_action('pre_get_posts', 'filtrar_documentos');
add_filter('post_type_link', 'modificar_url_documentos', 10, 2);
