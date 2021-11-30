<?php

    // get file walker class to add for menu 
    require_once('wp-bootstrap-navwalker.php');
    
	// add featured Image Support
    // add_theme_support( 'post-thumbnails' );

    // Add featurs To My Theme
    // =========================================================================
    
if ( ! function_exists( 'hamzoooz_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function hamzoooz_setup() {

		// Make theme available for translation. Translations can be filed in the /languages/ directory.
		load_theme_textdomain( 'hamzoooz', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Set detfault Post Thumbnail size
		set_post_thumbnail_size( 820, 410, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary'   => esc_html__( 'Main Navigation', 'hamzoooz' ),
			'secondary' => esc_html__( 'Top Navigation', 'hamzoooz' ),
			'footer'    => esc_html__( 'Footer Navigation', 'hamzoooz' ),
			'social'    => esc_html__( 'Social Icons', 'hamzoooz' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'hamzoooz_custom_background_args', array( 'default-color' => 'e5e5e5' ) ) );

		// Set up the WordPress core custom logo feature
		add_theme_support( 'custom-logo', apply_filters( 'hamzoooz_custom_logo_args', array(
			'height'      => 60,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		) ) );

		// Set up the WordPress core custom header feature.
		add_theme_support('custom-header', apply_filters( 'hamzoooz_custom_header_args', array(
			'header-text' => false,
			'width'       => 1190,
			'height'      => 250,
			'flex-height' => true,
		) ) );

		// Add Theme Support for wooCommerce
		add_theme_support( 'woocommerce' );

		// Add extra theme styling to the visual editor
		add_editor_style( array( 'css/editor-style.css', get_template_directory_uri() . '/css/custom-fonts.css' ) );

		// Add Theme Support for Selective Refresh in Customizer
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add custom color palette for Gutenberg.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html_x( 'Primary', 'Gutenberg Color Palette', 'hamzoooz' ),
				'slug'  => 'primary',
				'color' => apply_filters( 'hamzoooz_primary_color', '#2299cc' ),
			),
			array(
				'name'  => esc_html_x( 'White', 'Gutenberg Color Palette', 'hamzoooz' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html_x( 'Light Gray', 'Gutenberg Color Palette', 'hamzoooz' ),
				'slug'  => 'light-gray',
				'color' => '#f0f0f0',
			),
			array(
				'name'  => esc_html_x( 'Dark Gray', 'Gutenberg Color Palette', 'hamzoooz' ),
				'slug'  => 'dark-gray',
				'color' => '#777777',
			),
			array(
				'name'  => esc_html_x( 'Black', 'Gutenberg Color Palette', 'hamzoooz' ),
				'slug'  => 'black',
				'color' => '#353535',
			),
		) );
	}
endif; // hamzoooz_setup
add_action( 'after_setup_theme', 'hamzoooz_setup' );

    // =========================================================================
    

/******  function add by custom style *********
******  added by hamzoooz             ********
******  wp_enqueue_style()           ********/

    function mystyles() {
        
	// Get Theme Version
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet
		wp_enqueue_style( 'merlin-stylesheet', get_stylesheet_uri(), array(), $theme_version );
        wp_enqueue_style('bootstrap-css',get_template_directory_uri().'/css/bootstrap.min.css');
        wp_enqueue_style('font-awesome-css',get_template_directory_uri().'/css/all.css');
        wp_enqueue_style('main',get_template_directory_uri().'/css/main.css');
    }

