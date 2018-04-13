<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Laravel 5.5 </title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.cdn.lamhotsimamora.com/garuda2/"></script>
</head>
<body>
    
    <div class="container">
        <hr>
        <div id="disp_content">
            
        </div>
        </br>
        <input type="text" id="t_name" placeholder="Username" class="form-control"> </br>
        <input type="email" id="t_email" placeholder="Email" class="form-control"> </br>
        <input type="number" id="t_age" placeholder="Age" class="form-control"> </br>
        <div id="display_button">
            
        </div>
    </div>


    <div class="container">
        <hr>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Age</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="disp_table">
                    
              </tbody>
            </table>
    </div>


</body>
<script type="text/javascript">
    var _token = "{{ csrf_token() }}";
    var _url_add = "{{ url('/add') }}";
    var _url_load = "{{ url('/get-data') }}";
    var _url_delete = "{{ url('/delete') }}";
    var _url_update = "{{ url('/update') }}";
    var _url_loading_ = "{{ url('/loading.svg') }}";
    var _url_get_data = "{{ url('/get-data-single') }}";
    var _url_ = "{{ url('') }}";
    var _ori_url_ =  _url_.replace(/public/g, "");
    var _storage_ = _ori_url_+'storage/app/public/';
</script>
<script type="text/javascript" src="{{ url('app.js') }}"></script>
</html>