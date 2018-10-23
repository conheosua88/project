@extends('admin.share.layout')
@section('main')
<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-12"> 
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-12">
                        <h1>Bài viết</h1>
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
                        <a class="btn btn-round btn-primary pull-right" id="btnAdd" href="{{ url('admin/tintuc/create') }}" style="margin-top: 20px;">Thêm bài viết</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" style="overflow-x: hidden;">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Lượt xem </th>
                            <th scope="col">Danh mục</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="danhsach">
                            @foreach($tintucs as $danhsach)
                            <tr>
                            <td><img src="{{ $danhsach->image }}" alt="" width="100px"></td>
                            <td>{{ $danhsach->title }}</td>
                            <td>{{ str_limit($danhsach->content,100) }}</td>
                            <td>{{ $danhsach->view }}</td>
                            <td>{{ $danhsach->parent_new ? $danhsach->parent_new->name : 'null' }}</td> 
                            <td>
                                <a class="btn btn-info btnEdit fa fa-pencil" href="{{ url('admin/tintuc/edit').'/'.$danhsach->id }}">Sửa</a>
                                <button class="btn btn-danger btnDel fa fa-trash-o" onclick="Delete({{ $danhsach->id }})">Xóa</button>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right" id="phantrang_laravel">     
                        {{ $tintucs->links() }}
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
            var url = 'admin/tintuc/search_new';
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
                    html+='<td>'+(data.data[i].content).substring(0,100)+'</td>';
                    html+='<td>'+data.data[i].view+'</td>';
                    html+='<td>'+data.data[i].TenDanhMucCha+'</td>';
                    html+='<td><a class="btn btn-info btnEdit fa fa-pencil" href="admin/tintuc/edit/'+data.data[i].id+'">Sửa</a>'+
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
                        url:'{{ url("admin/tintuc/delete") }}' +'/' +id,
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
     
</script>        
@endsection
