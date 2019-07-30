// sticky navbar
jQuery(document).ready(function($) {

    var navbar = $('nav'),
        navbarwrapper = $('#wrapper-nav'),
        slide = $('#slide'),
    	distance = navbar.offset().top,
        $window = $(window);

    $window.scroll(function() {
        if ($window.scrollTop() > distance) { // if scrool >= distance
            navbarwrapper.removeClass('fixed-wrapper-nav').addClass('fixed-wrapper-nav'); // navbar-fixed-top
            navbarwrapper.css("background-color","#fff");
            slide.css("margin-top","50px");
        } else {
            navbarwrapper.removeClass('fixed-wrapper-nav');
            navbarwrapper.css("background-color","#f2f2e9");
            slide.css("margin-top","0px");
        }
    });
});
// end of sticky navbar

// slick slider
$(document).on('ready', function() {
    $(".center").slick({
        dots: false,
        arrows: false,
        infinite: true,
        centerMode: true,
        slidesToShow: 3,
        focusOnSelect: true,

        responsive: [
            {
            breakpoint: 992,
                settings: {
                    arrows: false,
                    centerMode: true,
                    slidesToShow: 2
                    }
            },
            {
            breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    slidesToShow: 2
                    }
            },
            {
            breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    slidesToShow: 1
                    }
            }
        ]
    });
});
// end of slick slider


// sticky sidebar
var $body = $(document.body);
var navHeight = $('.navbar').outerHeight(true) + 10;


$('#sidebar').affix({
      offset: {
        /* affix after top masthead */
        top: function () {
            var navOuterHeight = $('.carousel-inner').height()+75;
            return (this.top = navOuterHeight);
        },
        /* un-affix when footer is reached */
        bottom: function () {
            return (this.bottom = $('.footer').outerHeight(true));
        }
      }
});

$body.scrollspy({
  target: '#sidebar',
  offset: navHeight
});
// end of sticky sidebar