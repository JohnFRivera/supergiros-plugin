<?php
require_once plugin_dir_path( __FILE__ ) . 'class-functions.php';

class Intranet_Portafolio {
	/**
	 * Clase con las funciones principales
	 * @var Intranet_Functions
	 */
	private $functions;
	/**
	 * Slugs para el tipo de contenido y las taxonomias
	 * @var string
	 */
	private $post_type_slug;
	private $category_slug;
	private $tag_slug;
	
	public function __construct() {
		$this->functions 		= new Intranet_Functions();
		$this->post_type_slug 	= 'portafolio';
		$this->category_slug 	= 'categorias_portafolio';
		$this->tag_slug 		= 'etiquetas_portafolio';
	}

	// Registrar tipos de contenido de noticias
	public function post_type() {
		$this->functions->register_post_type($this->post_type_slug, array(
			'gender' 		=> 'male',
			'plural_name' 	=> 'portafolios',
			'singular_name' => 'portafolio',
			'featured_name' => 'logotipo',
			'rewrite_slug' 	=> "{$this->post_type_slug}/%{$this->category_slug}%",
			'supports' 		=> array('title', 'editor', 'thumbnail', 'author'),
			'description' 	=> 'Este tipo de contenido es para almacenar el portafolio',
			'menu_icon' 	=> 'dashicons-portfolio',
			'menu_position' => 5,
			'has_archive' 	=> $this->post_type_slug,
			'show_in_menu' 	=> true,
		));
	}

	// Registrar las taxonomias para los tipos de contenidos de noticias
	public function taxonomy() {
		$this->functions->register_taxonomy($this->category_slug, array($this->post_type_slug), array(
			'gender' 			=> 'female',
			'plural_name' 		=> 'categorias',
			'singular_name' 	=> 'categoria',
			'rewrite_slug' 		=> $this->post_type_slug,
			'hierarchical' 		=> true,
			'show_in_nav_menus' => true,
		));
		$this->functions->register_taxonomy($this->tag_slug, array($this->post_type_slug), array(
			'gender' 			=> 'female',
			'plural_name' 		=> 'etiquetas',
			'singular_name' 	=> 'etiqueta',
			'rewrite_slug' 		=> '',
			'hierarchical' 		=> false,
			'show_in_nav_menus' => false,
		));
	}

	// Añadir filtro a la tabla de publicaciónes de cada tipo de contenido
	public function restrict_manage_posts() {
		$this->functions->restrict_manage_posts(array(
			'post_type' => $this->post_type_slug,
			'taxonomy' 	=> $this->category_slug,
		));
	}

	/**
	 * Añadir consulta a los filtros agregados anteriormente
	 * @return array<string>|false
	 */
	public function pre_get_posts() {
		$tax_query = $this->functions->pre_get_posts(array(
			'post_type' => $this->post_type_slug,
			'taxonomy' 	=> $this->category_slug,
		));
		return $tax_query;
	}

	/**
	 * Modificar enlaces de los tipos de contenido
	 * @param string $url
	 * @param string $post_type
	 * @param int $post_id
	 * @return string|false
	 */
	public function post_type_link( $url, $post_type, $post_id ) {
		$url = $this->functions->post_type_link($url, $post_type, $post_id, array(
			'post_type' => $this->post_type_slug,
			'taxonomy' 	=> $this->category_slug,
		));
		return $url;
	}

}
