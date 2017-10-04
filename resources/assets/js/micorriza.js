import {ifElementExistsThenLaunch} from './functions/dom';
import {w} from './cltvo/constants.js';

w.on('load', () => {
	ifElementExistsThenLaunch([
		['#alert__container', alertsController, 'init', []],
	]);
});

// Page Transitions
(function($) {
	$(window).load(function() {
		$('#pre_JS').fadeOut(500);
	});
})(jQuery);

//Mobile Menu
jQuery(document).ready(function($){
	$('.mobile_JS').slideUp(0);
	var toggle = 0;
	$('.mobile_btn_JS').click( function () {
		if ( toggle === 0 ) {
			$('.mobile_JS').slideDown('fast');
			toggle++;
		} else {
			$('.mobile_JS').slideUp('fast');
			toggle = 0;
		}
	});
	$(window).resize( function () {
		$('.mobile_JS').slideUp('fast');
		toggle = 0;
	});
});

// Home Slider
jQuery(document).ready(function($){
	$('.slider_JS').slick({
		dots: false,
		fade: true,
		autoplay: true,
		autoplaySpeed: 2000,
		speed: 1000,
		pauseOnHover: false
	});
});

//Current Menu Item
jQuery(document).ready(function($) {
	$('.a_JS').each( function () {
		var id = $(this).attr('id');
		if(window.location.href.indexOf(id) > -1) {
			$(this).addClass('current');
		}
	});
});

//Smooth Scroll
$(function() {
	$('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top - 20
				}, 650, 'easeOutExpo');
				return false;
			}
		}
	});
});
