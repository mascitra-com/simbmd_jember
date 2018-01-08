@layout('common/main')
@section('title')Detail Data@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<h4 class="card-title mr-auto">Detail data yang disunting</h4>
				<span class="text-danger mr-3"><i class="fa fa-circle"></i> Data lama</span>
				<span class="text-success mr-4"><i class="fa fa-circle"></i> Data baru</span>
				<a href="{{site_url('admin/approval/update')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>kembali</a>
			</div>
			<div class="card-block table-responsive table-full">
				<table class="table table-hover table-striped">
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
							<?php
								$temp = json_decode($dat->temp);
								foreach ($dat as $key => $value) {
									if (!in_array($key, $excluded)) {
										$val = (!empty($temp->{$key}) && $value !== $temp->{$key}) ? "<span class='text-danger'>".$temp->{$key}."</span> => <span class='text-success'>{$value}</span>" : $value;
										echo "<td class='text-nowrap'>{$val}</td>";
									}
								}
							?>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection