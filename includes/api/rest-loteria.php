<?php
function supergiros_get_planes_de_premios(WP_REST_Request $request) {
    $order = $request->get_param('order');
    $orderby = $request->get_param('orderby');
    $paged = $request->get_param('paged');

    $args = array(
        'post_type'      => 'planes_de_premios',
        'order'          => $order ? $order : 'DESC',
        'orderby'        => $orderby ? $orderby : 'date',
        'posts_per_page' => 15,
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
            'message' => 'No se han encontrado loterías',
        );
        return rest_ensure_response($response);
    }
}
function supergiros_get_resultados_y_secos(WP_REST_Request $request) {
    $posts_per_page = $request->get_param('posts_per_page');
    $loteria = $request->get_param('loteria');
    $year = $request->get_param('year');
    $month = $request->get_param('month');
    $day = $request->get_param('day');
    $paged = $request->get_param('paged');

    $args = array(
        'post_type'      => 'resultados_y_secos',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page ? $posts_per_page : 15,
        'year'           => $year ? $year : '',
        'month'          => $month ? $month : '',
        'day'            => $day ? $day : '',
        'order'          => 'DESC',
        'orderby'        => 'date',
        'paged'          => $paged ? $paged : 1,
    );
    if ($loteria) {
        $args['meta_query'] = array(
            array(
                'key'     => '_loteria_id',
                'value'   => $loteria,
                'compare' => '=',
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
            $post_date = get_the_date('j \d\e F, Y');
            $loteria_id = get_post_meta( $post_id, '_loteria_id', true );
            $loteria_thumbnail_url = get_the_post_thumbnail_url( $loteria_id, 'full' );
            $loteria_title = get_post( $loteria_id )->post_title;

            $response['posts'][] = array(
                'id'            => $post_id,
                'url'           => $post_url,
                'thumbnail_url' => $loteria_thumbnail_url,
                'title'         => $loteria_title,
                'date'          => $post_date,
            );
        }
        wp_reset_postdata();
        return rest_ensure_response($response);
    } else {
        $response = array(
            'status'  => 200,
            'count'   => 0,
            'message' => 'No se han encontrado loterías',
        );
        return rest_ensure_response($response);
    }
}
function supergiros_get_resultados_filter(WP_REST_Request $request) {
    $loteria = $request->get_param('loteria');
    $year = $request->get_param('year');
    $month = $request->get_param('month');

    $args = array(
        'post_type'      => 'resultados_y_secos',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'order'          => 'DESC',
        'orderby'        => 'date',
        'year'           => $year ? $year : '',
        'month'          => $month ? $month : '',
        'fields'         => 'ids',
    );
    if ($loteria) {
        $args['meta_query'] = array(
            array(
                'key'     => '_loteria_id',
                'value'   => $loteria,
                'compare' => '=',
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $arr_response = array();
        while ($query->have_posts()) {
            $query->the_post();
            if (!$year) {
                $post_year = get_the_date('Y');
                if (!in_array($post_year, $arr_response)) {
                    $arr_response[] = $post_year;
                }
            } else {
                if (!$month) {
                    $post_month = array(
                        'text' => get_the_date('F'),
                        'value' => get_the_date('m'),
                    );
                    if (!in_array($post_month, $arr_response)) {
                        $arr_response[] = $post_month;
                    }
                }
            }
            if ($month) {
                $post_day = get_the_date('j');
                if (!in_array($post_day, $arr_response)) {
                    $arr_response[] = $post_day;
                }
            }
        }
        $response = array(
            'status' => 200,
            'array'  => $arr_response,
        );
        wp_reset_postdata();
        return rest_ensure_response($response);
    } else {
        $response = array(
            'status' => 400,
            'message' => 'Se desvió la consulta',
        );
        return rest_ensure_response($response);
    }
}

function registrar_rest_loterias() {
    register_rest_route('loterias/planes-de-premios', '/posts/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_get_planes_de_premios',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('loterias/resultados-y-secos', '/posts/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_get_resultados_y_secos',
        'permission_callback' => '__return_true',
    ));
    register_rest_route('loterias/resultados-y-secos', '/filter/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_get_resultados_filter',
        'permission_callback' => '__return_true',
    ));
}

add_action('rest_api_init', 'registrar_rest_loterias');
