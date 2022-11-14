@extends('layouts.admin')
@section('title', 'Show Time')
@section('admin-content')
<main>
   <div class="container ">
    <div class="heading-title p-2 my-2">
        <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="{{route('admin.index')}}">Home</a> >Area</span>
    </div>
    
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class=""><i class="fas fa-cogs me-1"></i>Show time</div>
                    </div>
                    <div class="card-body table-card-body">
                        <table>
                            @foreach ($time as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->time}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>  
            </div>   
        </div>
    </div>
</main>        
@endsection
@push('admin-js')
@endpush