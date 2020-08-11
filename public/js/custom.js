$(document).ready(function () {
// SLICK SLIDER SCRIPTS
//Visit https://github.com/kenwheeler/slick/ for documentation
    $('.recent-products, .similar-products').slick({
        autoplay: true,
        // centerMode: true,
        // variableWidth: true,
        infinite:true,
        // adaptiveHeight: true,
        // mobileFirst:true

    });

    $('.products').slick({
        // autoplay: true,
        // centerMode: true,
        // variableWidth: true,
        infinite:false,
        // adaptiveHeight: true,
        // mobileFirst:true

    });

// POPTROX.JS SCRIPTS (Lightbox gallery)
var $window = $(window),
		$body = $('body'),
		$header = $('#header'),
		$footer = $('#footer'),
		$main = $('#main'),
		settings = {

			// Parallax background effect?
				parallax: true,

			// Parallax factor (lower = more intense, higher = less intense).
				parallaxFactor: 20

		};

	// Breakpoints.
		breakpoints({
			xlarge:  [ '1281px',  '1800px' ],
			large:   [ '981px',   '1280px' ],
			medium:  [ '737px',   '980px'  ],
			small:   [ '481px',   '736px'  ],
			xsmall:  [ null,      '480px'  ],
		});

$window.on('load', function() {

    $('#product').poptrox({
        caption: function($a) { return $('#product').find('.product-name').text(); },
        overlayColor: '#2c2c2c',
        overlayOpacity: 0.85,
        popupCloserText: '',
        popupLoaderText: '',
        selector: 'a.gallery-anchor',
        usePopupCaption: true,
        usePopupDefaultStyling: false,
        usePopupEasyClose: false,
        usePopupNav: true,
        windowMargin: (breakpoints.active('<=small') ? 0 : 50),
    });
});
});
