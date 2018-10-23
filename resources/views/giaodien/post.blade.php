@extends('share.layout',['content'=>$posts->first()->parent_travel->name])
@section('main')
<!-- Begin body_box -->
<div class="image_title">
	<img src="images/4975backgr.jpg" alt="Ảnh đại diện" class="img-top" />
	<div class="container ">
		<div class="breadcum">
			<h1 class="cat_name avenir">@if(isset($keyword)) {{'Tìm kiếm'}} @else{{ $posts->first()->parent_travel->name }}@endif</h1>
			<div class="navbar-vina"><a href="/">Trang chủ</a><a>@if(isset($keyword)) {{'Tìm kiếm'}} @else{{ $posts->first()->parent_travel->name }}@endif</a></div>
		</div>
	</div>
</div>
<div class="content">
	<div class="container">
		@include('share.search')
		<div class="center">
		@if(isset($keyword))<div class="title_search">Kết quả tìm kiếm từ khóa  "<span style="color:red"> {{$keyword}} </span>"</div>@endif
			<div class="listproduct">
				@foreach($posts as $post)
				<div class="col-xs-12 col-sm-4 l">
					<div class="wrap_tour">
						<div class="item">
							<a class="image shadow" href="{{ 'tour-'.$post->slug }}" title="{{ $post->title }}"><img
									src="{{ $post->image }}" alt="{{ $post->title }}" title="{{ $post->title }}" /></a>
							<div class="w_me">
								<h3><a class="medium" href="{{ 'tour-'.$post->slug }}">{{ $post->title }}</a></h3>
							</div>
							<p class="price yellow">Từ {{ App\Helpers\Menu::formatCurrency($post->price) }}VNĐ</p>
						</div>
						<div class="wrap_brief">
							<div class="i_left">
								<p><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $post->trip_time }}</p>
								<p><i class="fa fa-calendar" aria-hidden="true"></i>KH: {{ $post->departure_time }}</p>
							</div>
							<span class="i_right">@if($post->vehicle == 0)<i class="fa fa-plane" aria-hidden="true"></i><i class="fa fa-bus" aria-hidden="true">@else<i class="fa fa-bus" aria-hidden="true">@endif</i></span>
						</div>
					</div>
				</div>
				@endforeach				
			</div>
		</div>
	</div>
</div>
<!-- End body_box -->
@endsection