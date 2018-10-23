@extends('share.layout',['content'=>'Công ty cổ phần du lịch và dịch vụ Hải Phòng'])
@section('main')
        <!-- Begin body_box -->
        <div class="slider_box">
            <!--begin slider-->
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <a href="#" target="_blank" ><img src="images/slide/7213japan-autumn-secondary-.jpg" alt="test" /></a>
                    </li>
                    <li>
                        <a href="#" target="_blank" ><img src="images/slide/9799japan---korea.jpg" alt="nhật - hàn" /></a>
                    </li>
                </ul>
            </div>
            <!--end slider-->
            <div class="clearfix"></div>
            <div class="container">
                <div class="wrap_search">
                    <p class="avenir fr">Đặt tour du lịch</p>
                    <p class="avenir ls">Hơn 300 tour du lịch Việt Nam & quốc tế</p>
                    <div class="wrap_form">
                        <div class="frs">
                            <form class="search_form" action="search_tour" method="POST">    
                            {{ csrf_field() }}        
                                <div id="multiple-datasets">        
                                    <input type="text" class="txtkeyword" name="keyword" placeholder="Từ khóa tìm kiếm..." autocomplete="off">
                                </div>
                                    <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            </div>
                            <div class="position">
                                <p class="title_s"><i class="fa fa-map-marker" aria-hidden="true"></i> Địa điểm HOT</p>
                                @foreach($tags as $tag)
                                @if(count($tag->tag_tintuc) > 0)
                                <div class="place_img col-xs-12 col-sm-4">
                                    
                                    <a class="place" href="{{ 'place/' .$tag->slug }}"><img src="{{ $tag->tours->first() ? $tag->tours->first()->image : ''}}" alt="{{ $tag->name }}" /></a>
                                    <a class="url" href="{{ 'place/' .$tag->slug }}">{{ $tag->name }}<br/><span><strong>{{ count($tag->tag_tintuc) }}</strong> tours</span></a>                                
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--tour nổi bật-->
        <div class="hot_tour" style="background:url( 'images/contact/5489untitled-6.jpg') center no-repeat; background-size:cover;">
            <div class="container">
                <h2 class="avenir title">Tour nổi bật</h2>
                <p class="avenir brief_tit">Những tour có lịch khởi hành gần nhất</p>
                <div class="hot_wrap">
                    @foreach($post_highlights as $post_highlight)
                    <div>
                        <div class="wrap_item">
                            <div class="item">
                            <a class="image shadow" href="{{ 'tour-'.$post_highlight->slug }}" title="{{ $post_highlight->title }}"><img src="{{ $post_highlight->image }}" alt="{{ $post_highlight->title }}" title="{{ $post_highlight->title }}" /></a>
                            <div class="w_me"><a class="medium" href="{{ 'tour-'.$post_highlight->slug }}">{{ $post_highlight->title }}</a></div>
                            <p class="price yellow_green">Từ {{ App\Helpers\Menu::formatCurrency($post_highlight->price) }}VNĐ</p>
                            </div>
                            <div class="item_brief col-xs-12">
                            <p class="brief">{{ str_limit($post_highlight->synopsis,100) }}</p>
                            <p>
                                <span class="i_left"></span>
                                <span class="i_right">@if($post_highlight->vehicle == 0)<i class="fa fa-plane" aria-hidden="true"></i><i class="fa fa-bus" aria-hidden="true">@else<i class="fa fa-bus" aria-hidden="true">@endif</i></span>									
                            </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <!--Các chủ đề nổi bật-->
        <div class="home_tour ">
            <div class="container">
                <h2 class="avenir title center_text"><a href="tour-trong-nuoc-t11.html">Tour trong nước</a></h2>
                <div class="listproduct">
                    @foreach($post_trongnuocs as $post_trongnuoc)
                    <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="wrap_tour">
                                <div class="item">
                                <a class="image shadow" href="{{ 'tour-'.$post_trongnuoc->slug }}" title="{{ $post_trongnuoc->title }}"><img src="{{ $post_trongnuoc->image }}" alt="{{ $post_trongnuoc->title }}" title="{{ $post_trongnuoc->title }}" /></a>
                                <div class="w_me">
                                    <h3><a class="medium" href="{{ 'tour-'.$post_trongnuoc->slug }}">{{ $post_trongnuoc->title }}</a></h3>
                                </div>
                                <p class="price yellow">Từ {{ App\Helpers\Menu::formatCurrency($post_trongnuoc->price) }} VNĐ</p>
                                </div>
                                <div class="wrap_brief">
                                <div class="i_left">
                                    <p><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $post_trongnuoc->trip_time }}</p>
                                    <p><i class="fa fa-calendar" aria-hidden="true"></i> KH: {{ $post_trongnuoc->departure_time }}</p>
                                </div>
                                <span class="i_right">@if($post_trongnuoc->vehicle == 0)<i class="fa fa-plane" aria-hidden="true"></i><i class="fa fa-bus" aria-hidden="true">@else<i class="fa fa-bus" aria-hidden="true">@endif</i></span>								
                                </div>
                            </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="home_tour even">
            <div class="container">
                <h2 class="avenir title center_text"><a href="tour-nuoc-ngoai">Tour nước ngoài</a></h2>
                <div class="listproduct">
                    @foreach($post_nuocngoais as $post_nuocngoai)
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="wrap_tour">
                            <div class="item">
                            <a class="image shadow" href="{{ 'tour-'.$post_nuocngoai->slug }}" title="{{ $post_nuocngoai->title }}"><img src="{{ $post_nuocngoai->image }}" alt="{{ $post_nuocngoai->title }}" title="{{ $post_nuocngoai->title }}" /></a>
                            <div class="w_me">
                                <h3><a class="medium" href="{{ 'tour-'.$post_nuocngoai->slug }}">{{ $post_nuocngoai->title }}</a></h3>
                            </div>
                            <p class="price yellow">Từ {{ App\Helpers\Menu::formatCurrency($post_nuocngoai->price) }}VNĐ</p>
                            </div>
                            <div class="wrap_brief">
                            <div class="i_left">
                                <p><i class="fa fa-clock-o" aria-hidden="true"></i>{{ $post_nuocngoai->trip_time }}</p>
                                <p><i class="fa fa-calendar" aria-hidden="true"></i> KH: {{ $post_nuocngoai->departure_time }}</p>
                            </div>
                            <span class="i_right">@if($post_nuocngoai->vehicle == 0)<i class="fa fa-plane" aria-hidden="true"></i><i class="fa fa-bus" aria-hidden="true">@else<i class="fa fa-bus" aria-hidden="true">@endif</i></span>								
                            </div>
                        </div>
                    </div>
                    @endforeach          
                    
                </div>
            </div>
        </div>
        <div class="banner">
        </div>
        <div  class="home_news col-xs-12">
            <div class="container">
                <a class="avenir title center_text" href="tin-tuc-l24.html">Blog du lịch</a>				
                <p class="avenir brief_tit center_text"></p>
                <div class="wrap_new">
                    @for($i = 0 ;$i < count($post_news) ; $i++)
                    @if($i % 2 == 0)
                    <div class="half ">
                    @endif
                        <div class="block_new col-xs-12">
                            <div class='image'>
                                <a class="animation" href="{{ $post_news[$i]->parent_new->slug.'/'.$post_news[$i]->slug }}">
                                <img src="{{ $post_news[$i]->image }}" alt="{{ $post_news[$i]->title }}" /></a>
                            </div>
                            <div class="info_new">
                            <h5><a class="name" href="{{ $post_news[$i]->parent_new->slug.'/'.$post_news[$i]->slug }}">{{ $post_news[$i]->title }}</a></h5>
                            <p class="brief">{!! str_limit($post_news[$i]->synopsis,100) !!} </p>
                            <a class="more_new" href="{{ $post_news[$i]->parent_new->slug.'/'.$post_news[$i]->slug }}">Xem thêm</a>							
                            </div>
                        </div>
                    @if($i % 2 ==1)
                    </div>
                    @endif
                    @endfor
                        
                </div>
            </div>
        </div>
        <div class="adv col-xs-12" style="background:url( 'images/link/42146720bn.jpg') center no-repeat; background-size:cover;">
            <div class="container"  >
                <div>
                    <p class="tit avenir">Nhiều hơn những tour đang có?</p>
                    <p class="bri ">Liên hệ với chúng tôi để nhận tư vấn, giải đáp miễn phí</p>
                </div>
                <a class="avenir" href="tel:0946 097 999 - 0987.062.568 ">0946 097 999 - 0987.062.568 </a>
            </div>
        </div>
        <!-- End body_box -->
        @endsection