<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quản lý hệ thống </title>
    <base href="{{ asset('') }}">
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="admin/login" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <h1>Quản lý hệ thống</h1>
              @if(count($errors) > 0)
                  <div class="alert alert-danger">
                      @foreach($errors->all() as $err)
                      {{ $err }}<br>
                      @endforeach
                  </div>
              @endif
              @if(session('thongbao'))
                  <div class="alert alert-danger">{{ session('thongbao') }}</div>
              @endif
              <div>
                <input type="text" class="form-control" placeholder="Username" name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password"/>
              </div>
              <div>
                <button class="btn btn-default" type="submit">Log in</button>
               
              </div>

              <div class="clearfix"></div>
              <div class="separator">
                
              </div>
              
              </div>
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>
