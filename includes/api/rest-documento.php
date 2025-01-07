<?php
function supergiros_get_documentos(WP_REST_Request $request) {
    $term = $request->get_param('term');
    $order = $request->get_param('order');
    $orderby = $request->get_param('orderby');
    $search = $request->get_param('search');
    $paged = $request->get_param('paged');

    $args = array(
        'post_type'      => 'documentos',
        's'              => $search ? $search : '',
        'order'          => $order ? $order : 'DESC',
        'orderby'        => $orderby ? $orderby : 'date',
        'posts_per_page' => 12,
        'post_status'    => 'publish',
        'paged'          => $paged ? $paged : 1,
    );
    if ($term) {
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'categoria_documentos',
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
            $post_pdf_url = get_post_meta( $post_id, '_documento_pdf', true );

            $response['posts'][] = array(
                'id'            => $post_id,
                'url'           => $post_url,
                'thumbnail_url' => $post_thumbnail_url,
                'title'         => $post_title,
                'date'          => $post_date,
                'pdf_url'       => $post_pdf_url,
            );
        }
        wp_reset_postdata();
        return rest_ensure_response($response);
    } else {
        $response = array(
            'status'  => 200,
            'count'   => 0,
            'message' => 'No se han encontrado documentos',
        );
        return rest_ensure_response($response);
    }
}

function registrar_rest_documentos() {
    register_rest_route('documentos', '/posts/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_get_documentos',
        'permission_callback' => '__return_true',
    ));
}

add_action('rest_api_init', 'registrar_rest_documentos');
