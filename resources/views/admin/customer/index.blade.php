@extends('layouts.admin')
@section('title', 'Customer')
@section('admin-content')
<main>
   <div class="container ">
    <div class="heading-title p-2 my-2">
        <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >Customer Create</span>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-user-plus"></i>
            customer form
        </div>
        <div class="card-body table-card-body p-3 mytable-body">
            
            <form id="customer_form" class="customerCreate" method="post" enctype="multipart/form-data">
               
                <div class="row">
                     <div class="col-md-6">
                         <div class="row">
                             <input type="hidden" name="id" id="id">
                            <div class="col-md-4">
                                <strong><label>Name</label> <span class="float-right">:</span></strong>
                            </div>
                            <div class="col-md-8">
                                {{-- @error('name') is-invalid @enderror --}}
                                 <input type="text" name="name"  value="{{old('name')}}" class="form-control my-form-control "  id="name">
                                 <strong><span class="text-danger" id="nameError"></span></strong>
                                 
                             </div> 
                             <div class="col-md-4">
                                <strong><label>Email</label> <span class="float-right">:</span></strong>
                            </div>
                             <div class="col-md-8">
                                <input type="email" name="email" value="{{old('email')}}" id="email" class="form-control my-form-control  @error('email') is-invalid @enderror" >
                                <strong><span class="text-danger" id="emailError"></span></strong>
                             </div> 
                             <div class="col-md-4">
                                <strong><label>Phone</label> <span class="float-right">:</span></strong>
                            </div>
                             <div class="col-md-8">
                                <input type="text" name="phone" value="{{old('phone')}}" id="phone" class="form-control my-form-control  @error('phone') is-invalid @enderror" >
                                <strong><span class="text-danger" id="phoneError"></span></strong>
                             </div> 
                             <div class="col-md-4">
                                <strong><label>Address</label> <span class="float-right">:</span></strong>
                            </div>
                             <div class="col-md-8">
                               <textarea name="address" rows="2" id="address" class="form-control @error('phone') is-invalid @enderror"></textarea>
                               <strong><span class="text-danger" id="addressError"></span> </strong>
                             </div> 
                             <div class="col-md-4">
                                <strong><label>Area</label> <span class="float-right">:</span></strong>
                            </div>
                             <div class="col-md-8 mt-1">
                                <div class="input-group input-group-sm">
                              <select class="js-example-basic-multiple form-control my-form-control mr-2  @error('area_id') is-invalid @enderror" id="area_id" data-live-search="true" name="area_id">
                                <option value=" ">Select Area</option>
                                @foreach ($areas as $area)
                                    <option value="{{$area->id}}">{{$area->name}}</option>  
                                @endforeach
                            </select>
                              <div class="input-group-append">
                                <a class="border rounded my-select my-form-control py-0 px-2" href="{{ route('area.index') }}" target="_blank"><i class="fas fa-plus"></i></a>
                              </div>
                            </div>
                                  @error('sub_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                  @enderror
                            </div>
                           
                         </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row right-row">
                           <div class="col-md-4">
                               <strong><label>Username</label> <span class="float-right">:</span></strong>
                           </div>
                            <div class="col-md-8">
                            <input type="text" name="username" id="username" value="{{old('username')}}" autocomplete="off" class="form-control my-form-control" >
                            <strong><span class="text-danger" id="usernameError"></span></strong>
                            </div> 
                            <div class="col-md-4">
                                <strong><label>Password</label> <span class="float-right">:</span></strong>
                            </div>
                             <div class="col-md-8">
                                <input type="password" id="password" name="password" value="{{old('password')}}"  class="form-control my-form-control  @error('password') is-invalid @enderror" autocomplete="off">
                                <strong><span class="text-danger" id="passwordError"></span></strong>
                             </div>
                             <div class="col-md-4">
                                <strong><label>Profile Image</label> <span class="float-right">:</span></strong>
                            </div>
                             <div class="col-md-6">
                                <input type="file" class="form-control my-form-control  @error('image') is-invalid @enderror" id="image" name="profile_picture" onchange="readURL(this);">
                                <strong><span class="text-danger" id="imageError"></span></strong>
                            </div>
                            <div class="col-md-2 ps-0">
                                <img class="form-controlo img-thumbnail w-100" src="#" id="previewImage" style="height:80px; background: #3f4a49;">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" id="createSubmit" class="btn btn-primary btn-sm float-right submit-btn mt-3 btn-p" value="Submit">Submit</button>
                                <button type="submit" id="editSubmit" class="btn btn-primary btn-sm  float-right submit-btn mt-3 btn-p" value="Submit" style="display: none">Update</button>
                            </div>
                        </div>
                    </div>  
                </div>
            </form>
        </div>
   </div>
        <div class="row">
            <div class="col-12">
               <div class="card"> 
                <div class="card-header">
                    <div class="table-head"><i class="fas fa-table me-1"></i>Customer List</div>
                </div>
                <div class="card-body table-card-body p-3">
                    <table id="datatablesSimple">
                        <thead class="text-center bg-light">
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Customer ID</th>
                                <th>Status</th>
                                <th>Username</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="customer_body" class="text-center">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</main>        
@endsection
@push('admin-js')
<script src="{{ asset('admin/js/ckeditor.js') }}"></script>
<script src="{{ asset('admin/js/sweetalert2.all.js') }}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.log( error );
        } );
