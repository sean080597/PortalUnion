<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>{{ config('app.name', 'HUTECH | DOAN HOI') }}</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Chango" rel="stylesheet">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ asset('theme/css/404_style.css') }}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div>
				<div class="notfound-404">
					<h1>!</h1>
				</div>
				<h2>Error<br>404</h2>
			</div>
            <p>Tài khoản của bạn không có quyền truy cập vào trang này</a></p>
            <div id="page-error">
                <h3 class="text-center">Quay trở lại <a href="{{url('/')}}" class="text-primary">Trang Chủ</a></h3>
            </div>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
