<?php
function agregar_menu_loterias() {

    add_menu_page(
        'Loterías',             // Título de la página
        'Loterías',             // Nombre del menú
        'manage_options',       // Capacidad de acceso
        'loterias_menu',        // Slug del menú
        '',                     // Función de contenido (no se necesita porque es solo un contenedor)
        'dashicons-calendar-alt', // Icono
        6,                      // Posición en el menú
    );

}

add_action( 'admin_menu', 'agregar_menu_loterias' );
