@extends('share.layout',['content'=>$post_news->first()->parent_new->name])
@section('main')
<!-- Begin body_box -->
<div class="image_title">
	<img src="images/4975backgr.jpg" alt="ẢNh đại diện" class="img-top" />
	<div class="container ">
		<div class="breadcum">
			<h1 class="cat_name avenir">{{ $post_news->first()->parent_new->name }}</h1>
			<div class="navbar-vina"><a href="/">Trang chủ</a><a>{{ $post_news->first()->parent_new->name }}</a></div>
		</div>
	</div>
</div>
<div class="content">
	<div class="container">
		@include('share.search')
		<div class="center">
			<div class="list_news wrap">
				@foreach($post_news as $post_new)			
				<dl class="col-xs-12">
					<dt class="col-xs-12 col-sm-4">
						<a href="{{ $post_new->parent_new->slug.'/'.$post_new->slug }}"><img
								src="{{ $post_new->image }}" alt="{{ $post_new->title }}" /></a>
						<div class="tiles-list-date">
							<span class="tiles-list-date-day">{{ $post_new->created_at->format('d-m-Y') }}</span>
						</div>
					</dt>
					<dd class="col-xs-12 col-sm-8">
						<h3><a class="medium" href="{{ $post_new->parent_new->slug.'/'.$post_new->slug }}">{{ $post_new->title }}</a></h3>
						<p>{{ $post_new->synopsis }}</p>
						<a class="seemore" href="{{ $post_new->parent_new->slug.'/'.$post_new->slug }}"><i
								class="fa fa-angle-double-right" aria-hidden="true"></i> Xem thêm</a>
					</dd>
				</dl>
				@endforeach
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>


<!-- End body_box -->
@endsection