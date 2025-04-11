<?php
class Intranet_Functions {
	/**
	 * Nombre de dominio del plugin
	 * @var string
	 */
	private $domain;
	/**
	 * Alternativas de etiquetas por genero
	 * @var array<array<string>>
	 */
	private $labels;

	public function __construct() {
		$this->domain = 'intranet-supergiros';
		$this->labels = array(
			'male' 		=> array('Todos los', 'nuevo', 'del', 'los'),
			'female' 	=> array('Todas las', 'nueva', 'de la', 'las'),
		);
	}

	/**
	 * Registrar los tipos de contenido
	 * @param string $post_type
	 * @param array<any> $args
	 */
	public function register_post_type( $post_type, $args ) {
		$all = $this->labels[$args['gender']][0];
		$new = $this->labels[$args['gender']][1];
		register_post_type($post_type, array(
			'labels' 				=> array(
				'name'                  => _x(ucfirst($args['plural_name']), 'Post Type General Name', 		$this->domain),
				'singular_name'         => _x(ucfirst($args['singular_name']), 'Post Type Singular Name', 	$this->domain),
				'menu_name'             => __(ucfirst($args['plural_name']), 								$this->domain),
				'name_admin_bar'        => __(ucfirst($args['plural_name']), 								$this->domain),
				'all_items'             => __("{$all} {$args['plural_name']}", 								$this->domain),
				'add_new_item'          => __("Añadir {$new} {$args['singular_name']}", 					$this->domain),
				'add_new'               => __("Añadir {$new}", 												$this->domain),
				'new_item'              => __(ucfirst($new) ." {$args['singular_name']}",					$this->domain),
				'edit_item'             => __("Editar {$args['singular_name']}", 							$this->domain),
				'update_item'           => __("Actualizar {$args['singular_name']}", 						$this->domain),
				'view_item'             => __("Ver {$args['singular_name']}", 								$this->domain),
				'view_items'            => __("Ver {$args['plural_name']}", 								$this->domain),
				'search_items'          => __("Buscar {$args['plural_name']}", 								$this->domain),
				'not_found'             => __("No se encontraron {$args['plural_name']}", 					$this->domain),
				'not_found_in_trash'    => __("No se encontraron {$args['plural_name']} en la papelera",	$this->domain),
				'featured_image'        => __($args['featured_name'], 										$this->domain),
				'set_featured_image'    => __("Establecer {$args['featured_name']}", 						$this->domain),
				'remove_featured_image' => __("Eliminar {$args['featured_name']}", 							$this->domain),
				'use_featured_image'    => __("Usar como {$args['featured_name']}", 						$this->domain),
			),
			'rewrite'				=> array(
				'slug' 					=> $args['rewrite_slug'],
				'with_front' 			=> false
			),
			'supports' 				=> $args['supports'],
			'description' 			=> __($args['description'], $this->domain),
			'has_archive' 			=> $args['has_archive'],
			'menu_icon' 			=> $args['menu_icon'],
			'menu_position' 		=> $args['menu_position'],
			'public' 				=> true,
			'show_in_menu' 			=> $args['show_in_menu'],
			'show_in_rest'			=> true,
			'show_in_nav_menus' 	=> false,
			'exclude_from_search' 	=> false,
		));
	}

