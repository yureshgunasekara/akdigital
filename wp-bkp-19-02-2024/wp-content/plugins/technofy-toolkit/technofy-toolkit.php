<?php
/**
 * Plugin Name: Technofy Toolkit
 * Description: Technofy Custom Elementor addon.
 * Plugin URI:  http://designingmedia.com
 * Version:     1.0.0
 * Author:      Designing Media
 * Author URI:  http://designingmedia.com
 * Text Domain: technofy-toolkit 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
define('PLUGIN_BASE_URI', plugin_dir_url( __FILE__ ));

function technofy_toolkit_addon() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\Technofy_Toolkit_Addon\Plugin::instance();

}
add_action( 'plugins_loaded', 'technofy_toolkit_addon' );


// Home URL Shortcode
function HomeURL() {
	return home_url(); 
}
add_shortcode('URL', 'HomeURL');

// Home URL Link Shortcode
function HomeURL1() {    
        $url = preg_replace("(^http?://)", "", home_url() );
        $url = preg_replace("(^https?://)", "", home_url() );
        return $url; 
    }
add_shortcode('url_link', 'HomeURL1');

// Add MetaBox in Page
$prefix = 'dbt_';

$meta_box = array(
    'id' => 'my-meta-box',
    'title' => 'Custom meta box',
    'page' => 'page',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Banner Content',
            'placeholder' => 'Enter Banner Content Here',
            'id' => $prefix . 'text',
            'type' => 'text'
        )
    )
);

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
        switch ($field['type']) {
            case 'text':
                echo '<input placeholder ="',$field['placeholder'],'" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['placeholder'], '" size="30" style="width:97%" />', '<br />';
                break;
            case 'textarea':
                echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>', '<br />';
                break;
            case 'select':
                echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                foreach ($field['options'] as $option) {
                    echo '<option ', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                }
                echo '</select>';
                break;
            case 'radio':
                foreach ($field['options'] as $option) {
                    echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                }
                break;
            case 'checkbox':
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                break;
        }
        echo     '</td><td>',
            '</td></tr>';
    }

    echo '</table>';
}


add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
    global $meta_box;

    // verify nonce
    if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}

// check autosave
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
}



// Woocomerce Cart Short Code

add_shortcode ('woo_cart_but', 'woo_cart_but' );
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
	ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
		<a class="btn nav-link" href="<?php echo $cart_url; ?>">
            <img class="cart-img" src="<?php echo get_template_directory_uri() .'/assets/img/cart-icon.png'?>">
			<span class="badge badge-info"></span>
	    <?php
        if ( $cart_count > 0 ) {
       ?>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php
        }
        ?>
        </a></li>
        <?php
	        
    return ob_get_clean();
 
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count', 10, 1 );
/**
 * Add AJAX Shortcode when cart contents update
 */
function woo_cart_but_count( $fragments ) {
 
    ob_start();
    
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
	<?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php            
    }
        ?></a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}

add_filter( 'wp_nav_menu_top-menu_items', 'woo_cart_but_icon', 10, 2 ); // Change menu to suit - example uses 'top-menu'
/**
 * Add WooCommerce Cart Menu Item Shortcode to particular menu
 */
function woo_cart_but_icon ( $items, $args ) {
       $items .=  '[woo_cart_but]'; // Adding the created Icon via the shortcode already created
       return $items;
}

add_action('wp_ajax_cart_count_retriever', 'cart_count_retriever');
add_action('wp_ajax_nopriv_cart_count_retriever', 'cart_count_retriever');
function cart_count_retriever() {
    global $wpdb;
    echo WC()->cart->get_cart_contents_count();
    wp_die();
}





// Home URL Shortcode
function HomeURL2() {
	return home_url(); 
}
add_shortcode('URL', 'HomeURL');

function postsShortCode(){
	$args = array(
		'post_type'=> 'studies',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'ASE',
		'posts_per_page' => -1 // this will retrive all the post that is published 
		);
		
		$result = new WP_Query( $args );
		if ( $result-> have_posts() ) {
			
			while ( $result->have_posts() ){ 
				
				
				$result->the_post();
				
				?>
				
				<?php
				
				the_title(); 
				the_content(); 
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
			    echo esc_html( $categories[0]->name );}
				get_post_permalink();
				
			
			}
			
		}
		
		wp_reset_postdata();
}

		
add_shortcode('posts_secion','postsShortCode');




// Home URL Shortcode
function HomeURL3() {
	return home_url(); 
}
add_shortcode('URL', 'HomeURL');

function postsShortCode1(){
	$args = array(
		'post_type'=> 'solution',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'ASE',
		'posts_per_page' => -1 // this will retrive all the post that is published 
		);
		
		$result = new WP_Query( $args );
		if ( $result-> have_posts() ) {
			
			while ( $result->have_posts() ){ 
				
				
				$result->the_post();
				
				?>
				
				<?php
				
				the_title(); 
				the_content(); 
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
			    echo esc_html( $categories[0]->name );}
				get_post_permalink();
				
			
			}
			
		}
		
		wp_reset_postdata();
}

		
add_shortcode('posts_secion','postsShortCode');







function postsShortCod(){
	$args = array(
		'post_type'=> 'post',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'DECS',
		'posts_per_page' => -1 // this will retrive all the post that is published 
		);
		
		$result = new WP_Query( $args );
		if ( $result-> have_posts() ) {
			
			while ( $result->have_posts() ){ 
				
				
				$result->the_post();
				
				?>
				<?php
				get_the_date();
				the_title(); 
				the_content(); 
				get_post_permalink();
				
			
			}
			
		}
		
		wp_reset_postdata();
}

		
add_shortcode('posts_sect','postsShortCod');



function cptui_register_my_cpts() {

	function cptui_register_my_cpts_solution() {

		/**
		 * Post Type: Case Studies.
		 */
	
		$labels = [
			"name" => esc_html__( "Case Studies", "technofy" ),
			"singular_name" => esc_html__( "Case Studies", "technofy" ),
		];
	
		$args = [
			"label" => esc_html__( "Case Studies", "technofy" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			"rest_controller_class" => "WP_REST_Posts_Controller",
			"rest_namespace" => "wp/v2",
			"has_archive" => false,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"delete_with_user" => false,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"can_export" => true,
			"rewrite" => [ "slug" => "solution", "with_front" => true ],
			"query_var" => true,
			"supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
			"show_in_graphql" => false,
		];
	
		register_post_type( "solution", $args );
	}
	
	add_action( 'init', 'cptui_register_my_cpts_solution' );
	

	/**
	 * Post Type: Recent Product.
	 */

	$labels = [
		"name" => esc_html__( "Recent Product", "technofy" ),
		"singular_name" => esc_html__( "Studies", "technofy" ),
	];

	$args = [
		"label" => esc_html__( "Recent Product", "technofy" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => [ "slug" => "studies", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
		"taxonomies" => [ "category" ],
		"show_in_graphql" => false,
	];

	register_post_type( "studies", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );
