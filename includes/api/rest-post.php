<?php
function supergiros_get_post(WP_REST_Request $request) {
    $term = $request->get_param('term');
    $tag = $request->get_param('tag');
    $order = $request->get_param('order');
    $orderby = $request->get_param('orderby');
    $paged = $request->get_param('paged');

    $args = array(
        'category_name'  => $term ? $term : '',
        'tag'            => $tag ? $tag : '',
        'order'          => $order ? $order : 'DESC',
        'orderby'        => $orderby ? $orderby : 'date',
        'posts_per_page' => 12,
        'post_status'    => 'publish',
        'paged'          => $paged ? $paged : 1,
    );

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
            'message' => 'No se han encontrado publicaciones',
        );
        return rest_ensure_response($response);
    }
}

function registrar_rest_post() {
    register_rest_route('post', '/posts/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_get_post',
        'permission_callback' => '__return_true',
    ));
}

add_action('rest_api_init', 'registrar_rest_post');
