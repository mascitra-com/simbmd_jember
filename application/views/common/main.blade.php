<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SIMBMD - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{base_url('res/plugins/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{base_url('res/plugins/fontawesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{base_url('res/styles/theme.css')}}">
	@yield('style')
</head>
<body>
	<?php $message = $this->session->flashdata('message'); ?>
	@if(!empty($message))
	<div class="alert alert-{{$message[1]}} alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert">
			<span>&times;</span>
		</button>
		<strong>Pesan!</strong> {{$message[0]}}
	</div>
	@endif

	@include('common/topbar_'.$access)
	<div class="container-fluid" id="content">
		@yield('content')
	</div>
	@yield('modal')
	<script type="text/javascript" src="{{base_url('res/plugins/jquery/jquery-3.1.1.min.js')}}"></script>
	<script type="text/javascript" src="{{base_url('res/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{base_url('res/scripts/theme.js')}}"></script>
	@yield('script')
</body>
</html>