@layout('common/main')
@section('title')Import Data Aset KIB-E@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Import Data</div>
			<div class="card-block row">
				<div class="col-md-5">
					<form action="{{site_url('admin/asset_e/import')}}" method="POST" enctype="multipart/form-data">
						{{$csrf}}
						<div class="form-group">
							<label>Pilih OPD</label>
							<select class="form-control" name="skpd_id">
								<option value="">Pilih OPD</option>
								@foreach($skpds AS $skpd)
								<option value="{{$skpd->id}}">{{$skpd->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Pilih Berkas</label>
							<input type="file" class="form-control" name="file" accept=".xls,.xlsx">
						</div>
						<div class="form-group">
							<label>Pesan (opsional)</label>
							<textarea name="message" class="form-control" placeholder="tulis pesan"></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary"><i class="fa fa-upload mr-2"></i>import</button>
							<a href="{{site_url('admin/asset_e')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>kembali</a>
						</div>
					</form>
				</div>
				<div class="col">
					<h3>Perlu diperhatikan!</h3>
					<p>File import harus sesuai dengan format yang telah ditentukan. Isilah data yang sesuai dan tidak boleh kosongi data yang wajib diisi. Unduh format excel disini.</p>
					<a href="{{site_url('res/docs/pre/template_kibe.xls')}}" class="btn btn-primary"><i class="fa fa-download mr-2"></i>unduh format excel</a>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Input data</div>
			<div class="card-block">
				<form action="{{site_url('admin/asset_e/insert')}}" method="POST">
					{{$csrf}}
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Pilih OPD</label>
								<div class="col">
									<select class="form-control" name="skpd_id">
										<option value="">Pilih OPD</option>
										@foreach($skpds AS $skpd)
										<option value="{{$skpd->id}}">{{$skpd->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Kode Barang</label>
								<div class="col">
								<input type="text" class="form-control" name="kode_barang" placeholder="kode barang" required/>
									<small class="form-text text-muted">wajib diisi</small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nama</label>
								<div class="col">
									<input type="text" class="form-control" name="nama" placeholder="nama barang" required/>
									<small class="form-text text-muted">wajib diisi</small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Kategori</label>
								<div class="col">
									<select name="category_id" class="form-control">
										<option value="">Pilih kategori...</option>
										@foreach($categories AS $cat)
										<option value="{{$cat->id}}">{{$cat->nama}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">reg</label>
								<div class="col">
									<input type="text" class="form-control" name="reg" placeholder="Reg" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Judul buku</label>
								<div class="col">
									<input type="text" class="form-control" name="buku_judul" placeholder="Judul buku" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Spesifikasi buku</label>
								<div class="col">
									<input type="text" class="form-control" name="buku_spesifikasi" placeholder="Spesifikasi buku" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Asal barang</label>
								<div class="col">
									<input type="text" class="form-control" name="barang_asal" placeholder="Asal barang" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Pencipta barang</label>
								<div class="col">
									<input type="text" class="form-control" name="barang_pencipta" placeholder="Pencipta barang" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Bahan barang</label>
								<div class="col">
									<input type="text" class="form-control" name="barang_bahan" placeholder="Bahan barang" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jenis hewan</label>
								<div class="col">
									<input type="text" class="form-control" name="hewan_jenis" placeholder="Jenis hewan" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Ukuran hewan</label>
								<div class="col">
									<input type="text" class="form-control" name="hewan_ukuran" placeholder="Ukuran hewan" />
								</div>
							</div>
						</div>
						<div class="col">
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Jumlah</label>
								<div class="col">
									<input type="number" class="form-control" name="jumlah" placeholder="Jumlah" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Tahun pembuatan</label>
								<div class="col">
									<select name="tahun_pembuatan" class="form-control">
										@for($i = date('Y'); $i >= 1945; $i--)
										<option value="{{$i}}">{{$i}}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Tahun pengadaan</label>
								<div class="col">
									<select name="tahun_pengadaan" class="form-control">
										@for($i = date('Y'); $i >= 1945; $i--)
										<option value="{{$i}}">{{$i}}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Asal-usul</label>
								<div class="col">
									<input type="text" class="form-control" name="asal_usul" placeholder="Asal usul" />
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Nilai Aset</label>
								<div class="col">
									<input type="number" class="form-control" name="nilai" placeholder="Nilai aset" required/>
									<small class="form-text text-muted">wajib diisi</small>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3 col-form-label">Keterangan</label>
								<div class="col">
									<input type="text" class="form-control" name="keterangan" placeholder="Keterangan" />
								</div>
							</div>
							<div class="form-group row">
								<div class="offset-md-3 col">
									<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan</button>
									<a href="{{site_url('admin/asset_e')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
								</div>
							</div>
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

	@media(max-width: 768px){
		.col-form-label {
			text-align: left;
		}
	}
</style>
@endsection