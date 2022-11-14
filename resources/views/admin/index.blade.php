@extends('layouts.admin')
@section('title', 'Home')
@section('admin-content')
<main class="">
    <div class="container-fluid">
        <div class="heading-title p-2">
            <span class="my-3 heading "><i class="fas fa-home"></i> <a class="" href="">Home</a> > Dashboard</span>
        </div>
        <div class="row mt-3">
            <div class="dashboard-logo text-center pt-3 pb-4">
                <img class="border p-2" style="height: 100px;" src="{{ asset('e-banner-3.jpg') }}" alt="">
            </div>
            
            <div class="col-xl-3 col-md-6 " >
                <div class="card mb-3 dashboard-card " style="background: linear-gradient(#e66465, #9198e5)">
                    <a href="{{route('order.index')}}" class="card-body mx-auto">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-spinner fa-2x"></i> <span class="count">{{ $pending }}</span>
                        </div>
                        
                        <p class="dashboard-card-text">Pending Order</p>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-3 dashboard-card" style="background: linear-gradient(#faf0fd, #9198e5)">
                    <a href="{{route('order.onProcess')}}" class="card-body mx-auto">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-project-diagram fa-2x"></i> <span class="count">{{ $process }}</span>
                        </div>
                         
                        <p class="dashboard-card-text">On Processing Order</p>
                    </a>
                </div>
            </div>
          
            
            <div class="col-xl-3 col-md-6">
                <div class="card mb-3 dashboard-card" style="background: linear-gradient(#faf0fd,#F76A9D)">
                    <a href="{{route('order.way')}}" class="card-body mx-auto">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-road fa-2x"></i> <span class="count">{{ $way }}</span>
                        </div>
                        
                        <p class="dashboard-card-text"> On The way</p>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-3 dashboard-card" style="background: linear-gradient(#DD00B0,#F76A9D)">
                    <a class="card-body mx-auto" href="{{route('order.delivary')}}">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-truck-loading fa-2x"></i> <span class="count">{{ $delivered }}</span>
                        </div>
                        <p class="dashboard-card-text">Delivered Order</p>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-3 dashboard-card" style="background: linear-gradient(#003B56,#F76A9D)">
                    <a href="{{route('sales.report')}}" class="card-body mx-auto">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fas fa-balance-scale-left fa-2x"></i>
                        </div>
                        <p class="dashboard-card-text">Sales report</p>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-3 dashboard-card" style="background: linear-gradient(#F4B019,#F76A9D)">
                    <a href="{{ route('product.index') }}" class="card-body mx-auto">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fab fa-product-hunt fa-2x"></i>
                        </div>
                        <p class="dashboard-card-text">Product List</p>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-3 dashboard-card" style="background: linear-gradient(#faf0fd,#F76A9D)">
                    <a href="{{ route('profile.edit') }}" class="card-body mx-auto">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="far fa-money-bill-alt fa-2x"></i>
                        </div>
                        <p class="dashboard-card-text">Company Profile</p>
                    </a>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mb-3 dashboard-card" style="background: linear-gradient(#54BFBD,#F76A9D)">
                    <div class="card-body mx-auto">
                        <div class=" d-flex justify-content-center align-items-center">
                            <i class="fa fa-sign-out-alt fa-2x"></i>
                        </div>
                        <p class="dashboard-card-text"><a href="{{ route('logout') }}" onclick="return confirm('Are you sure logout from Admin Panel')">Logout</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection