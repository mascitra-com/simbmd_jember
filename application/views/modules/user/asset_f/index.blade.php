@layout('common/main')
@section('title')Aset KIB-F@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<!-- BATCH ACTION -->
				<form action="{{site_url('user/asset_f/batch_action')}}" method="POST" id="form-batch" class="hidden-sm-down">
					{{$csrf}}
					<input type="hidden" name="batch_id">
					<div class="input-group">
						<select name="batch_action" class="form-control">
							<option value="0">Pilih aksi...</option>
							<option value="1">Hapus</option>
						</select>
						<span class="input-group-btn">
							<button class="btn btn-info"><i class="fa fa-check"></i></button>
						</span>
					</div>
				</form>

				<!-- DATA COUNT -->
				<span class="mr-auto ml-4"><b><i>{{$data_count}} data ditemukan</i></b></span>

				<!-- ADD BUTTON -->
				<a href="{{site_url('user/asset_f/add')}}" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Tambah / Import</a>
			</div>
			<div class="card-block table-responsive table-full table-scroll">
				<div class="table-container">
					<table class="table table-striped table-hover table-bordered">
						<thead>
							<tr>
								<th width="50px" class="text-center"><input type="checkbox" id="check-all"></th>
								<th class="text-nowrap">Aksi</th>
								<th class="text-nowrap">Thn. Pengadaan</th>
								<th class="text-nowrap">Kode Barang</th>
								<th class="text-nowrap">Nama</th>
								<th class="text-nowrap">Bangunan</th>
								<th class="text-nowrap">Tingkat</th>
								<th class="text-nowrap">Beton</th>
								<th class="text-nowrap">Luas</th>
								<th class="text-nowrap">Alamat</th>
								<th class="text-nowrap">Tgl. Dokumen</th>
								<th class="text-nowrap">No. Dokumen</th>
								<th class="text-nowrap">Tgl. Mulai</th>
								<th class="text-nowrap">Status Tanah</th>
								<th class="text-nowrap">Kode Tanah</th>
								<th class="text-nowrap">Asal Usul</th>
								<th class="text-nowrap">Nilai</th>
								<th class="text-nowrap">Keterangan</th>
								<th>Kategori</th>
							</tr>

							<!-- FILTER DATA  -->
							<form action="{{site_url('user/asset_f')}}" method="GET">
								<tr>
									<th class="th-form" colspan="2"><button class="btn btn-primary btn-block btn-sm"><i class="fa fa-search mr-2"></i>filter data</button></th>
									<th class="th-form"><input type="text" name="tahun_pengadaan" class="form-control" value="{{isset($filter['tahun_pengadaan']) ? $filter['kode_barang'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="kode_barang" class="form-control" value="{{isset($filter['kode_barang']) ? $filter['kode_barang'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="nama" class="form-control" value="{{isset($filter['nama']) ? $filter['nama'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="bangunan" class="form-control" value="{{isset($filter['bangunan']) ? $filter['bangunan'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="tingkat" class="form-control" value="{{isset($filter['tingkat']) ? $filter['tingkat'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="beton" class="form-control" value="{{isset($filter['beton']) ? $filter['beton'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="luas" class="form-control" value="{{isset($filter['luas']) ? $filter['luas'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="alamat" class="form-control" value="{{isset($filter['alamat']) ? $filter['alamat'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="tanggal_dokumen" class="form-control" value="{{isset($filter['tanggal_dokumen']) ? $filter['tanggal_dokumen'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="nomor_dokumen" class="form-control" value="{{isset($filter['nomor_dokumen']) ? $filter['nomor_dokumen'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="tanggal_mulai" class="form-control" value="{{isset($filter['tanggal_mulai']) ? $filter['tanggal_mulai'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="status_tanah" class="form-control" value="{{isset($filter['status_tanah']) ? $filter['status_tanah'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="kode_tanah" class="form-control" value="{{isset($filter['kode_tanah']) ? $filter['kode_tanah'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="text" name="asal_usul" class="form-control" value="{{isset($filter['asal_usul']) ? $filter['asal_usul'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="number" name="nilai" class="form-control" value="{{isset($filter['nilai']) ? $filter['nilai'] : ''}}" placeholder="-"></th>
									<th class="th-form"><input type="number" name="keterangan" class="form-control" value="{{isset($filter['keterangan']) ? $filter['keterangan'] : ''}}" placeholder="-"></th>
									<th class="th-form">
										<select name="category_id" class="form-control">
											<option value="">semua...</option>
											@foreach($categories AS $cat)
											<option value="{{$cat->id}}" {{isset($filter['category_id']) && $filter['category_id'] == $cat->id ? 'selected' : ''}}>{{$cat->nama}}</option>
											@endforeach
										</select>
									</th>
								</tr>
							</form>
							<!-- END FILTER DATA  -->

						</thead>
						<tbody>
							@if(empty($kibs))
								<tr><td colspan="20" class="text-center">Tidak ada data</td></tr>
							@endif

							@foreach($kibs AS $kib)
							<tr>
								<td width="50px" class="text-center"><input type="checkbox" value="{{$kib->id}}"></td>
								<td class="text-nowrap">
									<div class="btn-group">
										<a href="{{site_url('user/asset_f/edit/'.$kib->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
										<a href="{{site_url('user/asset_f/delete/'.$kib->id)}}" class="btn btn-sm btn-warning" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"></i></a>
										<button class="btn btn-sm btn-secondary" data-id="{{$kib->id}}"><i class="fa fa-exchange mr-2"></i>Mutasi</button>
									</div>
								</td>
								<td class="text-nowrap">{{$kib->tahun_pengadaan}}</td>
								<td class="text-nowrap">{{$kib->kode_barang}}</td>
								<td class="text-nowrap">{{$kib->nama}}</td>
								<td class="text-nowrap">{{$kib->bangunan}}</td>
								<td class="text-nowrap">{{$kib->tingkat}}</td>
								<td class="text-nowrap">{{$kib->beton}}</td>
								<td class="text-nowrap">{{$kib->luas}}</td>
								<td class="text-nowrap">{{$kib->alamat}}</td>
								<td class="text-nowrap">{{$kib->tanggal_dokumen}}</td>
								<td class="text-nowrap">{{$kib->nomor_dokumen}}</td>
								<td class="text-nowrap">{{$kib->tanggal_mulai}}</td>
								<td class="text-nowrap">{{$kib->status_tanah}}</td>
								<td class="text-nowrap">{{$kib->kode_tanah}}</td>
								<td class="text-nowrap">{{$kib->asal_usul}}</td>
								<td class="text-nowrap">{{money($kib->nilai)}}</td>
								<td class="text-nowrap">{{$kib->keterangan}}</td>
								<td class="text-nowrap">{{$kib->kategori}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer">{{$pagination}}</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal-mutasi">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Mutasi Aset</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{site_url('user/asset_f/exchange')}}" method="POST">
					{{$csrf}}
					<input type="hidden" name="id">
					<div class="form-group">
						<select name="skpd_id" class="form-control">
							<option value="">Pilih OPD...</option>
							@foreach($skpds AS $skpd)
							<option value="{{$skpd->id}}" {{isset($filter['skpd_id']) && $filter['skpd_id'] == $skpd->id ? 'selected' : ''}}>{{ucwords(strtolower($skpd->name))}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary"><i class="fa fa-exchange mr-2"></i>Simpan</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('style')
<style type="text/css">
	td {
		text-transform: capitalize;
	}

	.th-form {
		padding: 0!important;
	}

	.th-form .form-control {
		border:none;
		border-radius: 0;
		margin:0;
	}

	.th-form .btn {
		box-shadow: none;
		border-radius: 0;
	}

	.table > thead > tr > th {
		vertical-align: middle;
	}
</style>
@endsection

@section('script')
<script type="text/javascript">
	var asset = (function(){
		// cahce DOM
		var $form 	  = $("#form-batch");
		var $batch_id = $("[name='batch_id']");

		// bind events
		$form.on('submit', eventFormSubmit);
		$("#check-all").on('change', eventCheckChange);
		$("[data-id]").on('click', eventMutasi);

		init();

		// init function
		function init(){
			theme.setActive('.menu-aset');
		}

		function eventFormSubmit(e) {
			e.preventDefault();
			
			var value = "";
			$("[type='checkbox']").each(function(){
				if ($(this).is(':checked') && $(this).val() !== '') {
					value = value +' '+$(this).val();
				}
			});

			$batch_id.val(value);

			$(e.currentTarget).unbind('submit').submit();
		}

		function eventCheckChange(e) {
			var checkedStatus = $(e.target).is(":checked");
			$('table tbody tr').find('td:first [type=checkbox]').each(function() {
				$(this).prop('checked', checkedStatus);
			});
		}

		function eventMutasi(e) {
			var id = $(e.currentTarget).data('id');
			$("#modal-mutasi [name='id']").val(id);
			$("#modal-mutasi").modal('show');
		}
	})();
</script>
@endsection