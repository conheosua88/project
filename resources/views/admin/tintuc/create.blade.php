@extends('admin.share.layout')
@section('main')
<div class="right_col" role="main">
    <h1>Thêm Bài Viết</h1>
    <div class="row">   
        <div class="col-lg-12">
            <div class="form-group">
                <label for="danhmuc">Danh mục </label>
                <select id="danhmuc" name="danhmuc" class="form-control">
                    <option value="0">Chọn danh mục</option>
                    @foreach($danhmucs as $danhmuc)
                    <option value="{{ $danhmuc->id }}">{{ $danhmuc->name }}</option>
                    @endforeach
                </select>
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
                <label>Ảnh bài viết</label>
                <input type="file" class="form-control" name="anh_tintuc" >
                <img src="images/noimage.jpg" id="anhhienthi" width="250" height="150" alt="">
            </div>
            <div class="form-group">
                <label for="noidung">Nội dung</label>
                <textarea name="noidung" id="noidung"></textarea> 
                <script type="text/javascript">CKEDITOR.replace('noidung'); </script>   
            </div>
            <button class="btn btn-primary pull-right" onclick="themtintuc();">Save</button>
            <a class="btn btn-round btn-dark pull-right" href="{{ url('admin/tintuc/back') }}">Back</a>
            </div>
        </div>

</div>
        
@endsection
@section('script')
<script>  

    $('input[name=anh_tintuc]').change( function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("#anhhienthi").attr('src',tmppath);
    });
    var themtintuc = function(){
        var tieude = $("#tieude").val();
        var tomtat = $('#tomtat').val();
        var noidung = CKEDITOR.instances.noidung.getData();
        var danhmucid = $("select[name=danhmuc] option:selected").val();
        var anh = $(' [name=anh_tintuc]').prop('files')[0];
        var error = '';
            if(tieude == ''){error += 'Bạn chưa nhập tiêu đề .\n'}
            if(noidung == ''){error += 'Bạn chưa nhập nội dung .\n'}
            if(danhmucid == undefined ||danhmucid == 0){error += 'Bạn chưa chọn danh mục .\n'}
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
            form_data.append('noidung',noidung);
            form_data.append('danhmucid',danhmucid);
            if (anh !== undefined)
                form_data.append('anh', anh);
            
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
                },
                type:'post',
                url:'{{ url("admin/tintuc/create") }}',
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
                     window.location = 'admin/tintuc';
                     
                }).fail(function(err){
                    console.log(err);
                   
                });

            return false;
    }
    
</script>        
@endsection