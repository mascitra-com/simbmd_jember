@layout('common/main')
@section('title')Profil@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Profil Pengguna</h3>
			</div>
			<div class="card-block">
				<form action="{{site_url('admin/profile/update')}}" method="POST">
					{{$csrf}}
					<input type="hidden" name="id" value="{{$profil->id}}">
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nama</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="name" value="{{$profil->name}}" placeholder="nama pengguna" required/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Email</label>
						<div class="col-md-4">
							<input type="email" class="form-control" name="email" value="{{$profil->email}}" placeholder="email" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Username</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="username" value="{{$profil->username}}" placeholder="username" required/>
							<small class="form-text text-danger username-text"></small>
						</div>
					</div>
					<h3>Ubah Kata Sandi</h3>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Password</label>
						<div class="col-md-4">
							<input type="password" class="form-control" name="password" placeholder="Kata sandi" />
							<input type="password" class="form-control" name="password_re" placeholder="Tulis ulang" />
							<small class="form-text text-danger password-text"></small>
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-md-2 col-md-4">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>simpan</button>
							<button type="reset" class="btn btn-warning"><i class="fa fa-refresh mr-2"></i>batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	var username_awal;
	init();

	$("[name=username]").on('keyup', cekUsername);
	$("[name=password]").on('keyup', cekPassword);
	$("[name=password_re]").on('keyup', cekPassword);

	function init() {
		theme.setActive('.menu-profil');
		username_awal = $("[name=username]").val();
	}

	function cekUsername(e) {
		var username = $("[name=username]").val();
		$.getJSON("{{site_url('admin/user/api_get_by_username/')}}"+username, function(result){
			if (result && username !== username_awal) {
				$(".username-text").html('username telah terdaftar');
				$(":submit").attr('disabled', 'disabled');
			} else {
				$(".username-text").html('');
				$(":submit").removeAttr('disabled');
			}
		});
	}

	function cekPassword(e) {
		var password = $("[name=password]").val();
		var password_re = $("[name=password_re]").val();

		if (password === password_re) {
			$(":submit").removeAttr('disabled');
			$(".password-text").html('');
		} else {
			$(":submit").attr('disabled', 'disabled');
			$(".password-text").html('kata sandi tidak sama');
		}
	}
</script>
@endsection