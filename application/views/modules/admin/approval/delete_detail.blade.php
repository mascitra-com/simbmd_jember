@layout('common/main')
@section('title')Detail Data@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<h4 class="card-title">Detail data yang dihapus</h4>
				<a href="{{site_url('admin/approval/delete')}}" class="btn btn-warning ml-auto"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
			</div>
			<div class="card-block table-responsive table-full">
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>No.</th>
							@foreach($data[0] AS $key=>$value)
							@if(!in_array($key, $excluded))
							<th>{{$key}}</th>
							@endif
							@endforeach
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; ?>
						@foreach($data AS $dat)
						<tr>
							<td class="text-center">{{str_pad($no++, 3, '0', STR_PAD_LEFT)}}</td>
							@foreach($dat AS $index=>$item)
							@if(!in_array($index, $excluded))
							<td class="text-nowrap">{{$item}}</td class="text-nowrap">
							@endif
							@endforeach
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection