<?php
/**
 * Author Box.
 *
 * @category   Class
 * @package    ConeBlogWidgets
 * @subpackage WordPress
 */

namespace ConeBlogWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use ConeBlogWidgets\Classes\Helper;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Author Box widget class.
 *
 * @since 1.0.0
 */
class coneblog_Author_Box extends Widget_Base {

	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'coneblog-author-box', plugins_url( '/assets/css/author-box.css', CONEBLOG_WIDGETS ), array(), '1.0.0' );

	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'coneblog_author_box';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Author Box', 'coneblog-widgets' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'coneblog-icon-author-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'coneblog-widgets' );
	}
	
	/**
	 * Enqueue styles.
	 */
	public function get_style_depends() {
		return array( 'coneblog-author-box' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

		/**
		 * The Layout Tab
		 * 
		 */
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => __( 'Layout', 'coneblog-widgets' ),
			)
        );
        $this->add_control(
			'layout',
			array(
				'label'   => __( 'Layout', 'coneblog-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => __( '1', 'coneblog-widgets' ),
				'options' => ['1' => 'Layout 1', '2' => 'Layout 2'],
			)
        );
		$this->add_control(
			'default_shadow',
			array(
				'label'   => __( 'Box Shadow', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'coneblog-widgets' ),
				'label_off' => __( 'No', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'show_avatar',
			array(
				'label'   => __( 'Author Picture', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'show_title',
			array(
				'label'   => __( 'Author Title', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'show_bio',
			array(
				'label'   => __( 'Author Bio', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'show_social',
			array(
				'label'   => __( 'Social Links', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'show_articles',
			array(
				'label'   => __( 'Recent Artices', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'author_id',
			[
				'label' => __( 'Author ID', 'coneblog-widgets' ),
				'description' => __( 'Required to fetch posts of a specific author', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1,
				'condition' => [
					'show_articles' => 'yes'
				]
			]
		);
		$this->add_control(
			'author_posts_limit',
			[
				'label' => __( 'Number of Posts', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 5,
				'condition' => [
					'show_articles' => 'yes'
				]
			]
		);
		$this->end_controls_section();
		/**
		 * The Content
		 * 
		 */
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'coneblog-widgets' ),
			)
        );
		$this->add_control(
			'author_name',
			[
				'label' => __( 'Author Name', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'John Doe.', 'coneblog-widgets' ),
				'placeholder' => __( 'Your Name Here', 'coneblog-widgets' ),
			]
		);
		$this->add_control(
			'author_title',
			[
				'label' => __( 'Job Title', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Founder & CEO', 'coneblog-widgets' ),
				'placeholder' => __( 'Job Title Here', 'coneblog-widgets' ),
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);
		$this->add_control(
			'author_business',
			[
				'label' => __( 'Business/Company Name', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Company', 'coneblog-widgets' ),
				'placeholder' => __( 'Business Name Here', 'coneblog-widgets' ),
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);
		$this->add_control(
			'author_business_url',
			[
				'label' => __( 'Business URL', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-url.com', 'coneblog-widgets' ),
				'show_external' => true,
				'default' => [
					'url' => 'https://your-url.com',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);
		$this->add_control(
			'author_bio',
			[
				'label' => __( 'Description (Bio)', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ultricies tellus eget neque congue, id accumsan lectus tincidunt. Maecenas fermentum lobortis nibh at mollis. Pellentesque eget mollis sapien. Phasellus consequat quis neque a pulvinar.', 'coneblog-widgets' ),
				'placeholder' => __( 'Enter author details/bio  here.', 'coneblog-widgets' ),
				'condition' => [
					'show_bio' => 'yes',
				]
			]
		);
		$this->add_control(
			'avatar',
			[
				'label' => __( 'Profile Picture', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'show_avatar' => 'yes',
				],
				'default' => [
					'url' => CONEBLOG_ASSETS_PATH.'img/avatar.png',
				]
			]
		);
		$this->end_controls_section();
		/**
		 * Social Icons Repeater
		 */
		$this->start_controls_section(
			'section_social_links',
			array(
				'label' => __( 'Social Links', 'coneblog-widgets' ),
				'condition' => [
					'show_social' => 'yes',
				]
			)
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_link', [
				'label' => __( 'URL', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'coneblog-widgets' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-twitter',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'social_links_list',
			[
				'label' => __( 'Repeater List', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_link' => [
                            'url' => 'https://twitter.com',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
						'selected_icon' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_link' => [
                            'url' => 'https://facebook.com',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
						'selected_icon' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands',
						],
					],
					[
						'social_link' => [
                            'url' => 'https://instagram.com',
                            'is_external' => true,
                            'nofollow' => true,
                        ],
						'selected_icon' => [
							'value' => 'fab fa-instagram',
							'library' => 'fa-brands',
						],
					],
				],
			]
		);
		$this->end_controls_section();
		/**
         * Box Styling 
         */
        $this->start_controls_section(
            'coneblog_section_box_style',
            [
                'label' => __('Box Style', 'coneblog-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'author-box-padding',
            [
                'label' => __('Author Box Padding', 'coneblog-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coneblog-author-box ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'top' => '50',
					'right' => '30',
					'bottom' => '50',
					'left' => '30',
					'isLinked' => true,
				]
            ]
		);
		$this->add_control(
            'box_background',
            [
                'label' => __('Background Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .coneblog-author-box' => 'background-color: {{VALUE}};',
                ],

            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'author_box_shadow',
				'label' => __( 'Box Shadow', 'coneblog-widgets' ),
				'selector' => '{{WRAPPER}} .coneblog-author-box',
				'condition' => [
					'default_shadow' => 'yes',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'author_box_border',
				'label' => __( 'Border', 'coneblog-widgets' ),
				'selector' => '{{WRAPPER}} .coneblog-author-box',
			]
		);
		$this->add_responsive_control(
            'author_box_border_radius',
            [
                'label' => __('Border Radius', 'coneblog-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .coneblog-author-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => true,
				],
            ]
		);
		$this->end_controls_section();

		/**
         * Typography
         */
        $this->start_controls_section(
            'coneblog_section_box_typography',
            [
                'label' => __('Typography', 'coneblog-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coneblog_authorbox_name',
                'label' => __('Author Name', 'coneblog-widgets'),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
                'selector' => '{{WRAPPER}} .cb-author-name h3',
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => ['default' => ['size' => 32, 'unit' => 'px']],
				],
				'condition' => [
					'layout' => '1',
				]
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coneblog_authorbox_name_2',
                'label' => __('Author Name', 'coneblog-widgets'),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
                'selector' => '{{WRAPPER}} .cb-author-name h3',
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => ['default' => ['size' => 48, 'unit' => 'px']],
				],
				'condition' => [
					'layout' => '2',
				]
            ]
        );
		$this->add_control(
            'coneblog_authorbox_name_color',
            [
                'label' => __('Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .cb-author-name h3' => 'color: {{VALUE}};',
                ],

            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coneblog_authorbox_title',
                'label' => __('Author Title', 'coneblog-widgets'),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
                'selectors' => [
					'{{WRAPPER}} .cb-author-title',
					'{{WRAPPER}} .cb-author-title a',
				],
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => ['default' => ['size' => 16]],
				],

            ]
        );
		$this->add_control(
            'coneblog_authorbox_title_color',
            [
                'label' => __('Text Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .cb-author-title' => 'color: {{VALUE}};',
                ],

            ]
        );
		$this->add_control(
            'coneblog_authorbox_title_link_color',
            [
                'label' => __('Link Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f6ce2b',
                'selectors' => [
                    '{{WRAPPER}} .cb-author-title a' => 'color: {{VALUE}};',
                ],

            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coneblog_authorbox_bio',
                'label' => __('Author Bio', 'coneblog-widgets'),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
                'selector' => '{{WRAPPER}} .cb-author-bio p',
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_size' => ['default' => ['size' => 13]],
				],

            ]
        );
		$this->add_control(
            'coneblog_authorbox_bio_color',
            [
                'label' => __('Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .cb-author-bio p' => 'color: {{VALUE}};',
                ],

            ]
        );
		$this->end_controls_section();

		/**
         * Avatar
         */
        $this->start_controls_section(
            'coneblog_section_box_avatar',
            [
                'label' => __('Avatar', 'coneblog-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'show_avatar_border',
			array(
				'label'   => __( 'Avatar Border', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'avatar_border',
				'label' => __( 'Border', 'coneblog-widgets' ),
				'selector' => '{{WRAPPER}} .coneblog-author-box .cb-avatar img',
				'fields_options' => [
					'border' => ['default' => 'solid'],
					'color' => ['default' => '#f0f0f0'],
				],
				'condition' => [
					'show_avatar_border' => 'yes',
				]
			]
		);
		$this->add_control(
			'avatar_border_hover',
			[
				'label' => __( 'Hover Color', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .coneblog-author-box:hover .cb-avatar img' => 'border-color: {{VALUE}}',
				],
				'default' => '#f6ce2b',
				'condition' => [
					'show_avatar_border' => 'yes',
				]
			]
		);
		$this->add_responsive_control(
            'avatar_border_radius',
            [
                'label' => __('Border Radius', 'coneblog-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cb-avatar img ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'top' => '50%',
					'right' => '50%',
					'bottom' => '50%',
					'left' => '50%',
					'isLinked' => true,
				],
            ]
		);
		$this->add_responsive_control(
            'avatar_margin',
            [
                'label' => __('Margin', 'coneblog-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .cb-avatar ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default' => [
					'top' => '0px',
					'right' => '0px',
					'bottom' => '15px',
					'left' => '0px',
					'isLinked' => true,
				],
            ]
		);
		$this->end_controls_section();

		/**
         * Social Icons
         */
		$this->start_controls_section(
            'coneblog_section_box_social',
            [
                'label' => __('Social Icons', 'coneblog-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'icons_size',
			[
				'label' => __( 'Icons Size', 'coneblog-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .cb-social-links ul li a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'social_icon_color',
			[
				'label' => __( 'Icon Color', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cb-social-links ul li a' => 'color: {{VALUE}}',
				],
				'default' => '#222222'
			]
		);
		$this->add_control(
			'social_icon_hover_color',
			[
				'label' => __( 'Icon Hover Color', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cb-social-links ul li a:hover' => 'color: {{VALUE}}',
				],
				'default' => '#f6ce2b'
			]
		);
		$this->add_control(
			'social_icon_scale',
			array(
				'label'   => __( 'Scale Effect on Hover', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'coneblog-widgets' ),
				'label_off' => __( 'No', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->end_controls_section();

		/**
         * Recent Articles
         */
		$this->start_controls_section(
            'coneblog_section_box_articles',
            [
                'label' => __('Recent Articles', 'coneblog-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_articles' => 'yes'
				]
            ]
        );
		$this->add_control(
			'articles_section_heading',
			array(
				'label'   => __( 'Section Heading', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'articles_heading_text',
			[
				'label' => __( 'Heading Text', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Recent Articles', 'coneblog-widgets' ),
				'placeholder' => __( 'Type your text here', 'coneblog-widgets' ),
				'condition' => [
					'articles_section_heading' => 'yes'
				]
			]
		);
		$this->add_control(
			'popover_toggle',
			[
				'label' => __( 'Posts Colors', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'coneblog-widgets' ),
				'label_on' => __( 'Custom', 'coneblog-widgets' ),
				'return_value' => 'yes',
			]
		);
		$this->start_popover();
		$this->add_control(
			'posts_normal_color',
			[
				'label' => __( 'Text Color', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cb-author-posts a' => 'color: {{VALUE}}',
				],
				'default' => '#666666'
			]
		);
		$this->add_control(
			'posts_normal_bg_color',
			[
				'label' => __( 'Background Color', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cb-author-posts a' => 'background-color: {{VALUE}}',
				],
				'default' => '#f0f0f0'
			]
		);
		$this->add_control(
			'posts_hover_color',
			[
				'label' => __( 'Hover Text Color', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cb-author-posts a:hover' => 'color: {{VALUE}}',
				],
				'default' => '#f6ce2b'
			]
		);
		$this->add_control(
			'posts_hover_bg_color',
			[
				'label' => __( 'Hover Background Color', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cb-author-posts a:hover' => 'background-color: {{VALUE}}',
				],
				'default' => '#222222'
			]
		);
		$this->end_popover();

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		
		$layout = intval($settings['layout']);

		if($layout == 1){
			$avatar = wp_get_attachment_image( $settings['avatar']['id'], 'thumbnail' );
		} else {
			$avatar = wp_get_attachment_image( $settings['avatar']['id'], 'cb-author-avatar-md' );
		}

		?>
            <div class="coneblog-author-box-container layout-<?php echo esc_attr($layout) ?>">
				
				<?php
					if($layout == 1) {
						include 'includes/author_box/layout-1.php';
					}
					elseif($layout == 2) {
						include 'includes/author_box/layout-2.php';
					}
				?>
                
            </div>
		<?php
	}


}
