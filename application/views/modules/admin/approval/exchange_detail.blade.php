@layout('common/main')
@section('title')Detail Data@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<h4 class="card-title">Detail data yang dimutasi</h4>
				<a href="{{site_url('admin/approval/exchange')}}" class="btn btn-warning ml-auto"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
			</div>
			<div class="card-block table-responsive table-full">
				<table class="table table-hover table-bordered table-striped">
					<thead>
						<tr>
							<th>No.</th>
							<th>Mutasi Ke</th>
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
							<td class="text-nowrap text-primary">{{json_decode($dat->temp)->skpd_name}}</td>
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