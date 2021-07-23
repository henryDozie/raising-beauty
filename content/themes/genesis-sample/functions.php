
<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://www.studiopress.com/
 */

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'https://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.8.0' );

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function genesis_sample_localization_setup() {

	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );

}

// Adds helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to Customizer.
require_once get_stylesheet_directory() . '/lib/customize.php';

// Includes Customizer CSS.
require_once get_stylesheet_directory() . '/lib/output.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Adds the required WooCommerce styles and Customizer CSS.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Adds the Genesis Connect WooCommerce notice.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

add_action( 'after_setup_theme', 'genesis_child_gutenberg_support' );
/**
 * Adds Gutenberg opt-in features and styling.
 *
 * @since 2.7.0
 */
function genesis_child_gutenberg_support() { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound -- using same in all child themes to allow action to be unhooked.
	require_once get_stylesheet_directory() . '/lib/gutenberg/init.php';
}

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style(
		'genesis-sample-fonts',
		'//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,500,600,700',
		array(),
		CHILD_THEME_VERSION
	);
	wp_enqueue_style(
		'lato',
		'//fonts.googleapis.com/css?family=Lato:400,500,600,700',
		array(),
		CHILD_THEME_VERSION
	);
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'genesis-sample-responsive-menu',
		get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js",
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

	wp_enqueue_script(
		'genesis-sample',
		get_stylesheet_directory_uri() . '/js/genesis-sample.js',
		array( 'jquery' ),
		CHILD_THEME_VERSION,
		true
	);

	wp_enqueue_script(
		'custom-js',
		get_stylesheet_directory_uri() . '/js/custom.js',
		array( 'jquery' ),
		'2.9',
		true
	);

}

/**
 * Defines responsive menu settings.
 *
 * @since 2.3.0
 */
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'    => 'dashicons-before dashicons-menu',
		'subMenu'          => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Adds support for HTML5 markup structure.
add_theme_support( 'html5', genesis_get_config( 'html5' ) );

// Adds support for accessibility.
add_theme_support( 'genesis-accessibility', genesis_get_config( 'accessibility' ) );

// Adds viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Adds custom logo in Customizer > Site Identity.
add_theme_support( 'custom-logo', genesis_get_config( 'custom-logo' ) );

// Renames primary and secondary navigation menus.
add_theme_support( 'genesis-menus', genesis_get_config( 'menus' ) );

// Adds image sizes.
add_image_size( 'sidebar-featured', 75, 75, true );

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Removes output of unused admin settings metaboxes.
 *
 * @since 2.6.0
 *
 * @param string $_genesis_admin_settings The admin screen to remove meta boxes from.
 */
function genesis_sample_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_admin_settings, 'main' );

}

add_filter( 'genesis_customizer_theme_settings_config', 'genesis_sample_remove_customizer_settings' );
/**
 * Removes output of header and front page breadcrumb settings in the Customizer.
 *
 * @since 2.6.0
 *
 * @param array $config Original Customizer items.
 * @return array Filtered Customizer items.
 */
function genesis_sample_remove_customizer_settings( $config ) {

	unset( $config['genesis']['sections']['genesis_header'] );
	unset( $config['genesis']['sections']['genesis_breadcrumbs']['controls']['breadcrumb_front_page'] );
	return $config;

}

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
/**
 * Modifies size of the Gravatar in the author box.
 *
 * @since 2.2.3
 *
 * @param int $size Original icon size.
 * @return int Modified icon size.
 */
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
/**
 * Modifies size of the Gravatar in the entry comments.
 *
 * @since 2.2.3
 *
 * @param array $args Gravatar settings.
 * @return array Gravatar settings with modified size.
 */
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;
	return $args;

}


// Custom


//Customize site footer

 remove_action('genesis_footer', 'genesis_do_footer');
 remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
 remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

add_action( 'genesis_footer', 'sp_custom_footer' );
 function sp_custom_footer(){

         echo '<div class="site-footer">
	                <div class="wrap">
	                    <p class="copyright">&copy; '.date('Y').' Raising Beauty. Web Design by <a href="https://www.tagonline.com/" target="_blank">TAG Online, Inc</a>.</p>
		        	</div>
	        	</div>';
}


add_filter( 'excerpt_length', 'sp_excerpt_length' );
function sp_excerpt_length( $length ) {
	return 47; 
}


//Add CTA button to nav

function addCtaButton(){
	echo '<a class="button secondary-button" href="/contact">Contact Me</a>';
}

add_action('genesis_header', 'addCtaButton', 12);


//* Do NOT include the opening php tag shown above. Copy the code shown below.
//* Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs' );


//* Do NOT include the opening php tag shown above. Copy the code shown below.
//* Modify breadcrumb arguments.
add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );
function sp_breadcrumb_args( $args ) {
	$args['home'] = '';
	$args['sep'] = ' <img src="/content/uploads/2019/11/Flower-Icon-1.svg" />';
	$args['list_sep'] = ', '; // Genesis 1.5 and later
	$args['prefix'] = '<div class="breadcrumb">';
	$args['suffix'] = '</div>';
	$args['heirarchial_attachments'] = true; // Genesis 1.5 and later
	$args['heirarchial_categories'] = true; // Genesis 1.5 and later
	$args['display'] = true;
	$args['labels']['prefix'] = '<a href="/">Home</a>';
	$args['labels']['author'] = 'Archives for ';
	$args['labels']['category'] = 'Archives for '; // Genesis 1.6 and later
	$args['labels']['tag'] = 'Archives for ';
	$args['labels']['date'] = 'Archives for ';
	$args['labels']['search'] = 'Search for ';
	$args['labels']['tax'] = 'Archives for ';
	$args['labels']['post_type'] = 'Archives for ';
	$args['labels']['404'] = ''; // Genesis 1.5 and later
return $args;
}

