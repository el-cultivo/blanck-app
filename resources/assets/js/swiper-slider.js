import Swiper from 'swiper';

export const swiperSlider = function(selector) {
	return new Swiper (selector, {
		breakpoints: {
			600:  {
				slidesPerView: 1,
			},
			768: {
				slidesPerView: 2
			}
		},
		direction: 'horizontal',
		loop: false,
		pagination: '.slider__pagination',
		paginationClickable: true,
		freeMode: true,
		slidesPerView: 3,
		spaceBetween: 50,
		grabCursor: true,
		prevButton: selector+'-nav--prev',
		nextButton: selector+'-nav--next'
	});
};
