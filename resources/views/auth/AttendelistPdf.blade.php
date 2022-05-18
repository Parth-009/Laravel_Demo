<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
   
    <h1 style="text-align:center; margin-top:5px">Attendence List</h1>
    <h3>Date:{{$date}}</h3>
    <table class="table" border="1">
    <thead class="thead-dark">
      <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    @for($i=0;$i<count($value);$i++)
      <tr>
        <td>{{$value[$i]->name}}</td>
        <td>{{$value[$i]->date}}</td>
        <td>{{$value[$i]->status}}</td>
      </tr>
      @endfor
    </tbody>
</body>
</html>