<?php
	add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

	function enqueue_parent_styles() {
	   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	}

	function register_product() {
	    $labels = array(
	    		'name'                => __( 'Products' ),
	    		'singular_name'       => __( 'Product'),
	    		'add_new'             => __( 'Add New Product' ),
	    		'edit_item'           => __( 'Edit Product'),
	    		'new_item'            => __( 'New Product'),
	    		'view_item'           => __( 'View Product'),
	    		'search_items'        => __( 'Search Products'),
	    		'not_found'           => __( 'No Products found'),
	    		'not_found_in_trash'  => __( 'No Products found in Trash'),
	    		'parent_item_colon'   => __( 'Parent Product:'),
	    		'menu_name'           => __( 'Products'),
	    	);
	    
	    	$args = array(
	    		'labels'                   => $labels,
	    		'hierarchical'        => false,
	    		'description'         => '',
	    		'taxonomies'          => array('product-categories'),
	    		'public'              => true,
	    		'show_ui'             => true,
	    		'show_in_menu'        => true,
	    		'show_in_admin_bar'   => true,
	    		'menu_position'       => null,
	    		'menu_icon'           => null,
	    		'show_in_nav_menus'   => true,
	    		'publicly_queryable'  => true,
	    		'exclude_from_search' => false,
	    		'has_archive'         => true,
	    		'query_var'           => true,
	    		'can_export'          => true,
	    		'rewrite'             => true,
	    		'capability_type'     => 'post',
	    		'supports'            => array(
	    			'title', 'editor', 'author', 'thumbnail',
	    			'excerpt','custom-fields', 'trackbacks', 'comments',
	    			'revisions', 'page-attributes', 'post-formats'
	    			)
	    	);
	    register_post_type( 'product', $args );
	}
	add_action( 'init', 'register_product' );

	function register_product_categories() {

		$labels = array(
			'name'					=> __( 'Product Categories'),
			'singular_name'			=> __( 'Product Category'),
			'menu_name'				=> __( 'Product Categories')
		);
	
		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'show_tagcloud'     => true,
			'show_ui'           => true,
			'query_var'         => true,
			'rewrite'           => true,
			'query_var'         => true,
			'capabilities'      => array(),
		);
	
		register_taxonomy( 'product-categories', array( 'product' ), $args );	
		

	}
	add_action( 'init', 'register_product_categories' );