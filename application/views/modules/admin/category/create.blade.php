@layout('common/main')
@section('title')Kategori@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Manajemen Kategori</div>
			<div class="card-block">
				<form action="{{isset($cat) ? site_url('admin/category/update') : site_url('admin/category/create')}}" method="POST">
					{{$csrf}}
					<input type="hidden" name="id" value="{{isset($cat) ? $cat->id : ''}}">
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kode</label>
						<div class="col-md-4">
							<input type="text" name="kode" value="{{isset($cat) ? $cat->kode : ''}}" class="form-control" placeholder="Kode" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nama</label>
						<div class="col-md-4">
							<input type="text" name="nama" class="form-control" value="{{isset($cat) ? $cat->nama : ''}}" placeholder="Nama" required />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Umur Ekonomis</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" min="0" name="umur_ekonomis" value="{{isset($cat) ? $cat->umur_ekonomis : 0}}" class="form-control" placeholder="Umur Ekonomis" />
								<span class="input-group-addon">tahun</span>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Batas Kapitalisasi</label>
						<div class="col-md-4">
							<div class="input-group">
								<span class="input-group-addon">Rp</span>
								<input type="number" min="0" name="batas_kapitalisasi" value="{{isset($cat) ? $cat->batas_kapitalisasi : ''}}" class="form-control" placeholder="Batas kapitalisasi" />
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-md-2 col-md-4">
							<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>simpan</button>
							<a href="{{site_url('admin/category')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>kembali</a>
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
			theme.setActive('.menu-pengaturan');
		}

		return{
			hapus:hapus
		}

	})();
</script>
@endsection