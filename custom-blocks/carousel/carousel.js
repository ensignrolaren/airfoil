jQuery(document).ready(function($) {
  $('.rad-carousel__inner').slick({
		autoplay: autoPlay,
		arrows: arrows,
		nextArrow: '<button class="slick-next slick-arrow"><svg xmlns="http://www.w3.org/2000/svg" height="48" width="48" viewBox="0 0 48 48"><path d="m15.2 43.9-2.8-2.85L29.55 23.9 12.4 6.75l2.8-2.85 20 20Z"></path></svg></button>',
		prevArrow: '<button class="slick-prev slick-arrow"><svg xmlns="http://www.w3.org/2000/svg" height="48" width="48" viewBox="0 0 48 48"><path d="m33 44l-20-20 20-20 2.8 2.8-17.2 17.2 17.2 17.1z"></path></svg></button>',
		adaptiveHeight: adaptiveHeight,
		variableWidth: variableWidth,
		dots: dots,
		infinite: true,
		speed: speed,
		fade: fade,
		cssEase: 'linear',
		slidesToShow: slidesToShow,
        slidesToScroll: 1
  });
});