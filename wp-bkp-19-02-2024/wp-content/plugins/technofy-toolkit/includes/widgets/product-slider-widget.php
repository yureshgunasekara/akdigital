<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor product-slider Widget.
 *
 * Elementor widget that uses the product-slider control.
 *
 * @since 1.0.0
 */
class Elementor_Product_Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve product-slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'product-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve product-slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Product Slider', 'elementor-product-slider-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve product-slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel-loop';
	}

	/**
	 * Register product-slider widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		  
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-services-slider-control' ),
				'type' => \Elementor\Controls_Manager::TAB_CONTENT,
				
			]
		);
		
		
		$slides_to_show = range( 1 , 5 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => esc_html__( 'Slides to show', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'elementor' ),
				] + $slides_to_show,
				'condition' => [
					'slides_to_show!' => '0',
				],
				'default' => 5,
				'frontend_available' => true,
			]
			);
		
	


		$this->end_controls_section();




        $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Content', 'elementor-services-slider-control' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Title Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'text_align',
			[
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .product-heading'   => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_color3',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'margin',
			[
				'label' => esc_html__( 'Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .product-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_color2',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text-size-18' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .text-size-18' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_align',
			[
				'label' => esc_html__( 'Alignment', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'textdomain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'textdomain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'textdomain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .text-size-18'   => 'text-align: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fa-arrow-right' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'border-radius',
			[
				'label' => esc_html__( 'Image Radius', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .img-fluid' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background overlay',
				'types' => [ 'classic', 'gradient','video' ],
				'selector' => '{{WRAPPER}} .mb-0',
			]
		);
		$this->add_control(
			'icon_color1',
			[
				'label' => esc_html__( 'Image Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fa-arrow-right' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_color2',
			[
				'label' => esc_html__( 'Image Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .overlay-image:before ' => 'color: {{VALUE}}',
				],
			]
		);


	
        
		$this->end_controls_section();

		$this->start_controls_section(
			'info_sectio',
			[
				'label' => esc_html__( 'Button Color', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .mb-0',
			]
		);
		
		// $this->add_responsive_control(
		// 	'icon_align',
		// 	[
		// 		'label' => esc_html__( 'Alignment', 'textdomain' ),
		// 		'type' => \Elementor\Controls_Manager::CHOOSE,
		// 		'options' => [
		// 			'left' => [
		// 				'title' => esc_html__( 'Left', 'textdomain' ),
		// 				'icon' => 'eicon-text-align-left',
		// 			],
		// 			'center' => [
		// 				'title' => esc_html__( 'Center', 'textdomain' ),
		// 				'icon' => 'eicon-text-align-center',
		// 			],
		// 			'right' => [
		// 				'title' => esc_html__( 'Right', 'textdomain' ),
		// 				'icon' => 'eicon-text-align-right',
		// 			],
		// 		],
		// 		'default' => 'center',
		// 		'toggle' => true,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .fa-arrow-right '   => 'text-align: {{VALUE}};',
		// 		],
		// 	]
		// );
      
		$this->end_controls_section();
	
	}


	/**
	 * Render product-slider widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>




<?php
		//  var_dump($settings );
    $args = array(
		'post_type'=> 'studies',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'ASC',
		'posts_per_page' => -1 // this will retrive all the post that is published 
		);
		
		$result = new WP_Query( $args );
		if ( $result-> have_posts() ) {
			?>
		<div id="owl-product" class="owl-carousel owl-theme">
				<?php

					while ( $result->have_posts() ){ 
						
						
						$result->the_post();
						$url = wp_get_attachment_url( get_post_thumbnail_id(), "envato_tk_post_meta" );
						$categories = get_the_category();
						$meta = get_post_meta(get_the_ID(),'envato_tk_post_meta', true);
						
						?>
						<div class="item">
								<div class="services_box_content">
										<div class="services_box_lower_portion">
										<div class="overlay-image">
											<figure class="mb-0">
												<img src="<?php echo $meta ?>" alt="" class="img-fluid">
											</figure>
											
					                    </div>	
										
											<div class="content-outer">
												<div class="content-inner">
														<span class="product-category"> <?php if ( !empty( $categories ) ) {
														  echo esc_html( $categories[0]->name );} ?>
														</span>	
														<h5 class="product-heading"><?php the_title(); ?></h5>
														<div class="product-content text-size-18">
														<?php echo wp_trim_words( get_the_content(), 4 )?>
														</div>
												</div>		
												<div class="btn_wrapper">
												  <a href="<?php echo get_post_permalink(); ?>" class="text-decoration-none"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
														viewBox="0 0 17.19 13" style="enable-background:new 0 0 17.19 13;" xml:space="preserve">
															<style type="text/css">
																.st0{fill:none;stroke:#FFFFFF;stroke-linecap:round;stroke-miterlimit:10;}	
															</style>
																	<line class="st0" x1="0.49" y1="6.5" x2="16.48" y2="6.5"/>
																	<polyline class="st0" points="10.48,0.5 16.48,6.5 10.48,12.5 "/>
															</svg>
												</a>
											    </div>
											</div>
										</div>
								</div>   
						</div>	
						
					<?php	
					}   	
				}
				?>
		</div>
		<script>
			var screen_to_show = '<?=$settings['slides_to_show'] ?>';
			var screen_to_show_laptop = '<?=$settings['slides_to_show_laptop'] ?>';
			var screen_to_show_tablet = '<?=$settings['slides_to_show_tablet'] ?>';
			var screen_to_show_mobile = '<?=$settings['slides_to_show_mobile'] ?>';
			

		</script>
    
		
        <?php
	}

}