<?php

class HeroHeading extends \Elementor\Widget_Base {
    public function get_name() {
        return 'hero_heading';
    }

    public function get_title() {
        return esc_html__( 'Hero Heading', 'test-addon' );
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    public function get_categories() {
        return [ 'test_addon' ];
    }

    public function get_keywords() {
        return [ 'hero', 'heading' ];
    }

    public function get_style_depends() {
        return [ 'hero-heading-css' ];
    }

    protected function register_controls() {

        // Content Tab Start

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'test-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'List', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'test-addon' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => esc_html__( 'Item 1', 'test-addon' ),
                    ],
                    [
                        'name'=> 'subtitle',
                        'label' => esc_html__( 'Subtitle', 'test-addon' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                    ],
                    [
                        'name'=>'bg_image',
                        'label' => esc_html__( 'Background Image', 'test-addon' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name'=>'image',
                        'label' => esc_html__( 'Choose Image', 'test-addon' ),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ]
            ],
                'title_field' => '{{{ title }}}'
        ]);


        $this->end_controls_section();


        // Content Tab End




        // Start style tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'test-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->end_controls_section();

        // End style tab

    }

    protected function render() {
        $settings = $this->get_settings_for_display();


        ?>

        <!-- Carousel Start -->
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($settings['list'] as $index => $item) : ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <img class="w-100" src="<?= $item['bg_image']['url'] ?>" alt="Image">
                        <div class="carousel-caption d-flex align-items-center">
                            <div class="container">
                                <div class="row align-items-center justify-content-center justify-content-lg-start">
                                    <div class="col-10 col-lg-7 text-center text-lg-start">
                                        <h6 class="text-white text-uppercase mb-3 animated slideInDown">// <?= $item['subtitle'] ?> //</h6>
                                        <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown"><?= $item['title'] ?></h1>
                                        <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">Learn More<i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                    <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                        <img class="img-fluid" src="<?= $item['image']['url'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->

        <?php

    }
}