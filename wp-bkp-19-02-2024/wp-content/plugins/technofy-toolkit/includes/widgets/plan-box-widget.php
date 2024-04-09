<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor plan-box Widget.
 *
 * Elementor widget that uses the plan-box control.
 *
 * @since 1.0.0
 */
class Elementor_Plan_Box_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve plan-box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'plan-box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve plan-box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Plan Box', 'elementor-plan-box-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve plan-box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	 * Register plan-box widget controls.
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
				'label' => esc_html__( 'Content', 'elementor-plan-box-control' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'elementor-plan-box-control' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => PLUGIN_BASE_URI. 'assets/images/plan-box-default-icon.svg' ,
				],
			]
		);
		$this->add_control(
			'discount',
			[
				'label' => esc_html__( 'Discount', 'elementor-plan-box-control' ),
				'label_block' => true,
				'placeholder' => __( '20% Discount', 'elementor-plan-box-control' ),
				'default' => __( '20% Discount' , 'elementor-plan-box-control' ),
				'type' => 'text',
			]
		);
        $this->add_control(
			'heading',
			[
				'label' => esc_html__( 'Heading', 'elementor-plan-box-control' ),
				'label_block' => true,
				'default' => __( 'Heading' , 'elementor-plan-box-control' ),
				'type' => 'text',
			]
		);
        $this->add_control(
			'paragraph',
			[
				'label' => esc_html__( 'Paragraph', 'elementor-plan-box-control' ),
				'label_block' => true,
				'default' => __( 'Content' , 'elementor-plan-box-control' ),
				'type' => 'text',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'list_image',
			[
				'label' => __( 'Media', 'elementor-plan-box-control' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => PLUGIN_BASE_URI. 'assets/images/plan-box-default-img.svg' ,
				],
			]
		);
		$repeater->add_control(
			'list_title', [
				'label' => __( 'Title', 'elementor-plan-box-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'elementor-plan-box-control' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => __( 'Content', 'elementor-plan-box-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Content' , 'elementor-plan-box-control' ),
				'label_block' => true,
				'show_label' => false,
			]
		);
		$this->add_control(
			'list',
			[
				'label' => __( 'Repeater List', 'elementor-plan-box-control' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_image' => __( 'Item Media', 'elementor-plan-box-control' ),
						'list_title' => __( 'Item Title', 'elementor-plan-box-control' ),
						'list_content' => __( 'Item content', 'elementor-plan-box-control' ),
					],
					[
						'list_image' => __( 'Item Media', 'elementor-plan-box-control' ),
						'list_title' => __( 'Item Title', 'elementor-plan-box-control' ),
						'list_content' => __( 'Item content', 'elementor-plan-box-control' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);
		$this->add_control(
			'dollar-price',
			[
				'label' => esc_html__( 'Dollar-Price', 'elementor-plan-box-control' ),
				'label_block' => true,
				'type' => 'text',
				'placeholder' => __( '$2.', 'elementor-plan-box-control' ),
				'default' => __( '$2.' , 'elementor-plan-box-control' ),
			]
		);
		$this->add_control(
			'cents-price',
			[
				'label' => esc_html__( 'Cents-Price', 'elementor-plan-box-control' ),
				'label_block' => true,
				'placeholder' => __( '99', 'elementor-plan-box-control' ),
				'default' => __( '99' , 'elementor-plan-box-control' ),
				'type' => 'text',
			]
		);
		$this->add_control(
			'month',
			[
				'label' => esc_html__( 'Month', 'elementor-plan-box-control' ),
				'label_block' => true,
				'placeholder' => __( '/mo', 'elementor-plan-box-control' ),
				'default' => __( '/mo' , 'elementor-plan-box-control' ),
				'type' => 'text',
			]
		);
		$this->add_control(
			'button-text',
			[
				'label' => esc_html__( 'Button', 'elementor-plan-box-control' ),
				'label_block' => true,
				'placeholder' => __( 'Order Now', 'elementor-plan-box-control' ),
				'default' => __( 'Order Now' , 'elementor-plan-box-control' ),
				'type' => 'text',
			]
		);
		$this->add_control(
			'button-link',
			[
				'label' => esc_html__( 'Button-Link', 'elementor-plan-box-control' ),
				'label_block' => true,
				'placeholder' => __( '#', 'elementor-plan-box-control' ),
				'default' => __( '#' , 'elementor-plan-box-control' ),
				'type' => 'text',
			]
		);
	}


	/**
	 * Render plan-box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        ?>
		<div class="plan p-xl-5 p-lg-4 p-md-5 p-sm-5 p-4">
			<div class="hosting-text"><?php echo $settings['discount'] ?></div>
			<?php
			if( isset($settings['icon']['id']) && !empty( $settings['icon']['id']) ){
				?>
				<figure class="hosting-img-1 float-xl-none float-lg-none float-md-left float-sm-left">
					<?php echo wp_get_attachment_image( $settings['icon']['id'], 'full' ); ?>
				</figure>
				<?php
			}
			else {
				?>
				<figure class="hosting-img-1 float-xl-none float-lg-none float-md-left float-sm-left">
					<img src="<?php echo PLUGIN_BASE_URI. 'assets/images/plan-box-default-icon.svg' ?>" alt="">
				</figure>
				<?php
			}
			?>
			<h3 class="mb-xl-4 mb-lg-4 mb-md-4 mb-sm-2"><?php echo $settings['heading'] ?></h3>
			<p class="mb-xl-4 mb-lg-4 mb-md-4 mb-sm-4"><?php echo $settings['paragraph'] ?></p>
			<ul class="list-unstyled float-xl-none float-lg-none float-md-left float-sm-left">
				<?php
				if ( $settings['list'] ) {
					foreach ( $settings['list'] as $item ) {				
						?>
						<li>
							<?php
								if( isset($item['list_image']['id']) && !empty( $item['list_image']['id'] ) ){
							?>
								<figure class="float-left hosting-list-icon"><?php echo wp_get_attachment_image( $item['list_image']['id'], 'full' ); ?></figure>
							<?php
								}
								else {
									?>
									<figure class="float-left hosting-list-icon"><img src="<?php echo PLUGIN_BASE_URI. 'assets/images/plan-box-default-img.svg' ?>" alt=""></figure>
									<?php
								}
							?>
							<span class="specs pl-xl-3 pl-lg-3 pl-md-3 pl-sm-3 pl-3"><?php echo $item['list_title']; ?></span>
							<span class="weightage float-right"><?php echo $item['list_content']; ?></span>
						</li>
					<?php
					}
				}
				?>
			</ul>
			<div class="price-outer pt-xl-3">
			<small>Starting at:</small>
			<div class="hosting-pricing">
				<h2 class="mb-xl-2"><?php echo $settings['dollar-price'] ?><span><?php echo $settings['cents-price'] ?></span> <small><?php echo $settings['month'] ?></small></h2>
			</div>
			<div class="hosting-button pt-xl-3 pt-lg-3 pt-md-3 pt-sm-2">
				<a class="hosting-btn button-effect" href="<?php echo $settings['button-link'] ?>"><?php echo $settings['button-text'] ?></a>
				</div>
			</div>
		</div>
        <?php
	}

}