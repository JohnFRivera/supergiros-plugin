<?php
function supergiros_get_sorteos(WP_REST_Request $request) {
    $fecha = $request->get_param('fecha');

    $url = 'https://portal.supergirosnortedelvalle.com/api/resultados'; // URL de la API externa
    if ($fecha) {
        $url .= '?fecha=' . $fecha;
    }
    $response = wp_remote_get($url);

    if (is_wp_error($response)) {
        return new WP_Error('api_error', 'No se pudo obtener datos de la API externa', array('status' => 500));
    }

    $body = wp_remote_retrieve_body($response);

    return json_decode($body, true);
}

function registrar_rest_sorteos() {
    register_rest_route('sorteos', '/resultados/', array(
        'methods' => 'POST',
        'callback' => 'supergiros_get_sorteos',
        'permission_callback' => '__return_true', // Permite acceso sin autenticación
    ));
}

add_action('rest_api_init', 'registrar_rest_sorteos');
