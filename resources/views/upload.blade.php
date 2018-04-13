<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload Foto User</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.cdn.lamhotsimamora.com/garuda2/"></script>
</head>
<body>
	
	<div class="container">	
		<br>
		@if ($type)
			@if ($message != null)
				<div class="alert alert-success" role="alert">
				  {{ $message }}
				</div>
			@endif
		@else
		    @if ($message != null)
			<div class="alert alert-danger" role="alert">
				  {{ $message }}
			</div>
			@endif
		@endif
		<form action="{{ url('/store-upload/'.$id_user ) }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<input type="file" class="form-control" name="t_image_user"></br>
			<input class="btn btn-primary btn-md" type="submit" name="b_submit" value="Upload">
			<a href="{{ url('/') }}">Back</a>
		</form>
		
	</div>

</body>
<script type="text/javascript">
	
</script>
</html>