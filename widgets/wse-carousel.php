<?php

class Wse_Carousel_Elementor_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'wse_carousel_widget';
	}

	public function get_title() {
		return esc_html__( 'WSE Carousel', 'wse-addon' );
	}

	public function get_icon() {
		return 'eicon-slider-push';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'Carousel', 'Review Carousel' ];
	}

    public function get_style_depends() {
        return [
            'slick',
            'carousel-widget-css',
        ];
    }

    public function get_script_depends() {
        return [
            'slick',
            'wse-widgets-scripts',
        ];
    }

	protected function register_controls() {

        // Team Content tab Start
        $this->start_controls_section(
            'wse_carousel_content',
            [
                'label' => __( 'Carousel', 'wse-addon' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'carousel_title',
            [
                'label'   => __( 'Title', 'wse-addon' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Title','wse-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'carousel_sub_title',
            [
                'label'   => __( 'Sub Title', 'wse-addon' ),
                'type'    => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Sub Title','wse-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'carousel_image',
            [
                'label' => __( 'Image', 'wse-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'carousel_imagesize',
                'default' => 'large',
                'separator' => 'none',
            ]
        );



        $repeater->start_controls_tabs(
            'style_tabs'
        );
        
        $repeater->start_controls_tab(
            'button_one_tab',
            [
                'label' => esc_html__( 'Button One', 'textdomain' ),
            ]
        );

            $repeater->add_control(
                'button_one',
                [
                    'label' => esc_html__( 'Button Text', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default title', 'textdomain' ),
                    'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
                    'label_block' => true,
                ]
            );        
        
            $repeater->add_control(
                'button_one_link',
                [
                    'label' => esc_html__( 'Link', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( '#', 'textdomain' ),
                    'label_block' => true,
                ]
            );  
        
        $repeater->end_controls_tab();

        
        $repeater->start_controls_tab(
            'button_two_tab',
            [
                'label' => esc_html__( 'Button Two', 'textdomain' ),
            ]
        );
        
            $repeater->add_control(
                'button_two',
                [
                    'label' => esc_html__( 'Button Text', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( 'Default title', 'textdomain' ),
                    'placeholder' => esc_html__( 'Type your title here', 'textdomain' ),
                    'label_block' => true,
                ]
            );        
        
            $repeater->add_control(
                'button_two_link',
                [
                    'label' => esc_html__( 'Link', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__( '#', 'textdomain' ),
                    'label_block' => true,
                ]
            );

        $repeater->end_controls_tab();
        
        $repeater->end_controls_tabs();
        
        $this->add_control(
            'carousel_list',
            [
                'type'    => \Elementor\Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [

                    [
                        'carousel_image_title'        => __('Image Grid Title','wse-addon'),
                    ],

                ],
                'title_field' => '{{{ carousel_image_title }}}',
            ]
        );

        $this->add_control(
            'carousel_on',
            [
                'label'         => __( 'Carousel?', 'wse-addon' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'label_on'      => __( 'On', 'wse-addon' ),
                'label_off'     => __( 'Off', 'wse-addon' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
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

        ?>
        <div class="carousel-container">
            <?php foreach ( $settings['carousel_list'] as $item ): ?>
                
                <div class="carousel-wrap">
                    <h4 class="carousel-sub-title"><?php echo $item['carousel_sub_title']; ?></h4>
                    <h2 class="carousel-title"><?php echo $item['carousel_title']; ?></h2>
                    <div class="carousel-image">
                        <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item, 'carousel_imagesize', 'carousel_image' ); ?>
                    </div>
                    <div class="carousel-buttons">
                        <!-- Button One  -->  
                        <a href="<?php echo $item['button_one_link']; ?>">
                            <?php echo $item['button_one']; ?>
                        </a>     
                        <!-- Button Two  -->
                        <a href="<?php echo $item['button_two_link']; ?>">
                            <?php echo $item['button_two']; ?>
                        </a>         
                    </div>
                </div>
            <?php endforeach;?>
        </div>
		<?php 
	}
}


