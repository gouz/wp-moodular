<?php
/**
 * Plugin Name: Moodular
 * Plugin URI: http://www.gougouzian.fr/projects/jquery/moodular/
 * Description: Easily create carousels with Moodular and integrate its in your posts
 * Version: 0.1
 * Author: Benjamin PONGY, Sylvain GOUGOUZIAN
 * Author URI: http://www.axome.com/
 * License: MIT
 */

load_plugin_textdomain( 'moodular', false, basename( dirname( __FILE__ ) ) . '/languages' );

$moodular_config = array(
	'controls' => array(
		1 => array(
			'moodular' => 'buttons',
			'label' => __('Arrows', 'moodular')
		),
		2 => array(
			'moodular' => 'pagination',
			'label' => __('Pagination', 'moodular')
		)
	),
	'effects' => array(
		1 => array(
			'moodular' => 'fade',
			'label' => __('Fading', 'moodular') 
		),
		2 => array(
			'moodular' => 'left',
			'label' => __('Left movement', 'moodular') 
		)
	),
	'display' => array(
		1 => array(
			'moodular' => 'moodular-images',
			'label' => __('Just images', 'moodular')
		),
		2 => array(
			'moodular' => 'moodular-images_title',
			'label' => __('Images + Titles', 'moodular')
		),
		3 => array(
			'moodular' => 'moodular-full',
			'label' => __('Full', 'moodular')
		)
	)
);

if ( ! function_exists('moodular_cpt') ) {
	// Register Custom Post Type
	function moodular_cpt() {
		$labels = array(
			'name'                => _x( 'Items', 'Post Type General Name', 'moodular' ),
			'singular_name'       => _x( 'Item', 'Post Type Singular Name', 'moodular' ),
			'menu_name'           => __( 'Moodular', 'moodular' ),
			'parent_item_colon'   => __( 'Parent Item:', 'moodular' ),
			'all_items'           => __( 'All Items', 'moodular' ),
			'view_item'           => __( 'View Item', 'moodular' ),
			'add_new_item'        => __( 'Add New Item', 'moodular' ),
			'add_new'             => __( 'Add New', 'moodular' ),
			'edit_item'           => __( 'Edit Item', 'moodular' ),
			'update_item'         => __( 'Update Item', 'moodular' ),
			'search_items'        => __( 'Search Item', 'moodular' ),
			'not_found'           => __( 'Not found', 'moodular' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'moodular' ),
		);
		$args = array(
			'label'               => __( 'moodular', 'moodular' ),
			'description'         => __( 'Moodular description', 'moodular' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes', ),
			'taxonomies'          => array( 'moodular_category' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-format-gallery',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => false,
			'capability_type'     => 'post',
		);
		register_post_type( 'moodular', $args );
	}
	// Hook into the 'init' action
	add_action( 'init', 'moodular_cpt', 0 );
}


if ( ! function_exists( 'moodular_category' ) ) {
	
	// Register Custom Taxonomy
	function moodular_category() {
	
		$labels = array(
			'name'                       => _x( 'Moodular sliders', 'Taxonomy General Name', 'moodular' ),
			'singular_name'              => _x( 'Moodular category', 'Taxonomy Singular Name', 'moodular' ),
			'menu_name'                  => __( 'Slides', 'moodular' ),
			'all_items'                  => __( 'All slides', 'moodular' ),
			'parent_item'                => __( 'Parent slide', 'moodular' ),
			'parent_item_colon'          => __( 'Parent slide:', 'moodular' ),
			'new_item_name'              => __( 'New slide Name', 'moodular' ),
			'add_new_item'               => __( 'Add new slide', 'moodular' ),
			'edit_item'                  => __( 'Edit slide', 'moodular' ),
			'update_item'                => __( 'Update slide', 'moodular' ),
			'separate_items_with_commas' => __( 'Separate slides with commas', 'moodular' ),
			'search_items'               => __( 'Search slides', 'moodular' ),
			'add_or_remove_items'        => __( 'Add or remove slides', 'moodular' ),
			'choose_from_most_used'      => __( 'Choose from the most used slides', 'moodular' ),
			'not_found'                  => __( 'Not Found', 'moodular' )
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => true,
			'rewrite'                    => false
		);
		register_taxonomy( 'moodular_category', 'moodular', $args );
	
	}
	
	// Hook into the 'init' action
	add_action( 'init', 'moodular_category', 0 );

}

function add_moodular_button() {
	
	global $post;
	if( $post->post_type=='moodular' )
		return;
	
	$popup_url = __( 'moodular-popup', 'moodular' );
	$title = __( 'Insert slider', 'moodular' );

	echo "<a title='{$title}' href='#TB_inline?width=640&height=500&inlineId={$popup_url}' class='thickbox button add_media' title='{$title}'><span class='dashicons dashicons-format-gallery' style='vertical-align: text-top; color: #888;'></span> $title</a>";
}
add_action('media_buttons', 'add_moodular_button', 11);

function moodular_popup() {
	require_once('moodular-popup.php');
}
add_action('admin_footer', 'moodular_popup');

function moodular_script() {
	wp_enqueue_style( 'moodular', plugins_url('wp-moodular') . '/moodular.min.css', array(), '4.3' );
	wp_enqueue_script( 'moodular', plugins_url('wp-moodular') . '/moodular.min.js', array( 'jquery' ), '4.3' );
}
add_action( 'wp_enqueue_scripts', 'moodular_script' );

function moodular_shortcode( $atts ){
	extract( shortcode_atts( array(
		'id'         => -1,
		'v'          => '500',
		'transition' => 1,
		'ctrl'       => 1,
		'aff'        => 1,
		'random'     => 0
	), $atts ) );
	
	$moodular_id = 'moodular_' . uniqid();
	
	global $moodular_config;
	
	$elements = '';
	$myposts = get_posts( array(
		'post_type' => 'moodular',
		'tax_query' => array(
			array(
				'taxonomy' => 'moodular_category',
				'field' => 'id',
				'terms' => $id
			)
		) 
	) ); 
	foreach ( $myposts as $post ) : 
		$elements .= '<li>' . $post->post_title . '</li>'; 
	endforeach; 
	wp_reset_postdata();
	
	$controls = '';
	switch ($moodular_config['controls'][$ctrl]['moodular'])
	{
		default: break;
		case 'buttons':
			$controls = '<a class="moodular-btnLeft"></a><a class="moodular-btnRight"></a>';
			break;
		case 'pagination':
			$controls = '<ul class="moodular-pagination"></ul>';
			break;
	}
	
	return '
	<div id="' . $moodular_id . '" class="' . $moodular_config['display'][$aff]['moodular'] . '">
		<ul class="moodular-wrapper">
			' . $elements . '
		</ul>
		' . $controls . '
	</div>
	<script>
		(function($){
			$(document).ready(function(){
				var $moodular = $("#' . $moodular_id . '");
				$(".moodular-wrapper", $moodular).moodular({
					effects: "' . $moodular_config['effects'][$transition]['moodular'] . '",
					controls: "' . $moodular_config['controls'][$ctrl]['moodular'] . '",
					v: ' . (int) $v . ',
					btnLeft: $(".moodular-btnLeft", $moodular),
					btnRight: $(".moodular-btnLeft", $moodular),
					pagination: $(".moodular-pagination", $moodular),
					resize: 1
				});
			});
		})(window.jQuery);
	</script>';
}
add_shortcode( 'moodular', 'moodular_shortcode' );
