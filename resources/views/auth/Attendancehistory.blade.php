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
            $('#stafflist').change(function(){
               var value=document.getElementById('stafflist').value;
               console.log(value);
               $.ajaxSetup({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                });
                $.ajax({
                        type: 'POST',
                        url : "/attendance-history",
                        data: {"value":value},
                        success:function(data){
                            alert(data.success);
                        }
                });
            });
        });
    </script>

    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Attendance History</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{URL('/home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{URL('/staff-attendence')}}">Back</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    <h1 style="text-align:center; margin-top:5px">Attendenec History</h1>
    <div class="container">
        <div class="d-flex justify-content-between mt-3">
            <form action="" method="">
                @csrf
                <label for="html">From: </label>
                <input type="date" name="from" id="from" required/>
                <label for="html">To: </label>
                <input type="date" name="to" id="to" required/>
                <select name="stafflist" id="stafflist" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected>Select Category</option>
                        <option value="security">Security</option>
                        <option value="gardner">Gardner</option>
                        <option value="maintenance">Maintenance</option>
                </select>
                <select name="stafflist" id="stafflist"class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected>Select Category</option>
                        <option value="security">Security</option>
                        <option value="gardner">Gardner</option>
                        <option value="maintenance">Maintenance</option>
                </select>
            </form>
        </div>
    </div>
</body>
</html>