	/**
	 * Registrar las taxonomias
	 * @param string $taxonomy
	 * @param array<string> $object_type
	 * @param array<any> $args
	 */
	public function register_taxonomy( $taxonomy, $object_type, $args ) {
		$all = $this->labels[$args['gender']][0];
		$new = $this->labels[$args['gender']][1];
		$the = $this->labels[$args['gender']][2];
		$from = $this->labels[$args['gender']][3];
		register_taxonomy($taxonomy, $object_type, array(
			'labels' 			=> array(
				'name'              			=> _x(ucfirst($args['plural_name']) ." de {$args['plural_post']}", 'Taxonomy General Name', 	$this->domain),
				'singular_name'     			=> _x(ucfirst($args['singular_name']) ." de {$args['singular_post']}", 'Taxonomy Singular Name',$this->domain),
				'menu_name'         			=> __(ucfirst($args['plural_name']), 															$this->domain),
				'all_items'         			=> __("{$all} {$args['plural_name']}", 															$this->domain),
				'parent_item' 					=> __(ucfirst($args['singular_name']) .' padre', 												$this->domain),
				'parent_item_colon' 			=> __(ucfirst($args['singular_name']) .' padre:', 												$this->domain),
				'new_item_name'     			=> __("Nuevo nombre {$the} {$args['singular_name']}", 											$this->domain),
				'add_new_item'      			=> __("Añadir {$new} {$args['singular_name']}", 												$this->domain),
				'edit_item'         			=> __("Editar {$args['singular_name']}", 														$this->domain),
				'update_item'       			=> __("Actualizar {$args['singular_name']}", 													$this->domain),
				'view_item'         			=> __("Ver {$args['singular_name']}", 															$this->domain),
				'separate_items_with_commas' 	=> __("Separa {$args['plural_name']} con comas", 												$this->domain),
				'add_or_remove_items'        	=> __("Añadir o eliminar {$args['plural_name']}", 												$this->domain),
				'choose_from_most_used'      	=> __("Elija entre {$from} más usados", 														$this->domain),
				'popular_items'              	=> __(ucfirst($args['plural_name']) ." populares", 												$this->domain),
				'search_items'      			=> __("Buscar {$args['plural_name']}", 															$this->domain),
				'not_found'         			=> __("No se encontraron {$args['plural_name']}", 												$this->domain),
				'no_terms'          			=> __("No hay {$args['plural_name']}", 															$this->domain),
				'items_list'        			=> __("Lista de {$args['plural_name']}", 														$this->domain),
			),
			'rewrite' 			=> array(
				'slug' 				=> $args['rewrite_slug'],
				'with_front' 		=> false,
			),
			'hierarchical' 		=> $args['hierarchical'],
			'public' 			=> true,
			'show_in_rest' 		=> true,
			'show_admin_column' => true,
			'show_in_nav_menus' => $args['show_in_nav_menus'],
		));
	}

	/**
	 * Añadir filtro a la tabla de publicaciónes de cada tipo de contenido
	 * @param array<string> $args
	 */
	public function restrict_manage_posts( $args ) {
		global $pagenow;
		global $typenow;

		if( $typenow === $args['post_type'] && $pagenow === 'edit.php' ) {
			$taxonomy 	= get_taxonomy($args['taxonomy']);
			$terms 		= get_terms($args['taxonomy']);

			if( !is_wp_error($terms) && !empty($terms) ) {
				?>
				<select class="postform" name="filter-by-category" id="filter-by-category">
					<?php
					echo '<option value="">'. $taxonomy->labels->all_items .'</option>';
					foreach( $terms as $term ) {
						$selected = isset($_GET['filter-by-category']) && $_GET['filter-by-category'] == $term->term_id ? ' selected="selected"' : '';

						echo '<option value="' . $term->term_id . '" ' . $selected . '>';
						echo $term->name;
						echo '</option>';
					}
					?>
				</select>
				<?php
			}
		}
	}

	/**
	 * Añadir consulta a los filtros agregados anteriormente
	 * @param array<string> $args
	 * @return array<string>|false
	 */
	public function pre_get_posts( $args ) {
		global $pagenow;
		global $typenow;

		if( $typenow === $args['post_type'] && $pagenow === 'edit.php' ) {
			$tax_query = array(
				'relation'  => 'OR',
			);
			$filter_by_category = 'filter-by-category';
			if( isset($_GET[$filter_by_category]) && !empty($_GET[$filter_by_category]) ) {
				$tax_query[] = array(
					'taxonomy' => $args['taxonomy'],
					'field'    => 'id',
					'terms'    => $_GET[$filter_by_category],
					'operator' => 'IN',
				);
			}
			return $tax_query;
		}
		return false;
	}

	/**
	 * Modificar enlaces de los tipos de contenido
	 * @param string $url
	 * @param string $post_type
	 * @param int $post_id
	 * @param array<string> $args
	 * @return string|false
	 */
	public function post_type_link( $url, $post_type, $post_id, $args ) {
		if ($post_type === $args['post_type']) {
			$post_terms = wp_get_post_terms($post_id, $args['taxonomy']);

			if( !empty($post_terms) ) {
				$url = str_replace("%{$args['taxonomy']}%", $post_terms[0]->slug, $url);
				return $url;
			}
		}
		return false;
	}

}
