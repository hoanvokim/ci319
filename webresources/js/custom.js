$(window).load(function () {
    $("#loading").fadeOut();
})

$(document).ready(function ($) {

    /*==========================*/
    /* Nav */
    /*==========================*/
    $('.nav-menu-icon a').on('click', function () {
        if ($('nav').hasClass('slide-menu')) {
            $('nav').removeClass('slide-menu');
            $(this).removeClass('active');
        } else {
            $('nav').addClass('slide-menu');
            $(this).addClass('active');
        }
        return false;
    });

    /*==========================*/
    /* feature box same height */
    /*==========================*/
    var maxHeight = 0;
    $(function () {


        $(".feature-box.slick-slide").each(function () {
            if ($(this).height() > maxHeight) {
                maxHeight = $(this).height();
            }
        });

        $(".feature-box.slick-slide").height(maxHeight);

    });

    /*==========================*/
    /* Tooltip */
    /*==========================*/
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    /*==========================*/
    /* Masonry */
    /*==========================*/
    $(function () {
        var self = $("#masonry");

        self.imagesLoaded(function () {
            self.masonry({
                gutterWidth: 15,
                isAnimated: true,
                itemSelector: ".grid-item"
            });
        });

        $("ul.project-category li a").click(function (e) {
            e.preventDefault();
            $('ul.project-category li a').removeClass('active');
            $(this).addClass('active');
            var filter = $(this).attr("data-filter");

            self.masonryFilter({
                filter: function () {
                    if (!filter) return true;
                    return $(this).attr("data-filter") == filter;
                }
            });
        });
    });

    /*==========================*/
    /* Page Animation */
    /*==========================*/

    if ($(".animsition").length) {
        $(".animsition").animsition({
            inClass: 'zoom-in-sm',
            outClass: 'zoom-out-sm',
            inDuration: 1000,
            outDuration: 1000,
            linkElement: 'a:not([target="_blank"]):not([href^=#]):not([href^=tel]):not([href^=mailto])',
            // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
            loading: false,
            loadingParentElement: 'body',
            loadingClass: 'animsition-loading',
            unSupportCss: ['animation-duration',
                '-webkit-animation-duration',
                '-o-animation-duration'
            ],
            overlay: false,

            overlayClass: 'animsition-overlay-slide',
            overlayParentElement: 'body'
        });
    }

    /*==========================*/
    /* Google Map */
    /*==========================*/
    if ($('#map-canvas').length != 0) {
        var map;

        function initialize() {
            var mapOptions = {
                zoom: 10,
                scrollwheel: false,
                center: new google.maps.LatLng(25.932884, 83.569633),
                styles: [
                    {
                        "stylers": [{hue: "#000000"},
                            {saturation: -100},
                            {lightness: -5}]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels",
                        "stylers": [{"visibility": "off"}]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [{"lightness": 100},
                            {"visibility": "simplified"}]
                    }
                ]
            };
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var image = 'include/images/map-marker.png';
            var myLatLng = new google.maps.LatLng(25.932884, 83.569633);
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    }


    /*==========================*/
    /* Scroll to */
    /*==========================*/

    $('.intro-scroll-down').click(function () {
        $('html, body').animate({
            scrollTop: $(".main-container").offset().top - 60
        }, 500);
        return false;
    })

    /*==========================*/
    /* Sliders */
    /*==========================*/


    $('.recent-projects-slider').slick({
        dots: true,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        adaptiveHeight: true,
        touchMove: true
    });
    
    $('.recent-projects-slider2').slick({
        dots: true,
        infinite: true,
        speed: 2000,
        slidesToShow: 4,
        adaptiveHeight: true,
        touchMove: true,
        autoplay: true,
        autoplaySpeed: 2000
    });

    $('.projects-slider').slick({
        dots: true,
        infinite: true,
        speed: 1200,
        slidesToShow: 1,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 1400,
        pauseOnHover: false,
        touchMove: true,
        arrows: false

    });
    
    $('.feature-slider').slick({
        autoplay: true,
        dots: false,
        infinite: true,
        speed: 200,
        slidesToShow: 4,
        touchMove: true
    });


    $('.slider').slick({
        autoplay: true,
        dots: true,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        adaptiveHeight: true,
        touchMove: true
    });

    $('.banner-slider').slick({
        autoplay: true,
        dots: true,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        adaptiveHeight: false,
        pauseOnHover: false,
        autoplaySpeed: 4000
    });


    $('.text-rotator').slick({
        autoplay: true,
        dots: true,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        adaptiveHeight: false,
        pauseOnHover: false,
        autoplaySpeed: 4000
    });


    $('.screen-slider').slick({
        dots: true,
        autoplay: true,
        infinite: true,
        speed: 700,
        slidesToShow: 1,
        adaptiveHeight: true
    });


    /*==========================*/
    /* Accordion */
    /*==========================*/

    $('.accordion-panel .panel-title').click(function () {
        if (!$(this).closest('.accordion-panel').hasClass('open')) {

            $(this).closest('.accordion-container').find('.accordion-panel').removeClass('open');
            $(this).closest('.accordion-panel').addClass('open');
            $(this).closest('.accordion-container').find('.accordion-panel .panel-body').stop().slideUp();
            $(this).closest('.accordion-panel').find('.panel-body').stop().slideDown();

        }

        else {
            $(this).closest('.accordion-container').find('.accordion-panel').removeClass('open');
            $(this).closest('.accordion-container').find('.accordion-panel .panel-body').stop().slideUp();
        }
    });

});


/*==========================*/
/* Animated Number  */
/*==========================*/
$(window).scroll(function () {

    if ($('.stat-box').length) {
        $('.stat-box').not('.animated').each(function () {
            if ($(window).scrollTop() >= $(this).offset().top - $(window).height()) {
                $(this).addClass('animated').find('.timer').countTo({
                    from: 0
                });
            }

        });
    }
});


/*==========================*/
/* Mobile Nav */
/*==========================*/
if ($(window).width() < 1051) {

    $('nav ul li a').click(function () {
        $(this).next('ul').toggle();
        $(this).toggleClass('active');

    });
}