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
                       <span id="addHeader">Add Teacher</span>
                       <span id="updateHeader">Update Teacher</span>
                      </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Enter name">
                    <span class="text-danger" id="nameError"></span>

                  </div>

                  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" id="email" class="form-control" placeholder="Enter email">
                      <input type="hidden" id="id">
                      <span class="text-danger" id="emailError"></span>

                  </div>



                  <button type="submit" id="addTeacher" onclick="storeTeacher()"  class="btn btn-primary">Add Teacher</button>
                  <button type="submit" onclick="updateTeacher()" id="updateTeacher"  class="btn btn-primary">Update Teacher</button>
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
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($teachers as $row)


                          <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>


                            <td>
                                <button onclick="editData({{ $row->id }});" class="btn btn-success">Edit</button>
                                <button onclick="romoveData({{ $row->id }});"  class="btn btn-danger">Delete</button>
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
</script>

<script>

        $('#addHeader').show();
        $('#updateHeader').hide();
        $('#addTeacher').show();
        $('#updateTeacher').hide();


        function clearData(){
            $('#name').val('');
            $('#email').val('');
            $('#nameError').text('');
               $('#emailError').text('');

        }


  //add teacher start
  function storeTeacher(){
        var name=$('#name').val();
        var email=$('#email').val();


        $.ajax({
            type:'post',
            dataType:'json',
            data:{name:name,email:email},
            url:'/store/teacher',
            success:function(result){
                clearData()
                $('.alert').show();
                $('.alert').html(result.success);
                $('.table').load(location.href+' .table');
            },
            error:function(error){

               $('#nameError').text(error.responseJSON.errors.name);
               $('#emailError').text(error.responseJSON.errors.email);


            },
        });


    }
     //add teacher end

     //edit teacher start
     function editData(id){
        $('#addHeader').hide();
        $('#updateHeader').show();
        $('#addTeacher').hide();
        $('#updateTeacher').show();

$.ajax({
           type:'GET',
            dataType:'json',
            url:'/edit/teacher/'+id,
            success:function(res){
                var id=$('#id').val(res.id);
                var name=$('#name').val(res.name);
                var email=$('#email').val(res.email);
            },
});
     }
     //edit teacher end


     //update teacher start
     function updateTeacher(){

        var id=$('#id').val();
        var name=$('#name').val();
        var email=$('#email').val();


        $.ajax({
            type:'post',
            dataType:'json',
            data:{name:name,email:email},
            url:'/update/teacher/'+id,
            success:function(result){
                clearData();
                $('#addHeader').show();
                $('#updateHeader').hide();
                $('#addTeacher').show();
                $('#updateTeacher').hide();
                $('.alert').show();
                $('.alert').html(result.success);
                $('.table').load(location.href+' .table');
            },
            error:function(error){

               $('#nameError').text(error.responseJSON.errors.name);
               $('#emailError').text(error.responseJSON.errors.email);


            },
        });

     }
     //update teacher end


     //delete data start
     function romoveData(id){

        $.ajax({
            type:'GET',
        dataType:'json',
        url:'/delete/teacher/'+id,
        success:function(result){
            $('.alert').show();
                $('.alert').html(result.success);
                $('.table').load(location.href+' .table');
        }
        });
     }
     //delete data end




</script>
