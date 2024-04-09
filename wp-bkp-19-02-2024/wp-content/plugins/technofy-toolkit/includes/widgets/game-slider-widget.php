<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor banner-slider Widget.
 *
 * Elementor widget that uses the banner-slider control.
 *
 * @since 1.0.0
 */
class Elementor_Banner_Slider_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve banner-slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'banner-slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve banner-slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Banner Slider', 'elementor-banner-slider-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve banner-slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel-loop';
	}

	/**
	 * Register banner-slider widget controls.
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
				'label' => esc_html__( 'Content', 'elementor-banner-slider-control' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'list_heading', [
				'label' => __( 'Heading', 'elementor-banner-slider-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Heading' , 'elementor-banner-slider-control' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_content', [
				'label' => __( 'Content', 'elementor-banner-slider-control' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'elementor-banner-slider-control' ),
				'label_block' => true,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'list_image',
			[
				'label' => __( 'Media', 'elementor-banner-slider-control' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => PLUGIN_BASE_URI. 'assets/images/banner-slider-default-img.svg' ,
				],
			]
		);
		$repeater->add_control(
			'list_listing', [
				'label' => __( 'Listing', 'elementor-banner-slider-control' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Listing' , 'elementor-banner-slider-control' ),
				'label_block' => true,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'list_button_text_1',
			[
				'label' => esc_html__( 'Button Text 1', 'elementor-banner-slider-control' ),
				'label_block' => true,
				'placeholder' => __( 'Order Now', 'elementor-banner-slider-control' ),
				'default' => __( 'Order Now' , 'elementor-banner-slider-control' ),
				'type' => 'text',
			]
		);
		$repeater->add_control(
			'list_button_link_1',
			[
				'label' => esc_html__( 'Button Link 1', 'elementor-banner-slider-control' ),
				'label_block' => true,
				'placeholder' => __( '#', 'elementor-banner-slider-control' ),
				'default' => __( '#' , 'elementor-banner-slider-control' ),
				'type' => 'text',
			]
		);
		$repeater->add_control(
			'list_button_text_2',
			[
				'label' => esc_html__( 'Button Text 2', 'elementor-banner-slider-control' ),
				'label_block' => true,
				'placeholder' => __( 'Learn More', 'elementor-banner-slider-control' ),
				'default' => __( 'Learn More' , 'elementor-banner-slider-control' ),
				'type' => 'text',
			]
		);
		$repeater->add_control(
			'list_button_link_2',
			[
				'label' => esc_html__( 'Button Link 2', 'elementor-banner-slider-control' ),
				'label_block' => true,
				'placeholder' => __( '#', 'elementor-banner-slider-control' ),
				'default' => __( '#' , 'elementor-banner-slider-control' ),
				'type' => 'text',
			]
		);
		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'elementor-banner-slider-control' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_image' => __( 'Media', 'elementor-banner-slider-control' ),
						'list_heading' => __( 'Heading', 'elementor-banner-slider-control' ),
						'list_content' => __( 'Content', 'elementor-banner-slider-control' ),
						'list_listing' => __( 'Listing', 'elementor-banner-slider-control' ),
						'list_button_text_1' => __( 'Button Text 1', 'elementor-banner-slider-control' ),
						'list_button_link_1' => __( '#', 'elementor-banner-slider-control' ),
						'list_button_text_2' => __( 'Button Text 2', 'elementor-banner-slider-control' ),
						'list_button_link_2' => __( '#', 'elementor-banner-slider-control' ),
					],
					[
						'list_image' => __( 'Media', 'elementor-banner-slider-control' ),
						'list_heading' => __( 'Heading', 'elementor-banner-slider-control' ),
						'list_content' => __( 'Content', 'elementor-banner-slider-control' ),
						'list_listing' => __( 'Listing', 'elementor-banner-slider-control' ),
						'list_button_text_1' => __( 'Button Text 1', 'elementor-banner-slider-control' ),
						'list_button_link_1' => __( '#', 'elementor-banner-slider-control' ),
						'list_button_text_2' => __( 'Button Text 2', 'elementor-banner-slider-control' ),
						'list_button_link_2' => __( '#', 'elementor-banner-slider-control' ),
					],
				],
				'heading_field' => '{{{ list_heading }}}',
			]
		);
	}


	/**
	 * Render banner-slider widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
		<div id="banner_slider" class="carousel slide banner-section" data-ride="carousel">
			<!-- Indicators -->
			<ul class="carousel-indicators">
			<?php
			$count = 0;
			if ( $settings['list'] ) {
				foreach ( $settings['list'] as $item ) {	
			?>	
				<li data-target="#banner_slider" data-slide-to="<?=$count?>" class="<?php if($count==0){echo 'active';} ?>"></li>
			<?php
			$count++;
				}
			}
			?>
			</ul>
			<!-- The slideshow -->
			<div class="banner-slider-inner">
				<div class="carousel-inner">
					<?php
					$count = 0;
					if ( $settings['list'] ) {
						foreach ( $settings['list'] as $item ) {				
							?>
					<div class="carousel-item <?php if($count==0){echo 'active';} ?>">
						<div class="container">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">
									<div class="banner-text">
									<h1 class="text-white"><?php echo $item['list_heading']; ?></h1>
									<p><?php echo strip_tags($item['list_content']) ?></p>
									</div>
									<div class="banner-img">
										<?php
											if( isset($item['list_image']['id']) && !empty( $item['list_image']['id'] ) ){
										?>
											<figure class="home-banner-image">
												<?php echo wp_get_attachment_image( $item['list_image']['id'], 'full' ); ?>
											</figure>
										<?php
											}
											else {
											?>
												<figure class="home-banner-image">
													<img class="img-fluid" src="<?php echo PLUGIN_BASE_URI. 'assets/images/banner-slider-default-img.svg' ?>" alt="">
												</figure>
											<?php
											}
										?>
									</div>
									<div class="banner-listing">
										<?php
										if(empty($item['list_listing'])) {
											?>
											<p><?php echo strip_tags($item['list_listing']) ?></p>
										<?php
										}
										else {
											echo $item['list_listing'];
										}
										?>
										<div class="banner-button list-inline">    
											<div class="primary-button list-inline-item">
												<a href="<?php echo $item['list_button_link_1']; ?>" class="primary-btn button-effect"><?php echo $item['list_button_text_1']; ?></a>
											</div>    
											<div class="secondary-button list-inline-item">  
												<a href="<?php echo $item['list_button_link_2']; ?>" class="secondary-btn button-effect"><?php echo $item['list_button_text_2']; ?></a>
											</div>  
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
			</div>
		</div>
        <?php
	}

}