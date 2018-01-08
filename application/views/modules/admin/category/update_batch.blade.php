@layout('common/main')
@section('title')Kategori@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<h4>Sunting Sekaligus</h4>
			</div>
			<div class="card-block">
				<form action="{{site_url('admin/category/batch_update')}}" method="POST">
					<table class="table form">
						<thead>
							<tr>
								<th class="text-center">Kode</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Umur Ekonomis</th>
								<th class="text-center">Batas Kapitalisasi</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						{{$csrf}}
						<tbody>
							@foreach($categories AS $cat)
							<tr>
								<input type="hidden" name="id[]" value="{{$cat->id}}">
								<td><input type="text" name="kode[]" class="form-control" placeholder="Kode" value="{{$cat->kode}}" required></td>
								<td><input type="text" name="nama[]" class="form-control" placeholder="Nama" value="{{$cat->nama}}" required></td>
								<td><input type="text" name="umur_ekonomis[]" class="form-control" value="{{$cat->umur_ekonomis}}" placeholder="Umur ekonomis"></td>
								<td><input type="text" name="batas_kapitalisasi[]" class="form-control" value="{{$cat->batas_kapitalisasi}}" placeholder="Batas kapitalisasi"></td>
								<td><button type="button" class="btn btn-secondary btn-block" onclick="batch.hapus(this)"><i class="fa fa-times"></i></button></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>simpan</button>
					<a href="{{site_url('admin/cat')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>kembali</a>
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

		function hapus(e) {
			$(e).closest("tr").remove();
		}

		return{
			hapus:hapus
		}

	})();
</script>
@endsection