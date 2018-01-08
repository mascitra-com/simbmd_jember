<nav class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse" id="topbar">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#topbar-menu">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#"><strong>SIMBMD</strong></a>

	<div class="collapse navbar-collapse" id="topbar-menu">
		<div class="navbar-nav mr-auto">
			<a class="nav-item mr-2 nav-link menu-beranda" href="{{site_url('admin')}}">
				<i class="fa mr-1 fa-dashboard"></i> Beranda
			</a>
			<span class="nav-item mr-2 dropdown menu-aset">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="fa mr-1 fa-suitcase"></i> Aset
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="{{site_url('admin/asset_a')}}"><i class="fa fa-cubes mr-2"></i>KIB-A</a>
					<a class="dropdown-item" href="{{site_url('admin/asset_b')}}"><i class="fa fa-cubes mr-2"></i>KIB-B</a>
					<a class="dropdown-item" href="{{site_url('admin/asset_c')}}"><i class="fa fa-cubes mr-2"></i>KIB-C</a>
					<a class="dropdown-item" href="{{site_url('admin/asset_d')}}"><i class="fa fa-cubes mr-2"></i>KIB-D</a>
					<a class="dropdown-item" href="{{site_url('admin/asset_e')}}"><i class="fa fa-cubes mr-2"></i>KIB-E</a>
					<a class="dropdown-item" href="{{site_url('admin/asset_f')}}"><i class="fa fa-cubes mr-2"></i>KIB-F</a>
				</div>
			</span>
			<span class="nav-item mr-2 dropdown menu-persetujuan">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-check mr-1"></i>Persetujuan
					@if ($notif['ON_UPDATE'] != "0" OR $notif['ON_DELETE'] != "0" OR $notif['ON_INSERT'] != "0")
						<i class="fa fa-circle text-red notification"></i>
					@endif
				</a>
				<div class="dropdown-menu">
					<span class="dropdown-item">Aset</span>
					<a class="dropdown-item" href="{{site_url('admin/approval/import')}}"><i class="fa fa-plus mr-2"></i>Tambah {{$notif['ON_INSERT'] != "0" ? "<span class='badge badge-danger'>".$notif['ON_INSERT']."</span>" : ''}}</a>
					<a class="dropdown-item" href="{{site_url('admin/approval/update')}}"><i class="fa fa-pencil mr-2"></i>Sunting {{$notif['ON_UPDATE'] != "0" ? "<span class='badge badge-danger'>".$notif['ON_UPDATE']."</span>" : ''}}</a>
					<a class="dropdown-item" href="{{site_url('admin/approval/delete')}}"><i class="fa fa-trash mr-2"></i>Hapus {{$notif['ON_DELETE'] != "0" ? "<span class='badge badge-danger'>".$notif['ON_DELETE']."</span>" : ''}}</a>
					<!-- <div class="dropdown-divider"></div>
					<span class="dropdown-item">Rehab</span>
					<a class="dropdown-item" href="#"><i class="fa fa-plus mr-2"></i>Tambah</a>
					<a class="dropdown-item" href="#"><i class="fa fa-pencil mr-2"></i>Sunting</a>
					<a class="dropdown-item" href="#"><i class="fa fa-trash mr-2"></i>Hapus</a> -->
				</div>
			</span>
			<a class="nav-item mr-2 nav-link menu-penyusutan" href="{{site_url('admin/penyusutan')}}">
				<i class="fa mr-1 fa-compress"></i> Penyusutan
			</a>
			<a class="nav-item mr-2 nav-link menu-laporan" href="{{site_url('admin/laporan')}}">
				<i class="fa mr-1 fa-file-text-o"></i> Laporan
			</a>
			<span class="nav-item mr-2 dropdown menu-akun">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="fa mr-1 fa-users"></i> Manajemen Akun
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="{{site_url('admin/skpd')}}"><i class="fa fa-suitcase mr-2"></i>SKPD</a>
					<a class="dropdown-item" href="{{site_url('admin/user')}}"><i class="fa fa-user mr-2"></i>Pengguna</a>
				</div>
			</span>
			<span class="nav-item mr-2 dropdown menu-pengaturan">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown">
					<i class="fa mr-1 fa-cog"></i> Pengaturan
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="{{site_url('admin/category')}}"><i class="fa fa-tags mr-2"></i>Manajemen Kategori</a>
				</div>
			</span>
		</div>
		<div class="navbar-nav">
			<!-- <a class="nav-item mr-2 nav-link" href="#"><i class="fa mr-1 fa-bell"></i> Notifikasi</a> -->
			<a class="nav-item mr-2 nav-link menu-profil" href="{{site_url('admin/profile')}}"><i class="fa mr-1 fa-user"></i> Profil</a>
			<a class="nav-item mr-2 nav-link" href="{{site_url('keluar')}}"><i class="fa mr-1 fa-power-off"></i> Keluar</a>
		</div>
	</div>
</nav>