<?php
function supergiros_get_noticias(WP_REST_Request $request) {
    $posts_per_page = $request->get_param('posts_per_page');
    $order = $request->get_param('order');
    $orderby = $request->get_param('orderby');
    $search = $request->get_param('search');
    $paged = $request->get_param('paged');
    $term = $request->get_param('term');

    $args = array(
        'post_type'      => 'noticias',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page ? $posts_per_page : 12,
        's'              => $search ? $search : '',
        'order'          => $order ? $order : 'DESC',
        'orderby'        => $orderby ? $orderby : 'date',
        'paged'          => $paged ? $paged : 1,
    );
    if ($term) {
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'categoria_noticias',
                'terms'     => $term,
                'field'     => 'slug',
                'operators' => 'IN',
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $response = array(
            'status' => 200,
            'count'  => $query->found_posts,
            'posts'  => array(),
        );
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $post_url = get_the_permalink();
            $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
            $post_title = get_the_title();
            $post_date = get_the_date('j \d\e F, Y');

            $response['posts'][] = array(
                'id'            => $post_id,
                'url'           => $post_url,
                'thumbnail_url' => $post_thumbnail_url,
                'title'         => $post_title,
                'date'          => $post_date,
            );
        }
        wp_reset_postdata();
        return rest_ensure_response($response);
    } else {
        $response = array(
            'status'  => 200,
            'count'   => 0,
            'message' => 'No se han encontrado noticias',
        );
        return rest_ensure_response($response);
    }
}
function supergiros_get_ultima_noticias(WP_REST_Request $request) {
    $args = array(
        'post_type'      => 'noticias',
        'post_status'    => 'publish',
        'posts_per_page' => 2,
        'order'          => 'DESC',
        'orderby'        => 'date',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $response = array(
            'status' => 200,
            'posts'  => array(),
        );
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $post_url = get_the_permalink();
            $post_thumbnail_url = get_the_post_thumbnail_url( $post_id, 'full' );
            $post_title = get_the_title();
            $post_date = get_the_date('j \d\e F, Y');

            $response['posts'][] = array(
                'id'            => $post_id,
                'url'           => $post_url,
                'thumbnail_url' => $post_thumbnail_url,
                'title'         => $post_title,
                'date'          => $post_date,
            );
        }
        wp_reset_postdata();
        return rest_ensure_response($response);
    } else {
        $response = array(
            'status'  => 200,
            'message' => 'No se han encontrado noticias',
        );
        return rest_ensure_response($response);
    }
}

function registrar_rest_noticias() {
    register_rest_route('noticias', '/posts/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_get_noticias',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('noticias', '/last/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_get_ultima_noticias',
        'permission_callback' => '__return_true',
    ));
}

add_action('rest_api_init', 'registrar_rest_noticias');
