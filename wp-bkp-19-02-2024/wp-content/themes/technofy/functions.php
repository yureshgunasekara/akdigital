<?php
/**
 * technofy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package technofy
 */
 
/**
 * Define Const for theme Dir
 * @since 1.0.0
 * */
define('TECHNOFY_ROOT_PATH',get_template_directory());
define('TECHNOFY_ROOT_URL',get_template_directory_uri());
define('TECHNOFY_CSS',TECHNOFY_ROOT_URL .'/assets/css');
define('TECHNOFY_JS',TECHNOFY_ROOT_URL .'/assets/js');
define('TECHNOFY_IMG',TECHNOFY_ROOT_URL .'/assets/img');
define('TECHNOFY_INC',TECHNOFY_ROOT_PATH .'/inc');
define('TECHNOFY_THEME_STYLESHEETS',TECHNOFY_INC .'/theme-stylesheets');

/**
 * define theme info
 * @since 1.0.0
 * */
if (is_child_theme()){
	$theme = wp_get_theme();
	$parent_theme = $theme->Template;
	$theme_info = wp_get_theme($parent_theme);
}else{
	$theme_info = wp_get_theme();
}
define('TECHNOFY_DEV_MODE',true);
$gazania_version = TECHNOFY_DEV_MODE ? time() : $theme_info->get('Version');
define('TECHNOFY_NAME',$theme_info->get('Name'));
define('TECHNOFY_VERSION',$gazania_version);
define('TECHNOFY_AUTHOR',$theme_info->get('Author'));
define('TECHNOFY_AUTHOR_URI',$theme_info->get('AuthorURI'));

/*
 * include template helper function
 * @since 1.0.0
 * */
if (file_exists(TECHNOFY_INC.'/template-functions.php') && TECHNOFY_INC.'/template-tags.php'){
	require_once  TECHNOFY_INC.'/template-functions.php';
	require_once  TECHNOFY_INC.'/template-tags.php';

	function Technofy_Function($instance){
		$new_instance = false;
		switch ($instance){
			case ("Functions"):
				$new_instance = class_exists('Technofy_Functions') ? Technofy_Functions::getInstance() : false;
				break;
			case ("Tags"):
				$new_instance = class_exists('Technofy_Tags') ? Technofy_Tags::getInstance() : false;
				break;
			default:
				 $new_instance = false;
			break;
		}

		return $new_instance;
	}
}



/*
* Include theme init file
* @since 1.0.0
*/
if ( file_exists(TECHNOFY_INC.'/class-technofy-init.php' ) ) {
	require_once  TECHNOFY_INC.'/class-technofy-init.php';
}

if ( file_exists(TECHNOFY_INC.'/plugins/tgma/activate.php') ) {
	require_once  TECHNOFY_INC.'/plugins/tgma/activate.php';
}		

/**
 * Custom template helper function for this theme.
 */
require_once TECHNOFY_INC . '/template-helper.php';
require_once TECHNOFY_INC . '/technofy_customizer.php';
require_once TECHNOFY_INC . '/technofy_customizer_data.php';



// Move comments textarea to bottom
function gazania_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
add_filter( 'comment_form_fields', 'gazania_move_comment_field_to_bottom' );


/**
 * Nav menu fallback function
 * @since 1.0.0
 */
 function technofy_primary_menu_fallback()
{
    get_template_part('template-parts/default', 'menu');
}


