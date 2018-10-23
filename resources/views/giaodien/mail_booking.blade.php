<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Khách hàng đặt TOUR</h1>
    <h3>Tên tour : {{ $detail['tour_name'] }}</h3>
    <h3>Thời gian khởi hành : {{ $detail['tour_time'] }}</h3>
    <h3>Họ tên khách hàng : {{ $detail['name'] }}</h3>
    <h3>Số điện thoại : {{ $detail['mobile'] }}</h3>
    <h3>Địa chỉ : {{ $detail['address'] }}</h3>
    <h3>Email : {{ $detail['email'] }}</h3>
    <h3>Ghi chú : {{ $detail['content'] }}</h3>
    <h3>Thanh toán qua : {{ $detail['pt'] }}</h3>
</body>
</html>