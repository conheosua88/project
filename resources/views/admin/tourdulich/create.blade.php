@extends('admin.share.layout')
@section('main')
<div class="right_col" role="main">
    <h1>Thêm Tour</h1>
    <div class="row">    
        <div class="x_content">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Home</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Lịch trình tour</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Quy định</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab3" data-toggle="tab" aria-expanded="false">Điều khoản</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">    
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="danhmuc">Danh mục </label>
                                <select id="danhmuc" name="danhmuc" class="form-control">
                                    <option value="0">Chọn danh mục</option>
                                    {{ App\Helpers\Menu::menu($danhmucs) }}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tag">Địa điểm</label>
                                <select name="states[]" id="tag_tour" multiple="multiple">
                                    @foreach($tags as $tag)
                                    <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select >    
                            </div>
                            <div class="form-group">
                                <label for="tieude">Tiêu đề bài viết</label>
                                <input type="text" class="form-control" id="tieude" name="tieude"  placeholder="Nhập tiêu đề">
                            </div>
                            <div class="form-group">
                                <label for="tomtat">Tóm tắt nội dung bài viết</label>
                                <input type="text" class="form-control" name="tomtat" id="tomtat"  placeholder="Tóm tắt nội dung">
                            </div>
                            <div class="form-group">
                                <label for="departure_location">Địa điểm khởi hành</label>
                                <input type="text" class="form-control" id="departure_location" name="departure_location"  placeholder="Nhập địa điểm">
                            </div>
                            <div class="form-group">
                                <label for="trip_time">Thời gian chuyến đi</label>
                                <input type="text" class="form-control" id="trip_time" name="trip_time"  placeholder="Nhập thời gian">
                            </div>
                            <div class="form-group">
                                <label for="price">Giá tour</label>
                                <input type="text" class="form-control" id="price" name="price"  placeholder="Nhập giá tour">
                            </div>
                            <div class="form-group">
                                <label for="departure_time">Ngày khởi hành</label>
                                <input type="text" class="form-control" id="departure_time" name="departure_time">
                            </div>
                            <div class="form-group">
                                <label class="radio">Phương tiện</label>
                                <input type="radio" class="flat" value="0" name="vehicle">Máy bay+Xe<br/>
                                <input type="radio" class="flat" value="1" name="vehicle">Xe
                            </div>
                            <div class="form-group">
                                <label>Ảnh bài viết</label>
                                <input type="file" class="form-control" name="anh_tintuc" >
                                <img src="images/noimage.jpg" id="anhhienthi" width="250" height="150" alt="">
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <div class="form-group">
                            <textarea name="tour_schedule" id="tour_schedule"></textarea> 
                            <script type="text/javascript">CKEDITOR.replace('tour_schedule'); </script>   
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                        <div class="form-group">
                            <textarea name="regulations" id="regulations"></textarea> 
                            <script type="text/javascript">CKEDITOR.replace('regulations'); </script>   
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
                        <div class="form-group">
                            <textarea name="rules" id="rules"></textarea> 
                            <script type="text/javascript">CKEDITOR.replace('rules'); </script>   
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary pull-right" onclick="themtintuc();">Save</button>
            <a class="btn btn-round btn-dark pull-right" href="{{ url('admin/tourdulich/back') }}">Back</a>
        </div>
    </div>
</div>
        
@endsection
@section('script')
<script>  
    $('#departure_time').datetimepicker();
    $('#tag_tour').selectize({
        
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });
    $('input[name=anh_tintuc]').change( function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("#anhhienthi").attr('src',tmppath);
    });
    var themtintuc = function(){
        var tieude = $("#tieude").val();
        var tomtat = $('#tomtat').val();
        var diadiem = $('#departure_location').val();
        var thoigiandi = $('#trip_time').val();
        var gia = $('#price').val();
        var ngaydi = $('#departure_time').val();
        var phuongtien = $('input[name = vehicle]:checked').val();
        var tag_id = $("select[name='states[]']").val();
        var lichtrinh = CKEDITOR.instances.tour_schedule.getData();
        var dieukhoan = CKEDITOR.instances.rules.getData();
        var quydinh = CKEDITOR.instances.regulations.getData();
        var danhmucid = $("select[name=danhmuc] option:selected").val();
        var anh = $(' [name=anh_tintuc]').prop('files')[0];
        var error = '';
            if(tieude == ''){error += 'Bạn chưa nhập tiêu đề .\n'}
            if(danhmucid == undefined ||danhmucid == 0){error += 'Bạn chưa chọn danh mục .\n'}
            if(phuongtien == undefined){error += 'Bạn chưa chọn phương tiện .\n'}
            if(error != '') {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: error,
                    }); return ;
            }
            var form_data = new FormData();
            form_data.append('tieude',tieude);
            form_data.append('tomtat',tomtat);
            form_data.append('diadiem',diadiem);
            form_data.append('thoigiandi',thoigiandi);
            form_data.append('gia',gia);
            form_data.append('ngaydi',ngaydi);
            form_data.append('phuongtien',phuongtien);
            form_data.append('tag_id',tag_id);
            form_data.append('lichtrinh',lichtrinh);
            form_data.append('dieukhoan',dieukhoan);
            form_data.append('quydinh',quydinh);
            form_data.append('danhmucid',danhmucid);
            if (anh !== undefined)
                form_data.append('anh', anh);
            
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
                },
                type:'post',
                url:'{{ url("admin/tourdulich/create") }}',
                contentType: false,
                processData: false,
                data:form_data
                }).done(function(rs){
                     var data = JSON.parse(rs);
                     if(data.error){
                        swal({
                    type: 'error',
                    title: 'Oops...',
                    text: data.error,
                    });return false;}
                     window.location = 'admin/tourdulich/back';
                     
                }).fail(function(err){
                    console.log(err);
                   
                });

            return false;
    }
    
</script>        
@endsection