@layout('common/main')
@section('title')SKPD@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<h4>Sunting Sekaligus</h4>
			</div>
			<div class="card-block">
				<form action="{{site_url('admin/skpd/batch_update')}}" method="POST">
					<table class="table form">
						<thead>
							<tr>
								<th class="text-center">Kode</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Alamat</th>
								<th class="text-center">Telpon</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						{{$csrf}}
						<tbody>
							@foreach($skpds AS $skpd)
							<tr>
								<input type="hidden" name="id[]" value="{{$skpd->id}}">
								<td><input type="text" name="code[]" class="form-control" placeholder="Kode" value="{{$skpd->code}}" required></td>
								<td><input type="text" name="name[]" class="form-control" placeholder="Nama" value="{{$skpd->name}}" required></td>
								<td><input type="text" name="address[]" class="form-control" value="{{$skpd->address}}" placeholder="Alamat"></td>
								<td><input type="text" name="phone[]" class="form-control" value="{{$skpd->phone}}" placeholder="Telpon"></td>
								<td><button type="button" class="btn btn-secondary btn-block" onclick="batch.hapus(this)"><i class="fa fa-times"></i></button></td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>simpan</button>
					<a href="{{site_url('admin/skpd')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>kembali</a>
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

		function hapus(e) {
			$(e).closest("tr").remove();
		}

		return{
			hapus:hapus
		}

	})();
</script>
@endsection