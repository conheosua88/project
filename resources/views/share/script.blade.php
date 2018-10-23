<script type="text/javascript">
	$(document).ready(function () {
		$("#mn-Array").parent().addClass('active');
		//menu mobile
		$('.taskbar-m .btn-m').mobilemenu();

		$('.flexslider').flexslider({
			animation: "fade",
			directionNav: false,
			start: function (slider) {
				$('body').removeClass('loading');
			}
		});
		$("a[rel=example_group]").fancybox();
		$('ul.nav_ppage li a').each(function () {
			$(this).click(function () {
				$('ul.nav_ppage li a').removeClass('active');
				$(this).addClass('active');
				box_show = $(this).attr('href');
				$(this).parents('div.detail_product').children('div.cbox_ppage').hide();
				$(box_show).show();
				return false;
			});
		});

		$('#zoom_01').elevateZoom({
			zoomType: "inner",
			cursor: "crosshair",
			zoomWindowFadeIn: 500,
			zoomWindowFadeOut: 750
		});

		var document_w = $(document).width();

		$('.body_bg .left ._box > p').click(function () {
			if (document_w < 768) {
				$(this).next().toggle('medium');
			}
		});

		if (document_w > 992) {
			$('.body_bg .right').css('min-height', $('.body_bg').height());
		}
		$("#scroller").simplyScroll();
		var contact_footer = $('.contact_footer').height();


		if (document_w < 992) {
			$('.menu_left>li>ul>li> i').click(function (event) {
				$(this).parent().children('ul').slideToggle();
			})

		}
		var height_h = $('.header').height() + $('.image_title').height() + $('.full_image').height() + $('.brief_product')
			.height() + $('.booking_tour').height();
		rightp = $('.right_product').height();
		cp = $('.content').height();
		//		alert(cp);
		//		alert(rightp);
		$(window).scroll(function () {
			if (document_w < 992) {
				if ($(this).scrollTop() >= height_h) {
					$('.gotoform').show();
				} else $('.gotoform').hide();
			}

			if (document_w > 767) {
				@if(isset($abc))
				var ss = '{!! $abc !!}';
				@else
				var ss = '';
				@endif
				if (ss != '') {
					var booking_form = $('.right_product .booking_form').offset().top;
					var left_product = $('.left_product').offset().top;
					var height_left = $('.content').height();
					var height_right = $('.right_product').height();
					var height_left = height_left - 350;
					if ($(this).scrollTop() > left_product) {
						if ($(this).scrollTop() > height_left) {
							$('.right_product>div').removeClass('fix');
							$('.right_product').addClass('fix_pos');
							var fix_h = cp - rightp - 60;
							$('.right_product').css('top', fix_h + 'px')
						} else {
							$('.right_product>div').addClass('fix');
							$('.right_product').removeClass('fix_pos');
							$('.right_product').css('top', 0)
						}

					} else {
						$('.right_product>div').removeClass('fix');
						$('.right_product').css('top', 0)
					}
				}

			}
			if (document_w > 992) {
				var ss = $('.header').height() + $('.top').height();
				if ($(this).scrollTop() > ss) {
					$('.header').addClass('fix_header');

				} else {
					$('.header').removeClass('fix_header');
				}
			}
		});

		//		var item_length = $('.hot_wrap > div').length - 1;
		$('.hot_wrap').slick({
			dots: false,
			infinite: true,
			autoplay: true,
			speed: 1000,
			slidesToShow: 3,
			slidesToScroll: 1,
			arrows: false,
			responsive: [{
					breakpoint: 992,
					settings: {
						slidesToShow: 2
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 1,
						ettings: "unslick"
					}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});
		$('.txtkeyword').closest('body').click(function () {
			if ($(".position").hasClass("show") == true)
				$('.position').removeClass('show');
		});
		$('.txtkeyword').click(function () {
			$('.position').addClass('show');
			return false;
		});
		

		$('.datepicker').datepicker({
			format: "dd-mm-yyyy",
			startDate: '-0d',
			autoclose: true,
			language: 'vi'
		});
		$('.menu-m').css('height', $(window).height());
		$(window).scroll(function () {
			if (document_w < 992) {
				$('.menu-m').css('top', $(this).scrollTop());
				if ($('.wrapper ').hasClass("wrapper-m") == true) {
					$('.taskbar-m').css({
						'top': $(this).scrollTop(),
						'position': 'absolute'
					});
				} else {
					$('.taskbar-m').css({
						'top': 0,
						'position': 'fixed'
					});
				}
			}

		});
		$( ".txtkeyword" ).keyup(function() {
			var text=$(this).val();
			$.ajax({
				method: "GET",
				url: 'search_tour/',
				data: { text:text},
				success: function(data) {
					$('.position ').html('');
					if (data){
						$('.position').append(data);
					}
				},
			});
		});

	});
	$.fn.datepicker.dates['vi'] = {
		days: ["Chủ Nhật", "Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Thứ 7"],
		daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
		daysMin: ["Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy", "CN"],
		months: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9",
			"Tháng 10", "Tháng 11", "Tháng 12"
		],
		monthsShort: ["Th. 1", "Th. 2", "Th. 3", "Th. 4", "Th. 5", "Th. 6", "Th. 7", "Th. 8", "Th. 9", "Th. 10", "Th. 11",
			"Th. 12"
		],
		today: "Hôm nay",
		clear: "Xóa",
		//		format: "mm/dd/yyyy",
		//		titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
		//		weekStart: 0
	};
</script>