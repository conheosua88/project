@extends('share.layout',['content'=>$post_tour->title])
@section('main')
<!-- Begin body_box -->
<div class="image_title">
			<img src="images/4975backgr.jpg" alt="ẢNh đại diện" class="img-top" />
			<div class="container ">
				<div class="breadcum">
					<p class="cat_name avenir">Tour</p>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container">
				<div class="product ">
					<div class="navbar-vina"><a href="/">Trang chủ</a><a>{{ $post_tour->title }}</a></div>
					<div class="full_image">
						<h1 class="avenir"> {{ $post_tour->title }}</h1>
					</div>
					<div class="col-xs-12 col-sm-8 left_product col-md-9">
						<div class="product_main">
							<div class="slide"><img src="{{ $post_tour->image }}" alt="{{ $post_tour->title }}" title="{{ $post_tour->title }}" /></div>
						</div>
						<script type="text/javascript">
							$('.product_main').slick({
								slidesToShow: 1,
								slidesToScroll: 1,
								arrows: true,
								fade: true,
								autoplay: true,
								autoplaySpeed: 2000,
								adaptiveHeight: true,
								prevArrow: "<button type='button' class='slick-prev'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
								nextArrow: "<button type='button' class='slick-next'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
							});
						</script>

						<div class="brief_product">
							<p><i class="fa fa-map-marker" aria-hidden="true"></i>{{ $post_tour->departure_location }} </p>
							<p><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $post_tour->trip_time }} </p>
							<p class="pt"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Phương tiện:
							@if($post_tour->vehicle == 0)<i class="fa fa-plane" aria-hidden="true"></i><i class="fa fa-bus" aria-hidden="true">@else<i class="fa fa-bus" aria-hidden="true">@endif</i> </p>
							<p><i class="fa fa-calendar" aria-hidden="true"></i> KH: {{ str_limit($post_tour->departure_time,10) }}</p>
						</div>
						<div class="booking_tour hidden-sm hidden-md hidden-lg">
							<p class="price_s">{{App\Helpers\Menu::formatCurrency($post_tour->price)}} VND</p>

							<form class="booking_form" action="booking" method="GET">
							
								<div class="kh col-xs-8">
									<p>KHỞI HÀNH</p>
									<input readonly type='text' name="date" value="02-10-2018" data-provide="datepicker" class="form-control datepicker" />
								</div>
								<div class="sokhach col-xs-4">
									<p>SỐ KHÁCH</p>
									<input value="1" type="text" name="num" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
									 maxlength="3" class="form-control number">
								</div>
								<input type="hidden" name="tour" value="{{ $post_tour->id }}">
								<button type="submit">Đặt tour</button>
							</form>
						</div>
						<div id="lichtrinh" class="content_news">
							<p class="title_p">Lịch trình tour</p>
							<div class="network_ppage">
								<div class="fb-like" data-href="http://haiphongtoserco.com.vn/tour-chau-au-gia-shock-duc---ha-lan---bi---phap-p63.html"
								 data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" style="display: inline-block;"></div>
								<!-- <div style="display: inline-block;">
									<script src="/js/plusone.js"></script>
									<g:plus action="http://haiphongtoserco.com.vn/share" annotation="bubble"></g:plus>
								</div> -->
							</div>
							{!! $post_tour->tour_schedule !!}
						</div>
						<div id="dichvu" class="content_news">
							<p class="title_p">Dịch vụ đi kèm</p>
							<p class="col-xs-6 col-sm-4 col-md-3 dv"><i class="fa fa-bus" aria-hidden="true"></i> Xe đưa đón</p>
							<p class="col-xs-6 col-sm-4 col-md-3 dv"><i class="fa fa-ticket" aria-hidden="true"></i> Vé tham quan</p>
							<p class="col-xs-6 col-sm-4 col-md-3 dv"><i class="fa fa-flag" aria-hidden="true"></i> Hướng dẫn viên</p>
							<p class="col-xs-6 col-sm-4 col-md-3 dv"><i class="fa fa-cutlery" aria-hidden="true"></i> Bữa ăn</p>
							<p class="col-xs-6 col-sm-4 col-md-3 dv"><i class="fa fa-check" aria-hidden="true"></i> Bảo hiểm</p>
						</div>
						@if(isset($post_tour->rules))
						<div id="dieukhoan" class="content_news">
							<p class="title_p">Điều khoản</p>
							{!! $post_tour->rules !!}
						</div>
						@endif
						@if(isset($post_tour->regulations))
						<div id="quydinh" class="content_news">
							<p class="title_p">Quy định</p>
							{!! $post_tour->regulations !!}
						</div>
						@endif
					</div>
					<div class="col-xs-12 col-sm-4 right_product col-md-3">
						<div class>
							<div class="booking_tour hidden-xs">
								<p class="price_s">{{ App\Helpers\Menu::formatCurrency($post_tour->price) }} VND</p>
								<form class="booking_form" action="booking" method="GET">
								
									<div class="kh col-sm-12">
										<p>KHỞI HÀNH</p>
										<input readonly type='text' name="date" value="02-10-2018" data-provide="datepicker" class="form-control datepicker" />
									</div>
									<div class="sokhach col-sm-12">
										<p>SỐ KHÁCH</p>
										<input value="1" type="text" name="num" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
										 maxlength="3" class="form-control number">
									</div>
									<input type="hidden" name="tour" value="{{ $post_tour->id }}">
									<button type="submit">Đặt tour</button>
								</form>
							</div>
							<div class="contact_tour">
								<p>Gọi ngay tới số <span style="font-size:16px"><strong>0946.097.999 (Mr.Nam) </strong></span><strong><span
										 style="font-size:16px;">0987.062.568</span></strong><span style="font-size:16px;"><strong>(Mr.
											Hùng)</strong></span>&nbsp;để đặt tour với chúng tôi</p>
							</div>
							<nav id="myScroll">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="{{ URL::current() }}#lichtrinh">Lịch trình tour</a></li>
									<li><a href="{{ URL::current() }}#dichvu">Dịch vụ đi kèm</a></li>
									@if(isset($post_tour->rules))
									<li><a href="{{ URL::current() }}#dieukhoan">Điều khoản</a></li>
									@endif
									@if(isset($post_tour->regulations))
									<li><a href="{{ URL::current() }}#dieukhoan">Quy định</a></li>
									@endif

								</ul>
							</nav>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="gotoform">Đặt tour ngay</div>
		<script type="text/javascript">
			$(document).ready(function () {
				$(".number").keyup(function () {
					var soluong = $(this).val();
					var price = '{{ $post_tour->price }}';
					if (soluong == '') soluong = 1;
					var tong = soluong * price;
					var tien = tong.toFixed(0).replace(/./g, function (c, i, a) {
						return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
					}) + ' VNĐ';
					$(this).parents().parents().parents().children('.price_s').html();
					$(this).parents().parents().parents().children('.price_s').html(tien);

				})
				$('.gotoform').click(function () {
					$('html,body').animate({
							scrollTop: $(".left_product .booking_tour").offset().top - 50
						},
						'slow');
					return false;
				})
			})
		</script>



		<!-- End body_box -->
        @endsection