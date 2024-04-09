<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor service-slider Widget.
 *
 * Elementor widget that uses the service-slider control.
 *
 * @since 1.0.0
 */
class Elementor_Service_Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve service-slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'service-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve service-slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'service Slider', 'elementor-service-slider-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve service-slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel-loop';
	}

	/**
	 * Register service-slider widget controls.
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
		
		
		$slides_to_show = range( 1 , 4 );
	
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
				'default' => 4,
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
					'{{WRAPPER}} .content-title' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .content-title'   => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_color3',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .service-content' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .service-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .fa-arrow-right:before ' => 'color: {{VALUE}}',
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
				'selector' => '{{WRAPPER}} .fa-arrow-right:before ',
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
	 * Render service-slider widget output on the frontend.
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
	//var_dump($settings );
    $args = array(
		'post_type'=> 'solution',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'ASC',
		'posts_per_page' => -1 // this will retrive all the post that is published 
		);
		
		$result = new WP_Query( $args );
		if ( $result-> have_posts() ) {
			?>
		<div id="owl-service3" class="owl-carousel owl-theme">
				<?php

					while ( $result->have_posts() ){ 
						
						
						$result->the_post();
						$url = wp_get_attachment_url( get_post_thumbnail_id(), "envato_tk_post_meta" );
						$categories = get_the_category();
						$meta = get_post_meta(get_the_ID(),'envato_tk_post_meta', true);
						
						?>
						<div class="item service-sect">										
				        	<div class="service-box box-mb">
								<div class="img-sec">
									<figure class="service-marketicon">
										<img src="<?php echo $meta ?>" alt="" class="img-fluid">
									</figure>
					            </div>	
									<div class="content-sec">
											<h4 class="content-title"><?php the_title(); ?></h4>
											<p class="text-size-18 service-content"><?php echo wp_trim_words( get_the_content(), 10 )?></p>
							        </div>
									<div class="arrow-sec">
					     				<a class="arrow text-decoration-none" href="<?php echo get_post_permalink(); ?>">
											 <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
						
					<?php	
					}   	
				}
				?>
		</div>
		<script>
			var screen_to_show3 = '<?=$settings['slides_to_show'] ?>';
			var screen_to_show_laptop3 = '<?=$settings['slides_to_show_laptop'] ?>';
			var screen_to_show_tablet3 = '<?=$settings['slides_to_show_tablet'] ?>';
			var screen_to_show_mobile3 = '<?=$settings['slides_to_show_mobile'] ?>';
			
			

		</script>
    
		
        <?php
	}

}