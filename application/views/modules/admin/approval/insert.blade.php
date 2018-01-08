@layout('common/main')
@section('title')Persetujuan Hapus Data@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Persetujuan Penyuntingan Data</h4>
			</div>
			<div class="card-block table-responsive table-full">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th class="text-center" width="100px">No</th>
							<th>OPD</th>
							<th>Jumlah Pengajuan</th>
							<th>Jenis Aset</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@if(empty($approvals))
						<tr><td colspan="5" class="text-center">Tidak ada pengajuan</td></tr>
						@endif

						<?php $no = 1; ?>
						@foreach($approvals AS $app)
						<tr>
							<td class="text-center">{{str_pad($no++, 3, '0', STR_PAD_LEFT)}}</td>
							<td>{{$app->skpd}}</td>
							<td>{{$app->jumlah}} Pengajuan</td>
							<td>KIB-{{strtoupper($app->jenis_aset)}}</td>
							<td class="text-right">
								<a href="{{site_url('admin/approval/insert_detail/kib'.$app->jenis_aset.'/'.$app->skpd_id)}}" class="btn btn-secondary btn-sm"><i class="fa fa-info mr-2"></i>selengkapnya</a>
								<button class="btn btn-success btn-sm btn-setuju" data-id="{{$app->skpd_id}}" data-kib="{{$app->jenis_aset}}"><i class="fa fa-check mr-2"></i>setujui</a>
								<button class="btn btn-danger btn-sm btn-batal" data-id="{{$app->skpd_id}}" data-kib="{{$app->jenis_aset}}"><i class="fa fa-times mr-2"></i>tolak</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal-approval">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{site_url('admin/approval/insert_save')}}" method="POST">
					{{$csrf}}
					<div class="form-group">
						<input type="hidden" name="skpd_id">
						<input type="hidden" name="asset_category">
						<input type="hidden" name="approval_status">
						<textarea name="message" rows="7" class="form-control" placeholder="Pesan"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn"></button>
						<button type="button" class="btn btn-warning" data-dismiss='modal'><i class="fa fa-times mr-2"></i>batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	theme.setActive('.menu-persetujuan');

	$(".modal form").on('submit', function(){
		$(".modal :submit").text("Memproses. . .").attr("disabled", "disabled");
	});

	$(".btn-setuju").on('click', function(){
		var skpd_id = $(this).data('id');
		var asset_category = $(this).data('kib');

		$(".modal-dialog").removeClass('modal-danger').addClass('modal-success');
		$(".modal-title").html('<i class="fa fa-check mr-2"></i>Setujui');
		$("#modal-approval :submit").removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-check mr-2"></i>Setujui');
		$("#modal-approval [name=skpd_id]").val(skpd_id);
		$("#modal-approval [name=asset_category]").val(asset_category);
		$("#modal-approval [name=approval_status]").val(1);

		$("#modal-approval").modal('show');
	});

	$(".btn-batal").on('click', function(){
		var skpd_id = $(this).data('id');
		var asset_category = $(this).data('kib');

		$(".modal-dialog").removeClass('modal-sucess').addClass('modal-danger');
		$(".modal-title").html('<i class="fa fa-ban mr-2"></i>Tolak');
		$("#modal-approval :submit").removeClass('btn-sucess').addClass('btn-danger').html('<i class="fa fa-ban mr-2"></i>Tolak');
		$("#modal-approval [name=skpd_id]").val(skpd_id);
		$("#modal-approval [name=asset_category]").val(asset_category);
		$("#modal-approval [name=approval_status]").val(0);

		$("#modal-approval").modal('show');
	});
</script>
@endsection