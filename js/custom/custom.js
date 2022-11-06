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

});
