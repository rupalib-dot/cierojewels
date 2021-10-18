<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QuirinusSoft</title>
</head>
<body>
	<h1>You Are Not Authorised</h1>
	@if (session('url'))<button><a href="{{session('url')}}">Return to last page</button></div>@endif
	
</body>
</html>