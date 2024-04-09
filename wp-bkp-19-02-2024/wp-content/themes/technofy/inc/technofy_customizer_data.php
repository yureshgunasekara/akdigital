<?php
/** 
 * Technofy Customizer data
 */

function technofy_customizer( $data ) {
	$technofy_elementor_template_list = technofy_get_elementor_templates();
	return array(
		'panel' => array ( 
			'id' => 'technofy',
			'name' => esc_html__('Technofy Customizer','technofy'),
			'priority' => 10,
			'section' => array(
				'header_setting' => array(
					'name' => esc_html__( 'Header Topbar Setting', 'technofy' ),
					'priority' => 10,
					'fields' => array(
						array(
							'name' => esc_html__( 'Topbar Swicher', 'technofy' ),
							'id' => 'technofy_topbar_switch',
							'default' => false,
							'type' => 'switch',
							'transport'	=> 'refresh'
						),						
						array(
							'name' => esc_html__( 'Show Button', 'technofy' ),
							'id' => 'technofy_show_header_btn',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Button Text', 'technofy' ),
							'id' => 'technofy_header_btn_text',
							'default' => esc_html__('Sign in','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Button Link', 'technofy' ),
							'id' => 'technofy_header_btn_link',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Button Icon', 'technofy' ),
							'id' => 'technofy_header_btn_icon',
							'default' => esc_html__('fa fa-user-o', 'technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						/** investment button **/	
						array(
							'name' => esc_html__( 'Show Investment Offer Link', 'technofy' ),
							'id' => 'technofy_show_investment_offer_link',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Link Text', 'technofy' ),
							'id' => 'technofy_header_link_text',
							'default' => esc_html__('Technofy Offer','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Link Url', 'technofy' ),
							'id' => 'technofy_header_link_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						/** contact-info **/
						array(
							'name' => esc_html__( 'Show Contact Info', 'technofy' ),
							'id' => 'technofy_show_contact_info',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Email Address', 'technofy' ),
							'id' => 'technofy_header_email',
							'default' => esc_html__('info@gmail.com','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Phone Number', 'technofy' ),
							'id' => 'technofy_header_phone',
							'default' => esc_html__('+97657945737', 'technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						)

					) 
				),
				'technofy_topbar_social_profiles_setting' => array(
					'name' => esc_html__( 'Header Social Profiles', 'technofy' ),
					'priority' => 15,
					'fields' => array(
						array(
							'name' => esc_html__( 'Show Social Profiles', 'technofy' ),
							'id' => 'technofy_show_social_profiles',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Facebook Url', 'technofy' ),
							'id' => 'technofy_topbar_fb_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Twitter Url', 'technofy' ),
							'id' => 'technofy_topbar_twitter_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Linkedin Url', 'technofy' ),
							'id' => 'technofy_topbar_linkedin_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Instagram Url', 'technofy' ),
							'id' => 'technofy_topbar_instagram_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
					) 
				),
				'header_main_setting' => array(
					'name' => esc_html__( 'Header Setting', 'technofy' ),
					'priority' => 20,
					'fields' => array(
						array(
							'name' => esc_html__( 'Choose Header Style', 'technofy' ),
							'id' => 'choose_default_header',
							'type'     => 'select',
							'choices'  => array(
								'header-style-1' => esc_html__( 'Header Style 1', 'technofy' ),
								'header-style-2' => esc_html__( 'Header Style 2', 'technofy' ),
							),
							'default' => 'header-style-2',
							'transport'	=> 'refresh'
						),
						array(
							'name' => esc_html__( 'Header Logo', 'technofy' ),
							'id' => 'logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Black Logo', 'technofy' ),
							'id' => 'seconday_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Retina Logo', 'technofy' ),
							'id' => 'retina_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo@2x.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Retina Black Logo', 'technofy' ),
							'id' => 'retina_secondary_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo-black@2x.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Show Header Search', 'technofy' ),
							'id' => 'technofy_header_search_show',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),	
					) 
				),	
				'page_title_setting'=> array(
					'name'=> esc_html__('Page Title Setting','technofy'),
					'priority'=> 30,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Choose Breadcrumb Style', 'technofy' ),
							'id' => 'choose_default_breadcrumb',
							'type'     => 'select',
							'choices'  => array(
								'breadcrumb-style-1' => esc_html__( 'Breadcrumb Style 1', 'technofy' ),
								'breadcrumb-style-2' => esc_html__( 'default', 'technofy' ),
							),
							'default' => 'breadcrumb-style-1',
							'transport'	=> 'refresh'
						),
						array(
							'name'=>esc_html__('Breadcrumb BG Color','technofy'),
							'id'=>'breadcrumb_bg_color',
							'default'=> esc_html__('#343a40','technofy'),
							'transport'	=> 'refresh'  
						),
						array(
							'name' => esc_html__( 'Page Title Background Image', 'technofy' ),
							'id' => 'breadcrumb_bg_img',
							'default' => '',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb Archive', 'technofy' ),
							'id' => 'breadcrumb_archive',
							'default' => esc_html__('Archive for category','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb Search', 'technofy' ),
							'id' => 'breadcrumb_search',
							'default' => esc_html__('Search results for','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb tagged', 'technofy' ),
							'id' => 'breadcrumb_post_tags',
							'default' => esc_html__('Posts tagged','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb posted by', 'technofy' ),
							'id' => 'breadcrumb_artitle_post_by',
							'default' => esc_html__('Articles posted by','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb Page Not Found', 'technofy' ),
							'id' => 'breadcrumb_404',
							'default' => esc_html__('Page Not Found','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb Page', 'technofy' ),
							'id' => 'breadcrumb_page',
							'default' => esc_html__('Page','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),			
						array(
							'name' => esc_html__( 'Breadcrumb Shop', 'technofy' ),
							'id' => 'breadcrumb_shop',
							'default' => esc_html__('Shop','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),			
						array(
							'name' => esc_html__( 'Breadcrumb Home', 'technofy' ),
							'id' => 'breadcrumb_home',
							'default' => esc_html__('Home','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),					
					)
				),
				'blog_setting'=> array(
					'name'=> esc_html__('Blog Setting','technofy'),
					'priority'=> 40,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Show Blog BTN', 'technofy' ),
							'id' => 'technofy_blog_btn_switch',
							'default' => 1,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Show Blog Btn Icon', 'technofy' ),
							'id' => 'technofy_blog_btn_icon_switch',
							'default' => 1,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Blog Button text', 'technofy' ),
							'id' => 'technofy_blog_btn',
							'default' => esc_html__('Read More','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),							
						array(
							'name' => esc_html__( 'Blog Button Icon', 'technofy' ),
							'id' => 'technofy_blog_btn_icon',
							'default' => esc_html__('fas fa-angle-double-right','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Blog Title', 'technofy' ),
							'id' => 'breadcrumb_blog_title',
							'default' => esc_html__('Blog','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Blog Details Title', 'technofy' ),
							'id' => 'breadcrumb_blog_title_details',
							'default' => esc_html__('Blog Details','technofy'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),

					)
				),
				'technofy_footer_setting' => array(
					'name'=> esc_html__('Footer Setting','technofy'),
					'priority'=> 60,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Footer Elementor Templates', 'technofy' ),
							'id' => 'choose_elementor_footer',
							'type'     => 'select',
							'choices'  => $technofy_elementor_template_list,
							'transport'	=> 'refresh',
							'required' => ['footer_source_type',
							'=',
							'e'],
						),
						array(
							'name' => esc_html__( 'Choose Footer Style', 'technofy' ),
							'id' => 'choose_default_footer',
							'type'     => 'select',
							'choices'  => array(
								'footer-style-1' => esc_html__( 'Footer Style 1', 'technofy' ),
								'footer-style-2' => esc_html__( 'Footer Style 2', 'technofy' ),
								'footer-style-3' => esc_html__( 'Footer Style 3', 'technofy' ),
							),
							'default' => 'footer-style-1',
							'transport'	=> 'refresh'
						),
						array(
							'name' => esc_html__( 'Footer Background Image', 'technofy' ),
							'id' => 'technofy_footer_bg',
							'default' => '',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name'=>esc_html__('Footer BG Color','technofy'),
							'id'=>'technofy_footer_bg_color',
							'default'=> esc_html__('#f4f9fc','technofy'),
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('Copy Right','technofy'),
							'id'=>'technofy_copyright',
							'default'=> esc_html__('Copyright &copy; Technofy 2023. All rights reserved','technofy'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),	
						array(
							'name'=>esc_html__('Enable Scrollup','technofy'),
							'id'=>'technofy_scrollup_switch',
							'default'=> false,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						),						
						array(
							'name'=>esc_html__('Enable Footer Widgets','technofy'),
							'id'=>'technofy_enable_footer_widgets',
							'default'=> true,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						),	
						array(
							'name'=>esc_html__('Enable Preloader','technofy'),
							'id'=>'technofy_preloader_switch',
							'default'=> false,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						)
					)
				),
				'error_page_setting'=> array(
					'name'=> esc_html__('404 Setting','technofy'),
					'priority'=> 90,
					'fields'=> array(
						array(
							'name'=>esc_html__('400 Text','technofy'),
							'id'=>'technofy_error_404_text',
							'default'=> esc_html__('404','technofy'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('Not Found Title','technofy'),
							'id'=>'technofy_error_title',
							'default'=> esc_html__('Page not found','technofy'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('404 Description Text','technofy'),
							'id'=>'technofy_error_desc',
							'default'=> esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted','technofy'),
							'type'=>'textarea',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('404 Link Text','technofy'),
							'id'=>'technofy_error_link_text',
							'default'=> esc_html__('Back To Home','technofy'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						)
						
					)
				),
			),
		)
	);

}

add_filter('technofy_customizer_data', 'technofy_customizer');


