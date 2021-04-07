<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample Theme' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.1.2' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'opensans-font', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap', array(), CHILD_THEME_VERSION );
}

//* Enqueue OWL CAROUSEL
add_action( 'wp_enqueue_scripts', 'agencyclix_add_owlcarousel' );
function agencyclix_add_owlcarousel() {
     wp_enqueue_style( 'owl-carousel-css', get_stylesheet_directory_uri() .'/owl-carousel/assets/owl.carousel.min.css', array(), CHILD_THEME_VERSION );
     wp_enqueue_script( 'owl-carousel-js', get_stylesheet_directory_uri() .'/owl-carousel/owl.carousel.min.js', array( 'jquery' ), false, true );
}

//* Enqueue POP UP files
add_action( 'wp_enqueue_scripts', 'pop_up_onload' );
function pop_up_onload() {
	wp_enqueue_script('jquery-cdn', 'https://code.jquery.com/jquery-3.6.0.js', array('jquery'),false);
	wp_enqueue_script('pop-up-js', get_stylesheet_directory_uri(). '/js/app.js', array('jquery'),false);
}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );



function mytheme_setup() {
  add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'mytheme_setup' );


//*Add Dash Icons
function ww_load_dashicons(){
    wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'ww_load_dashicons');

// 
// 
// 
// CUSTOM POST TESTIMONIAL

add_action( 'init', 'custom_testimonial_post_type' );
 function custom_testimonial_post_type() {

     $supports = array(
    'title', // post title
    'editor', // post content
    'author', // post author
    'thumbnail', // featured images
    'excerpt', // post excerpt
    'custom-fields', // custom fields
    'comments', // post comments
    'revisions', // post revisions
    'post-formats', // post formats
    );	
        
    $labels = array(
    'name' => _x('Testimonial', 'plural'),
    'singular_name' => _x('Testimonial', 'singular'),
    'menu_name' => _x('Testimonial', 'admin menu'),
    'name_admin_bar' => _x('Testimonial', 'admin bar'),
    'add_new' => _x('Add New', 'add new'),
    'add_new_item' => __('Add New Testimonial'),
    'new_item' => __('New Testimonial'),
    'edit_item' => __('Edit Testimonial'),
    'view_item' => __('View Testimonial'),
    'all_items' => __('All Testimonial'),
    'search_items' => __('Search Testimonial'),
    'not_found' => __('No Testimonial found.'),
    );

     $testimonial = array (
        'supports' => $supports,
		'labels' => $labels,
        'public' => true,
        'taxonomies' => array( 'category', 'post_tag'),
        'show_ui' => true,
        'show_in_menus' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'testimonial'),
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-welcome-write-blog',


     );

     register_post_type( 'testimonial', $testimonial);
}


//Shortcode


add_shortcode('our-shortcode', 'shortcodeCode');

function shortcodeCode(){
	
		$postitle = array (
			'post_type' => 'post'
		);	  
	$test = "";
		$alltitles = new WP_Query($postitle);
		
		while($alltitles->have_posts()) {
			$alltitles->the_post();
           
		
		 $test .="<div class='main'>
		        <div class='short-title'>
					<a href='".get_the_permalink()."'>".get_the_title()."</a>
				<div/>

			    <div class='short-content'>

					<div class='short-tumbnail'>
					".get_the_post_thumbnail()."
					</div>

					<div class='short-text'>
					".get_the_excerpt()."
					</div>

				<div/>
			  </div>";
		}
	wp_reset_query();
	return $test;
	}
	





 