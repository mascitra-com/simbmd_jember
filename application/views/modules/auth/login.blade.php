<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SIMBMD Kabupaten Jember</title>
	<link rel="stylesheet" href="{{base_url('res/plugins/bootstrap/css/bootstrap.min.css')}}">
	<style type="text/css">
		html, body {
			background-color: #333;
		}

		.row-full {
			height: 100vh;
			max-height: 100vh;
			overflow:hidden;
		}

		.box {
			box-shadow: 0px 1px 5px rgba(0,0,0,.5);
			border-radius: 5px;
			background-color: #FFF;
		}

		.bg-info, .bg-info *{
			color: #FFF;
		}

		h1,h2,h3,h4{
			font-weight: bolder;
		}

		.alert {
			width: 100%;
			position: absolute;
			top: 0;
			z-index: 9999;
			border-radius: 0
		}

		@media (max-width: 767px) {
			.row-full {
				overflow-y:auto;
			}

			.box{border-radius: 0}
		}
	</style>
</head>
<body>
	<!-- MESSAGE -->
	<?php $message = $this->session->flashdata('message'); ?>
	@if(!empty($message))
	<div class="alert alert-{{$message[1]}} alert-dismissible fade show" role="alert">
		<button type="button" class="close" data-dismiss="alert">
			<span>&times;</span>
		</button>
		<strong>Pesan!</strong> {{$message[0]}}
	</div>
	@endif
	<div class="container-fluid">
		<div class="row row-full align-items-center justify-content-center">
			<div class="col-12 col-md-7">
				<div class="row box">
					<div class="col-12 col-md-6">
						<form action="{{site_url('auth/do_login')}}" method="POST" class="px-4 py-4">
							{{$csrf}}
							<h1 class="mb-0">SIMBMD</h1>
							<span style="font-size: 1.3em">Masuk halaman admin</span>
							<div class="form-group mt-4">
								<label for="">Username</label>
								<input type="text" name="username" class="form-control" placeholder="isi username" required/>
							</div>
							<div class="form-group">
								<label for="">Kata sandi</label>
								<input type="password" name="password" class="form-control" placeholder="isi password" required/>
							</div>
							<div class="form-group">
								<button class="btn btn-primary mr-2">Masuk</button>
								<a href="#">Lupa password?</a>
							</div>
						</form>
					</div>
					<div class="col-12 col-md-6 bg-info">
						<div class="px-3 py-4">
							<h1 class="mb-4">Selamat Datang</h1>
							<p>Sistem Informasi Manajemen Barang Milik Daerah Pemerintah Kabupaten Jember</p>
							<h4>Badan Pengelolaan Keuangan dan Aset (BPKA)</h4>
							<p>Pemerintah Kabupaten Jember</br>
Jl. Sudarman No. 1 Jember</br>
Tilp. +62 331 428824</br>
Fax. +62 331 428824</br>
Email. bpka@jemberkab.go.id<p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="{{base_url('res/plugins/jquery/jquery-3.1.1.min.js')}}"></script>
		<script type="text/javascript" src="{{base_url('res/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	</body>
	</html>