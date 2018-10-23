<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Khách hàng liên hệ</h1>
    <h3>Họ Tên : {{ $detail['name'] }}</h3>
    <h3>Số điện thoại : {{ $detail['mobile'] }}</h3>
    <h3>Email : {{ $detail['email'] }}</h3>
    <h3>Nội dung yêu cầu : {{ $detail['body'] }}</h3>
</body>
</html>