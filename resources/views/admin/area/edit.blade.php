@extends('layouts.admin')
@section('title', 'Area')
@section('admin-content')
<main>
   <div class="container ">
    <div class="heading-title p-2 my-2">
        <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >Area</span>
    </div>
    <form action="{{route('area.update',$area->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class=""><i class="fas fa-cogs me-1"></i>Edit Area</div>
                    </div>
                    <div class="card-body table-card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <strong><label>Thana Name</label> <span class="float-right">:</span></strong>
                            </div>
                            <div class="col-md-8 mb-1">
                            <select name="thana_id" id="thana_id" class="form-control" >
                                <option value="">Select Thana</option>
                                @foreach ($thana as $item)
                                    <option value="{{$item->id}}" {{ $item->id == $area->thana->id ? 'selected' : '' }}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('thana_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            </div>
                            <div class="col-md-4">
                                <strong><label>Area Name</label> <span class="float-right">:</span></strong>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{$area->name}}" class="form-control  @error('name') is-invalid @enderror " name="name" >
                            </div>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            <div class="col-md-4">
                                <strong><label>Charge Amount</label> <span class="float-right">:</span></strong>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{$area->amount}}" class="form-control  @error('amount') is-invalid @enderror " name="amount" >
                            </div>
                            @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary mt-2" value="Submit">Update</button>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>   
        </div>
        </form> 
    </div>
</main>        
@endsection
@push('admin-js')
<script>
    $(document).ready(function() {
    $('#thana_id').select2();
});
</script>
@endpush