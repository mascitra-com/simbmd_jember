@layout('common/main')
@section('title')Kategori@endsection

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<form action="{{site_url('admin/category/batch_action')}}" method="POST" id="form-batch" class="hidden-sm-down">
					{{$csrf}}
					<input type="hidden" name="batch_id">
					<div class="input-group">
						<select name="batch_action" class="form-control">
							<option value="0">Pilih aksi...</option>
							<option value="1">Sunting</option>
							<option value="2">Hapus</option>
						</select>
						<span class="input-group-btn">
							<button class="btn btn-info"><i class="fa fa-check"></i></button>
						</span>
					</div>
				</form>
				<form action="{{site_url('admin/category')}}" method="GET" class="ml-auto mr-2">
					<div class="input-group">
						<input type="text" name="key" class="form-control" value="{{isset($filter['key']) ? $filter['key'] : ''}}" placeholder="cari category">
						<span class="input-group-btn">
							<button class="btn btn-primary"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
				<a href="{{site_url('admin/category/add')}}" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>tambah</a>
			</div>
			<div class="card-block table-responsive table-full">
				<table class="table table-striped table-hover">
					<thead>
						<thead>
							<tr>
								<th class="text-center"><input type="checkbox" id="check-all"></th>
								<th class="text-center">Kode</th>
								<th>Nama</th>
								<th>Umur Ekonomis</th>
								<th>Batas Kapitalis</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories AS $category)
							<tr>
								<td class="text-center"><input type="checkbox" value="{{$category->id}}"></td>
								<td class="text-center">{{$category->kode}}</td>
								<td>{{$category->nama}}</td>
								<td>{{!empty($category->umur_ekonomis) ? "{$category->umur_ekonomis} tahun" : "<i class='text-muted'>(kosong)</i>"}}</td>
								<td>{{!empty($category->batas_kapitalisasi) ? $category->batas_kapitalisasi : "<i class='text-muted'>(kosong)</i>"}}</td>
								<td>
									<a href="{{site_url('admin/category/edit/'.$category->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil mr-2"></i>sunting</a>
									<a href="{{site_url('admin/category/delete/'.$category->id)}}" class="btn btn-warning btn-sm" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash mr-2"></i>hapus</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</thead>
				</table>
			</div>
			<div class="card-footer">{{$pagination}}</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">
	var admin = (function(){
		// cahce DOM
		var $form 	  = $("#form-batch");
		var $batch_id = $("[name='batch_id']");

		// bind events
		$form.on('submit', eventFormSubmit);
		$("#check-all").on('change', eventCheckChange);

		init();

		// init function
		function init(){
			theme.setActive('.menu-pengaturan');
		}

		function eventFormSubmit(e) {
			e.preventDefault();
			
			var value = "";
			$("[type='checkbox']").each(function(){
				if ($(this).is(':checked') && $(this).val() !== '') {
					value = value +' '+$(this).val();
				}
			});

			$batch_id.val(value);

			$(e.currentTarget).unbind('submit').submit();
		}

		function eventCheckChange(e) {
			var checkedStatus = $(e.target).is(":checked");
			$('table tbody tr').find('td:first [type=checkbox]').each(function() {
				$(this).prop('checked', checkedStatus);
			});
		}
	})();
</script>
@endsection