<div class="left col-md-3">
			<div class="box_left col-xs-12">
				<p class="title_left">TÌm tour</p>
				<div class="wrap_form w">
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
						<a class="place" href="{{ 'place/'.$tag->slug }}">{{ $tag->name }}<span><strong>{{ count($tag->tag_tintuc) }}</strong> tours</span></a>
						@endif
						@endforeach
					</div>
				</div>
			</div>
			<div class="menu_left col-xs-12 box_left">
				<p class="title_left">Địa điểm trong nước</p>
				<div>
					@foreach($tags as $tag)
					@if($tag->tours->first()->category_id == 3)
					<a href="{{ 'place/'.$tag->slug }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ $tag->name }}</a>
					@endif
					@endforeach
				</div>
			</div>
			<div class="menu_left col-xs-12 box_left">
				<p class="title_left">Địa điểm nước ngoài</p>
				<div>
					@foreach($tags as $tag)
					@if($tag->tours->first()->category_id == 4)
					<a href="{{ 'place/'.$tag->slug }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ $tag->name }}</a>
					@endif
					@endforeach
				</div>
			</div>
		</div>