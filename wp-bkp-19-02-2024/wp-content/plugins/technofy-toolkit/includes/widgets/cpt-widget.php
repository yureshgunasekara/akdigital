<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor cpt Widget.
 *
 * Elementor widget that uses the cpt control.
 *
 * @since 1.0.0
 */
class Elementor_Cpt_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve cpt widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cpt';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve cpt widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Techofy Case Studies', 'elementor-cpt-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve cpt widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel-loop';
	}

	/**
	 * Register cpt widget controls.
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
				'label' => esc_html__( 'Content', 'elementor-cpt-control' ),
				'type' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'number_of_case_studies',
			[
				'label' => __( 'Number of Projects', 'elementor-cpt-control' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 6, // Set a default value
				'min' => 1,
				'max' => 21,
				'step' => 1,
			]
			);
			$this->end_controls_section();
			$this->start_controls_section(
				'color_section',
				[
					'label' => esc_html__( 'Color', 'elementor-cpt-control' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
			$this->add_control(
				'text_color',
				[
					'label'     => esc_html__( 'Text Color', 'elementor-cpt-control' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .case-study-content' => 'color: {{VALUE}}',
					],
				]
			);
			
			// $this->add_control(
			// 	'background_color',
			// 	[
			// 		'label'     => esc_html__( 'Background Color', 'elementor-cpt-control' ),
			// 		'type'      => \Elementor\Controls_Manager::COLOR,
			// 		'selectors' => [
			// 			'{{WRAPPER}} .overlay:hover figur' => 'background-color: {{VALUE}}',
			// 		],
			// 	]
			// );
			$this->add_control(
				'title_color',
				[
					'label' => __( 'Title Color', 'elementor-cpt-control' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .conten-title' => 'color: {{VALUE}}',
					],
				]
			);
          
			$this->end_controls_section();
			
	}
	/**
	 * Render cpt widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_inline_editing_attributes( 'title_color', 'basic' );
		$this->add_render_attribute( 'title_color', 'class', 'elementor-heading-title' );
		$this->add_render_attribute( 'alignment', 'class', 'your-class' );
		$css = '';
		if ( ! empty( $settings['title_color'] ) ) {
    		$css .= '{{WRAPPER}} h4.elementor-heading-title { color: ' . $settings['title_color'] . '; }';
		}
		if ( ! empty( $settings['alignment'] ) ) {
    		$css .= '{{WRAPPER}} .your-class { text-align: ' . $settings['alignment'] . '; }';
		}
		if ( $css ) {
    		echo '<style>' . $css . '</style>';
		}
		$number_of_case_studies = $settings['number_of_case_studies'];
        ?>
        <?php
    	$args = array(
			'post_type' => 'studies',
			'orderby' => 'ID',
			'post_status' => 'publish',
			'order' => 'ASC',
			'posts_per_page' => $number_of_case_studies,
		);	
		$result = new WP_Query( $args );
		echo '<div class="study-section">';
		if ( $result-> have_posts() ) {
			
			?>
			<?php
				echo '<div class="row">';
				$count=0;
			while ( $result->have_posts() ){ 
				
				$result->the_post();
				$url = wp_get_attachment_url( get_post_thumbnail_id(), "envato_tk_post_meta" );
                $categories = get_the_category();
				$meta = get_post_meta(get_the_ID(),'envato_tk_post_meta', true);
				?>
                
                            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                                <div class="case-box overlay">
                                    <div class="overlay-image">
                                        <figure class="image mb-0">
                                            <img src="<?php echo $meta ?>" alt="" class="">
                                        </figure>
                                    </div>
                                    <div class="content">
                                        <span class="text-white">Development</span>
                                        <h5 class="conten-title"><?php the_title(); ?></h5>
                                        <p class="case-study-content text-size-18"><?php echo wp_trim_words( get_the_content(), 4 )?></p>
                                    <a href="<?php echo get_post_permalink(); ?>"> <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                                  


				<?php
        		$count++;
        		if ($count % 3 == 0) {
            	echo '</div><div class="row">';
        		}
				
            }   
			echo '</div>';
	    }
    
		echo '</div>';
		?>
    	
        <?php
		
	}

}
