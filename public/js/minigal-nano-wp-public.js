(function() {
	"use strict";
	jQuery('a[href= "#top-minigal"]').click(function() {
		var target = jQuery(this.hash);
		target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
		if (target.length) {
			jQuery('html, body').animate({
				scrollTop: target.offset().top
			}, 1000);
			return false;
		}
	});

})(jQuery);