//Add Sidebar for single blog posts

add_action( 'genesis_entry_footer', 'custom_set_single_posts_layout', 1 );
function custom_set_single_posts_layout() {
    if ( is_single() ) {
    	echo '<div class="sidebar-wrapper">';
        dynamic_sidebar('Primary Sidebar');
        echo '</div>';
    }
}

//Add Sidebar for blog, search, and category pages

add_action( 'genesis_loop', 'custom_set_single_posts_layout_2', 20 );
function custom_set_single_posts_layout_2() {
    if ( is_home() || is_search() || is_category() ) {
    	echo '<div class="sidebar-wrapper">';
        dynamic_sidebar('Primary Sidebar');
        echo '</div>';
    }
}


//Add breadcrumbs to blog page

function addBreadcrumbs(){
	if(is_home() || is_search() || is_category()){
		genesis_do_breadcrumbs();
	}
}
add_action('genesis_archive_title_descriptions', 'addBreadcrumbs');


//Add new identical class to blog, search, and category pages

add_filter( 'body_class', 'sp_body_class' );
function sp_body_class( $classes ) {
    if(is_home() || is_search() || is_category()){
          $classes[] = 'blog-page';
          return $classes;
    }
    else{
   		return $classes;
    }
}


//Exclude pages from WordPress Search
if (!is_admin()) {
function wpb_search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
		return $query;
	}
	add_filter('pre_get_posts','wpb_search_filter');
}

//Add read more links to blog posts
function addReadMore(){
		if(is_home() || is_search() || is_category()){
	    	echo '<a class="more-link link-style" href="' . get_permalink() . '">Read More</a>';
	    }
}

add_action('genesis_entry_content','addReadMore', 20);

//More blog header into content


function moveBlogHeaderIntoEntry(){
	if(is_home() || is_search() || is_category()){
		//* Remove the entry header markup (requires HTML5 theme support)
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

		//* Remove the entry header markup (requires HTML5 theme support)
		add_action( 'genesis_entry_content', 'genesis_entry_header_markup_open', 1 );
		add_action( 'genesis_entry_content', 'genesis_do_post_title', 2);
		add_action( 'genesis_entry_content', 'genesis_entry_header_markup_close', 3 );
	}
}

add_action('genesis_before_content', 'moveBlogHeaderIntoEntry');


//Creating custom testimonial post type

// Our custom post type function
function create_posttype_testimonials() {
 
    register_post_type( 'testimonials',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Testimonials' ),
                'singular_name' => __( 'Testimonial' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'testimonials'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_testimonials' );

function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Testimonials', 'Post Type General Name', 'genesis-sample' ),
        'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'genesis-sample' ),
        'menu_name'           => __( 'Testimonials', 'genesis-sample' ),
        'parent_item_colon'   => __( 'Parent Testimonials', 'genesis-sample' ),
        'all_items'           => __( 'All Testimonials', 'genesis-sample' ),
        'view_item'           => __( 'View Testimonial', 'genesis-sample' ),
        'add_new_item'        => __( 'Add New Testimonial', 'genesis-sample' ),
        'add_new'             => __( 'Add New', 'genesis-sample' ),
        'edit_item'           => __( 'Edit Testimonial', 'genesis-sample' ),
        'update_item'         => __( 'Update Testimonial', 'genesis-sample' ),
        'search_items'        => __( 'Search Testimonial', 'genesis-sample' ),
        'not_found'           => __( 'Not Found', 'genesis-sample' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'genesis-sample' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Testimonials', 'genesis-sample' ),
        'description'         => __( 'Testimonial news and reviews', 'genesis-sample' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'Testimonials', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );


function wpdocs_custom_excerpt_length( $length ) {
    return 22;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


//Shortcode for testimonials page

function add_testimonials(){
	$args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );
	$the_query = new WP_Query( $args );
    echo '<div class="swiper-container-testimonials">
            <div class="swiper-wrapper">';
			if ( $the_query->have_posts() ) :
			  while ( $the_query->have_posts() ) : 
				$the_query->the_post();
				echo '<div class="swiper-slide">
						<div class="card home-testimonial">
							<img class="mb-16" src="' . get_the_post_thumbnail_url() . '" />
							<p class="mb-31 home-testimonial-text" >' . get_the_content() . '</p>
							<p class="mb-0 home-testimonial-name">' . get_the_title() . '</p>
							<p class="home-testimonial-position mb-0">' . get_field('position') . '</p>
						</div>
					 </div>';
			endwhile;
		endif;
    echo    '</div>
            <div class="swiper-pagination"></div>
           </div> ';
            wp_reset_query();

}

add_shortcode('testimonials', 'add_testimonials');