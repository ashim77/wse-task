;(function($){
    "use strict";

        // Carousel Handler
        var WseWidgetCarouselHandler = function ($scope, $) {
    
            var carousel_elem = $scope.find( '.carousel-container' ).eq(0);
            if( carousel_elem.length > 0){ carousel_elem[0].style.display='block'; }
            if ( carousel_elem.length > 0 ) {
    
                var settings = carousel_elem.data('settings');
                // var sectionid = settings['sectionid'];
                // var arrows = settings['arrows'];
                // var arrow_prev_txt = settings['arrow_prev_txt'];
                // var arrow_next_txt = settings['arrow_next_txt'];
                // var dots = settings['dots'];
                // var autoplay = settings['autoplay'];
                // var autoplay_speed = parseInt(settings['autoplay_speed']) || 3000;
                // var animation_speed = parseInt(settings['animation_speed']) || 300;
                // var pause_on_hover = settings['pause_on_hover'];
                // var center_mode = settings['center_mode'];
                // var verticalMode = ( settings['vertical_mode'] ) ? settings['vertical_mode'] : false;
                // var slloop = settings['slloop'];
                // var center_padding = settings['center_padding'] ? parseInt( settings['center_padding'] ): 0;
                // var variable_width = settings['variable_width'] ? true : false;
                // var display_columns = parseInt(settings['display_columns']) || 1;
                // var scroll_columns = parseInt(settings['scroll_columns']) || 1;
                // var tablet_width = parseInt(settings['tablet_width']) || 800;
                // var tablet_display_columns = parseInt(settings['tablet_display_columns']) || 1;
                // var tablet_scroll_columns = parseInt(settings['tablet_scroll_columns']) || 1;
                // var mobile_width = parseInt(settings['mobile_width']) || 480;
                // var mobile_display_columns = parseInt(settings['mobile_display_columns']) || 1;
                // var mobile_scroll_columns = parseInt(settings['mobile_scroll_columns']) || 1;

                carousel_elem.slick({
                    // arrows: arrows,
                    // prevArrow: '<button class="htmega-carosul-prev">'+arrow_prev_txt+'</button>',
                    // nextArrow: '<button class="htmega-carosul-next">'+arrow_next_txt+'</button>',
                    // dots: dots,
                    arrows: false,
                    dots: true,
                    centerMode: true,
                    variableWidth: true,
                    infinite: true,
                    // autoplay: autoplay,
                    // autoplaySpeed: autoplay_speed,
                    // speed: animation_speed,
                    fade: false,
                    centerPadding: '60px',
                    // pauseOnHover: pause_on_hover,
                    // slidesToShow: display_columns,
                    slidesToShow: 5,
                    // slidesToScroll: scroll_columns,
                    // centerMode: center_mode,
                    // centerPadding: center_padding+'px',
                    // vertical: verticalMode,
                    // rtl: elementorFrontendConfig.is_rtl,
                    // responsive: [
                    //     {
                    //         breakpoint: tablet_width,
                    //         settings: {
                    //             slidesToShow: tablet_display_columns,
                    //             slidesToScroll: tablet_scroll_columns
                    //         }
                    //     },
                    //     {
                    //         breakpoint: mobile_width,
                    //         settings: {
                    //             slidesToShow: mobile_display_columns,
                    //             slidesToScroll: mobile_scroll_columns
                    //         }
                    //     }
                    // ]
                });                
    
            }
        }

        // Run this code under Elementor.
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction( 'frontend/element_ready/wse_carousel_widget.default', WseWidgetCarouselHandler);
        });
    
    })(jQuery);