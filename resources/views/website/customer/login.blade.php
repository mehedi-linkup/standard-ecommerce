@extends('layouts.website')
@section('website-content')

    <section class="py-5">
        <h2 class="text-center text-success"> Customer Login</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-12">

                    <div class="card">
                        <div class="card-body p-3">
                            <form action="{{ route('customer.auth') }}" method="post">
                                @csrf
                                <div class="form-group py-3">
                                    <input type="text" name="userphone" class="form-control px-3" placeholder="Phone Number">
                                </div>
                                <div class="form-group py-3 position-relative">
                                    <input type="password" name="password" id="id_password" class="form-control px-3 "
                                        placeholder="Password"><i class="far fa-eye show-icon position-absolute"
                                        id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                                </div>
                                <div class="form-group py-3 d-flex">

                                    <div class="">
                                        <span>
                                            <a href="{{ route('customer.signup') }}" class="btn btn-success ms-auto"> Sign
                                                Up</a>
                                        </span>

                                    </div>
                                    <div class="ms-auto">
                                        <span class="">
                                            <button type="submit" class="btn btn-success ms-0 w-100">Login</button>
                                        </span>


                                        <div class="forget-password mt-2">
                                            <a href="{{ route('forget.password') }}" class="text-danger">Forget
                                                Password</a>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <?php
    Session::forget('phone');
    ?>
@endsection
@push('website-js')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>

@endpush
