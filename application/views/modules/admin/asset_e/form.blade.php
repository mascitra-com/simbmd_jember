@layout('common/main')
@section('title')Sunting Aset KIB-E@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Sunting data</div>
			<div class="card-block">
				<form action="{{site_url('admin/asset_e/update')}}" method="POST">
					{{$csrf}}
					<input type="hidden" name="id" value="{{$kib->id}}">
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kode Barang</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kode_barang" value="{{$kib->kode_barang}}" placeholder="kode barang" required/>
							<small class="form-text text-muted">wajib diisi</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nama</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nama" value="{{$kib->nama}}" placeholder="nama barang" required/>
							<small class="form-text text-muted">wajib diisi</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kategori</label>
						<div class="col-md-4">
							<select name="category_id" class="form-control">
								<option value="">Pilih kategori...</option>
								@foreach($categories AS $cat)
								<option value="{{$cat->id}}" {{$kib->category_id == $cat->id ? 'selected' : ''}}>{{$cat->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">reg</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="reg" value="{{$kib->reg}}" placeholder="Reg" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Judul buku</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="buku_judul" value="{{$kib->buku_judul}}" placeholder="Judul buku" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Spesifikasi buku</label>
						<div class="col-md-4">
								<input type="text" class="form-control" name="buku_spesifikasi" value="{{$kib->buku_spesifikasi}}" placeholder="Spesifikasi buku" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Asal barang</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="barang_asal" value="{{$kib->barang_asal}}" placeholder="Asal barang" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Pencipta barang</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="barang_pencipta" value="{{$kib->barang_pencipta}}" placeholder="Pencipta barang" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Bahan barang</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="barang_bahan" value="{{$kib->barang_bahan}}" placeholder="Bahan barang" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Jenis hewan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="hewan_jenis" value="{{$kib->hewan_jenis}}" placeholder="Jenis hewan" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Ukuran hewan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="hewan_ukuran" value="{{$kib->hewan_ukuran}}" placeholder="Ukuran hewan" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Jumlah</label>
						<div class="col-md-4">
							<input type="number" class="form-control" name="jumlah" value="{{$kib->jumlah}}" placeholder="Jumlah" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tahun pembuatan</label>
						<div class="col-md-4">
							<select name="tahun_pembuatan" class="form-control">
								@for($i = date('Y'); $i >= 1945; $i--)
								<option value="{{$i}}" {{$kib->tahun_pembuatan == $i ? 'selected' : ''}}>{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tahun pengadaan</label>
						<div class="col-md-4">
							<select name="tahun_pengadaan" class="form-control">
								@for($i = date('Y'); $i >= 1945; $i--)
								<option value="{{$i}}" {{$kib->tahun_pengadaan == $i ? 'selected' : ''}}>{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Asal-usul</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="asal_usul" value="{{$kib->asal_usul}}" placeholder="Asal usul" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nilai Aset</label>
						<div class="col-md-4">
							<input type="number" class="form-control" name="nilai" value="{{$kib->nilai}}" placeholder="Nilai aset" required/>
							<small class="form-text text-muted">wajib diisi</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Keterangan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="keterangan" value="{{$kib->keterangan}}" placeholder="Keterangan" />
						</div>
					</div>
					<div class="form-group row">
						<div class="offset-md-2 col-md-4">
							<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan</button>
							<a href="{{site_url('admin/asset_e')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
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