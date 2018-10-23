@extends('share.layout',['content'=>$tour->title])
@section('main')
<!-- Begin body_box -->
<div class="image_title">
   <img src="/images/4975backgr.jpg" alt="ẢNh đại diện" class="img-top"/>
   <div class="container " >
      <div class="breadcum" >
         <h1 class="cat_name avenir">Thông tin thanh toán</h1>
         <div class="navbar-vina"><a href="/">Trang chủ</a><a>Thanh toán </a></span></div>
      </div>
   </div>
</div>
<div class="content">
   <div class="container">
      <div class="block_tt info col-xs-12 col-md-4">
         <!--            <p class="avenir title center_text">Thông tin tour</p>-->
         <div class="img col-xs-12 col-sm-6 col-md-12">
            <img src="/images/attachment/5084nha-trang-hon-mun.jpg" alt="TOUR NHA TRANG KHÁM PHÁ 4 ĐẢO" />            
         </div>
         <div class="c_info col-xs-12 col-sm-6 col-md-12">
            <h1 class="avenir">{{ $tour->title }}</h1>
            <div>
               <p>Ngày khởi hành: {{ $tour->departure_time }}</p>
               <p>Nơi khởi hành: {{ $tour->departure_location }}</p>
               <p>Thời gian: {{ $tour->trip_time }}</p>
               <p>Số hành khách: {{ $num }}</p>
               <p>Tổng: <span class="price_s">{{ App\Helpers\Menu::formatCurrency($price) }}VNĐ</span></p>
            </div>
         </div>
      </div>
      @if(session('thongbao'))
        <div class="col-md-8 alert alert-success">{{ session('thongbao') }}</div>
        @endif
      <div class="col-md-8 wr_block_right">
         <form id="contact-form" action="booking_user" method="post">
         {!! csrf_field() !!}
            <div class="block_tt thongtin col-xs-12">
               <p class="avenir title">Thông tin liên hệ</p>
               <input type="hidden" name="tour_name" value="{{ $tour->title }}">
               <input type="hidden" name="tour_time" value="{{ $tour->departure_time }}">
               <div class="name col-md-6">
                  <p>Họ tên <span>*</span></p>
                  <input placeholder="Họ tên" class="form-control" name="name"  type="text" />                                    
               </div>
               <div class="phone col-md-6">
                  <p>Điện thoại <span>*</span></p>
                  <input placeholder="Điện thoại" class="form-control" name="mobile"  type="text" />                                    
               </div>
               <div class="address col-md-6">
                  <p>Địa chỉ <span>*</span></p>
                  <input placeholder="Địa chỉ" class="form-control" name="address"  type="text" />                                    
               </div>
               <div class="email col-md-6">
                  <p>Email <span>*</span></p>
                  <input placeholder="Email" class="form-control" name="email" type="email" />                                    
               </div>
               <div class="body col-md-12">
                  <p>Ghi chú </p>
                  <textarea placeholder="Thông tin" class="form-control" name="content"></textarea>
               </div>
            </div>
            <div class="block_tt pt col-xs-12">
               <p class="avenir title ">Phương thức thanh toán</p>
               <input  checked="checked" type="radio" name="pt"/ value="Thanh toán tại Văn phòng"><label>Thanh toán tại Văn phòng</label><br/>
               <input  type="radio" name="pt" value="Chuyển khoản qua Ngân hàng"/> <label>Chuyển khoản qua Ngân hàng</label></span>
            </div>
            <div class=""><input class="btn btn_tour btn-primary" type="submit"/></div>
         </form>
      </div>
   </div>
</div>
<!-- End body_box -->
@endsection
@section('script')
<script>
    $('#contact-form').validate({
        rules:{
            name : "required",
            mobile : {
                required : true,
                number : true,
            },
            email : {
                required : true,
                email :true,
            },
            address : "required",
        },
        messages :{
            name : 'Bạn chưa điền họ tên',
            email :{
                required : 'Bạn chưa nhập email',
                email : 'Email của bạn chưa đúng định dạng'
            },
            mobile : {
                required : 'Bạn chưa nhập số điện thoại',
                number : 'Số điện thoại nhập là số',
            },
            address : 'Bạn chưa nhập địa chỉ',
        },
        submitHandler: function(form) {
            form.submit();
        }
    })
</script>
@endsection