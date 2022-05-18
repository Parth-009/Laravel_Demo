<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script>
    $(document).ready(function(){
        $('#flexCheckDefault').click(function(event){
            if(this.checked){
                $(':checkbox').each(function(){
                    this.checked=true;
                });
            }
            else{
                $(':checkbox').each(function(){
                    this.checked=false;
                });
            }
        });
    });

    $(document).ready(function(){
      $("#date").on('change',function(){
       var selectDate = $(this).val();
       //console.log(selectDate);
       var todayDate = new Date().toISOString().slice(0, 10);
       console.log(todayDate);
       if(selectDate>todayDate){
         alert('Selected date is not today date');
         $(this).val('');
       } 
       else if(selectDate<todayDate){
         alert('Selected date is not today date');
         $(this).val('');
       } 
       else{
         return true;
       }
      });
    });
  </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Staff Attendence</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{URL('/home')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{URL('/attendenceList')}}">Attendence List</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <h1 style="text-align:center; margin-top: 10px;">Staff Attendance</h1>
  <form  action="/staff-present" method="POST">
    @csrf
    <div class="form-check mt-3" class="row justify-content-center">
    <label for="html">Select Date: </label>
    <input type="date" name="date" id="date" value="date">
      @error('date')
      <div class="error" style="color:red">{{ $message }}</div>
      @enderror   
    </div>
    <div style="overflow:auto; max-height:300px; margin-top:20px">
      <table  class="table table-striped table-bordered mx-auto " style="width:900px;">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Category</th>
            <th>Mark</th>
          </tr>
        </thead>
        @if(isset($data))
        @foreach($data as $value)
          <tr>
            <td>{{$value->id}}</td>
            <td>{{$value->name}}</td>
            <td>{{$value->category}}</td>
            <input type="hidden" id="scales.{{$value->id}}" name="present[]" value="{{$value->id}}">
            <td><input type="checkbox" id="scales.{{$value->id}}" name="present[]" value="{{$value->id}}"></td>
          </tr>
        @endforeach
      </table>
    </div> 
    <div class="text-center mt-4">
    <button type="submit" id="present" class="btn btn-success">Submit</button>
    </form>
    </div>
    @endif
</body>
</html>





