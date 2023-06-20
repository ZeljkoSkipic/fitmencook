jQuery(document).ready(function ($) {

    // 1st carousel, main
    $('.carousel-main').flickity(
        {
            prevNextButtons: true,
            pageDots: false,
			adaptiveHeight: true
        }
    );
    // 2nd carousel, navigation
    $('.carousel-nav').flickity({
        asNavFor: '.carousel-main',
        contain: true,
        pageDots: false,
		prevNextButtons: false,
    });

	// Search Toggle
	$(".fmc_toggle_trigger").click(function () {
        $(".fmc_toggle_content").slideToggle();
        $(this).toggleClass('fmc_toggle_open')
    });

	// Nav Search Toggle
	$(".search_icon").click(function () {
        $(".fmc_search_container .asp_w_container").slideToggle();
		$(this).toggleClass('fmc_search_open')
    });

	// Full Nav Search Toggle
	$(".search_icon2, .fmc_full_screen_close").click(function () {
        $(".fmc_full_screen_search").fadeToggle();
    });

    // Mobile navigation toggle

    $(".fmc_mm_trigger").click(function () {
        $(".fmc_header").slideToggle();
        $('.fmc_mobile_header').toggleClass('fmc_nav_open')
    });

	// Mobile Menu Behaviour
	$( ".fmc_header ul li.menu-item-has-children > a" ).after( "<span class='fmc_submenu_acitvator'></span>" );
		$( ".fmc_submenu_acitvator" ).click(function() {
		$( this ).toggleClass( "sub-open" ).siblings( ".sub-menu" ).slideToggle();
	});


    // Category Carousel

    $('.carousel-home').flickity({
        // options
        pageDots: false,
        cellAlign: 'left',
        watchCSS: true,
        wrapAround: true,
        prevNextButtons: false
    });

    // Category Logos

    $('.carousel-logos').flickity({
        // options
        pageDots: false,
        cellAlign: 'left',
        watchCSS: true,
        wrapAround: true,
        prevNextButtons: false
    });

    // Recipe Video
    (function ($) {
        var $window = $(window);
        var $videoWrap = $('.video-wrap');
        var $video = $('.fmc_video');

        if ($videoWrap.length && $video.length) {
            var videoHeight = $video.outerHeight();
            $window.on('scroll', function () {
                var windowScrollTop = $window.scrollTop();
                var videoBottom = videoHeight + $videoWrap.offset().top;

                if (windowScrollTop > videoBottom) {
                    $videoWrap.height(videoHeight);
                    $video.addClass('stuck');
                } else {
                    $videoWrap.height('auto');
                    $video.removeClass('stuck');
                }
            });
        }

    }(jQuery));

    // Count single product price on quantity change

    const quantity = $('.quantity .qty');
    const unitPrice = $('.fmc_product_unit_price');
    const totalPrice = $('.fmc_product_unit_total-js');

    const countProductPrice = (e) => {

        let currentValue = $(e.currentTarget).val();
        let unitPriceValue = unitPrice.data('unit-price');
        let total = parseFloat(currentValue * unitPriceValue).toFixed(2);
        totalPrice.html(total);
    };

    quantity.on('change', countProductPrice);

    // Validate comment form

    if ($.validator !== undefined) {

        const commentForm = $('#commentform');

        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            console.log(value);
            return arg !== value;
        }, "Value must not equal arg.");


        commentForm.validate({
            rules: {
                author: 'required',
                email: {
                    required: true,
                    email: true
                },
                comment: 'required',
                rateRecipe: { valueNotEquals: "0" }
            },
            messages: {
                rateRecipe: { valueNotEquals: "Please select a rating." }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "rateRecipe" || element.attr("name") == "rateRecipe") {
                    error.insertAfter(".recipe_rate-wrapper");
                } else {
                    error.insertAfter(element);
                }
            },
            ignore: []
        });

    }

    // Open Reviews tab on single product when review is posted

    const hash = window.location.hash;
    const tabReviews = $('a[href=#tab-reviews]');

    if (hash != '' && $('.product').length) {
        tabReviews.parent().addClass('active');
        setTimeout(function () {
            tabReviews.next().attr('style', '');
        }, 500)
    }

	(function ($) {

	const plus = '.plus';
	const minus = '.minus';
	const body = $('body');

	function increseQty() {

		var val = parseInt($(this).prev('input').val());
		var max = parseInt($(this).prev('input').attr('max'));

		if (val < max || !max) {
			$(this).prev('input').val(val + 1).trigger('change');

		}

	}

	function decreseQty () {
		var val = parseInt($(this).next('input').val());
		if (val > 1) {
			$(this).next('input').val(val - 1).trigger('change');
		}

	}

	body.on('click', minus, decreseQty);
	body.on('click', plus, increseQty);

	}(jQuery));

	// Delete rating for reply

    const reply = $('.reply');

    reply.on('click', function() {
        $(this).parent().next().find('#recipe-rate').remove();
        $(this).parent().next().find('.recipe-rate-label').remove();
        $(this).parent().next().find('.rateit').remove();
    });

});


const observer = new IntersectionObserver(
    ([e]) => e.target.toggleAttribute('stuck', e.intersectionRatio < 1),
    { threshold: [1] }
);
