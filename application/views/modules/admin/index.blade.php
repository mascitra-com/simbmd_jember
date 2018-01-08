@layout('common/main')
@section('title')Dashboard@endsection

@section('content')
<div class="row mb-5">
	<div class="col">
		<div class="card">
			<div class="card-header">Sistem Informasi Manajemen Barang Milik Daerah Kabupaten Jember</div>
			<div class="card-block">
				<h4 class="card-title">Selamat datang di SIMBMD Kabupaten Jember</h4>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6 col-md-6">
		<div class="card card-inverse card-primary card-widget">
			<div class="card-block">
				<h4 class="card-title">Jumlah Aset</h4>
				<h1 class="card-text">{{money($insight['asset_count'])}}</h1>
				<span>aset</span>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="card card-inverse card-info card-widget">
			<div class="card-block">
				<h4 class="card-title">Total Nilai Aset</h4>
				<h3 class="card-text">Rp {{money($insight['asset_sum'])}}</h3>
				<!-- <span>(dalam juta)</span> -->
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="card card-inverse card-success card-widget">
			<div class="card-block">
				<h4 class="card-title">Total Pengajuan</h4>
				<h1 class="card-text">{{$insight['proposal_count']}}</h1>
				<span>pengajuan</span>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="card card-inverse card-warning card-widget">
			<div class="card-block">
				<h4 class="card-title">Jumlah SKPD</h4>
				<h1 class="card-text">{{$insight['skpd_count']}}</h1>
				<span>SKPD</span>
			</div>
		</div>
	</div>
</div>
@endsection

@section('style')
<style type="text/css">
	.card-widget {
		height: 150px;
		margin-bottom: 10px;
	}
</style>
@endsection

@section('script')
<script type="text/javascript">
	theme.setActive('.menu-beranda')
</script>
@endsection