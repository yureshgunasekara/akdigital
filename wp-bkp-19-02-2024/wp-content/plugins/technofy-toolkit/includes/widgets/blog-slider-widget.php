<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor blog-slider Widget.
 *
 * Elementor widget that uses the blog-slider control.
 *
 * @since 1.0.0
 */
class Elementor_Blog_Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve blog-slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'blog-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve blog-slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'blog Slider', 'elementor-blog-slider-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve blog-slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel-loop';
	}

	/**
	 * Register blog-slider widget controls.
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
		
		
		$slides_to_show = range( 1, 3 );
		$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
		$this->add_responsive_control(
			'slides_to_show1',
			[
				'label' => esc_html__( 'Slides to show', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'elementor' ),
				] + $slides_to_show,
				'condition' => [
					'slides_to_show1!' => '1',
				],
				'default' => 3,
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
			'text_colorr',
			[
				'label' => esc_html__( 'Title Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading-txt' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .heading-txt'   => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-contents' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .blog-contents' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'text_colors',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read_more' => 'color: {{VALUE}}',
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
		

        
		$this->end_controls_section();

		$this->start_controls_section(
			'info_sectio',
			[
				'label' => esc_html__( 'Button Color', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_color3',
			[
				'label' => esc_html__( 'Text Color', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .read_more' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'content_align3',
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
					'{{WRAPPER}} .read_more'   => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		
	}


	/**
	 * Render blog-slider widget output on the frontend.
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
		'post_type'=> 'post',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'ASC',
		'posts_per_page' =>-1 // this will retrive all the post that is published 
		);
		
		$result = new WP_Query( $args );
		
		if ( $result-> have_posts() ) {
			?>
		<div id="owl-blog2" class="owl-carousel owl-theme">
				<?php

					// global $post_date;
					$count = 0;
					while ( $result->have_posts() ){ 
						
						
						
						$result->the_post();
						$url = wp_get_attachment_url( get_post_thumbnail_id(), "thumbnail" );
						$meta = get_post_meta(get_the_ID(),'envato_tk_post_meta', true);
					
						?>
						<div class="item blog-sect">
							<div class="blog_boxcontent">
									<div class="upper_portion">
										<figure class="mb-0"><img src="<?php echo $meta ?>" alt="" class="img-fluid blog-post-img"></figure>
										<div class="image_content">
											<div class="content">
											<div class="btn_wrapper">
													<span class="date-content"><?=get_the_date('d')?></span></br>
													<span class="month-content"><?=get_the_date('M')?></span>
												  
											    </div>
											
			
											</div>
										</div>
									</div>
									<div class="lower_portion_wrapper">
										<div class="lower_portion">
											<h4 class="heading-txt"><?php the_title(); ?></h4>
											<p class="blog-contents text-size-18"><?php echo wp_trim_words( get_the_content(), 10 )?></p>
											<a class="read_more text-decoration-none" href="<?php echo get_post_permalink(); ?>">Read More
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
								
						</div>		
					<?php	
						$count++;
					}   	
				}
				?>
		</div>
		<script>
			var screen_to_show2 = '<?=$settings['slides_to_show1'] ?>';
			var screen_to_show_laptop2 = '<?=$settings['slides_to_show1_laptop'] ?>';
			var screen_to_show_tablet2 = '<?=$settings['slides_to_show1_tablet'] ?>';
			

		</script>
    


        <?php
	}

}