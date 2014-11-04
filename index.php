<?php
/**
 * Plugin Name: Moodular
 * Plugin URI: http://www.gougouzian.fr/projects/jquery/moodular/
 * Description: Easily create carousels with Moodular and integrate them in your
 * posts
 * Version: 0.3
 * Author: Benjamin PONGY, Sylvain GOUGOUZIAN, Nicolas SOROSAC
 * Author URI: http://www.axome.com/
 * Text Domain: moodular
 * Domain Path: /languages/
 * License: MIT
 *
 * ============================
 * Filter items HTML attributes
 * ============================
 * 
 * add_filter('moodular_item_attributes', function($attributes, $post) {
 * 	$bgcolor = get_post_meta($post->ID, '_bgcolor', true);
 * 	if ($bgcolor) $attributes['style'] = "background-color:{$bgcolor}";
 * 	return $attributes;
 * }, 10, 2);
 *
 */

load_plugin_textdomain( 'moodular', false, basename( __DIR__ ) . '/languages' );

require_once __DIR__ . '/core/cpt.php';
require_once __DIR__ . '/core/Moodular.php';
$wp_moodular = Moodular::getInstance();
require_once __DIR__ . '/core/config.php';
