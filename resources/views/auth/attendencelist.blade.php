<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        #pdf{
            width:100px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Attendence List</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{URL('/staff-attendence')}}">Back</a>
      </li>
  </div>
</nav>
<h1 style="text-align:center; margin-top:5px">Attendenec List</h1>
    <div class="container mt-2" >
        <div class="row justify-content-center">
            <form action="/attendence/list" method="GET">
                <input type="date" id="date" name="date" required>
                <button type="submit" class="btn btn-warning" name="submit">Submit</button> 
                <button type="submit" class="btn btn-primary" name="pdf" >ExportPDF</button> 
            </form> 

        </div>
        @if(isset($data))
        <div class="mt-3" style="overflow:auto; max-height:400px; margin-top:30px">
        <table border="1" class="table">
            <thead  class="thead-dark"> 
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            @foreach($data as $value)
            @if($value->status== "present")
            <tr class="table-primary">  
                <td>{{$value->name}}</td>
                <td>{{$value->date}}</td>
                <td>{{$value->status}}</td>
            </tr>
            @endif
            @if($value->status== "absent")
            <tr class="table-danger">
                <td>{{$value->name}}</td>
                <td>{{$value->date}}</td>
                <td>{{$value->status}}</td>
            </tr>
            @endif
            @endforeach
            @else
            <tbody>
                <tr>
                    <td>No Data Found</td> 
                </tr>
            </tbody>
        </table>
    </div>
    @endif 
</body>
</html>