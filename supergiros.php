<?php
/*
Plugin Name: SuperGIROS Norte del Valle
Description: Este es un plugin desarrollado especificamente para la intranet de SuperGIROS, las funcionalidades principales del plugin es la de crear los Post Types Noticias y Documentos, este ultimo con su respectivo Custom Field, también se crean rutas para consultar las entradas y consumirlas asincronicamente.
Version: 1.0
Author: John Freddy Rivera Ayala
Author URI: https://ejemplo.com
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: supergiros
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function cargar_media_uploader() {

    // Solo cargar los scripts en la página de edición del post
    if (get_current_screen()->base === 'post') {
        // Cargar los scripts de media uploader
        wp_enqueue_media();
    }

}
add_action('admin_enqueue_scripts', 'cargar_media_uploader');

// Post types
include_once( plugin_dir_path( __FILE__ ) . 'includes/post-types/portafolio.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/post-types/noticia.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/post-types/loteria.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/post-types/documento.php');

// Taxonomies
include_once( plugin_dir_path( __FILE__ ) . 'includes/taxonomies/categoria_portafolio.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/taxonomies/categoria_noticias.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/taxonomies/caregoria_documentos.php');

// Meta boxes
include_once( plugin_dir_path( __FILE__ ) . 'includes/meta-boxes/documento-meta.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/meta-boxes/loteria-meta.php');

// Rest api
include_once( plugin_dir_path( __FILE__ ) . 'includes/api/rest-portafolio.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/api/rest-noticia.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/api/rest-loteria.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/api/rest-documento.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/api/rest-sorteos.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/api/rest-post.php');

// Functions
include_once( plugin_dir_path( __FILE__ ) . 'includes/functions/funciones-portafolio.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/functions/funciones-noticias.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/functions/funciones-loterias.php');
include_once( plugin_dir_path( __FILE__ ) . 'includes/functions/funciones-documento.php');