/*****  function add by custom script ********
******  added by hamzoooz             ********
******  wp_enqueue_script()           *******/

    function myscripts()
    {
        wp_deregister_script('jquery'); // to remove old jquery from wordpress
        wp_register_script('jquery', includes_url('/js/jquery/jquery.js') ,false,'', true);// add anew jquery to footer 
        wp_enqueue_script('bootstrap-js',get_template_directory_uri() .'/js/bootstrap.min.js', array('jquery'), false, true );/* last true to put file script in last body becous the default value false */
        wp_enqueue_script('fontawesome-js',get_template_directory_uri() .'/js/all.js', array(), false, true );
        wp_enqueue_script('main-js',get_template_directory_uri() . '/js/main.js',array(),false,true);//array to tell what incluede this fun from libaraly
        wp_enqueue_script('HTML5 Shiv',get_template_directory_uri() . '/js/HTML5 Shiv 3.7.3.js');
        wp_script_add_data('HTML5 Shiv','conditional','lt IE 9');
        wp_enqueue_script('Respond',get_template_directory_uri().'/js/Respond.js');//array to tell what incluede this fun from libaraly
        wp_script_add_data('Respond','conditional','lt IE 9');
    }

    // add register nav menu
    function register_my_nav_menu(){
        register_nav_menus(array(
            'bootstrap-menu' => 'Navigation Bar',
            'footer-menu' => 'footer Bar'
        ));
    }
    
    function bootstrap_menu(){
		wp_nav_menu(array(
            'theme_location' => 'bootstrap-menu',
            'menu_class'     => 'nav navbar-right navbar-nav',
            'container'      => false ,//to cancle div
            'depth'         => 5,
            'walker'        => new wp_bootstrap_navwalker()
        ));
    }
	
		// add Action                                                        
		// style
		add_action('wp_enqueue_scripts','mystyles');
		// script
		add_action('wp_enqueue_scripts','myscripts');
		// custom menu 
		add_action('init','register_my_nav_menu');//run after worpres load
	
    // Add costomize The excerpt
    function hamzoooz_extend_excetrpt_length($length) {
        if(is_author()){
            return 40;
        }elseif(is_category()){
            return 60;
        }
        else{
            return 85;
        }
    }
    add_filter('excerpt_length' , 'hamzoooz_extend_excetrpt_length');

    function hamzoooz_extend_chinge_dots($more) {
        return ' ...' ;
    }

    add_filter('excerpt_more' , 'hamzoooz_extend_chinge_dots');

    // Numbering Pagination

    function numbering_pagination() {
        global $wp_query; //Make WP_Query Global
        $all_pages = $wp_query->max_num_pages;  // Get All Posts
        $current_page = max(1 , get_query_var('paged')); //Get Current Pages
        // echo $current_page;
        if($all_pages > 1){ // check if Total pages > 1
            return paginate_links(array(
                'base'      =>  get_pagenum_link() . '%_%',
                'format'    =>  'page/%#%',  
                'current'   =>  $current_page,
                'mid_size'  =>  2 ,
                'end_size'  =>  2,
            ));
        }
    }


    // ===================================================================


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function hamzoooz_widgets_init() {

	register_sidebar( array(
		'name' => esc_html__( 'Sidebar', 'hamzoooz' ),
        'id' => 'main-sidebar',
        'class'  =>  'main-sidebar',
		'description' => esc_html__( 'Appears on posts and pages except the full width template.', 'hamzoooz' ),
        'before_widget'     =>  '<div class="widget-content">',
        'after_widget'      =>  '</div>',
        'befor'             =>  '<h3 class="widget-title">',
        'after'             =>  '</h3>'
	));

	register_sidebar( array(
		'name' => esc_html__( 'Header', 'hamzoooz' ),
        'id' => 'main-sidebar',
        'class'  =>  'main-sidebar',
		'description' => esc_html__( 'Appears on header area. You can use a search or ad widget here.', 'hamzoooz' ),
        'before_widget'     =>  '<div class="widget-content">',
        'after_widget'      =>  '</div>',
        'befor_title'             =>  '<h3 class="widget-title">',
        'after_title'             =>  '</h3>'
	));

	register_sidebar( array(
		'name' => esc_html__( 'Magazine Homepage', 'hamzoooz' ),
		'id' => 'main-sidebar',
        'class'  =>  'main-sidebar',
        'description' => esc_html__( 'Appears on Magazine Homepage template only. You can use the Category Posts widgets here.', 'hamzoooz' ),
        'before_widget'     =>  '<div class="widget-content">',
        'after_widget'      =>  '</div>',
        'befor_title'             =>  '<h3 class="widget-title">',
        'after_title'             =>  '</h3>'
	));
}
add_action( 'widgets_init', 'hamzoooz_widgets_init' );


    // ===================================================================
    // Register Sidebar

    // function hamzoooz_main_sidebar(){
    //     register_sidebar(array(
    //         'name'              =>  'Main Sidebar',
    //         'id'                =>  'main-sidebar',
    //         'description'       =>  'Main Sidebar',
    //         'class'             =>  'main-sidebar',
    //         'before_widget'     =>  '<div class="widget-content">',
    //         'after_widget'      =>  '</div>',
    //         'befor_title'             =>  '<h3 class="widget-title">',
    //         'after_title'             =>  '</h3>'
    //     ));
    // }

    // add_action('widgets_init' , 'hamzoooz_main_sidebar');
    // Remove Paragraph Element From posts


    function hamzoooz_remove_p($content){
        remove_filter('the_content' , 'wpautop');
        return $content;
    }
    add_filter('the_content' ,'hamzoooz_remove_p', 0);


