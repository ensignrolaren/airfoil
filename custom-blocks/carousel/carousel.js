jQuery(document).ready(function(){
	var initializeBlock = function( $block ) {
			$block.find('.rad-carousel__inner').slick({
				autoplay: autoPlay,
				arrows: arrows,
				nextArrow: '<button class="slick-next slick-arrow">›</button>',
				prevArrow: '<button class="slick-prev slick-arrow">‹</button>',
				adaptiveHeight: false,
				variableWidth: variableWidth,
				dots: dots,
				infinite: true,
				speed: speed,
				fade: fade,
				cssEase: 'linear',
				slidesToShow: slidesToShow,
			});
		}

		// Initialize each block on page load (front end).
		jQuery(document).ready(function(){
			$('.rad-carousel').each(function(){
				initializeBlock( $(this) );
			});
		});

		// Initialize dynamic block preview (editor).
		if( window.acf ) {
			window.acf.addAction( 'render_block_preview/type=carousel', initializeBlock );
		}
});