function technofy_block_editor_styles() {
	wp_enqueue_style( 'block-editor-bootstrap', get_theme_file_uri( 'assets/css/block-editor.bootstrap.css' ), array(), null );
	wp_enqueue_style( 'block-editor-theme', get_theme_file_uri( 'assets/css/block-editor.theme.css' ), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'technofy_block_editor_styles', 1, 1 );

/**
* admin js
**/
add_action('admin_enqueue_scripts', 'technofy_admin_custom_scripts');
function technofy_admin_custom_scripts(){
	wp_enqueue_media();
	wp_register_script('technofy-admin-custom', get_template_directory_uri().'/inc/js/admin_custom.js', array('jquery'), '', true);
	wp_enqueue_script('technofy-admin-custom');
}


/**
* shortcode supports for removing extra p, spance etc
*
*/
add_filter( 'the_content', 'technofy_shortcode_extra_content_remove' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function technofy_shortcode_extra_content_remove( $content ) {

    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );

}


/**
 * Nav menu fallback function
 * @since 1.0.0
 */
 function technofy_theme_fallback_menu()
{
    get_template_part('template-parts/default', 'menu');
}


/**
 * Technofy CSS Include
 */
function enqueue_our_required_stylesheet(){
	wp_enqueue_style('load-fa-pro', get_template_directory_uri(). '/assets/fonts/fontawesome-pro-v5.css');
	wp_enqueue_style('load-fa', get_template_directory_uri(). '/assets/fonts/fontawesome-v6.css');
	wp_enqueue_style('roboto-font', get_template_directory_uri() . '/assets/fonts/roboto.css' );
	wp_enqueue_style('technofy-style-css', get_template_directory_uri() . '/assets/css/technofy.css' ); 
	wp_enqueue_style('technofy-responsive-css', get_template_directory_uri() . '/assets/css/technofy-responsive.css' ); 
	wp_enqueue_style('owl-carousel-min', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_our_required_stylesheet' );


/**
 * Natix CSS Include In Footer
 */
function add_css_in_footer() {
	$rtl_class = get_body_class();
	if(in_array('rtl', $rtl_class)) {
		?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/style-rtl.css'?>" type="text/css" media="all">
		<?php
	}
	else {
		?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/style.css'?>" type="text/css" media="all">
		<?php
	}
		?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/assets/css/responsive.css'?>" type="text/css" media="all">
	<?php
}
add_action( 'wp_footer', 'add_css_in_footer', 100 );

function enqueue_theme_styles() {
	wp_register_style( 'header-style', TECHNOFY_CSS . '/style.css', array(), time(), 'all' );
	wp_register_style( 'responsive', TECHNOFY_CSS . '/responsive.css', array(), time(), 'all' );
	
	wp_enqueue_style( 'header-style' );
	wp_enqueue_style( 'responsive' );
	}
	add_action( 'wp_enqueue_scripts', 'enqueue_theme_styles' );
	
/**
 * Technofy CSS Include In Footer
 */



/**
 * Technofy JS Include
 */
function enqueue_load_js() {
	if ( is_page( array( 'vps-servers' ) )) {
        wp_enqueue_script( 'jquery-1.8.3', get_template_directory_uri() . '/assets/js/jquery-1.8.3.js', array(), '1.0.0', true );
    }
	wp_enqueue_script( 'jquery-1.8.3', get_template_directory_uri() . '/assets/js/jquery-1.8.3.js', array(), '1.0.0', true );
	wp_enqueue_script( 'jquery.cycle.all', get_template_directory_uri() . '/assets/js/jquery.cycle.all.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'jquery.slicknav', get_template_directory_uri() . '/assets/js/jquery.slicknav.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'slider', get_template_directory_uri() . '/assets/js/slider.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'custom.min', get_template_directory_uri() . '/assets/js/jquery-ui-1.9.2.custom.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'effects.core', get_template_directory_uri() . '/assets/js/jquery.effects.core.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'vps-def', get_template_directory_uri() . '/assets/js/vps-def.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'vps_sliders', get_template_directory_uri() . '/assets/js/vps_sliders.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'tab2_sliders', get_template_directory_uri() . '/assets/js/tab2_sliders.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'tab3_sliders', get_template_directory_uri() . '/assets/js/tab3_sliders.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '', true );
	wp_localize_script( 'custom', 'TechnofyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'HOME_URL'=> home_url() ));  
	wp_enqueue_script( 'owlcarousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'slider-post', get_template_directory_uri() . '/assets/js/sliderpost.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'blog-slider-post', get_template_directory_uri() . '/assets/js/blogslider.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'service-slider-post', get_template_directory_uri() . '/assets/js/serviceslider.js', array( 'jquery' ), '', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_load_js' );


/**
 * Function For Elementor Global Colors after import.
 */
add_action('akd_elementor_global', 'technofy_elementor_global_setup');
function technofy_elementor_global_setup()
{
    $technofy_elementor_kit = apply_filters('technofy_elementor_global', false);
    if ($technofy_elementor_kit)
    {
        esc_attr($technofy_elementor_kit);
    }
}


/**
 * Get Elementor Template list
 */
function technofy_get_elementor_templates()
{
    $args = array(
        'post_type' => 'elementor_library',
        'post_status' => 'publish',
    );
    $technofy_the_query = new WP_Query($args);
    $technofy_elementor_posts = array();
    if ($technofy_the_query->have_posts()):
        foreach ($technofy_the_query->posts as $technofy_post):
            $technofy_elementor_posts[$technofy_post->ID] = apply_filters('the_title', get_the_title($technofy_post));
        endforeach;
    endif;
    return $technofy_elementor_posts;
}


// Add product title in Woocoomerce single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
function woocommerce_template_single_title_custom()
{
    the_title( '<h3 class="product_title entry-title">',' </h3>' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title_custom', 5);