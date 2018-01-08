@layout('common/main')
@section('title')Aset Penyusutan@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Buat Penyusutan</div>
			<div class="card-block">
				<form action="{{site_url('user/penyusutan/generate')}}" method="GET">
					<!-- {{$csrf}} -->
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Pilih KIB</label>
						<div class="col-md-4">
							<select name="kib" class="form-control">
								<option value="b">KIB-B</option>
								<option value="c">KIB-C</option>
								<option value="d">KIB-D</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Sampai Tahun Pengadaan</label>
						<div class="col-md-4">
							<select name="tahun_pengadaan" class="form-control">
								@for($i=date('Y'); $i >= 1945; $i--)
								<option value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tahun Penyusutan</label>
						<div class="col-md-4">
							<select name="tahun_penyusutan" class="form-control">
								@for($i=date('Y')+10; $i >= 1945; $i--)
								<option value="{{$i}}" {{($i==date('Y'))?'selected':''}}>{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-md-2 col-md-4">
							<button type="submit" class="btn btn-primary"><i class="fa fa-file mr-2"></i>Generate</button>
							<button type="reset" class="btn btn-warning"><i class="fa fa-refresh mr-2"></i>Batal</button>
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
	theme.setActive('.menu-penyusutan');
</script>
@endsection