@layout('common/main')
@section('title')SKPD@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">{{isset($skpd) ? 'Sunting' : 'Tambah'}} SKPD</h3>
			</div>
			<div class="card-block">
				<form action="{{isset($skpd->id) ? site_url('admin/skpd/update') : site_url('admin/skpd/create')}}" method="POST">
					{{$csrf}}
					<input type="hidden" name="id" value="{{isset($skpd->id) ? $skpd->id : ''}}">
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kode</label>
						<div class="col-md-4">
							<input type="text" name="code" class="form-control" value="{{isset($skpd->code) ? $skpd->code : ''}}" placeholder="Kode SKPD" required/>
							<small class="form-text text-danger">* wajib diisi</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nama</label>
						<div class="col-md-4">
							<input type="text" name="name" class="form-control" value="{{isset($skpd->name) ? $skpd->name : ''}}" placeholder="nama SKPD" required />
							<small class="form-text text-danger">* wajib diisi</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Alamat</label>
						<div class="col-md-4">
							<textarea name="address" class="form-control" placeholder="Alamat">{{isset($skpd->address) ? $skpd->address : ''}}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Telpon</label>
						<div class="col-md-4">
							<input type="text" name="phone" class="form-control" value="{{isset($skpd->phone) ? $skpd->phone : ''}}" placeholder="Telpon" />
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-md-2 col-md-4">
							<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>simpan</button>
							<a href="{{site_url('admin/skpd')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>kembali</a>
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
	var batch = (function(){
		init();

		function init() {
			theme.setActive('.menu-akun');
		}

		return{
			hapus:hapus
		}

	})();
</script>
@endsection