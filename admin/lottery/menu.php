<?php
add_action('admin_menu', 'add_menu_lottery');

function add_menu_lottery(){
    add_menu_page(
        'Loterías',                                             // Titulo de la página
        'Loterías',                                             // Titulo del menú
        'manage_options',                                       // Capability
        'menu_lotteries',                                       // Slug
        null,                                                   // Callback
        'dashicons-tickets-alt',                                // Icono
        '7',                                                    // Posición en dashboard
    );
    add_submenu_page(
        'menu_lotteries',                                       // Slug padre
        'Loterías',                                             // Titulo de la página
        'Loterías',                                             // Titulo del menú
        'manage_options',                                       // Capability
        'edit-tags.php?taxonomy=category_lottery&post_type=lottery_prizes',// Slug
        null,                                                   // Callback
        '0',
    );
};