</script>
<script> 
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload=function(e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .width(100);
                   
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    document.getElementById("previewImage").src="/noimage.png";
    
</script> 
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function allData(){
            $.ajax({
                url:"{{route('customer.all')}}",
                type:"get",
                dataType: "json",
                success:function(res){
                    console.log(res);
                    var data = "";
                    var key = 1;
                    $.each(res,function(key,value){
                        var key = key+1;
                        data = data + '<tr>'
                        data = data + '<td>'+key+'</td>'
                        data = data + '<td>'+value.name+'</td>'
                        data = data + '<td>'+value.email+'</td>'
                        data = data + '<td>'+value.code+'</td>'
                        data = data + '<td>'+value.status+'</td>'
                        data = data + '<td>'+value.username+'</td>'
                        data = data + '<td>'+value.phone+'</td>'
                        data = data + '<td class="text-nowrap text-center">'
                        data = data + '<a class="btn btn-edit btn-info btn-sm" id="createSubmit" onclick="editData('+value.id+')"><i class="fas fa-edit"></i></a>' 
                        data = data + '<a class="btn btn-delete btn-danger btn-sm" onclick="deleteData('+value.id+')"><i class="fas fa-trash"></i></a>'
                        data = data + '</td>'
                    })
                   
                    $('#customer_body').html(data);
                }
            })
        }
        allData();

        $(document).on('submit', '.customerCreate', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            console.log(formData);
            $.ajax({
                url:"{{route('customer.store')}}",
                type:"post",
                dataType: "json",
                data:formData,
                cache: false,
                contentType: false,
                processData: false,
                success:function(res){
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data Insert Successfully',
                    icon: 'success',
                    })

                    $('.customerCreate').trigger('reset');
                    allData();
                    $('#short_details').val('');
                    $('#previewImage').attr('src','/noimage.png');
                    $('#area_id').val(res.id).trigger('change');
                    // error messag hide
                    $('#nameError').text('');
                    $('#name').removeClass('is-invalid');
                    $('#email').removeClass('is-invalid');
                    $('#emailError').text('');
                    $('#phone').removeClass('is-invalid');
                    $('#phoneError').text('');
                    $('#addressError').text('');
                    $('#address').removeClass('is-invalid');
                    $('#usernameError').text('');
                    $('#password').removeClass('is-invalid');
                    $('#passwordError').text('');
                    $('#password').removeClass('is-invalid');
                    $('#area_id').text('');
                    $('#areaidError').text('');
                    $('#imageError').text('');
                    

                },
                error:function(data){
                    Swal.fire({
                    title: 'Error!',
                    text: 'Customer Added Fail',
                    })
                    $('#nameError').text(data.responseJSON.errors.name);
                    if(data.responseJSON.errors.name){
                        $('#name').addClass('is-invalid');
                    }
                    $('#emailError').text(data.responseJSON.errors.email);
                    if(data.responseJSON.errors.email){
                        $('#email').addClass('is-invalid');
                    }
                    $('#phoneError').text(data.responseJSON.errors.phone);
                    if(data.responseJSON.errors.phone){
                        $('#phone').addClass('is-invalid');
                    }
                    $('#addressError').text(data.responseJSON.errors.address);
                    if(data.responseJSON.errors.address){
                        $('#address').addClass('is-invalid');
                    }
                    $('#usernameError').text(data.responseJSON.errors.username);
                    if(data.responseJSON.errors.username){
                        $('#username').addClass('is-invalid');
                    }
                    $('#passwordError').text(data.responseJSON.errors.password);
                    if(data.responseJSON.errors.password){
                        $('#password').addClass('is-invalid');
                    }
                    $('#areaidError').text(data.responseJSON.errors.area_id);
                    if(data.responseJSON.errors.area_id){
                        $('#area_id').addClass('is-invalid');
                    }
                    $('#imageError').text(data.responseJSON.errors.profile_picture);
                    if(data.responseJSON.errors.profile_picture){
                        $('#profile_picture').addClass('is-invalid');
                    }
                }

            });
        })


        function editData(id){
            var url = "/customer/customer/edit/"+id;
            console.log(url);
            $.ajax({
            url:url,
            type:"get",
            dataType:"json",
            success:function(res){
              $('#createSubmit').hide();
              $('#editSubmit').show();
              $('#name').val(res.name);
              $('#email').val(res.email);
              $('#phone').val(res.phone);
              $('#address').val(res.address);
              $('#username').val(res.username);
              $('#area_id').val(res.area_id).trigger('change');
              $('#previewImage').attr('src',res.profile_picture);
              $('#id').val(res.id);
              $('#customer_form').removeClass('customerCreate');
              $('#customer_form').addClass('customerEdit');
              // error messag hide
              $('#nameError').text('');
                $('#name').removeClass('is-invalid');
                $('#email').removeClass('is-invalid');
                $('#emailError').text('');
                $('#phone').removeClass('is-invalid');
                $('#phoneError').text('');
                $('#addressError').text('');
                $('#address').removeClass('is-invalid');
                $('#usernameError').text('');
                $('#password').removeClass('is-invalid');
                $('#passwordError').text('');
                $('#password').removeClass('is-invalid');
                $('#areaidError').text('');
                $('#imageError').text('');
            }
          })
        }

         // ajax update data
         $(document).on('submit', '.customerEdit', function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url:"{{route('customer.update')}}",
                type:"post",
                dataType: "json",
                data:formData,
                cache: false,
                contentType: false,
                processData: false,
                success:function(res){
                    Swal.fire({
                    title: 'Success!',
                    text: 'Data Updated Successfully',
                    icon: 'success',
                    })
                    $('.customerEdit').trigger('reset');
                    allData();
                    $('#previewImage').attr('src','/noimage.png');
                    $('#area_id').val(res.id).trigger('change');
                    $('#createSubmit').show();
                    $('#editSubmit').hide();
                    $('#customer_form').addClass('customerCreate');
                    $('#customer_form').removeClass('customerEdit');
                   // error messag hide
                    $('#nameError').text('');
                    $('#name').removeClass('is-invalid');
                    $('#email').removeClass('is-invalid');
                    $('#emailError').text('');
                    $('#phone').removeClass('is-invalid');
                    $('#phoneError').text('');
                    $('#addressError').text('');
                    $('#address').removeClass('is-invalid');
                    $('#usernameError').text('');
                    $('#password').removeClass('is-invalid');
                    $('#passwordError').text('');
                    $('#password').removeClass('is-invalid');
                    $('#areaidError').text('');
                    
                },
                error:function(data){
                    $('#nameError').text(data.responseJSON.errors.name);
                    if(data.responseJSON.errors.name){
                        $('#name').addClass('is-invalid');
                    }
                    $('#emailError').text(data.responseJSON.errors.email);
                    if(data.responseJSON.errors.email){
                        $('#email').addClass('is-invalid');
                    }
                    $('#phoneError').text(data.responseJSON.errors.phone);
                    if(data.responseJSON.errors.phone){
                        $('#phone').addClass('is-invalid');
                    }
                    $('#addressError').text(data.responseJSON.errors.address);
                    if(data.responseJSON.errors.address){
                        $('#address').addClass('is-invalid');
                    }
                    $('#usernameError').text(data.responseJSON.errors.username);
                    if(data.responseJSON.errors.username){
                        $('#username').addClass('is-invalid');
                    }
                    $('#passwordError').text(data.responseJSON.errors.password);
                    if(data.responseJSON.errors.password){
                        $('#password').addClass('is-invalid');
                    }
                    $('#areaidError').text(data.responseJSON.errors.area_id);
                    if(data.responseJSON.errors.area_id){
                        $('#area_id').addClass('is-invalid');
                    }
                    $('#imageError').text(data.responseJSON.errors.profile_picture);
                    if(data.responseJSON.errors.profile_picture){
                        $('#profile_picture').addClass('is-invalid');
                    }
                    
                }

            });
        })

        function deleteData(id){
            var x = confirm("Are you sure you want to delete?");
                if (x)
                $.ajax({
                url:"/customer/customer/delete/"+id,
                    type:"get",
                    dataType:"json",
                    success:function(res){
                        Swal.fire({
                        title: 'Success!',
                        text: 'Data Updated Successfully',
                        icon: 'success',
                        })
                        allData();
                        setInterval('refreshPage()', 5000);
                    }
                });   
        }

</script>
<script>
    $(document).ready(function(){
      $(".dataTable-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#datatablesSimple tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>
@endpush