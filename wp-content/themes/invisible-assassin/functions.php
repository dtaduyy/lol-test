<?php
/**
 * invisible_assassin functions and definitions
 *
 * @package invisible_assassin
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'invisible_assassin_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function invisible_assassin_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on invisible_assassin, use a find and replace
	 * to change 'invisible_assassin' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'invisible_assassin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 *
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'invisible_assassin' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'invisible_assassin_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_image_size('pop-thumb',542, 340, true );
	add_image_size('invisible_assassin-thumb',542, 410, true );
}
endif; // invisible_assassin_setup
add_action( 'after_setup_theme', 'invisible_assassin_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function invisible_assassin_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'invisible_assassin' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'bose' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'bose' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'bose' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'bose' ), /* Primary Sidebar for Everywhere else */
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title title-font">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'invisible_assassin_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function invisible_assassin_scripts() {
	wp_enqueue_style( 'invisible_assassin-style', get_stylesheet_uri() );
	
	wp_enqueue_style('invisible_assassin-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('invisible_assassin_title_font', 'Source Sans Pro') ).':100,300,400,700' );
	
	wp_enqueue_style('invisible_assassin-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('invisible_assassin_body_font', 'Source Sans Pro') ).':100,300,400,700' );
	
	wp_enqueue_style( 'invisible_assassin-fontawesome-style', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' );
	
	wp_enqueue_style( 'invisible_assassin-nivo-style', get_template_directory_uri() . '/assets/css/nivo-slider.css' );
	
	wp_enqueue_style( 'invisible_assassin-nivo-skin-style', get_template_directory_uri() . '/assets/css/nivo-default/default.css' );
	
	wp_enqueue_style( 'invisible_assassin-bootstrap-style', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );
	
	wp_enqueue_style( 'invisible_assassin-hover-style', get_template_directory_uri() . '/assets/css/hover.min.css' );
			
	wp_enqueue_style( 'invisible_assassin-main-theme-style', get_template_directory_uri() . '/assets/css/main.css' );

	wp_enqueue_script( 'invisible_assassin-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	
	wp_enqueue_script( 'invisible_assassin-externaljs', get_template_directory_uri() . '/js/external.js', array('jquery') );

	wp_enqueue_script( 'invisible_assassin-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'invisible_assassin-custom-js', get_template_directory_uri() . '/js/custom.js', array(), 1, true );
}
add_action( 'wp_enqueue_scripts', 'invisible_assassin_scripts' );

function invisible_assassin_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'invisible_assassin_excerpt_more');

/**
 * Include the Custom Functions of the Theme.
 */
require get_template_directory() . '/framework/theme-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Custom CSS Mods.
 */
require get_template_directory() . '/inc/css-mods.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


add_action('init',  'add_custom_product_option_type'  );

function add_custom_product_option_type(){
	$label = array(
		'name'                => _x( 'Tuyển Thủ', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Tuyển Thủ', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Tuyển Thủ', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Product Options', 'twentythirteen' ),
		'all_items'           => __( 'Tất cả Tuyển Thủ', 'twentythirteen' ),
		'view_item'           => __( 'View Product Options', 'twentythirteen' ),
		'add_new_item'        => __( 'Thêm Tuyển Thủ mới', 'twentythirteen' ),
		'add_new'             => __( 'Thêm mới', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Product Options', 'twentythirteen' ),
		'update_item'         => __( 'Update Product Options', 'twentythirteen' ),
		'search_items'        => __( 'Search Product Options', 'twentythirteen' ),
		'not_found'           => __( 'Not Found Product Options', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found Product Options in Trash', 'twentythirteen' ),
	);

	$args = array(
		'labels' => $label, 
		'description' => '', 
		'supports' => array(
			'title',
			'editor',
		), 
		'hierarchical' => false, 
		'public' => false,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'show_in_admin_bar' => true, 
		'menu_position' => 58, 
		'menu_icon' => 'dashicons-admin-post', 
		'can_export' => true, 
		'has_archive' => true, 
		'exclude_from_search' => false, 
		'publicly_queryable' => true,
		'capability_type' => 'post'
	);
	register_post_type('tuyen_thu', $args); 
}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_doi_tuyen_hierarchical_taxonomy', 10 );

//create a custom taxonomy name it Thông Tin for your posts

function create_doi_tuyen_hierarchical_taxonomy() {

	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

	$labels = array(
		'name' => _x( 'Khu Vực', 'taxonomy general name' ),
		'singular_name' => _x( 'Khu Vực', 'taxonomy singular name' ),
		'search_items' =>  __( 'Tìm kiếm khu vực' ),
		'all_items' => __( 'Tất cả khu vực' ),
		'parent_item' => __( 'Parent Topic' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item' => __( 'Edit Topic' ), 
		'update_item' => __( 'Update Topic' ),
		'add_new_item' => __( 'Add New Topic' ),
		'new_item_name' => __( 'New Topic Name' ),
		'menu_name' => __( 'Khu Vực' ),
	);    

	// Now register the taxonomy

	register_taxonomy('thong_tin',array('tuyen_thu'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_menu' =>true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'topic' ),
	));
 
}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_test_hierarchical_taxonomy', 10 );

//create a custom taxonomy name it Thông Tin for your posts

function create_test_hierarchical_taxonomy() {

	// Add new taxonomy, make it hierarchical like categories
	//first do the translations part for GUI

	$labels = array(
		'name' => _x( 'Giải Đấu', 'taxonomy general name' ),
		'singular_name' => _x( 'Giải Đấu', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Giải Đấu' ),
		'all_items' => __( 'All Giải Đấu' ),
		'parent_item' => __( 'Parent Topic' ),
		'parent_item_colon' => __( 'Parent Topic:' ),
		'edit_item' => __( 'Edit Topic' ), 
		'update_item' => __( 'Update Topic' ),
		'add_new_item' => __( 'Add New Topic' ),
		'new_item_name' => __( 'New Topic Name' ),
		'menu_name' => __( 'Giải Đấu' ),
	);    

	// Now register the taxonomy

	register_taxonomy('giai_dau',array('tuyen_thu'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_in_menu' =>true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'topic' ),
	));
 
}