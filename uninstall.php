<?php
if ( ! defined( 'WP_UNINSTALL_PLUGGIN' ) ) {
    exit;
}

$post_types = array('portafolio', 'noticias', 'resultados-y-secos', 'planes-de-premios', 'documentos');
foreach( $post_types as $post_type ) {
	$posts = get_posts(array(
		'post_type' 	=> $post_type,
		'numberposts' 	=> -1,
		'post_status' 	=> 'any',
	));
	foreach( $posts as $post ) {
		wp_delete_post($post->ID, true); // Los post se borrarán permanentemente
	}
}
