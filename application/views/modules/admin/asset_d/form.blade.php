@layout('common/main')
@section('title')Sunting Aset KIB-C@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">Sunting data</div>
			<div class="card-block">
				<form action="{{site_url('admin/asset_d/update')}}" method="POST">
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
					@if(!empty($kib->reg))
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
					@endif
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kontruksi</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kontruksi" value="{{$kib->kontruksi}}" placeholder="kontruksi" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Panjang</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="panjang" value="{{$kib->panjang}}" placeholder="panjang" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Lebar</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="lebar" value="{{$kib->lebar}}" placeholder="lebar" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Luas</label>
						<div class="col-md-4">
							<div class="input-group">
								<input type="number" class="form-control" name="luas" value="{{$kib->luas}}" placeholder="luas" />
								<span class="input-group-addon">m&sup3</span> 
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Alamat</label>
						<div class="col-md-4">
							<textarea class="form-control" name="alamat" placeholder="Alamat">{{$kib->alamat}}</textarea>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Tanggak Dokumen</label>
						<div class="col-md-4">
							<select name="tahun_pengadaan" class="form-control">
								@for($i = date('Y'); $i >= 1945; $i--)
								<option value="{{$i}}" {{$kib->tahun_pengadaan == $i ? 'selected' : ''}}>{{$i}}</option>
								@endfor
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nomor Dokumen</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nomor_dokumen" value="{{$kib->nomor_dokumen}}" placeholder="nomor Dokumen" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Status Tanah</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="status_tanah" value="{{$kib->status_tanah}}" placeholder="status tanah" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Nomor Tanah</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nomor_tanah" value="{{$kib->nomor_tanah}}" placeholder="nomor tanah" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Asal-usul</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="asal_usul" value="{{$kib->asal_usul}}" placeholder="Asal usul" />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 col-form-label">Kondisi</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="kondisi" value="{{$kib->kondisi}}" placeholder="Kondisi" />
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