<!DOCTYPE html>
<html lang="vi">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>{{ $content ? $content : ''}}</title>
	<base href="{{ url('') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link rel="icon" href="images/favicon/3581logo-do.jpg">
	<meta name="keywords" content="{{ $content ? $content : ''}}" />
	<meta name="description" content="{{ $content ? $content : ''}}" />
	<meta property="og:title" content="{{ $content ? $content : ''}}">
	<meta property="og:type" content="website">
	<meta property="og:description" content="{{ $content ? $content : ''}}">
	<meta property="og:image" content="images/favicon/3581logo-do.jpg">
	<meta property="og:site_name" content="Công ty cổ phần du lịch và dịch vụ Hải Phòng">
	<meta property="og:url" content="{{ URL::current() }}">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=vietnamese"
	 rel="stylesheet">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<script type="text/javascript" src="js/jquery.js"></script>

	<link type="text/css" rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
	<link type="text/css" rel="stylesheet" href="css/bootstrap/bootstrap-theme.min.css" />
	<script type="text/javascript" src="css/bootstrap/bootstrap.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/normalize.css" />
	<link type="text/css" rel="stylesheet" href="css/layout.css" />
	<link type="text/css" rel="stylesheet" href="css/contact/contact.css" />
	<link type="text/css" rel="stylesheet" href="css/news/news.css" />

	<script type="text/javascript" src="css/fancybox/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="css/fancybox/jquery.fancybox.css" media="screen" />

	<link rel="stylesheet" href="css/flexslider/flexslider.css" type="text/css" media="screen" />
	<script src="css/flexslider/modernizr.js"></script>
	<script src="css/flexslider/jquery.flexslider.js"></script>

	<link type="text/css" rel="stylesheet" href="css/flexisel/style.css" />
	<script type="text/javascript" language="javascript" src="css/flexisel/jquery.flexisel.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.elevatezoom.js"></script>


	<link type="text/css" rel="stylesheet" href="css/slick/slick.css" />
	<script type="text/javascript" src="css/slick/slick.js"></script>
	<link rel="stylesheet" type="text/css" href="css/slick/slick-theme.css">

	<link type="text/css" rel="stylesheet" href="css/simplyscroll/jquery.simplyscroll.css" />
	<script type="text/javascript" src="css/simplyscroll/jquery.simplyscroll.js"></script>

	<script type="text/javascript" language="javascript" src="js/jquery.mobilemenu.js"></script>
	<!--	datetimepicker -->
	<script type="text/javascript" src="css/datepicker/bootstrap-datepicker.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/datepicker/bootstrap-datepicker.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>

	@include('share.script')
	<style>
		.error{
			color :red;
		}
	</style>
</head>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
	var Tawk_API = Tawk_API || {},
		Tawk_LoadStart = new Date();
	(function () {
		var s1 = document.createElement("script"),
			s0 = document.getElementsByTagName("script")[0];
		s1.async = true;
		s1.src = 'https://embed.tawk.to/5a66a5834b401e45400c4d73/default';
		s1.charset = 'UTF-8';
		s1.setAttribute('crossorigin', '*');
		s0.parentNode.insertBefore(s1, s0);
	})();
</script>
<!--End of Tawk.to Script-->
<body @if(isset($abc)) {!! $abc !!} @endif>
	<div class="wrapper animate">
        @include('share.menu_mobile')
		@include('share.header')
		@yield('main')
		@include('share.footer')
	</div>
	@yield('script')
</body>

</html>
