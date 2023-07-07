<?php
class Wse_Blog_Elementor_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wse_blog_widget';
	}

	public function get_title() {
		return esc_html__( 'Blog Widget', 'wse-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'hello', 'world' ];
	}

    public function get_style_depends() {
        return array( 'blog-widget-css' );
    }	

	protected function register_controls() {

		// Content Tab Start
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'wse-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'post_limit',
            [
                'label' => __('Post Limit', 'wse-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'separator'=>'before',
            ]
        );

		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Title', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_length',
			[
				'label' => __( 'Title Length', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 8,
				'condition' => [
					'show_title' => 'yes',
				]
			]
		);

		$this->add_control(
			'show_content',
			[
				'label' => esc_html__( 'Content', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'content_limit',
			[
				'label' => __( 'Content Length', 'wse-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 50,
				'condition' => [
					'show_content' => 'yes',
				]
			]
		);

		$this->add_control(
			'show_read_more_btn',
			[
				'label' => esc_html__( 'Read More', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'read_more_txt',
			[
				'label' => __( 'Read More button text', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Read More', 'wse-addon' ),
				'placeholder' => __( 'Read More', 'wse-addon' ),
			]
		);

		$this->end_controls_section();

		// Content Tab Start
		$this->start_controls_section(
			'blog_widget_style',
			[
				'label' => esc_html__( 'Layout Style', 'wse-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'blog_columns',
			[
				'label' => esc_html__( 'Colums', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .blog-grid' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
				],
			]
		);		

		$this->add_responsive_control(
			'blog_column_spacing',
			[
				'label' => esc_html__( 'Columns Spacing', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);		


		// Blog area box shadow
		$this->add_control(
			'popover-toggle',
			[
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label' => esc_html__( 'Box Shadow', 'wse-addon' ),
				'label_off' => esc_html__( 'Default', 'wse-addon' ),
				'label_on' => esc_html__( 'Custom', 'wse-addon' ),
				'return_value' => 'yes',
			]
		);
		
		$this->start_popover();
			$this->add_control(
				'blog_area_box_shadow',
				[
					'label' => esc_html__( 'Box Shadow', 'wse-addon' ),
					'type' => \Elementor\Controls_Manager::BOX_SHADOW,
					'selectors' => [
						'{{WRAPPER}} .blog-post' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
					],
				]
			);				 
		$this->end_popover();

		$this->add_responsive_control(
			'area_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .blog-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->end_controls_section();

		$this->start_controls_section(
			'blog_content_style',
			[
				'label' => esc_html__( 'Content Area', 'wse-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'content_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .blog-post',
			]
		);				

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'padding', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .blog-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .blog-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'blog_category_btn_style',
			[
				'label' => esc_html__( 'Category Button', 'wse-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'blog_cat_typography',
				'selector' => '{{WRAPPER}} .category a',
			]
		);

		$this->add_responsive_control(
			'cat_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'cat_btn_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .category-wrapper span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);			

		$this->add_responsive_control(
			'cat_btn_spacing',
			[
				'label' => esc_html__( 'Spacing', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .category-wrapper span.category:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'cat_btn_style_tabs'
		);
		
			$this->start_controls_tab(
				'cat_btn_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'wse-addon' ),
				]
			);

				$this->add_control(
					'cat_btn_normal_color',
					[
						'label' => esc_html__( 'Button Color', 'wse-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .category a' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'background',
						'types' => [ 'classic', 'gradient', 'video' ],
						'selector' => '{{WRAPPER}} .category-wrapper span',
					]
				);	
			
			$this->end_controls_tab();

			$this->start_controls_tab(
				'cat_btn_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'wse-addon' ),
				]
			);

				$this->add_control(
					'cat_btn_hover_color',
					[
						'label' => esc_html__( 'Button Color', 'wse-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .category:hover a' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'hover_background',
						'types' => [ 'classic', 'gradient', 'video' ],
						'selector' => '{{WRAPPER}} .category:hover',
					]
				);	
			
			$this->end_controls_tab();		
		
		$this->end_controls_tabs();			

		$this->end_controls_section();

		$this->start_controls_section(
			'blog_title_style',
			[
				'label' => esc_html__( 'Title', 'wse-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'blog_title_typography',
				'selector' => '{{WRAPPER}} .blog-title a',
			]
		);

		$this->add_responsive_control(
			'blog_title_padding',
			[
				'label' => esc_html__( 'Padding', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .blog-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_title_margin',
			[
				'label' => esc_html__( 'Margin', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .blog-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'blog_title_style_tabs'
		);
		
			$this->start_controls_tab(
				'blog_title_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'wse-addon' ),
				]
			);

				$this->add_control(
					'blog_title_normal_color',
					[
						'label' => esc_html__( 'Button Color', 'wse-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .blog-title a' => 'color: {{VALUE}}',
						],
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'blog_title_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'wse-addon' ),
				]
			);

				$this->add_control(
					'blog_title_hover_color',
					[
						'label' => esc_html__( 'Button Color', 'wse-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .blog-title a:hover' => 'color: {{VALUE}}',
						],
					]
				);
			
			$this->end_controls_tab();		
		
		$this->end_controls_tabs();		

		$this->end_controls_section();

		$this->start_controls_section(
			'read_more_style',
			[
				'label' => esc_html__( 'Read More', 'wse-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'read_more_typography',
				'selector' => '{{WRAPPER}} a.read-more',
			]
		);

		$this->add_responsive_control(
			'read_more_padding',
			[
				'label' => esc_html__( 'Padding', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} a.read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'read_more_margin',
			[
				'label' => esc_html__( 'Margin', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} a.read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'read_more_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} a.read-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'read_more_style_tabs'
		);
		
			$this->start_controls_tab(
				'read_more_normal_tab',
				[
					'label' => esc_html__( 'Normal', 'wse-addon' ),
				]
			);

				$this->add_control(
					'read_more_normal_color',
					[
						'label' => esc_html__( 'Color', 'wse-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} a.read-more' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'read_more_normal_border',
						'selector' => '{{WRAPPER}} a.read-more',
					]
				);		

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'read_more_normal_background',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} a.read-more',
					]
				);				

			$this->end_controls_tab();

			$this->start_controls_tab(
				'read_more_hover_tab',
				[
					'label' => esc_html__( 'Hover', 'wse-addon' ),
				]
			);

				$this->add_control(
					'read_more_hover_color',
					[
						'label' => esc_html__( 'Button Color', 'wse-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} a.read-more:hover' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'read_more_hover_border',
						'selector' => '{{WRAPPER}} a.read-more:hover',
					]
				);				

				$this->add_group_control(
					\Elementor\Group_Control_Background::get_type(),
					[
						'name' => 'read_more_hover_background',
						'types' => [ 'classic', 'gradient' ],
						'selector' => '{{WRAPPER}} a.read-more:hover',
					]
				);		
			
			$this->end_controls_tab();		
		
		$this->end_controls_tabs();		

		$this->end_controls_section();
	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();
        
        $content_limit =  !empty( $settings['content_limit'] ) ? $settings['content_limit'] : 50;

		$query_args = array(
			'post_type'      		=> 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page' 		=> !empty( $settings['post_limit'] ) ? (int)$settings['post_limit'] : 3,
		);

		$query = new \WP_Query( $query_args ); ?>
		<div class="blog-grid">
		<?php if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				?>
	
				<div class="blog-post">
					<div class="blog-image">
						<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">	
					</div>

					<div class="blog-container">
						<?php 
						$categories = get_the_category();
						if (!empty($categories)) {
							echo '<div class="category-wrapper">';
							foreach ($categories as $category) {
								$category_link = get_category_link($category->cat_ID);
								echo '<span class="category"><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a></span>';
							}
							echo '</div>';
						} ?>					
						<?php if ( $settings['show_title'] ) : 

							$title_length = $settings['title_length'];

							if ( 0 > $title_length ) { ?>
								<h2 class="blog-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
							<?php } else { ?>
								<h2 class="blog-title"><a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), (int)$title_length, '' ); ?></a></h2>
							<?php }

						endif; ?>	

						<?php if ( $settings['show_read_more_btn'] ) : ?>
							<a href="<?php the_permalink(); ?>" class="read-more"><?php echo $settings['read_more_txt']; ?></a>
						<?php endif; ?>		
					</div>	
				</div>

				<?php
			}
			wp_reset_postdata();
		}        
?>
		</div>
		<?php 
	}
}
