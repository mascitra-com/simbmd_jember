<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan</title>
	<link rel="stylesheet" type="text/css" href="{{base_url('res/plugins/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
	<div class="container-fluid">
		<table class="table table-bordered">
			<thead>
				<tr>
					@foreach($assets[0] AS $key => $value)
					<td>{{$key}}</td>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach($assets AS $asset)
				<tr>
					@foreach($asset AS $index => $item)
					<td>{{$item}}</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>