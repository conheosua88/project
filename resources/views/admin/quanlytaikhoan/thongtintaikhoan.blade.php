@extends('admin.share.layout')
@section('main')
 <div class="right_col" role="main" >
          <div class="">  
           
                  <div ><h3>Thông tin tài khoản</h3></div>
                    <div>
                     @if(count($errors) > 0)
                      <div class="alert alert-danger">
                          @foreach($errors->all() as $err)
                          {{ $err }}<br>
                          @endforeach
                      </div>
                      @endif
                      @if(session('thongbao'))
                      <div class="alert alert-success">{{ session('thongbao') }}</div>
                      @endif
                      
                      <form action="{{ url('admin/taikhoan') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div>
                          <label>Tài khoản đăng nhập</label>
                          <input type="text" class="form-control" placeholder="Nhập tên" name="name" value="{{ old('name',Auth::user()->name) }}" >
                        </div>
                        <br>
                        <div>
                          <label>Ảnh đại diện</label>
                          <input type="file" class="form-control" name="anh" id="anh">
                          <img src="@if(Auth::user()->image !=''){{ Auth::user()->image }}@else{{'images/noimage.jpg'}}@endif" id="anhhienthi" width="150" alt="">
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="text" class="form-control" placeholder="Nhập Email" name="email" value="@if(Auth::user()->email != ''){{ Auth::user()->email }} @endif"
                            >
                        </div>
                        <br>
                         
                        <div>
                          <input type="checkbox" id="changePassword" name="changePassword">
                            <label>Đổi mật khẩu</label>
                            <input type="password" class="password form-control" name="password" aria-describedby="basic-addon1" disabled>
                          <br>
                            <label>Nhập lại mật khẩu</label>
                            <input type="password" class="password form-control" name="passwordAgain" aria-describedby="basic-addon1" disabled>
                        </div>
                        
                        <br>
                        <button type="submit" class="btn btn-default">Sửa
                        </button>

                      </form>
                     
                    </div>
                  </div>
            
          </div>  
</div>
<script>
   $(document).ready(function(){
      $("#changePassword").change(function(){
          if($(this).is(":checked")){
              $(".password").removeAttr('disabled');
          }else{
              $(".password").attr('disabled','');
          }
      });
   });

   $('input[name=anh]').change( function(event) {
      var tmppath = URL.createObjectURL(event.target.files[0]);
      $("#anhhienthi").attr('src',tmppath);
  });
</script>
@endsection      