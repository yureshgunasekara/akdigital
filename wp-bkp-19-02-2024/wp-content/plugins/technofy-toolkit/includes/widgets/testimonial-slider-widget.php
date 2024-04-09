<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor testimonial-slider Widget.
 *
 * Elementor widget that uses the testimonial-slider control.
 *
 * @since 1.0.0
 */
class Elementor_Testimonial_Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonial-slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'testimonial-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonial-slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'testimonial Slider', 'elementor-testimonial-slider-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve testimonial-slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel-loop';
	}

	/**
	 * Register testimonial-slider widget controls.
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
				'label' => esc_html__( 'Content', 'elementor-testimonial-slider-control' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'list_subheading', [
				'label' => __( 'subHeading', 'elementor-testimonial-slider-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'subHeading' , 'elementor-testimonial-slider-control' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_heading', [
				'label' => __( 'Heading', 'elementor-testimonial-slider-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'First Heading' , 'elementor-testimonial-slider-control' ),
				'label_block' => true,
				'show_label' => false,
			]
		);
        $repeater->add_control(
			'list_content', [
				'label' => __( 'content', 'elementor-testimonial-slider-control' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'content' , 'elementor-testimonial-slider-control' ),
				'label_block' => true,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'list_image',
			[
				'label' => __( 'Media', 'elementor-testimonial-slider-control' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				
			]
		);
		$repeater->add_control(
			'list_name', [
				'label' => __( 'Name', 'elementor-testimonial-slider-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'content' , 'elementor-testimonial-slider-control' ),
				'label_block' => true,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'list_designation', [
				'label' => __( 'Designation', 'elementor-testimonial-slider-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'content' , 'elementor-testimonial-slider-control' ),
				'label_block' => true,
				'show_label' => false,
			]
		);
		
		
		
		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'elementor-testimonial-slider-control' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_subheading' => __( 'subHeading', 'elementor-testimonial-slider-control' ),
						'list_heading' => __( 'Heading', 'elementor-testimonial-slider-control' ),
						'list_content' => __( 'Content', 'elementor-testimonial-slider-control' ),
						'list_image' => __( 'Media', 'elementor-testimonial-slider-control' ),
						'list_name' => __( 'Name', 'elementor-testimonial-slider-control' ),
						'list_designation' => __( 'Designation', 'elementor-testimonial-slider-control' ),
					],
					[
						'list_subheading' => __( 'subHeading', 'elementor-testimonial-slider-control' ),
						'list_heading' => __( 'Heading', 'elementor-testimonial-slider-control' ),
						'list_content' => __( 'Content', 'elementor-testimonial-slider-control' ),
						'list_image' => __( 'Media', 'elementor-testimonial-slider-control' ),
						'list_name' => __( 'Name', 'elementor-testimonial-slider-control' ),
						'list_designation' => __( 'Designation', 'elementor-testimonial-slider-control' ),

					],
				],
				'heading_field' => '{{{ list_heading }}}',
			]
		);
	}


	/**
	 * Render testimonial-slider widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
	<div id="testimonial_slider" class="carousel slide testimonial-section" data-ride="carousel">
			<!-- Indicators -->
			<ul class="carousel-indicators">
			<?php
			$count = 0;
			if ( $settings['list'] ) {
				foreach ( $settings['list'] as $item ) {	
			?>	
				<li data-target="#testimonial_slider" data-slide-to="<?=$count?>" class="<?php if($count==0){echo 'active';} ?>"></li>
			<?php
			$count++;
				}
			}
			?>
			</ul>
			<!-- The slideshow -->
		<div class="testimonial-slider-inner">
			<div class="carousel-inner">
				<?php
					$count = 0;
					if ( $settings['list'] ) {
						foreach ( $settings['list'] as $item ) {				
							?>
							<div class="carousel-item <?php if($count==0){echo 'active';} ?>">
								<div class="container">
									<div class="row">
										<div class="heading" data-aos="fade-right">
											<h6><?php echo $item['list_subheading']; ?></h6>
											<h2><?php echo $item['list_heading']; ?></h2>
										</div>	
										<div class="testimonial-content">
											<p><?php echo $item['list_content']; ?></p>
											<div class="content">
												<div class="circle">
													<figure class="testimonial-quote mb-0">
													<?php echo wp_get_attachment_image( $item['list_image']['id'], 'full' ); ?>
													</figure>
												</div>
												<div class="designation-outer">
													<span class="designation-text"><?php echo $item['list_name']; ?></span>
													<p class="text-size-18 mb-0"><?php echo $item['list_designation']; ?></p>
												</div>
											</div>	
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
			            <div class="arrow-outer">
							    <a class="carousel-control-prev" href="#testimonial_slider" role="button" data-slide="prev">
									<span class="carousel-control-prev-icon" aria-hidden="true">
										<i class="fas fas fa-arrow-left d-flex align-items-center justify-content-center"></i></span>
								</a>
								<a class="carousel-control-next" href="#testimonial_slider" role="button" data-slide="next">
									<span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fas fa-arrow-right d-flex align-items-center justify-content-center"></i></span>
								</a> 
						</div>   
		</div>
	</div>
	

        <?php
	}

}