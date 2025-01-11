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

// INCLUDES
include_once(plugin_dir_path(__FILE__).'includes/enqueues.php');
include_once(plugin_dir_path(__FILE__).'includes/helpers.php');
include_once(plugin_dir_path(__FILE__).'includes/functions.php');

// PORTFOLIO
include_once(plugin_dir_path(__FILE__).'admin/portfolio/post_type.php');
include_once(plugin_dir_path(__FILE__).'admin/portfolio/taxonomies.php');

// NEWS
include_once(plugin_dir_path(__FILE__).'admin/news/post_type.php');
include_once(plugin_dir_path(__FILE__).'admin/news/taxonomies.php');

// LOTTERIES
include_once(plugin_dir_path(__FILE__).'admin/lottery/menu.php');
include_once(plugin_dir_path(__FILE__).'admin/lottery/post_type.php');
include_once(plugin_dir_path(__FILE__).'admin/lottery/taxonomies.php');
include_once(plugin_dir_path(__FILE__).'admin/lottery/meta_boxes.php');

// DOCUMENTS
include_once(plugin_dir_path(__FILE__).'admin/documents/post_type.php');
include_once(plugin_dir_path(__FILE__).'admin/documents/taxonomies.php');
include_once(plugin_dir_path(__FILE__).'admin/documents/meta_boxes.php');
