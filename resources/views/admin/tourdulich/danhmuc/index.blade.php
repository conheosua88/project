@extends('admin.share.layout')
@section('main')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-lg-12">
                        <h1>Danh mục</h1>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" class="btn btn-round btn-default" name="timkiem" placeholder="Search">
                        <button style="background:transparent;border:0" onclick="timkiem();"><i class="fa fa-search"></i></button>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-round btn-success pull-right" id="btnAdd">Thêm mới</button>
                    </div>

                </div>
                <div class="card-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>   
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Danh mục cha</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="danhsach">
                            @foreach($danhmucs as $danhmuc)
                                <tr>
                                    <td>{{$danhmuc->name}}</td>
                                    <td danhmuccha-id="{{ $danhmuc->parent ? $danhmuc->parent->id : 'null' }}">{{ $danhmuc->parent ? $danhmuc->parent->name : 'null' }}</td>
                                    <td>
                                        <button class="btn btn-info btnEdit" onclick="sua({{$danhmuc->id}})">Sửa</button>
                                        <button class="btn btn-danger btnDel" onclick="xoa({{$danhmuc->id}})">Xóa</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pull-right" id="phantrang_laravel">                   
                    {{ $danhmucs->links() }}
                    </div>
                    <ul id="phantrang"></ul>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Thêm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">   
            <div class="form-group">
                <label for="ten">Chọn danh mục cha</label>
                <select name="danhmucAdd" class="form-control">
                    <option value="0">=====*=====</option>
                    {{ \App\Helpers\Menu::menu($danhmucs) }}
                </select>
            </div>
            <div class="form-group">
                <label for="ten">Tên danh mục</label>
                <input type="text" class="form-control" id="tenAdd"  placeholder="Nhập tên">
            </div> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSave">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>

</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Sửa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="frmEdit">
              <div class="form-group">   
                  <label for="ten">Chọn danh mục cha</label>
                  <select name="danhmucEdit" class="form-control">
                      <option value="0">=====*=====</option>
                      {{ App\Helpers\Menu::menu($danhmucs) }}
                  </select>
              </div>
              <div class="form-group">
                  <label for="ten">Tên danh mục</label>
                  <input type="text" class="form-control" name="tenEdit"  placeholder="Nhập tên">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSaveEdit" onclick="sua_modal();">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>

</div>   
@endsection
@section('script')
<script>
    
    $('input[name=anh_Add]').change( function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("#anhhienthiAdd").attr('src',tmppath);
    });
    $('input[name=anh_Edit]').change( function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("#anhhienthiEdit").attr('src',tmppath);
    });
        var timkiem = function(){
            var ten_tieude = $(' input[name=timkiem]').val();
            $('#phantrang_laravel').css('display','none');
            danhsach(ten_tieude,1,10);
        }
        var danhsach = function(ten_tieude,page,limit){
            var url = 'admin/tourdulich/search_category';
            url+= ten_tieude != '' ? '/'+ten_tieude : '/all';
            url += '/'+page+'/'+limit;
            $.get(url,function(rs){
                var html ='';
                var data = JSON.parse(rs);
                for(var i = 0;i < data.data.length;i++){
                    html+='<tr>';
                    html+='<td>'+data.data[i].name+'</td>';
                    html+='<td>'+data.data[i].parent_category_name+'</td>';        
                    html+='<td><a class="btn btn-info btnEdit fa fa-pencil" onclick="sua('+data.data[i].id+')">Sửa</a>'+
                                '<button class="btn btn-danger btnDel fa fa-trash-o" onclick="xoa( '+data.data[i].id+' )">Xóa</button></td>';
                    html+='</tr>';
                }
                $('#danhsach').html(html);
                html = '';
                    if (data.total > 1) {
                        if (page == 1) {
                            html += '<li class="disabled"  ><a style="cursor: no-drop;"> ← </a></li>';
                        }
                        else {
                            html += '<li ><a onclick="danhsach(\''+ten_tieude+'\','+(page-1)+','+limit+');"> ← </a></li>';
                        }

                        for (var i = 1; i <= data.total; i++) {
                            if (page == i) {
                                html += '<li class="active"><a onclick="danhsach(\''+ten_tieude+'\','+i+','+limit+');">' + i + '</a></li>';
                            } else {
                                html += '<li><a onclick="danhsach(\''+ten_tieude+'\','+i+','+limit+');">' + i + '</a></li>';
                            }
                        }

                        if (page ==  data.total) {
                            html += '<li class="disabled"><a style="cursor: no-drop;"> → </a></li>';
                        }
                        else {
                            html += '<li><a onclick="danhsach(\''+ten_tieude+'\',,'+(page+1)+','+limit+');"> → </a></li>';
                        }

                    }
                $('#phantrang').html(html);
            });
        }
    
    var sua = function(id){
        $.get('/admin/tourdulich/danhsach/'+id,function(rs){
            var data = JSON.parse(rs);     
            var id = data.data.id    
            var ten = data.data.name;
            var danhmucid = data.data.parent_category_id;
            $("#frmEdit [name=tenEdit]").val(ten);
            $('#frmEdit select option[value=' + danhmucid + '] ').prop("selected", true);
            $('#frmEdit select option').prop("hidden", false);
            $('#frmEdit select option[value=' + id + '] ').prop("hidden", true);
            
            $("#btnSaveEdit").attr('danhmuc-id', id);
            $("#modalEdit").modal('show');
        })
    }
    var sua_modal = function(){
        var ten = $("#frmEdit [name=tenEdit]").val();
            var danhmucid = $('#frmEdit option:selected').val();
            if(ten == ''){
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Bạn chưa nhập tên',
                    });return false;}
            var form_data = new FormData();
            form_data.append('danhmucid',danhmucid);
            form_data.append('ten',ten);
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
                },
                type:'post',
                url:'{{  url("admin/tourdulich/suadanhmuc") }}' +'/' + $('#btnSaveEdit').attr('danhmuc-id'),
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
                    });return;}
                        window.location.reload();
                       
                }).fail(function(err){
                    console.log(err);
                    $("#modalEdit").modal('hide');
                });

            return false;
    }
    var xoa = function(id){
        swal({
            title: 'Are you sure?',
            text: "Bạn có muốn xóa danh mục này ko!",
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
                        url:'{{ url("admin/tourdulich/xoadanhmuc") }}' +'/' +id,
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
                            
                    }).fail(function(err){
                        console.log(err);
                        $("#modalDel").modal('hide');
                    });

                    return false;            
            }
            })
    }
    
    $(document).ready(function() {
        

        $("#btnAdd").on('click',function(){
            $("#tenAdd").val('');
            $("#modalAdd").modal('show');
        });
        
        $("#btnSave").on('click',function(){
            var ten = $("#tenAdd").val();
            var danhmucid = $('select[name=danhmucAdd] option:selected').val();
            var error = '';
            if(ten == ''){error += 'Bạn chưa nhập tên \n'}
            if(error != '') {
                swal({
                    type: 'error',
                    title: 'Oops...',
                    text: error,
                    }); return ;
            }
            var form_data = new FormData();
            form_data.append('ten',ten);
            form_data.append('danhmucid',danhmucid);
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
                },
                type:'post',
                url:'{{ url("admin/tourdulich/themdanhmuc") }}',
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
                     window.location.reload();
                     
                }).fail(function(err){
                    console.log(err);
                    $("#modalAdd").modal('hide');
                });

            return false;
        });
        
        
    });
</script>
@endsection 