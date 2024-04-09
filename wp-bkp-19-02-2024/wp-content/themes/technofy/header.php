<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Technofy
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <?php endif; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'technofy' ); ?></a>

	<?php 
	$technofy_show_header_button = get_theme_mod('technofy_show_header_button');
    $btn_text_from_page = get_post_meta(get_the_ID(), 'button_text_from_page', true);
    if( $btn_text_from_page ){
        $btn_text = get_post_meta(get_the_ID(), 'button_text_from_page', true);
        $btn_link = get_post_meta(get_the_ID(), 'button_url_from_page', true);
    }else{
        $btn_text = get_theme_mod('technofy_header_btn_text', 'free trial');
        $btn_link = get_theme_mod('technofy_header_btn_link', '#');
    }
    // header-search
    $show_header_search = get_theme_mod('technofy_header_search_show', false);
    /** header topbar switcher **/
    $enable_header_topbar = get_theme_mod('technofy_topbar_switch');
    // header_link
    $enable_investment_offer_link = get_theme_mod('technofy_show_investment_offer_link');
    $enable_header_link_text = get_theme_mod('technofy_header_link_text', esc_html__('Technofy Offer', 'technofy'));
    $enable_header_link_url = get_theme_mod('technofy_header_link_url');
    // contact info
    $enable_show_contact_info = get_theme_mod('technofy_show_contact_info');
    $contact_header_email = get_theme_mod('technofy_header_email', esc_html__('info@gmail.com', 'technofy'));
    $contact_header_phone = get_theme_mod('technofy_header_phone', esc_html__('+97657945737', 'technofy')); ?>
    <!-- navbar start -->
    <div class="navbar-area navbar-area-2 style-2 <?php if( empty($enable_header_topbar) ){ esc_attr_e("extra-margin-top", "technofy") ; } ?>">
        <?php 
        $technofy_show_header_button = get_theme_mod('technofy_show_header_button');
    $btn_text_from_page = get_post_meta(get_the_ID(), 'button_text_from_page', true);
    if( $btn_text_from_page ){
        $btn_text = get_post_meta(get_the_ID(), 'button_text_from_page', true);
        $btn_link = get_post_meta(get_the_ID(), 'button_url_from_page', true);
    }else{
        $btn_text = get_theme_mod('technofy_header_btn_text', 'free trial');
        $btn_link = get_theme_mod('technofy_header_btn_link', '#');
    }
    // header-search
    $show_header_search = get_theme_mod('technofy_header_search_show', false);
    /** header topbar switcher **/
    $enable_header_topbar = get_theme_mod('technofy_topbar_switch');
    // header_link
    $enable_investment_offer_link = get_theme_mod('technofy_show_investment_offer_link');
    $enable_header_link_text = get_theme_mod('technofy_header_link_text', esc_html__('Technofy Offer', 'technofy'));
    $enable_header_link_url = get_theme_mod('technofy_header_link_url');
    // contact info
    $enable_show_contact_info = get_theme_mod('technofy_show_contact_info');
    $contact_header_email = get_theme_mod('technofy_header_email', esc_html__('info@gmail.com', 'technofy'));
    $contact_header_phone = get_theme_mod('technofy_header_phone', esc_html__('+97657945737', 'technofy'));
	

	$preLoader = get_theme_mod('technofy_preloader_switch');
    if($preLoader == true) :?>
        <div class="preloader" id="preloader">
            <div class="preloader-inner">
                <div class="spinner">
                    <div class="dot1"></div>
                    <div class="dot2"></div>
                </div>
            </div>
        </div>
    <?php endif;  ?>

    <div class="body-overlay" id="body-overlay"></div>
    <div class="search-popup" id="search-popup">
        <?php get_search_form(); ?>  
    </div>

	<!-- navbar start -->
	<div class="navbar-area navbar-area-2 style-2 <?php if( empty($enable_header_topbar) ){ esc_attr_e("extra-margin-top", "technofy") ; } ?>">
	    <?php 
	    if($enable_header_topbar == true) :?>
	        <div class="navbar-top">
	            <div class="container">
	                <div class="row">
	                    <div class="col-sm-7 text-sm-left text-center">
	                        <?php 
	                        if($enable_show_contact_info == true): ?>
	                            <ul class="topbar-left">
	                                <li class="topbar-single-info"><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_html($contact_header_email); ?>"><?php echo esc_html($contact_header_email); ?></a></li>
	                                <li class="topbar-single-info ml-3 ml-lg-0"><i class="fa fa-phone"></i><a href='tel:<?php echo esc_html($contact_header_phone); ?>'></a><?php echo esc_html($contact_header_phone); ?></li>
	                            </ul>
	                        <?php 
	                        endif; ?>
	                    </div>
	                    <div class="col-sm-5 text-sm-right text-center">
	                        <?php 
	                        if($enable_header_topbar == true) :?>
	                            <ul class="topbar-right float-md-right">
	                                <?php 
	                                if( $enable_investment_offer_link ): ?>
	                                    <li class="topbar-single-info">
	                                        <a href="<?php echo esc_html($enable_header_link_url); ?>" class="d-none d-lg-inline-block"><?php echo esc_html($enable_header_link_text); ?></a>
	                                    </li>
	                                <?php 
	                                endif; ?>
	                                <?php technofy_header_social_profiles(); ?>
	                                <?php technofy_user_login(); ?>
	                            </ul>
	                        <?php 
	                        endif; ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    <?php 
	    endif; ?>
	    <nav class="navbar navbar-area navbar-expand-lg nav-transparent">
	        <div class="container nav-container nav-white">
	            <div class="responsive-mobile-menu">
                    <div class="logo">
                        <?php echo technofy_header_logo(); ?>
                    </div>
	                <button class="s7t-header-menu toggle-btn d-block d-lg-none" data-toggle="collapse" data-target="#technofy_main_menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','technofy'); ?>">
	                    <span class="icon-left"></span>
	                    <span class="icon-right"></span>
	                </button>
	            </div>
                <?php
                    wp_nav_menu(array(
                        'menu' => 'primary-menu',
                        'theme_location' => 'main-menu',
                        'menu_class' => 'navbar-nav',
                        'container' => 'div',
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'technofy_main_menu',
                        'fallback_cb' => 'technofy_theme_fallback_menu',
                    ));
                ?>
	            <?php 
	            if($show_header_search == true) :?>
	                <ul class="right-part-search pr-0">
	                    <li class="search" id="search">
	                        <a href="#"><i class="fa fa-search"></i></a>
	                    </li>
	                </ul>
	            <?php 
	            endif; ?> 
                 <?php 
	            if($show_header_search == true) :?>
	                <ul class="right-part-search pr-0">
	                    <li class="search" id="search">
	                        <a href="#"><i class="fa fa-search"></i></a>
	                    </li>
	                </ul>
	            <?php 
	            endif; ?> 
                 <?php
                    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                        // Yes, WooCommerce is enabled
                        ?>
                            <div class="cart-btn">
                                <?php
                                    // get_header(); 
                                    echo do_shortcode("[woo_cart_but]");
                                ?>
                            </div>
                        <?php
                        } else {
                        // WooCommerce is NOT enabled!
                    }
             ?>
	        </div>

	        </div>
	    </nav>
	</div>




<div id="content" class="site-content">
<?php do_action('technofy_before_main_content'); ?>