@layout('common/main')
@section('title')Sunting Aset KIB-C@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Sunting data</div>
			<div class="card-block">
				<form action="{{site_url('user/asset_c/insert_rehab')}}" method="POST">
					{{$csrf}}
					<input type="hidden" name="rehab_to" value="{{$id}}">
					<input type="hidden" name="skpd_id" value="{{$skpd_id}}">
					<input type="hidden" name="category_id" value="{{$category_id}}">
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kode Barang</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kode_barang" placeholder="kode barang" required/>
							<small class="form-text text-muted">wajib diisi</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nama</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nama" placeholder="nama barang" required/>
							<small class="form-text text-muted">wajib diisi</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kondisi</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kondisi" placeholder="kondisi" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tingkat</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="tingkat" placeholder="tingkat" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Pondasi</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="pondasi" placeholder="pondasi" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Luas lantai</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="luas_lantai" placeholder="luas lantai" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tanggal Dokumen</label>
						<div class="col-md-4">
							<select name="tahun_pengadaan" class="form-control">
								@for($i = date('Y'); $i >= 1945; $i--)
								<option value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Alamat</label>
						<div class="col-md-4">
							<textarea class="form-control" name="alamat" placeholder="Alamat"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nomor Dokumen</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nomor_dokumen" placeholder="nomor Dokumen" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Luas bangunan</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="luas_bangunan" placeholder="luas bangunan" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Status Tanah</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="status_tanah" placeholder="status tanah" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">kode Tanah</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kode_tanah" placeholder="kode tanah" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Asal-usul</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="asal_usul" placeholder="Asal usul" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nilai Aset</label>
						<div class="col-md-4">
							<input type="number" class="form-control" name="nilai" placeholder="Nilai aset" required/>
							<small class="form-text text-muted">wajib diisi</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Keterangan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="keterangan" placeholder="Keterangan" />
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-md-2 col-md-4">
							<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan</button>
							<a href="{{site_url('user/asset_c')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('style')
<style type="text/css">
	.col-form-label {
		text-align: right;
	}
</style>
@endsection

@section('script')
<script type="text/javascript">
	theme.setActive('.menu-aset')
</script>
@endsection