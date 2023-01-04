<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


    <title>Ajax Crud</title>
</head>
<body>
<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center">Laravel Ajax Crud Application</h2>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-4">

            <div class="card">

                <div class="card-body">
                    <div class="alert alert-primary" role="alert" style="display: none">

                      </div>

                    <div class="card-header">
                       <span id="addS">Add Student</span>
                       <span id="updateS">Update Student</span>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Enter name">
                    <span class="text-danger" id="nameError"></span>

                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" id="email" class="form-control" placeholder="Enter email">
                      <span class="text-danger" id="emailError"></span>

                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Phone</label>
                      <input type="text" id="phone" class="form-control" placeholder="Enter phone">
                      <span class="text-danger" id="phoneError"></span>
                      <input type="hidden" id="id">

                  </div>

                  <button type="submit" onclick="storeStudent()" id="addStudent" class="btn btn-primary">Add Student</button>
                  <button type="submit" onclick="UpdateStudent();" id="updateStudent" class="btn btn-primary">Update Student</button>
                </div>
              </div>


              <div id="reload">

              </div>

        </div>
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $row)


                          <tr>
                            <th>{{ $row->id }}</th>
                            <th>{{ $row->name}}</th>
                            <th>{{ $row->email}}</th>
                            <th>{{ $row->phone}}</th>

                            <td>
                                <button onclick="editData({{ $row->id }});" class="btn btn-success">Edit</button>
                                <button onclick="deleteData({{ $row->id }});"  class="btn btn-danger">Delete</button>
                            </td>
                          </tr>
                          @endforeach


                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>







<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('#addS').show();
$('#updateS').hide();
$('#addStudent').show();
$('#updateStudent').hide();


function clear(){
    $('#name').val('');
    $('#email').val('');
    $('#phone').val('');
    $('#nameError').text('');
    $('#emailError').text('');
    $('#phoneError').text('');
}


//store student
function storeStudent(){
    var name=$('#name').val();
    var email=$('#email').val();
    var phone=$('#phone').val();

    $.ajax({
        type:'post',
        dataType:'json',
        url:'/store/student',
        data:{
            name:name,
            email:email,
            phone:phone
        },
        success:function(result){
            clear();
            $('.alert').show();
           $('.alert').text(result.message);
           $('.table').load(location.href+' .table');
        },
        error:function(error){
            $('#nameError').text(error.responseJSON.errors.name);
            $('#emailError').text(error.responseJSON.errors.email);
            $('#phoneError').text(error.responseJSON.errors.phone);

        }
    })
}
//store student end


//edit student start
function editData(id){

  $.ajax({
    type:'GET',
    dataType:'json',
    url:'/edit/student/'+id,
    success:function(response){
        $('#addS').hide();
        $('#updateS').show();
        $('#addStudent').hide();
        $('#updateStudent').show();
        var id=$('#id').val(response.id);
        var name=$('#name').val(response.name);
    var email=$('#email').val(response.email);
    var phone=$('#phone').val(response.phone);
    }
  })
}
//edit student end


//update student start
function UpdateStudent(){
    var id=$('#id').val();
    var name=$('#name').val();
    var email=$('#email').val();
    var phone=$('#phone').val();

    $.ajax({
        type:'POST',
        dataType:'json',
        data:{
            name:name,
            email:email,
            phone:phone
        },
        url:'/student/update/'+id,
        success:function(result){
            $('#addS').show();
            $('#updateS').hide();
            $('#addStudent').show();
            $('#updateStudent').hide();

            clear();
            $('.alert').show();
           $('.alert').html(result.success);
           $('.table').load(location.href+' .table');
        }


    })
}
//update student end


//delete student start
function deleteData(id){
    $.ajax({
        type:'GET',
        dataType:'json',
        url:'/student/delete/'+id,
        success:function(result){
            $('.alert').show();
           $('.alert').text(result.success);
           $('.table').load(location.href+' .table');
        }
    })
}
//delete student end
</script>




</body>
</html>
