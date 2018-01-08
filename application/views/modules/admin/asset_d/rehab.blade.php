@layout('common/main')
@section('title')Tambah Rehab KIB-D@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Tambah data</div>
			<div class="card-block">
				<form action="{{site_url('admin/asset_d/insert_rehab')}}" method="POST">
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
						<label class="col-md-2 col-form-label">Kontruksi</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kontruksi" placeholder="kontruksi" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Panjang</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="panjang" placeholder="panjang" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Lebar</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="lebar" placeholder="lebar" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Luas</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="luas" placeholder="luas" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Alamat</label>
						<div class="col-md-4">
							<textarea class="form-control" name="alamat" placeholder="Alamat"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tanggak Dokumen</label>
						<div class="col-md-4">
							<select name="tahun_pengadaan" class="form-control">
								@for($i = date('Y'); $i >= 1945; $i--)
								<option value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nomor Dokumen</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nomor_dokumen" placeholder="nomor Dokumen" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Status Tanah</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="status_tanah" placeholder="status tanah" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nomor Tanah</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nomor_tanah" placeholder="nomor tanah" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Asal-usul</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="asal_usul" placeholder="Asal usul" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kondisi</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kondisi" placeholder="Kondisi" />
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
							<a href="{{site_url('admin/asset_d')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
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