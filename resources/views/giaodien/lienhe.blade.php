@extends('share.layout',['content'=>'Liên hệ'])
@section('main')
<!-- Begin body_box -->
<div class="image_title">
    <img src="images/4975backgr.jpg" alt="ẢNh đại diện" class="img-top" />
    <div class="container ">
        <div class="breadcum">
            <p class="cat_name avenir">Liên hệ</p>
            <div class="navbar-vina"><a href="/">Trang chủ</a><a href="contact.html">Liên hệ</a></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFmVtGqvNTqOk6vRBbD2mSG5Xi9qQ7kmk"
    async defer></script>
<script type="text/javascript">
    var infoWindow;

    window.onload = function () {
        var toa_do = new google.maps.LatLng(20.860079, 106.682751);
        var conf = {
            center: toa_do,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            mapTypeControl: true,
            navigationControl: true,
            navigationControlOptions: {
                style: google.maps.NavigationControlStyle.SMALL
            }
        }
        map = new google.maps.Map(document.getElementById('mapcont'), conf);

        var marker = new google.maps.Marker({
            position: toa_do,
            map: map,
            title: 'Công ty cổ phần du lịch và dịch vụ Hải Phòng',
        });

        google.maps.event.addListener(marker, 'click', function () {
            if (!infoWindow) {
                infoWindow = new google.maps.InfoWindow();
            }
            var content = '<div id="info">' +
                '<div><h2>Công ty cổ phần du lịch và dịch vụ Hải Phòng</h2>' +
                '<p><strong>Add: Số 40 Trần Quang Khải, Hồng Bàng, Hải Phòng</strong></p>' +
                '<p><strong>Phone:</strong> 0225 3747332 - 0225 3746346 </p>' +
                '<p style="color: #e00;"><strong>Hotline:</strong> 0946 097 999 - 0987.062.568 </p>' +
                '<p><strong>Email:</strong> <a href="mailto:hptsc@haiphongtoserco.com.vn">hptsc@haiphongtoserco.com.vn</a></p>' +
                '<p><strong>Website:</strong> <a href="haiphongtoserco.com.vn">haiphongtoserco.com.vn</a></p></div>';
            infoWindow.setContent(content);
            infoWindow.open(map, marker);
        });
    };
</script>

<div class="content">
    <div class="container">
        <!--begin contact_page-->
        <div class="contact_page wrap">
            <div class="row">
                <div class="col-xs-12 item col-sm-6">
                    <div class="brief_contact">
                        <p>Vui lòng để lại Liên hệ cho <strong>Công ty cổ phần du lịch và dịch vụ Hải Phòng</strong></p>
                    </div>
                    @if(session('thongbao'))
                    <div class="col-md-8 alert alert-success">{{ session('thongbao') }}</div>
                    @endif
                    <form id="contact-form" action="contact" method="post">
                    {!! csrf_field() !!}
                        <ul>
                            <li>
                                <input placeholder="Họ tên" name="name" type="text" /> 
                            </li>
                            <li>
                                <input placeholder="Email" name="email" type="text" /> 
                            </li>
                            <li>
                                <input placeholder="Điện thoại" name="mobile" type="text" /> 
                            </li>
                            <li>
                                <textarea placeholder="Nội dung yêu cầu" name="body"></textarea> 
                            </li>
                            <li>
                                <input class="btn" type="submit" value="Gửi" />
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="col-xs-12 item detail_contact col-sm-6">
                    <div id="mapcont"></div>
                </div>
            </div>
        </div>
        <!--end contact_page-->
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
        },
        submitHandler: function(form) {
            form.submit();
        }
    })
</script>
@endsection