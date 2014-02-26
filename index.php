<?php
/**
 * Plugin Name: Moodular
 * Plugin URI: http://www.gougouzian.fr/projects/jquery/moodular/
 * Description: Moodular
 * Version: 0.1
 * Author: Gouz
 * Author URI: http://www.gougouzian.fr/
 * License: MIT
 */



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
			'menu_icon'           => '',
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
	$popup_url = 'moodular-popup';
	$title = 'Insérer un diaporama dans la page';

	$bt = "<a title='{$title}' href='#TB_inline?width=640&height=650&inlineId={$popup_url}' class='thickbox button add_media' style='padding-left: 0px; padding-right: 0px;' title='{$title}'> <img src='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPjxzdmcgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjIwcHgiIGhlaWdodD0iMjBweCIgdmlld0JveD0iMCAwIDIwIDIwIiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCAyMCAyMCIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGcgaWQ9IkNhbHF1ZV8xIj48cmVjdCB4PSI2IiB5PSI3IiBmaWxsPSJub25lIiBzdHJva2U9IiMwMDAwMDAiIHN0cm9rZS13aWR0aD0iMS43MzA3IiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIHdpZHRoPSI4IiBoZWlnaHQ9IjYiLz48L2c+PGcgaWQ9IkNhbHF1ZV8yIj48cG9seWdvbiBwb2ludHM9IjMuNywxMi42IDEsOS45IDMuNyw3LjMgIi8+PHBvbHlnb24gcG9pbnRzPSIxNi4zLDEyLjYgMTksOS45IDE2LjMsNy4zICIvPjwvZz48L3N2Zz4=' style='height: 20px; position: relative; top: -2px;'></a>";

	echo $bt;
}
add_action('media_buttons', 'add_moodular_button', 11);



function moodular_popup() {
	include('moodular-popup.php');
}
add_action('admin_footer', 'moodular_popup');