// ========================================================================

    /**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hamzoooz_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'hamzoooz_content_width', 810 );
}
add_action( 'after_setup_theme', 'hamzoooz_content_width', 0 );
// ========================================================================

/**
 * Enqueue custom fonts.
 */
function hamzoooz_custom_fonts() {
	wp_enqueue_style( 'hamzoooz-custom-fonts', get_template_directory_uri() . '/css/custom-fonts.css', array(), '14420113' );
}
add_action( 'wp_enqueue_scripts', 'hamzoooz_custom_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'hamzoooz_custom_fonts', 1 );

// ========================================================================

/**
 * Enqueue editor styles for the new Gutenberg Editor.
 */
function hamzoooz_block_editor_assets() {
	wp_enqueue_style( 'hamzoooz-editor-styles', get_template_directory_uri() . '/css/gutenberg-styles.css', array(), '20181102', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'hamzoooz_block_editor_assets' );

// ========================================================================

/**
 * Add custom sizes for featured images
 */
function hamzoooz_add_image_sizes() {

	// Add image size for small post thumbnais
	add_image_size( 'hamzoooz-thumbnail-small', 360, 270, true );

	// Add Custom Header Image Size
	add_image_size( 'hamzoooz-header-image', 1190, 250, true );

	// Add Slider Image Size
	add_image_size( 'hamzoooz-slider-image', 880, 440, true );

	// Add Category Post Widget image sizes
	add_image_size( 'hamzoooz-category-posts-widget-small', 135, 75, true );
	add_image_size( 'hamzoooz-category-posts-widget-medium', 270, 150, true );
	add_image_size( 'hamzoooz-category-posts-widget-large', 585, 325, true );

}
add_action( 'after_setup_theme', 'hamzoooz_add_image_sizes' );

// ========================================================================


/**
 * Include Files
 */

// include Theme Info page
require get_template_directory() . '/include/theme-info.php';

// include Theme Customizer Options
require get_template_directory() . '/include/customizer/customizer.php';
require get_template_directory() . '/include/customizer/default-options.php';

// Include Extra Functions
require get_template_directory() . '/include/extras.php';

// include Template Functions
require get_template_directory() . '/include/template-tags.php';

// Include support functions for Theme Addons
require get_template_directory() . '/include/addons.php';

// Include Post Slider Setup
require get_template_directory() . '/include/slider.php';

// include Widget Files
require get_template_directory() . '/include/widgets/widget-category-posts-boxed.php';
require get_template_directory() . '/include/widgets/widget-category-posts-columns.php';
require get_template_directory() . '/include/widgets/widget-category-posts-grid.php';

// ========================================================================
// ========================================================================
// ========================================================================
// ========================================================================
// ========================================================================
// ========================================================================
// ========================================================================
// ========================================================================