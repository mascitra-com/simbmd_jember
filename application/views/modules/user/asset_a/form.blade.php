@layout('common/main')
@section('title')Sunting Aset KIB-A@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Sunting data</div>
			<div class="card-block">
				<form action="{{site_url('user/asset_a/update')}}" method="POST">
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
						<label class="col-md-2 col-form-label">Luas</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="luas" value="{{$kib->luas}}" placeholder="Luas" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tahun Pengadaan</label>
						<div class="col-md-4">
							<select name="tahun_pengadaan" class="form-control">
								@for($i = date('Y'); $i >= 1945; $i--)
								<option value="{{$i}}" {{$kib->tahun_pengadaan == $i ? 'selected' : ''}}>{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Alamat</label>
						<div class="col-md-4">
							<textarea class="form-control" name="alamat" placeholder="Alamat">{{$kib->alamat}}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Hak</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="hak" value="{{$kib->hak}}" placeholder="Hak"/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tanggal Sertifikat</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="tanggal_sertifikat" value="{{$kib->tanggal_sertifikat}}" placeholder="Tanggal Sertifikat"/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nomor Sertifikat</label>
						<div class="col-md-4">
							<input type="number" class="form-control" name="nomor_sertifikat" value="{{$kib->nomor_sertifikat}}" placeholder="Nomor sertifikat" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Pengguna</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="pengguna" value="{{$kib->pengguna}}" placeholder="Pengguna" />
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
							<a href="{{site_url('user/asset_a')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
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