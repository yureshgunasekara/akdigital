<?php

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Plugin;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class AKD_Blog_Posts_Widget extends Widget_Base {



	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		wp_register_style('blog-post-css',  plugin_dir_url( __FILE__ )  . '/assets/blog.css');
        wp_enqueue_style('blog-post-css');
	}

    /**
     * Get widget name.
     *
     * Retrieve widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'akd-blog-posts';
    }

    /**
     * Get widget title.
     *
     * Retrieve widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Blog Posts', 'plugin-name' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    // public function get_icon() {
    //     return 'fa fa-code';
    // }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'akd-essentials' ];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

		/** Content Section */
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Number of Posts', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_number_posts',
            [
                'label' => __( 'Show number of posts', 'plugin-name' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
				'max' => 100,
				'default' => 3,
            ]
        );

        $this->end_controls_section();


		/**Styling Section */
		/**Blog Section Styling */
		$this->start_controls_section(
            'blog_section_styling',
            [
                'label' => __( 'Blog Section', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
            'blog_section_width',
            [
                'label' => __('Blog Section Width','akd-essentials'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1140,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-section' => 'width: {{SIZE}}{{UNIT}}!important',

                ],
            ]
        );

		$this->add_control(
            'blog_section_margin',
            [
                'label' => __('Margin', 'akd-essentials'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blog-section' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();


		/**Blog Card Styling */
		$this->start_controls_section(
            'blog_post_style_section',
            [
                'label' => __( 'Blog Post Card', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
            'blog_card_width',
            [
                'label' => __('Card Width','akd-essentials'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-outer' => 'width: {{SIZE}}{{UNIT}}!important',

                ],
            ]
        );

		$this->add_control(
            'blog_section_height',
            [
                'label' => __('Blog Section Height','akd-essentials'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 440,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-outer' => 'min-height: {{SIZE}}{{UNIT}}!important',

                ],
            ]
        );

		$this->add_control(
            'blog_card_margin',
            [
                'label' => __('Margin', 'akd-essentials'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
				'default' => [
					'top' => 10,
					'right' => 15,
					'bottom' => 10,
					'left' => 15,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-outer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
            [
				'name' => 'box_shadow',
                'label' => __('Box Shadow','akd-essentials'),
				'default' => [
					'horizontal' => 0,
					'vertical' => 0,
					'blur' => 117,
					'spread' => 0,
					'color' => 'rgba(196,206,213,0.24)',
				],
                'selector' => '{{WRAPPER}} .blog-outer',

            ]
        );

		$this->add_responsive_control(
            'blog_card_float',
            [
                'label' => __('Float', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',

                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .blog-outer' => 'float: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		/**Blog Title Styling */
		$this->start_controls_section(
            'blog_title_style_section',
            [
                'label' => __( 'Blog Post Title', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		/**Blog Title Styling Normal*/
		$this->start_controls_tabs( 'title_styling' );

		$this->start_controls_tab( 'title_styling_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
            'title_color',
            [
                'label' => __('Title Color','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#00002b',
                'selectors' => [

                    '{{WRAPPER}} .blog-heading h5' => 'color: {{VALUE}}!important',

                ],
            ]

        );

		$this->add_control(
            'title_bg_color',
            [
                'label' => __('Title Background Color','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#fff',
                'selectors' => [

                    '{{WRAPPER}} .blog-outer .blog-heading' => 'background-color: {{VALUE}}!important',

                ],
            ]

        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
            [
				'name' => 'title_typography',
                'label' => __('Title Typography','akd-essentials'),
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 18 ] ],
					'font_family' => [
						'default' => 'Poppins',
					],
					'font_weight' => [
						'default' => '800',
					],
					'line_height' => [ 'default' => [ 'unit' => 'px', 'size' => 24 ] ],
				],
                'selector' => '{{WRAPPER}} .blog-heading h5',
            ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
            [
				'name' => 'title_shadow',
                'label' => __('Title Shadow','akd-essentials'),
                'selector' => '{{WRAPPER}} .blog-heading h5',

            ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
            [
					'name' => 'title_border',
                    'label' => __('Title Border','akd-essentials'),
					'fields_options' => [
						'border' => [
							'default' => 'solid',
						],
						'width' => [
							'default' => [
								'top' => '0',
								'right' => '0',
								'bottom' => '1',
								'left' => '0',
								'isLinked' => false,
							],
						],
						'color' => [
							'default' => '#e6e7f2',
						],
					],
                    'selector' => '{{WRAPPER}} .blog-heading',
            ]
        );
		$this->add_control(
            'blog_title_margin',
            [
                'label' => __('Margin', 'akd-essentials'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-heading h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
            'blog_title_padding',
            [
                'label' => __('Padding', 'akd-essentials'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
				'default' => [
					'top' => 20,
					'right' => 33,
					'bottom' => 25,
					'left' => 29,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-outer .blog-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'blog_title_align',
            [
                'label' => __('Title Align','akd-essentials'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options'=> [
                    'left'=> [
                        'label' => 'Left',
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'=> [
                        'label' => 'Center',
                        'icon'  => 'fa fa-align-center',
                    ],
                    'Right'=> [
                        'label' => 'Right',
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',

            ]
        );
		$this->end_controls_tab();

		/**Blog Title Styling Hover*/
		$this->start_controls_tab( 'title_styling_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
            'title_color_hover',
            [
                'label' => __('Title Color Hover','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#00002b',
                'selectors' => [

                    '{{WRAPPER}} .blog-heading h5:hover' => 'color: {{VALUE}}!important',

                ],
            ]

        );

		$this->add_control(
            'title_bg_color_hover',
            [
                'label' => __('Title Background Color Hover','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#fff',
                'selectors' => [

                    '{{WRAPPER}} .blog-outer .blog-heading:hover' => 'background-color: {{VALUE}}!important',

                ],
            ]

        );

        $this->add_group_control(
                Group_Control_Typography::get_type(),
            [
				'name' => 'title_typography_hover',
                'label' => __('Title Typography','akd-essentials'),
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 18 ] ],
					'font_family' => [
						'default' => 'Poppins',
					],
					'font_weight' => [
						'default' => '800',
					],
					'line_height' => [ 'default' => [ 'unit' => 'px', 'size' => 24 ] ],
				],
                'selector' => '{{WRAPPER}} .blog-heading h5:hover',
            ]
        );

        $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
            [
				'name' => 'title_shadow_hover',
                'label' => __('Title Shadow','akd-essentials'),
                'selector' => '{{WRAPPER}} .blog-heading h5:hover',

            ]
        );

        $this->add_group_control(
                Group_Control_Border::get_type(),
            [
					'name' => 'title_border_hover',
                    'label' => __('Title Border','akd-essentials'),
					'fields_options' => [
						'border' => [
							'default' => 'solid',
						],
						'width' => [
							'default' => [
								'top' => '0',
								'right' => '0',
								'bottom' => '1',
								'left' => '0',
								'isLinked' => false,
							],
						],
						'color' => [
							'default' => '#e6e7f2',
						],
					],
                    'selector' => '{{WRAPPER}} .blog-heading:hover',
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/**End Normal Hover Controls */

		$this->end_controls_section();


		/**Blog Icon Button Styling */
		$this->start_controls_section(
            'blog_icon_style_section',
            [
                'label' => __( 'Blog Post Icon', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		/**Blog Icon Button Styling Normal*/
		$this->start_controls_tabs( 'icon_styling' );
		$this->start_controls_tab( 'icon_styling_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
            'icon_color',
            [
                'label' => __('Icon Button Color','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#fff',
                'selectors' => [

                    '{{WRAPPER}} .blog-heading .circle i' => 'color: {{VALUE}}!important',

                ],
            ]

        );

		$this->add_control(
            'icon_bg_color',
            [
                'label' => __('Icon Button Background Color','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#00c9b7',
                'selectors' => [

                    '{{WRAPPER}} .blog-heading .circle i' => 'background-color: {{VALUE}}!important',

                ],
            ]

        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography_hover',
				'label' => __('Icon Button Typography','akd-essentials'),
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 16 ] ],
					'font_weight' => [
						'default' => '900',
					],
					'line_height' => [ 'default' => [ 'unit' => 'px', 'size' => 40 ] ],
				],
				'selector' => '{{WRAPPER}} .blog-heading .circle i',
			]
		);

		$this->add_control(
            'icon_buttom_align',
            [
                'label' => __('Icon Align','akd-essentials'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options'=> [
                    'left'=> [
                        'label' => 'Left',
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'=> [
                        'label' => 'Center',
                        'icon'  => 'fa fa-align-center',
                    ],
                    'Right'=> [
                        'label' => 'Right',
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',

            ]
        );


		$this->add_control(
            'icon_width_height',
            [
                'label' => __( 'Icon Button Width & Height', 'akd-essentials' ),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __( '<b>Add icon width & height.</b>', 'akd-essentials' ),
                'default' => [
                    'width' => '40',
                    'height' => '40',
                ],
            ]
        );

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __( 'Icon Button Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top' => 50,
					'right' => 50,
					'bottom' => 50,
					'left' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-heading .circle i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		/**Blog Icon Button Styling Hover*/
		$this->start_controls_tab( 'icon_styling_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);
		$this->add_control(
            'icon_color_hover',
            [
                'label' => __('Icon Button Color Hover','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#fff',
                'selectors' => [

                    '{{WRAPPER}} .blog-heading .circle i:hover' => 'color: {{VALUE}}!important',

                ],
            ]

        );

		$this->add_control(
            'icon_bg_color_hover',
            [
                'label' => __('Icon Background Color Hover','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#00c9b7',
                'selectors' => [

                    '{{WRAPPER}} .blog-heading .circle i:hover' => 'background-color: {{VALUE}}!important',

                ],
            ]

        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		/**Blog Author Name Styling */
		$this->start_controls_section(
            'blog_avatar_style_section',
            [
                'label' => __( 'Author Avatar', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
            'author_avatar_padding',
            [
                'label' => __('Margin', 'akd-essentials'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
				'default' => [
					'right' => 13,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-avatar-img img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
            'author_avatar_width',
            [
                'label' => __('Width','akd-essentials'),
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-avatar-img img' => 'width: {{SIZE}}{{UNIT}}!important',

                ],
            ]
        );

		$this->add_responsive_control(
			'avatar_border_radius',
			[
				'label' => __( 'Avatar Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .blog-avatar-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();



		/**Blog Author Name Styling */
		$this->start_controls_section(
            'blog_author_style_section',
            [
                'label' => __( 'Author Name', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		/**Blog Author Name Styling Normal*/
		$this->start_controls_tabs( 'author_styling' );
		$this->start_controls_tab( 'author_styling_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
            'author_text_color',
            [
                'label' => __('Author Name Color','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#00c9b7',
                'selectors' => [

                    '{{WRAPPER}} .blog-content .author-name' => 'color: {{VALUE}}!important',

                ],
            ]

        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'label' => __('Author Name Typography','akd-essentials'),
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 18 ] ],
					'font_family' => [
						'default' => 'Poppins',
					],
					'font_weight' => [
						'default' => '600',
					],
					'line_height' => [ 'default' => [ 'unit' => 'px', 'size' => 24 ] ],
				],
				'selector' => '{{WRAPPER}} .blog-content .author-name',
			]
		);

		$this->add_control(
            'author_name_padding',
            [
                'label' => __('Padding', 'akd-essentials'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
				'default' => [
					'top' => 1,
				],
                'selectors' => [
                    '{{WRAPPER}} .blog-content .author-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_tab();

		/**Blog Author Name Styling Hover*/
		$this->start_controls_tab( 'author_styling_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
            'author_text_color_hover',
            [
                'label' => __('Author Name Color Hover','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#00c9b7',
                'selectors' => [

                    '{{WRAPPER}} .blog-content .author-name:hover' => 'color: {{VALUE}}!important',

                ],
            ]

        );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		/**Blog Date Name Styling */
		$this->start_controls_section(
            'blog_date_style_section',
            [
                'label' => __( 'Publish Date', 'plugin-name' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		/**Blog Author Name Styling Normal*/
		$this->start_controls_tabs( 'date_styling' );
		$this->start_controls_tab( 'date_styling_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
            'date_text_color',
            [
                'label' => __('Date Color','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#45455d',
                'selectors' => [

                    '{{WRAPPER}} .blog-content .publish-date' => 'color: {{VALUE}}!important',

                ],
            ]

        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => __('Date Typography','akd-essentials'),
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 14 ] ],
					'font_family' => [
						'default' => 'Barlow',
					],
					'font_weight' => [
						'default' => '400',
					],
					'line_height' => [ 'default' => [ 'unit' => 'px', 'size' => 24 ] ],
				],
				'selector' => '{{WRAPPER}}  .blog-content .publish-date',
			]
		);

		$this->add_control(
            'date_name_padding',
            [
                'label' => __('Padding', 'akd-essentials'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blog-content .publish-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_tab();

		/**Blog Author Name Styling Hover*/
		$this->start_controls_tab( 'date_styling_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
            'date_text_color_hover',
            [
                'label' => __('Date Color Hover','akd-essentials'),
                'type' => Controls_Manager::COLOR,
				'default' => '#00c9b7',
                'selectors' => [

                    '{{WRAPPER}} .blog-content .publish-date:hover' => 'color: {{VALUE}}!important',

                ],
            ]

        );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

    }

    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

		$number = array(
            'numberposts' => $settings['show_number_posts']
        );

        $all_posts = get_posts( $number );

		?>

		<div class="blog-section">
			<?php

			foreach($all_posts as $post)
			{
				$author_name = get_the_author_meta('display_name', $post->post_author);
				$author_id = $post->post_author;
				$author_img = get_avatar_url( $author_id );
				$icon_demension = $settings['icon_width_height'];
				$icon_width =  $icon_demension['width'];
				$icon_height = $icon_demension['height'];
				?>
				<div class="blog-outer">
					<figure class="blog-thumbnail-img">
						<?php
							if ( has_post_thumbnail($post->ID)) {
								$image_url = get_the_post_thumbnail_url($post->ID, 'full');
						?>
								<img src="<?= $image_url ?>" alt="">
						<?php
						} else{ ?>
									<img src="<?= Utils::get_placeholder_image_src(); ?>" alt="">
						<?php }
						?>
					</figure>
					<div class="blog-heading">
						<a href=" <?= $post->guid ?>"> <h5 style="text-align:<?= $settings['blog_title_align']?>"> <?= $post->post_title ?></h5> </a>
						<div class="circle">
						<a href=" <?= $post->guid ?>"> <i class="fas fa-arrow-right" style="width:<?= $icon_width ?>px; height:<?= $icon_height ?>px; text-align:<?= $settings['icon_buttom_align']?>"></i> </a>
						</div>
					</div>
					<div class="blog-content">
						<figure class="blog-avatar-img">
							<?php if(!empty($author_img))
							{?>
								<img src="<?= esc_url( $author_img ); ?>" alt="">
							<?php }
							else{?>
								<img src="<?= Utils::get_placeholder_image_src(); ?>" alt="" tyle="width:<?= $settings['author_avatar_width']; ?>">
							<?php } ?>
						</figure>
						<span class="author-name"> <?= $author_name ?></span>
						<?php
						$postdate = get_the_date( 'Y-m-d', $post->ID );
						$yrdata= strtotime( $postdate );
						?>
						<span class="publish-date"><?= date('dS F Y', $yrdata); ?></span>
                	</div>
				</div>
			<?php } ?>
		</div>
<?php
    }
}
