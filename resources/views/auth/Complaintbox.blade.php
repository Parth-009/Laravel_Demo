<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Complaint List</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{URL('/home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{URL('/complaintstatus')}}">Complaint Status</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    <div class="d-flex justify-content-center mb-3">
        <h1 style="text-align:center; margin-top: 10px;">Complaint List</h1>
    </div>
        @if(isset($data))
        <table class="table table-striped table-bordered mx-auto mt-2" style="width:900px">
            <thead>
                <tr>
                    <th>Member Name</th>
                    <th>Mobile</th>
                    <th>Complaint Type</th>
                    <th>Complaint</th>
                    <th>Date&Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($data as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->mobile}}</td>
                        <td>{{$value->type}}</td>
                        <td>{{$value->complaints}}</td>
                        <td>{{$value->created_at}}</td>
                        @if($value['status']=='Submitted')
                        <td>
                            <a href="{{'/updatestatus/'. $value->id}}" style="color:white;text-decoration:none;"><button class="btn btn-primary"  id="btn1" onclick="buttondisable(this)" value="{{$value}}">Open</button></a>
                            <button class="btn btn-success">Close</button>
                        </td>
                        @elseif($value['status'] == 'In Progress')
                        <td>
                            <a href="{{'/deletestatus/'. $value->id}}" style="color:white;text-decoration:none;"><button class="btn btn-success">Close</button></a>
                        </td>
                        @elseif($value['status'] == 'Close')
                        <td>
                            <p>Resolved</p>
                        </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {!! $data->links() !!}
        </div>
        @endif
</body>
</html>






