@layout('common/main')
@section('title')Pengguna@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<h3 class="card-title">{{isset($user->id) ? 'Sunting' : 'Tambah'}} Pengguna</h3>
	</div>
	<div class="card-block">
		<form action="{{isset($user->id) ? site_url('admin/user/update') : site_url('admin/user/create')}}" method="POST">
			{{$csrf}}
			<input type="hidden" name="id" value="{{isset($user->id) ? $user->id : ''}}">
			<h3>Data pribadi</h3><hr>
			<div class="form-group row">
				<label class="col-md-2 col-form-label">Nama</label>
				<div class="col-md-4">
					<input type="text" name="name" class="form-control" placeholder="Nama pengguna" value="{{isset($user->name) ? $user->name : ''}}" required/>
					<small class="form-text text-muted">* wajib diisi</small>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 col-form-label">Email</label>
				<div class="col-md-4">
					<input type="email" name="email" class="form-control" placeholder="Email" value="{{isset($user->email) ? $user->email : ''}}" required/>
					<small class="form-text text-muted">* wajib diisi</small>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 col-form-label">SKPD</label>
				<div class="col-md-4">
					<select name="skpd_id" class="form-control">
						<option value="">Pilih SKPD</option>
						@foreach($skpds AS $skpd)
						<option value="{{$skpd->id}}" {{isset($user->skpd_id) && $user->skpd_id == $skpd->id ? 'selected' : ''}}>{{$skpd->name}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<h3>Data akun</h3><hr>
			<div class="form-group row">
				<label class="col-md-2 col-form-label">Username</label>
				<div class="col-md-4">
					<input type="text" name="username" class="form-control" placeholder="Username" value="{{isset($user->username) ? $user->username : ''}}" required />
					<small class="form-text username-text text-danger"></small>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-2 col-form-label">Kata sandi</label>
				<div class="col-md-4">
					<input type="password" name="password" class="form-control" placeholder="Kata sandi" {{isset($user->id) ? '' : 'required'}} />
					<input type="password" name="password_re" class="form-control" placeholder="Tulis ulang" {{isset($user->id) ? '' : 'required'}} />
					<small class="form-text password-text text-danger"></small>
				</div>
			</div>
			<div class="form-group row">
				<div class="offset-md-2 col-md-4">
					<button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>simpan</button>
					<a href="{{site_url('admin/user')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>kembali</a>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	theme.setActive('.menu-akun');

	$("[name=username]").on('keyup', cekUsername);
	$("[name=password]").on('keyup', cekPassword);
	$("[name=password_re]").on('keyup', cekPassword);

	function cekUsername(e) {
		var username = $("[name=username]").val();
		$.getJSON("{{site_url('admin/user/api_get_by_username/')}}"+username, function(result){
			if (result) {
				$(".username-text").html('username telah terdaftar');
			} else {
				$(".username-text").html('');
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