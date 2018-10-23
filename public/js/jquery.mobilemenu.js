(function ($) {
	$.fn.mobilemenu = function(options) {

		var defaults = $.extend({
		},options);

		var obj = $(this);
		var wrapper = obj.closest('.wrapper');	//pháº§n tá»­ chá»©a toĂ n bá»™ trang
		var taskbar_m = obj.parents('.taskbar-m');

		var opts = $.extend(defaults,options);

		return this.each(function() {

			//Hiá»ƒn thá»‹ menu mobile
			obj.click(function() {
				wrapper.toggleClass('wrapper-m');
			});

			//Hiá»ƒn thá»‹ menu con cá»§a menu mobile
			wrapper.find('.menu-m > ul > li > span').click(function() {
				$(this).parent().find('ul.one').toggle('medium');
			});
			wrapper.find('.menu-m > ul >li>ul li > span').click(function() {
				$(this).parent().find('ul.two').toggle('medium');
			});
			//Hiá»ƒn thá»‹ textbox search
			// taskbar_m.find('form button').click(function() {
			// 	txt_prev = $(this).prev();
			// 	if (txt_prev.width() === 0) {
			// 		txt_prev.width(220);
			// 		return false;
			// 	}
			//
			// 	if (txt_prev.width() > 0) {
			// 		if (!txt_prev.val())
			// 		{
			// 			txt_prev.width(0);
			// 			return false;
			// 		}
			// 	}
			// });

			//áº¨n menu mobile báº±ng cĂ¡ch click ra bĂªn ngoĂ i menu mobile
			obj.closest('body').click(function(e) {

				//Náº¿u cĂ³ class wrapper-m vĂ  pháº§n tá»­ Ä‘Ă­ch khĂ´ng pháº£i lĂ  btn-m
				if ( wrapper.hasClass('wrapper-m') && !($(e.target).hasClass('btn-m')) )
				{
					if ($(e.target).closest(".menu-m").length === 0) {
						wrapper.toggleClass('wrapper-m');
					}
				}
			});

		});

	};
})(jQuery);