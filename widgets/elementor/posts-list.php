<?php
/**
 * Posts List.
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
 * FeaturedGrid widget class.
 *
 * @since 1.0.0
 */
class coneblog_Posts_List extends Widget_Base {

	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'coneblog-posts-list', plugins_url( '/assets/css/posts-list.css', CONEBLOG_WIDGETS ), array(), '1.0.0' );

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
		return 'coneblog_posts_list';
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
		return __( 'Posts List', 'coneblog-widgets' );
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
		return 'coneblog-icon-posts-list';
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
		return array( 'coneblog-posts-list' );
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
		$post_types = Helper::coneblog_get_post_types();
		$taxonomies = get_taxonomies([], 'objects');

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
				'label'   => __( 'List Layout', 'coneblog-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => __( '1', 'coneblog-widgets' ),
				'options' => ['1' => 'Layout 1', '2' => 'Layout 2'],
			)
		);
		$this->add_control(
			'show_widget_head',
			array(
				'label'   => __( 'Widget Heading', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'heading_layout',
			array(
				'label'   => __( 'Heading Style', 'coneblog-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => __( '1', 'coneblog-widgets' ),
				'options' => ['1' => 'Style 1', '2' => 'Style 2'],
				'condition' => [ 'show_widget_head' => 'yes' ]
			)
        );
        $this->add_control(
			'widget_head_text',
			array(
				'label'   => __( 'Widget Heading Text', 'coneblog-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Posts List', 'coneblog-widgets' ),
				'condition' => [ 'show_widget_head' => 'yes' ]
			)
		);
		$this->add_control(
			'show_widget_icon',
			array(
				'label'   => __( 'Display Icon', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'heading_icon',
			[
				'label' => esc_html__( 'Select Icon', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [ 'show_widget_icon' => 'yes' ]
			]
		);
		$this->add_control(
			'show_thumb',
			array(
				'label'   => __( 'Post Thumbnail', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'show_term',
			array(
				'label'   => __( 'Post Term', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->add_control(
			'show_meta',
			array(
				'label'   => __( 'Post Meta', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
        );
        $this->add_control(
			'show_excerpt',
			array(
				'label'   => __( 'Post Excerpt', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'coneblog-widgets' ),
				'label_off' => __( 'Hide', 'coneblog-widgets' ),
				'return_value' => 'yes',
				'default' => 'yes',
			)
		);
		$this->end_controls_section();

		/**
		 * The Query Tab
		 * 
		 */
		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query', 'coneblog-widgets' ),
			)
		);

		$this->add_control(
            'post_type',
            [
                'label' => __('Source', 'coneblog-widgets'),
                'type' => Controls_Manager::SELECT,
                'options' => $post_types,
                'default' => key($post_types),
            ]
		);
		foreach ($taxonomies as $taxonomy => $object) {
            if (!isset($object->object_type[0]) || !in_array($object->object_type[0], array_keys($post_types))) {
                continue;
            }

            $this->add_control(
                $taxonomy . '_ids',
                [
                    'label' => $object->label,
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'object_type' => $taxonomy,
                    'options' => wp_list_pluck(get_terms($taxonomy), 'name', 'term_id'),
                    'condition' => [
                        'post_type' => $object->object_type,
                    ],
                ]
            );
        }

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'coneblog-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => '5',
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => __('Offset', 'coneblog-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'coneblog-widgets'),
                'type' => Controls_Manager::SELECT,
                'options' => Helper::coneblog_get_post_orderby_options(),
                'default' => 'date',

            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'coneblog-widgets'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
                'default' => 'desc',

            ]
        );
		$this->end_controls_section();
		/**
         * Widget Head & Thumbnail
         */
		$this->start_controls_section(
            'section_widget_head_thumb',
            [
                'label' => __('Widget Head & Thumbnail', 'coneblog-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'coneblog-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
                    '{{WRAPPER}} .coneblog-widget-head .heading-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
                'condition' => [ 'show_widget_icon' => 'yes' ]
			]
		);
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'coneblog-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
                    '{{WRAPPER}} .coneblog-widget-head .heading-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
                'condition' => [ 'show_widget_icon' => 'yes' ]
			]
		);
		$this->add_responsive_control(
			'thumbnail_width',
			[
				'label' => __( 'Thumbmnail Width', 'coneblog-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 130,
				],
				'selectors' => [
                    '{{WRAPPER}} .coneblog-posts-list.layout-1 .item-thumb' => 'max-width: {{SIZE}}{{UNIT}};',
				],
                'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'show_thumb',
							'operator' => '==',
							'value' => 'yes'
						],
						[
							'name' => 'layout',
							'operator' => '==',
							'value' => '1'
						]
					]
				]
			]
		);
		$this->add_control(
            'coneblog_post_list_widget_head_bg',
            [
                'label' => __('Widget Head Background', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f6ce2b',
                'selectors' => [
                    '{{WRAPPER}} .coneblog-widget-head' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .coneblog-widget-head.style-1 h3' => 'background-color: {{VALUE}};',
                ],

            ]
        );
        $this->add_control(
            'coneblog_post_list_widget_head_text',
            [
                'label' => __('Widget Head Text Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .coneblog-widget-head h3' => 'color: {{VALUE}};',
                ],

            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coneblog_widget_heading_typography',
                'label' => __('Widget Head Typography', 'coneblog-widgets'),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
                'selector' =>
					'{{WRAPPER}} .coneblog-widget-head h3',
            ]
        );
		$this->add_control(
			'thumbnail_border_radius',
			[
				'label' => __( 'Thumbnail Border Radius', 'coneblog-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'	=> [
					'top' => 5,
					'right' => 5,
					'bottom' => 5,
					'left' => 5,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
                    '{{WRAPPER}} .coneblog-posts-list .item-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;'
				],
			]
		);
		$this->end_controls_section();
		/**
         * Typography 
         */
        $this->start_controls_section(
            'coneblog_section_typography',
            [
                'label' => __('Typography', 'coneblog-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'coneblog_post_list_widget_head',
            [
                'label' => __('Widget Head', 'coneblog-widgets'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'coneblog_post_list_title_style',
            [
                'label' => __('Post Content', 'coneblog-widgets'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'coneblog_post_list_title_color',
            [
                'label' => __('Post Title Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .coneblog-posts-list .item-meta .post-title a' => 'color: {{VALUE}};',
                ],

            ]
        );

        $this->add_control(
            'coneblog_post_list_title_hover_color',
            [
                'label' => __('Post Title Hover Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f6ce2b',
                'selectors' => [
                    '{{WRAPPER}} .coneblog-posts-list .item-meta .post-title a:hover' => 'color: {{VALUE}};',
                ],

            ]
        );
		$this->add_control(
            'coneblog_post_meta_color',
            [
                'label' => __('Post Meta Color', 'coneblog-widgets'),
                'type' => Controls_Manager::COLOR,
                'default' => '#8F8F8F',
                'selectors' => [
                    '{{WRAPPER}} .coneblog-posts-list .list-item .list-meta-info' => 'color: {{VALUE}};',
					'{{WRAPPER}} .coneblog-posts-list .list-item .list-meta-info a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .coneblog-posts-list .list-item .list-meta-info i' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_responsive_control(
            'coneblog_post_list_title_alignment',
            [
                'label' => __('Text Alignment', 'coneblog-widgets'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'coneblog-widgets'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'coneblog-widgets'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'coneblog-widgets'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .coneblog-posts-list .item-meta' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .coneblog-posts-list .item-meta .post-title' => 'text-align: {{VALUE}};',
                ],
            ]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coneblog_post_list_title_typography',
                'label' => __('Post Title', 'coneblog-widgets'),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
                'selector' =>
					'{{WRAPPER}} .coneblog-posts-list .item-meta .post-title',
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coneblog_post_list_title_typography_2',
                'label' => __('Post Excerpt', 'coneblog-widgets'),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
                'selector' => '{{WRAPPER}} .coneblog-posts-list .item-meta .post-desc',
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'coneblog_post_list_title_text_shadow',
				'label' => __( 'Text Shadow', 'coneblog-widgets' ),
				'selector' => '{{WRAPPER}} .featured-grid-item .featured-meta-inner h3 a',
			]
		);
        $this->end_controls_section();
        
		/**
         * Post Term
         */
        $this->start_controls_section(
            'coneblog_section_post_term',
            [
                'label' => __('Post Term', 'coneblog-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
		);
		$this->add_control(
			'coneblog_post_term_name_bg',
			[
				'label' => __( 'Term Name Background', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .grid-post-term span.term-name' => 'background-color: {{VALUE}}',
				],
				'default' => '#f6ce2b',
			]
		);
		$this->add_control(
			'coneblog_post_term_name_color',
			[
				'label' => __( 'Term Name Color', 'coneblog-widgets' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .grid-post-term span.term-name' => 'color: {{VALUE}}',
				],
				'default' => '#000000',
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'coneblog_post_term_typography',
                'label' => __('Typography', 'coneblog-widgets'),
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
                'selector' =>
					'{{WRAPPER}} .grid-post-term span.term-name',
            ]
        );
		$this->add_control(
			'coneblog_post_term_border_radius',
			[
				'label' => __( 'Border Radius', 'coneblog-widgets' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'	=> [
					'top' => 2,
					'right' => 2,
					'bottom' => 2,
					'left' => 2,
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
                    '{{WRAPPER}} .grid-post-term span.term-name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
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

		$this->add_inline_editing_attributes( 'layout', 'none' );
		$layout = intval($settings['layout']);

		$args = Helper::coneblog_get_query_args($settings);
		?>
            <div class="coneblog-posts-list-container">
				<?php
                if ( 'yes' === $settings['show_widget_head'] ) { ?>
					<div class="coneblog-widget-head style-<?php echo esc_attr($settings['heading_layout']) ?>">
						<h3>
							<span class="heading-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['heading_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
							<?php echo esc_textarea($settings['widget_head_text']) ?>
						</h3>
					</div>
				<?php } ?>
                <div class="coneblog-posts-list layout-<?php echo esc_attr($layout) ?>">
                    <?php
                    $list_posts = new \WP_Query($args);
                    if($list_posts->have_posts()) {
                        while($list_posts->have_posts()):
                            $list_posts->the_post();
                    ?>
                    <div class="list-item">
						<?php
                		if ( 'yes' === $settings['show_thumb'] ) { ?>
                        <div class="item-thumb">
							<a href="<?php the_permalink()?>">
                            <?php
                            if(has_post_thumbnail()):
                                the_post_thumbnail('coneblog-classic-thumb');
                            else:
                                echo '<img src="'.esc_url(CONEBLOG_ASSETS_PATH).'img/thumb-classic.png">';
                            endif;
                            ?>
							</a>
                            <?php
                                if ( 'yes' === $settings['show_term'] ) {
                                    Helper::coneblog_post_term_box();
                                }
                            ?>
						</div>
						<?php } ?>
                        <div class="item-meta">
                            <h4 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                            <p class="post-desc">
                                <?php
                                if ( 'yes' === $settings['show_excerpt'] ) {
                                    echo esc_textarea(Helper::coneblog_list_excerpt(15));
                                }
                                
                                ?>
                            </p>
                            <?php
                            if ( 'yes' === $settings['show_meta'] ) { ?>
                                <span class="list-meta-info d-block">
                                    <?php Helper::coneblog_posted_on() ?> <?php Helper::coneblog_entry_comments() ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                    <?php endwhile; }
                        \wp_reset_postdata();
                    ?>
                </div>
                
            </div>
		<?php
	}

}
