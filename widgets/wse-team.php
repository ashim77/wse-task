<?php
class Wse_Team_Elementor_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wse_team_widget';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'wse-addon' );
	}

	public function get_icon() {
		return 'eicon-person';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'Team', 'Team Member' ];
	}

    public function get_style_depends() {
        return array( 'team-widget-css' );
    }	

	protected function register_controls() {

        // Team Content tab Start
        $this->start_controls_section(
            'wse_teamm_content',
            [
                'label' => __( 'Team Member', 'wse-addon' ),
            ]
        );

        $this->add_control(
            'wse_member_image',
            [
                'label' => __( 'Member Photo', 'wse-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'wse_member_imagesize',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'wse_member_name',
            [
                'label' => __( 'Name', 'wse-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Rasel Ahmed',
                'placeholder' => __( 'Rasel Ahmed', 'wse-addon' ),
            ]
        );

        $this->add_control(
            'wse_member_designation',
            [
                'label' => __( 'Designation', 'wse-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'BOSS', 'wse-addon' ),
            ]
        );
            
        $this->add_control(
            'wse_member_dec',
            [
                'label' => __( 'Descriptions', 'wse-addon' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __( 'I am web developer.', 'wse-addon' ),
            ]
        );

		$this->end_controls_section();

        // Social Media tab
        $this->start_controls_section(
            'wse_team_member_social_link',
            [
                'label' => __( 'Social Media', 'wse-addon' ),
            ]
        );

		$this->add_control(
			'wse_social_list',
			[
				'label' => esc_html__( 'Social List', 'wse-addon' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'wse_social_title',
						'label' => esc_html__( 'Title', 'wse-addon' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Social Name' , 'wse-addon' ),
						'label_block' => true,
					],
                    [
                        'name' => 'wse_social_link',
                        'label' => esc_html__( 'Link', 'wse-addon' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => esc_html__( 'https://your-link.com', 'wse-addon' ),
                        'options' => [ 'url', 'is_external', 'nofollow' ],
                        'default' => [
                            'url' => '',
                            'is_external' => true,
                            'nofollow' => true,
                            'custom_attributes' => '',
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'wse_social_icon',
                        'label' => esc_html__( 'Icon', 'wse-addon' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fas fa-circle',
                            'library' => 'fa-solid',
                        ],
                    ],
					[
						'name' => 'list_color',
						'label' => esc_html__( 'Color', 'wse-addon' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
						],
					]
				],
				'default' => [
					[
						'wse_social_title' => esc_html__( 'Facebook', 'wse-addon' )
					],
					[
						'wse_social_title' => esc_html__( 'YouTube', 'wse-addon' )
					],
				],
				'title_field' => '{{{ wse_social_title }}}',
			]
		);        

		$this->end_controls_section();



		// Content Tab Start
		$this->start_controls_section(
			'team_widget_style',
			[
				'label' => esc_html__( 'Layout Style', 'wse-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->end_controls_section();


	}

	protected function render( $instance = [] ) {
		$settings = $this->get_settings_for_display();
        $sectionid = "sid". $this-> get_id();

        ?>
        <div class="team-member">
            <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'wse_member_imagesize', 'wse_member_image' ); ?>
            <?php
                if( !empty($settings['wse_member_name']) ){ ?>
                    <h3><?php echo $settings['wse_member_name']; ?></h3>
                <?php }
                if( !empty($settings['wse_member_designation']) ){ ?>
                    <p class="'designation"><?php echo $settings['wse_member_designation']; ?></p>
                <?php }
                if( !empty($settings['wse_member_dec']) ){ ?>
                    <p class="description"><?php echo $settings['wse_member_dec']; ?></p>
                <?php }
            ?>
            <ul class="social-media-icons">
            <?php foreach ( $settings['wse_social_list'] as $item ) : 
                if ( ! empty( $item['wse_social_link']['url'] ) ) {
                    $this->add_link_attributes( 'wse_social_link', $item['wse_social_link'] );
                } ?>
                <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>" >
                    <a <?php echo $this->get_render_attribute_string( 'wse_social_link' ); ?>>
                    <?php \Elementor\Icons_Manager::render_icon( $item['wse_social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </a>                        
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
		<?php 
	}
}


