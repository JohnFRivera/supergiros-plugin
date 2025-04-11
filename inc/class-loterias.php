<?php
require_once plugin_dir_path( __FILE__ ) . 'class-functions.php';

class Intranet_Loterias {
	/**
	 * Clase con las funciones principales
	 * @var Intranet_Functions
	 */
	private $functions;
	/**
	 * Slugs para los tipos de contenidos y la taxonomia
	 * @var string
	 */
	private $resultados_slug;
	private $planes_slug;
	private $taxonomy;

	public function __construct() {
		$this->functions 		= new Intranet_Functions();
		$this->resultados_slug 	= 'resultados-y-secos';
		$this->planes_slug 		= 'planes-de-premios';
		$this->taxonomy 		= 'loterias';
	}

	// Registrar tipos de contenido de noticias
	public function post_type() {
		// Resultados y secos
		$this->functions->register_post_type($this->resultados_slug, array(
			'gender' 		=> 'male',
			'plural_name' 	=> 'resultados y secos',
			'singular_name' => 'resultado y seco',
			'featured_name' => 'imagen',
			'rewrite_slug' 	=> "{$this->taxonomy}/{$this->resultados_slug}",
			'supports' 		=> array('title', 'editor', 'author'),
			'description' 	=> 'Este tipo de contenido es para almacenar los resultados y secos de las loterías',
			'menu_icon' 	=> 'dashicons-tickets-alt',
			'menu_position' => 7,
			'has_archive' 	=> "{$this->taxonomy}/{$this->resultados_slug}",
			'show_in_menu' 	=> 'menu-loterias',
		));
		// Planes de premios
		$this->functions->register_post_type($this->planes_slug, array(
			'gender' 		=> 'male',
			'plural_name' 	=> 'planes de premios',
			'singular_name' => 'plan de premio',
			'featured_name' => 'imagen',
			'rewrite_slug' 	=> "{$this->taxonomy}/{$this->planes_slug}",
			'supports' 		=> array('title', 'editor', 'author'),
			'description' 	=> 'Este tipo de contenido es para almacenar los planes de premios de las loterías',
			'menu_icon' 	=> 'dashicons-tickets-alt',
			'menu_position' => 7,
			'has_archive' 	=> "{$this->taxonomy}/{$this->planes_slug}",
			'show_in_menu' 	=> 'menu-loterias',
		));
	}

	// Registrar las taxonomias para los tipos de contenidos de noticias
	public function taxonomy() {
		$this->functions->register_taxonomy($this->taxonomy, array($this->resultados_slug, $this->planes_slug), array(
			'gender' 			=> 'female',
			'plural_name' 		=> 'loterias',
			'singular_name' 	=> 'loteria',
			'rewrite_slug' 		=> $this->taxonomy,
			'hierarchical' 		=> true,
			'show_in_nav_menus' => false,
		));
	}

	// Añadir filtro a la tabla de publicaciónes de cada tipo de contenido
	public function restrict_manage_posts() {
		// Resultados y secos
		$this->functions->restrict_manage_posts(array(
			'post_type' => $this->resultados_slug,
			'taxonomy' 	=> $this->taxonomy,
		));
		// Planes de premios
		$this->functions->restrict_manage_posts(array(
			'post_type' => $this->planes_slug,
			'taxonomy' 	=> $this->taxonomy,
		));
	}

	/**
	 * Añadir consulta a los filtros agregados anteriormente
	 * @return array<string>|false
	 */
	public function pre_get_posts() {
		// Resultados y secos
		$resultados_query = $this->functions->pre_get_posts(array(
			'post_type' => $this->resultados_slug,
			'taxonomy' 	=> $this->taxonomy,
		));
		// Planes de premios
		$planes_query = $this->functions->pre_get_posts(array(
			'post_type' => $this->planes_slug,
			'taxonomy' 	=> $this->taxonomy,
		));
		$tax_query = $resultados_query ? $resultados_query : $planes_query;
		return $tax_query;
	}

	// Encolar scripts de loterías al wp-admin
	public function admin_enqueue_scripts() {
		global $pagenow;
		global $taxonomy;

		if( $taxonomy === 'loterias' ) {
			if( $pagenow === 'term.php' || $pagenow === 'edit-tags.php' ) {
				wp_enqueue_media();
				wp_enqueue_script( 'intranet-loterias', plugins_url('js/loterias.js', __DIR__), array('jquery'), null, true );
			}
		}
	}

	// Añadir botónes y sub-botónes de loterías al menú del admin
	public function admin_menu() {
		add_menu_page( 'Loterías', 'Loterías', 'manage_options', 'menu-loterias', '', 'dashicons-tickets-alt', 5 );
		add_submenu_page( 'menu-loterias', 'Loterías', 'Loterías', 'manage_options', 'edit-tags.php?taxonomy=loterias&post_type=planes-de-premios', '', 0 );
	}

	/**
	 * Agregar campos a la lista de terminos de una taxonomía
	 * @param string $taxonomy
	 */
	public function taxonomy_add_form_fields( $taxonomy ) {
		?>
		<div class="form-field term-group">
			<label for="_loteria_logotipo">Logotipo</label>
			<input type="hidden" id="ipLogoUrl" name="_loteria_logotipo" value="" />
			<input type="button" class="button" value="Establecer logo" id="btnUploadLogo" />
			<p>El logotipo es la imagen que aparecerá en todos los post relacionados con la lotería</p>
		</div>
		<?php
	}

	/**
	 * Agregar campos a la página de edición de terminos de una taxonomía
	 * @param WP_Term $term
	 * @param string $taxonomy
	 */
	public function taxonomy_edit_form_fields( $term, $taxonomy ) {
		$logo_url = get_term_meta($term->term_id, '_loteria_logotipo', true);
		?>
		<tr class="form-field term-group">
			<th scope="row">
				<label for="_loteria_logotipo">Logotipo</label>
			</th>
			<td>
				<input type="hidden" id="ipLogoUrl" name="_loteria_logotipo" value="<?php echo esc_url($logo_url); ?>" data-filename="<?php echo 'Logotipo de '. $term->name; ?>" />
				<input type="button" class="button" value="Establecer logo" id="btnUploadLogo" />
			</td>
		</tr>
		<?php
	}

	/**
	 * Guardar o actualizar meta-datos al crear o editar un termino de una taxonomía
	 * @param int $term_id
	 * @param int $tt_id
	 */
	public function create_and_edited_taxonomy( $term_id, $tt_id ) {
		$meta_key = '_loteria_logotipo';
		if( isset( $_POST[$meta_key] ) ) {
			$logotipo_url = sanitize_text_field($_POST[$meta_key]);
			update_term_meta($term_id, $meta_key, $logotipo_url);
		}
	}

}
