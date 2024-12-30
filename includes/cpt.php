<?php

namespace GSCOACH;

// if direct access than exit the file.
defined('ABSPATH') || exit;

class Cpt{
    public function __construct(){
        add_action('init', array($this,'register_coach_cpt'));
        add_action( 'init', array( $this, 'register_coach_taxonomies' ) );
    }

	// Register coach Custom Post Type
	function register_coach_cpt() {
		$labels = array(
			'name'               => __( 'Coach', 'gscoach' ),
			'singular_name'      => __( 'Coach', 'gscoach' ),
			'menu_name'          => _x( 'GS Coach', 'admin menu', 'gscoach' ),
			'name_admin_bar'     => _x( 'GS Coach', 'add new on admin bar', 'gscoach' ),
			'add_new'            => __( 'Add New Coach', 'gscoach' ),
			'add_new_item'       => __( 'Add New Coach', 'gscoach' ),
			'new_item'           => __( 'New Coach', 'gscoach' ),
			'edit_item'          => __( 'Edit Coach', 'gscoach' ),
			'view_item'          => __( 'View Coach', 'gscoach' ),
			'all_items'          => __( 'All Coaches', 'gscoach' ),
			'search_items'       => __( 'Search Coaches', 'gscoach' ),
			'parent_item_colon'  => __( 'Parent Coaches:', 'gscoach' ),
			'not_found'          => __( 'No Coaches found.', 'gscoach' ),
			'not_found_in_trash' => __( 'No Coaches found in Trash.', 'gscoach' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'bla' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 39,
			'menu_icon'          => 'dashicons-welcome-learn-more',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		);

		register_post_type( 'gs_coach', $args );
	}

    // Register taxonomies for coach
    public function register_coach_taxonomies() {
		
		$this->group();
		$this->tag();
	}

    // Register Group Taxonomy For Coach
	function group() {

		// if ( plugin()->builder->get_tax_option('enable_group_tax') !== 'on' ) return;

		$plural = 'Groups';
		$singular = 'Group' ;

		$labels = array(
			'name'                       => $plural,
			'singular_name'              => $singular,
			'all_items'                  => sprintf( __('All %s'), $plural ),
			'parent_item'                => sprintf( __('Parent %s'), $singular ),
			'parent_item_colon'          => sprintf( __('Parent %s'), $singular ),
			'new_item_name'              => sprintf( __('New %s'), $singular ),
			'add_new_item'               => sprintf( __('Add New %s'), $singular ),
			'edit_item'                  => sprintf( __('Edit %s'), $singular ),
			'update_item'                => sprintf( __('Update %s'), $singular ),
			'separate_items_with_commas' => sprintf( __('Separate %s with commas'), $plural ),
			'search_items'               => sprintf( __('Search %s'), $plural ),
			'add_or_remove_items'        => sprintf( __('Add or remove %s'), $plural ),
			'choose_from_most_used'      => sprintf( __('Choose from the most used %s'), $plural ),
			'not_found'                  => __( 'Not Found', 'gscoach' ),
		);
		$rewrite = array(
			'slug'                       => 'bla-group',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'gs_coach_group', array( 'gs_coach' ), $args );

	}

    	
	// Register Tag Taxonomy For Team
	function tag() {

		// if ( plugin()->builder->get_tax_option('enable_tag_tax') !== 'on' ) return;

		$plural = 'Tags';
		$singular = 'Tag';

		$labels = array(
			'name'                       => $plural,
			'singular_name'              => $singular,
			'all_items'                  => sprintf( __('All %s'), $plural ),
			'parent_item'                => sprintf( __('Parent %s'), $singular ),
			'parent_item_colon'          => sprintf( __('Parent %s'), $singular ),
			'new_item_name'              => sprintf( __('New %s'), $singular ),
			'add_new_item'               => sprintf( __('Add New %s'), $singular ),
			'edit_item'                  => sprintf( __('Edit %s'), $singular ),
			'update_item'                => sprintf( __('Update %s'), $singular ),
			'separate_items_with_commas' => sprintf( __('Separate %s with commas'), $plural ),
			'search_items'               => sprintf( __('Search %s'), $plural ),
			'add_or_remove_items'        => sprintf( __('Add or remove %s'), $plural ),
			'choose_from_most_used'      => sprintf( __('Choose from the most used %s'), $plural ),
			'not_found'                  => __( 'Not Found', 'gsteam' ),
		);
		$rewrite = array(
			'slug'                       => 'bla-tag',
			'with_front'                 => true,
			'hierarchical'               => false,
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => false,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => false,
			'show_tagcloud'              => false,
			'rewrite'                    => $rewrite,
		);
		register_taxonomy( 'gs_coach_tag', array( 'gs_coach' ), $args );

	}
}