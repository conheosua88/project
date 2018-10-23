@extends('admin.share.layout')
@section('main')
<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-12"> 
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-12">
                        <h1>Các Bài viết</h1>
                    </div>
                    <div class="col-lg-8">
                        <div class="col-md-2  form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control btn-round" name="tentieude" placeholder="Tiêu đề">
                        </div>
                        <div class="col-md-4  form-group">
                            <label>Chủ đề</label>
                            <input type="text" class="form-control btn-round" name="tenchude" placeholder="Nhập danh mục">
                        </div>
                        <div class="col-md-2  form-group">
                            <button  style="background:transparent;border:0;padding-top: 25px;" onclick="timkiem();"><i class="fa fa-search" style="font-size: 25px;"></i></button>
                        </div>
                        
                    </div>
                    <div class="col-lg-4">
                        <a class="btn btn-round btn-primary pull-right" id="btnAdd" href="{{ url('admin/tourdulich/create') }}" style="margin-top: 20px;">Thêm bài viết</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" style="overflow-x: hidden;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Thời gian đi</th>
                            <th scope="col">Điểm xuất phát</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Tour nổi bật</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="danhsach">
                            @foreach($post_travels as $danhsach)
                            <tr>
                            <td><img src="{{ $danhsach->image ? $danhsach->image : 'images/noimage.jpg'}}" alt="" width="100px"></td>
                            <td>{{ $danhsach->title }}</td>
                            <td>{{ $danhsach->trip_time }}</td>
                            <td>{{ $danhsach->departure_location }}</td>
                            <td>{{ $danhsach->parent_travel ? $danhsach->parent_travel->name : 'null' }}</td> 
                            <td><input type="checkbox" value="{{$danhsach->status}}" onclick="tournoibat({{ $danhsach->id }},this);" @if($danhsach->status == 1){{'checked'}}@endif></td>
                            <td>
                                <a class="btn btn-info btnEdit fa fa-pencil" href="{{ url('admin/tourdulich/edit').'/'.$danhsach->id }}">Sửa</a>
                                <button class="btn btn-danger btnDel fa fa-trash-o" onclick="Delete({{ $danhsach->id }})">Xóa</button>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right" id="phantrang_laravel">     
                        {{ $post_travels->links() }}
                    </div>
                    <ul id="phantrang"></ul>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>
@endsection
@section('script')
<script>  
    var timkiem = function(){
        var ten_tieude = $(' input[name=tentieude]').val();
        var ten_chude = $(' input[name=tenchude]').val();
        $('#phantrang_laravel').css('display','none');
        danhsach(ten_tieude,ten_chude,1,10);
    }
    var danhsach = function(ten_tieude,ten_chude,page,limit){
        var url = 'admin/tourdulich/search_travel';
        url+= ten_tieude != '' ? '/'+ten_tieude : '/all';
        url+= ten_chude != '' ? '/'+ten_chude : '/all';
        url += '/'+page+'/'+limit;
        $.get(url,function(rs){
            var html ='';
            var data = JSON.parse(rs);
            for(var i = 0;i < data.data.length;i++){
                html+='<tr>';
                html+='<td><img src="'+data.data[i].image+'" width="100px"></td>';
                html+='<td>'+data.data[i].title+'</td>';
                html+='<td>'+(data.data[i].trip_time)+'</td>';
                html+='<td>'+data.data[i].departure_location+'</td>';
                html+='<td>'+data.data[i].TenDanhMucCha+'</td>';
                html+='<td><a class="btn btn-info btnEdit fa fa-pencil" href="admin/tourdulich/edit/'+data.data[i].id+'">Sửa</a>'+
                            '<button class="btn btn-danger btnDel fa fa-trash-o" onclick="Delete( '+data.data[i].id+' )">Xóa</button></td>';
                html+='</tr>';
            }
            $('#danhsach').html(html);
            html = '';
                if (data.total > 1) {
                    if (page == 1) {
                        html += '<li class="disabled"><a style="cursor: no-drop;"> ← </a></li>';
                    }
                    else {
                        html += '<li ><a onclick="danhsach(\''+ten_tieude+'\',\''+ten_nguoidang+'\',\''+ten_chude+'\',\''+ngaydang+'\','+(page-1)+','+limit+');"> ← </a></li>';
                    }

                    for (var i = 1; i <= data.total; i++) {
                        if (page == i) {
                            html += '<li class="active"><a onclick="danhsach(\''+ten_tieude+'\',\''+ten_nguoidang+'\',\''+ten_chude+'\',\''+ngaydang+'\','+i+','+limit+');">' + i + '</a></li>';
                        } else {
                            html += '<li><a onclick="danhsach(\''+ten_tieude+'\',\''+ten_nguoidang+'\',\''+ten_chude+'\',\''+ngaydang+'\','+i+','+limit+');">' + i + '</a></li>';
                        }
                    }

                    if (page ==  data.total) {
                        html += '<li class="disabled"><a style="cursor: no-drop;"> → </a></li>';
                    }
                    else {
                        html += '<li><a onclick="danhsach(\''+ten_tieude+'\',\''+ten_nguoidang+'\',\''+ten_chude+'\',\''+ngaydang+'\','+(page+1)+','+limit+');"> → </a></li>';
                    }

                }
                $('#phantrang').html(html);
        });
    }
    function Delete(id) {
        swal({
        title: 'Are you sure?',
            text: "Bạn có muốn xóa tin tức này ko!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {   
                var form_data = new FormData();
                    form_data.append('_method', 'delete');
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
                    },
                    type:'post',
                    url:'{{ url("admin/tourdulich/delete") }}' +'/' +id,
                    contentType: false,
                    processData: false,
                    data: form_data,
                }).done(function(rs){
                    var data = JSON.parse(rs);
                        if(data.error){
                            swal({
                        type: 'error',
                        title: 'Oops...',
                        text: data.error,
                        });return false;}
                        swal(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'           
                            ).then((result)=>{window.location.reload();})            
                });
                return false;        
            }
            })
    }
    function tournoibat(id,el) {
        $(el).css('pointer-events',"none");
        var status = $(el).val();
        var form_data = new FormData();
        if(status == 1){
            form_data.append('status', '0');
        }else{
            form_data.append('status', '1');
        }
            
         $.ajax({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            },
            type:'post',
            url:'{{ url("admin/tourdulich/status") }}' +'/' +id,
            contentType: false,
            processData: false,
            data: form_data,
        }).done(function(rs){
            window.location.reload();   
        });

        return false;
         
     }
</script>        
@endsection
