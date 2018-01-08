@layout('common/main')
@section('title')Laporan@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Cetak Laporan Aset</div>
			<div class="card-block">
				<form action="{{site_url('user/laporan/generate')}}" method="POST">
					{{$csrf}}
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Pilih KIB</label>
						<div class="col-md-4">
							<select name="asset_category" class="form-control">
								<option value="a">KIB-A</option>
								<option value="b">KIB-B</option>
								<option value="c">KIB-C</option>
								<option value="d">KIB-D</option>
								<option value="e">KIB-E</option>
								<option value="f">KIB-F</option>
								<option value="g">KIB-G</option>
							</select>
						</div>
					</div>
					<!-- <div class="form-group row">
						<label class="col-md-2 col-form-label">Sampai tahun perolehan</label>
						<div class="col-md-4">
							<select name="tahun_pengadaan" class="form-control">
								@for($i=date('Y'); $i>=1945; $i--)
								<option value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div>
					</div> --><!-- 
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nilai Perolehan</label>
						<div class="col-md-4 form-inline">
							<input type="number" name="nilai_min" min="0" class="form-control mr-4" placeholder="Minimal" />
							<input type="number" name="nilai_max" min="0" class="form-control" placeholder="Maksimal" />
						</div>
					</div> -->
					<div class="form-group row">
						<div class="offset-md-2 col-md-4">
							<button type="submit" class="btn btn-primary"><i class="fa fa-file mr-2"></i>cetak laporan</button>
							<button type="reset" class="btn btn-warning"><i class="fa fa-refresh mr-2"></i>batal</button>
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
	theme.setActive('.menu-laporan');
</script>
@endsection