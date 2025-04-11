<?php
/**
 * Plugin Name: Intranet SuperGIROS Norte del Valle
 * Description: Plugin para la gestión de contenidos personalizados en la intranet de SuperGIROS. Permite crear y gestionar post types para Loterías, Noticias, Documentos y el Portafolio de Productos y Servicios, facilitando la organización y distribución de información interna.
 * Version: 	1.0.0
 * Author: 		John Freddy Rivera
 * Author URI: 	https://www.linkedin.com/in/john-freddy-rivera-ayala/
 * License: 	GPL2
 * Text Domain: intranet-supergiros
 */

if( !defined('ABSPATH') ) {
	exit;
}

// Importar modulos principales
require_once plugin_dir_path( __FILE__ ) . 'inc/class-portafolio.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/class-noticias.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/class-loterias.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/class-documentos.php';

class Intranet_SuperGIROS {
	// Clases principales
	public $portafolio;
	public $noticias;
	public $loterias;
	public $documentos;

	public function __construct() {
		$this->portafolio 	= new Intranet_Portafolio();
		$this->noticias 	= new Intranet_Noticias();
		$this->loterias 	= new Intranet_Loterias();
		$this->documentos 	= new Intranet_Documentos();
		$this->add_hooks();
	}

	// Hooks utilizados en el plugin
	private function add_hooks() {
		add_action( 'init', 					array($this, 'init') );
		add_action( 'admin_enqueue_scripts', 	array($this, 'admin_enqueue_scripts') );
		add_action( 'admin_menu', 				array($this, 'admin_menu') );
		add_action( 'restrict_manage_posts', 	array($this, 'restrict_manage_posts') );
		add_action( 'pre_get_posts', 			array($this, 'pre_get_posts') );
		add_filter( 'post_type_link', 			array($this, 'post_type_link'), 10, 2 );
		// Loterías
		add_action( 'loterias_add_form_fields', 	array($this->loterias, 'taxonomy_add_form_fields') );
		add_action( 'loterias_edit_form_fields', 	array($this->loterias, 'taxonomy_edit_form_fields'), 10, 2 );
		add_action( 'create_loterias', 				array($this->loterias, 'create_and_edited_taxonomy'), 10, 2 );
		add_action( 'edited_loterias', 				array($this->loterias, 'create_and_edited_taxonomy'), 10, 2 );
	}

	// Al terminar de cargar WordPress
	public function init() {
		// Post types
		$this->portafolio->post_type();
		$this->noticias->post_type();
		$this->loterias->post_type();
		$this->documentos->post_type();
		// Taxonomies
		$this->portafolio->taxonomy();
		$this->noticias->taxonomy();
		$this->loterias->taxonomy();
		$this->documentos->taxonomy();
	}

	// Encolar scripts al wp-admin
	public function admin_enqueue_scripts() {
		$this->loterias->admin_enqueue_scripts();
	}

	// Añadir botónes al menú del admin
	public function admin_menu() {
		$this->loterias->admin_menu();
	}

	// Añadir filtro a la tabla de publicaciónes de cada tipo de contenido
	public function restrict_manage_posts() {
		$this->portafolio->restrict_manage_posts();
		$this->noticias->restrict_manage_posts();
		$this->loterias->restrict_manage_posts();
		$this->documentos->restrict_manage_posts();
	}

	/**
	 * Añadir consulta a los filtros agregados anteriormente
	 * @param WP_Query $query
	 */
	public function pre_get_posts( $query ) {
		$pre_get_portafolio = $this->portafolio->pre_get_posts();
		$pre_get_noticias 	= $this->noticias->pre_get_posts();
		$pre_get_loterias 	= $this->loterias->pre_get_posts();
		$pre_get_documentos = $this->documentos->pre_get_posts();
		$tax_query = $pre_get_portafolio ?: ($pre_get_noticias ?: ($pre_get_loterias ?: $pre_get_documentos));
		if( $tax_query ) $query->query_vars['tax_query'] = $tax_query;
	}

	/**
	 * Modificar enlaces de los tipos de contenido
	 * @param string $url
	 * @param WP_Post $post
	 * @return string
	 */
	public function post_type_link( $url, $post ) {
		$portafolio_link 	= $this->portafolio->post_type_link($url, $post->post_type, $post->ID);
		$noticias_link 		= $this->noticias->post_type_link($url, $post->post_type, $post->ID);
		$documentos_link 	= $this->documentos->post_type_link($url, $post->post_type, $post->ID);
		$url = $portafolio_link ?: ($noticias_link ?: ($documentos_link ?: $url));
		return $url;
	}

	public function activate() {
		flush_rewrite_rules();
	}

	public function deactivate() {
		flush_rewrite_rules();
	}

}

if( class_exists('Intranet_SuperGIROS') ) {
    $Intranet_SuperGIROS = new Intranet_SuperGIROS();
}

register_activation_hook( __FILE__, array( $Intranet_SuperGIROS, 'activate' ) );
register_deactivation_hook( __FILE__, array( $Intranet_SuperGIROS, 'deactivate' ) );
