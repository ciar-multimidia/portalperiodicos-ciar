jQuery(document).ready(function($) {
  $("#slider .container .items-slider").bxSlider({
    pager: true,
    mode: 'horizontal',
    controls: false,
    maxSlides: 1,
    minSlides: 1,
    auto: true,
    autoHover: true,
    pause: 4500
  });
});
