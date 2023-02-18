jQuery(document).ready(function( $ ){

// 1st carousel, main
$('.carousel-main').flickity(
	{
		prevNextButtons: false,
		pageDots: false
	}
);
// 2nd carousel, navigation
$('.carousel-nav').flickity({
  asNavFor: '.carousel-main',
  contain: true,
  pageDots: false
});

// Logo slider block

/* $('.fmc_logo_slider').flickity({
	// options
	wrapAround: true,
	contain: true,
	pageDots: false,
  });
 */

// Mobile navigation toggle

$( ".fmc_mm_trigger" ).click(function() {
  $( ".fmc_header" ).slideToggle();
  $( '.fmc_mobile_header' ).toggleClass('fmc_nav_open')
});

// Mobile navigation submenu

$( ".fmc_header ul > li a" ).click(function() {
	$( this ).toggleClass('sub-open');
	$( this ).siblings('.sub-menu').slideToggle();
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

 // Category Carousel

 $('.carousel-logos').flickity({
	// options
	  pageDots: false,
	  cellAlign: 'left',
	  watchCSS: true,
	  wrapAround: true,
	  prevNextButtons: false
  });

// Recipe Video
(function($) {
	var $window = $(window);
	var $videoWrap = $('.video-wrap');
	var $video = $('.fmc_video');
	var videoHeight = $video.outerHeight();

	$window.on('scroll',  function() {
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

const commentForm = $('#commentform');

$.validator.addMethod("valueNotEquals", function(value, element, arg){
    console.log(value);
    return arg !== value;
   }, "Value must not equal arg.");


commentForm.validate({
    rules : {
        author: 'required',
        email : {
            required: true,
            email: true
        },
        comment: 'required',
        rateRecipe: {valueNotEquals: "0"}
    },
    messages: {
        rateRecipe: { valueNotEquals: "Please select a rating." }
       },
       errorPlacement: function(error, element) {
        if (element.attr("name") == "rateRecipe" || element.attr("name") == "rateRecipe" ) {
          error.insertAfter(".recipe_rate-wrapper");
        } else {
          error.insertAfter(element);
        }
      },
      ignore: []
});


});


const observer = new IntersectionObserver(
	([e]) => e.target.toggleAttribute('stuck', e.intersectionRatio < 1),
	{threshold: [1]}
  );

//   observer.observe(document.querySelector('.fmc_mobile_header'));
