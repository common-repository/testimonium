<?php
/*
 * Plugin Name: Testimonium
 * Plugin URI: https://dmoran.co
 * Description: A plugin to display testimonials in creative ways on your website!
 * Version: 0.3
 * Author: David Moran
 * Author URI: https://dmoran.co
 * License: GPL2
 */


class Testimonium {
     
	/**
	 * Constructor. Called when plugin is initialised
	 */
	function __construct() {
		add_action( 'init', array( $this, 'register_custom_post_type' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_plugin_scripts' ) );
		add_shortcode( 'testimonium', array( 'Testimonium', 'testimonium_shortcode' ) );
		
		// Allow shortcode to run in text widget
		if ( ! has_filter( 'widget_text', 'do_shortcode' ) )
			add_filter('widget_text', 'do_shortcode');
		}
	
	/**
	 * Registers a custom post type called Testimonial
	 */
	function register_custom_post_type(){
		register_post_type( 'testimonial', array(
			'labels' => array(
				'name'               => _x( 'Testimonials', 'post type general name', 'testimonium' ),
				'singular_name'      => _x( 'Testimonial', 'post type singular name', 'testimonium' ),
				'menu_name'          => _x( 'Testimonials', 'admin menu', 'testimonium' ),
				'name_admin_bar'     => _x( 'Testimonial', 'add new on admin bar', 'testimonium' ),
				'add_new'            => _x( 'Add New', 'contact', 'testimonium' ),
				'add_new_item'       => __( 'Add New Testimonial', 'testimonium' ),
				'new_item'           => __( 'New Testimonial', 'testimonium' ),
				'edit_item'          => __( 'Edit Testimonial', 'testimonium' ),
				'view_item'          => __( 'View Testimonial', 'testimonium' ),
				'all_items'          => __( 'All Testimonials', 'testimonium' ),
				'search_items'       => __( 'Search Testimonials', 'testimonium' ),
				'parent_item_colon'  => __( 'Parent Testimonials:', 'testimonium' ),
				'not_found'          => __( 'No testimonials found.', 'testimonium' ),
				'not_found_in_trash' => __( 'No testimonials found in Trash.', 'testimonium' ),
			),
         
			// Frontend
			'has_archive'        => false,
			'public'             => false,
			'publicly_queryable' => false,
         
			// Admin
			'capability_type' => 'post',
			'menu_icon'     => 'dashicons-businessman',
			'menu_position' => 10,
			'query_var'     => true,
			'show_in_menu'  => true,
			'show_ui'       => true,
			'supports'      => array(
					'title',
					'editor',
					'thumbnail', 
					'excerpt'
			),

		));
	}
	
	/**
	 * Shortcode for basic output
	 */
	public static function testimonium_shortcode( $atts, $content = "" ) {
		
		$a = shortcode_atts( array(
        'number' => '3',
        'version' => '1',
				'order' => 'rand'
    ), $atts );

		$numOfTestimonials = $a['number'];
		$testimonialVer = $a['version'];
		$orderOfTestimonials = $a['order'];
		
		// Step 2 - Setup HTML	
		$testimonialHTML = '';
		if ($testimonialVer == 1) {
			include(ABSPATH . 'wp-content/plugins/testimonium/public/partials/layout-1.php');
		} else if ($testimonialVer == 2){
			include(ABSPATH . 'wp-content/plugins/testimonium/public/partials/layout-2.php');
		}
		
		// Step 3 - Return HTML
		return $testimonialHTML;
	}
	
	/**
	 * Enqueue Styles
	 */
	function register_plugin_scripts() {
		
		wp_register_style( 'testimonium', plugins_url( 'testimonium/testimonium.css' ) );
		wp_enqueue_style( 'testimonium' );
		wp_register_style( 'unslider', plugins_url( 'testimonium/unslider.css' ) );
		wp_enqueue_style( 'unslider' );
		wp_register_style( 'unslider-dots', plugins_url( 'testimonium/unslider-dots.css' ) );
		wp_enqueue_style( 'unslider-dots' );
		
		// Basic check for font awesome and enqueue
		if( !wp_style_is( 'font-awesome' ) || !wp_style_is( 'fontawesome' ) ) {
			wp_register_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css' );
			wp_enqueue_style( 'font-awesome' );
		};
		
		wp_register_script( 'unslider-js', plugins_url( 'testimonium/unslider-min.js' ), array('jquery'), '2.0', true );
		wp_enqueue_script( 'unslider-js');
		
	}

     
}

 
$testimonium = new Testimonium;