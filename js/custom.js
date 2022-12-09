"use strict";

jQuery(document).ready(function ($) {
  // 1st carousel, main
  $('.carousel-main').flickity({
    prevNextButtons: false,
    pageDots: false
  });
  // 2nd carousel, navigation
  $('.carousel-nav').flickity({
    asNavFor: '.carousel-main',
    contain: true,
    pageDots: false
  });

  // Logo slider block

  $('.fmc_logo_slider').flickity({
    // options
    wrapAround: true,
    contain: true,
    pageDots: false
  });

  // Mobile navigation toggle

  $(".fmc_mm_trigger").click(function () {
    $(".fmc_header").slideToggle();
    $('.fmc_mobile_header').toggleClass('fmc_nav_open');
  });

  // Mobile navigation submenu

  $(".fmc_header ul > li a").click(function () {
    $(this).toggleClass('sub-open');
    $(this).siblings('.sub-menu').slideToggle();
  });

  // Home Carousel

  $('.carousel-home').flickity({
    // options
    pageDots: false,
    cellAlign: 'left'
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

  // Sticky Recipe Video
  (function ($) {
    var $window = $(window);
    var $videoWrap = $('.video-wrap');
    var $video = $('.fmc_video');
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
  })(jQuery);
});