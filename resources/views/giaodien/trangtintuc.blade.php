@extends('share.layout',['content'=>$post_new->parent_new->name])
@section('main')
<!-- Begin body_box -->
<div class="image_title">
    <img src="images/4975backgr.jpg" alt="ẢNh đại diện" class="img-top" />
    <div class="container ">
        <div class="breadcum">
            <h1 class="cat_name avenir">{{ $post_new->parent_new->name }}</h1>
            <div class="navbar-vina"><a href="index.html">Trang chủ</a><a href="{{ $post_new->parent_new->slug }}">{{ $post_new->parent_new->name }}</a></div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        @include('share.search')
        <div class="center">
            <div class="news_page wrap">
                <h1 class="avenir title_news">{{ $post_new->title }}</h1>
                <div>Ngày: {{ $post_new->created_at }}| Lượt xem: {{ $post_new->view }}</div>

                <div class="network_ppage">
                    <div class="fb-like" data-href="http://haiphongtoserco.com.vn/tuyen-dung/tuyen-nhan-vien-van-phong-n69.html"
                        data-layout="button_count" data-action="like" data-show-faces="true" data-share="true" style="display: inline-block;"></div>
                    <div style="display: inline-block;">
                        <script src="../../apis.google.com/js/plusone.js"></script>
                        <g:plus action="http://haiphongtoserco.com.vn/share" annotation="bubble"></g:plus>
                    </div>
                </div>
                <div class="brief_news_page">
                    <p><span style="font-size:16px"><strong> {{ $post_new->synopsis }}</strong></span></p>
                </div>
                <div class="content_news_page">
                {!! $post_new->content !!}
                </div>
                <div class="related_news_page">
                    <p><strong>Bài viết liên quan</strong></p>
                    <ul>
                        @foreach($relate_news as $relate_new)
                        <li>
                            <p><a href="{{ $post_new->parent_new->slug.'/'.$relate_new->slug }}"><img width="140" height="80" src="{{ $relate_new->image }}"
                                        alt="{{ $relate_new->title }}" /></a></p>
                            <a href="{{ $post_new->parent_new->slug.'/'.$relate_new->slug }}">{{ $relate_new->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <br />
            </div>
        </div>
    </div>
</div>
<!-- End body_box -->
@endsection