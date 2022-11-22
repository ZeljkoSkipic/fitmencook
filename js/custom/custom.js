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


// Mobile navigation toggle

$( ".fmc_mm_trigger" ).click(function() {
  $( ".fmc_header" ).slideToggle();
});

// Home Carousel

$('.carousel-home').flickity({
  // options
	pageDots: false,
	cellAlign: 'left',
});

// Category Carousel

$('.carousel-category').flickity({
  // options
  cellAlign: 'left',
	wrapAround: true,
	pageDots: false,
	prevNextButtons: false,
	initialIndex: 5
});

});
