@extends('layouts.admin')
@section('title', 'Permission')
@section('admin-content')
<main>
   <div class="container ">
    <div class="heading-title p-2 my-2">
        <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >User Permission</span>
    </div>
    <div class="card"> 
        <div class="card-header">
            <div class="table-head"><i class="fas fa-table me-1"></i>Action Permission  </div>
        </div>
        <form action="{{route('permission.two.action',$user->id)}}" method="post">
            @csrf
            <div class="row justify-content-center mt-2">
                <div class="col-md-1">
                    <input type="checkbox" id="action" name="action_process" value="1" {{$user->action_process == 1 ?'checked':''}}>
                    <label for="action"> Action </label>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="action_view" name="action_view" value="1" {{$user->action_view == 1 ?'checked':''}}>
                    <label for="action_view"> View</label><br><br>
                </div>
                <div class="col-md-2">
                    <input type="checkbox" id="action_create" name="action_create" value="1" {{$user->action_create == 1 ?'checked':''}}>
                    <label for="action_create">Offer Pending</label>
                </div>

                <div class="col-md-1">
                    <input type="checkbox" id="action_edit" name="action_edit" value="1" {{$user->action_edit == 1 ?'checked':''}}>
                    <label for="action_edit"> Edit</label>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="action_delete" name="action_delete" value="1" {{$user->action_delete == 1 ?'checked':''}}>
                    <label for="action_delete"> Delete</label><br><br>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info float-right mb-5 mr-5" value="Save">Save</button>
                </div>
            </div>
               
                
           
            
        </form>
        
   </div>
</main>        
@endsection
@push('admin-js')

@endpush    
