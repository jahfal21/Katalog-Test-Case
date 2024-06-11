{{-- Register Page --}}
@extends('auth.auth_layout')

{{-- Title Section --}}
@section('title')
    Register Page
@endsection

{{-- Content Section --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center row vh-100">
            <div class="col-lg-6 col-md-8 col-sm-10 text-center">
                <img src="{{ asset('images/logo_katalog.png') }}" alt="register" class="img-fluid mb-3" width="240px" height="160px">
                <h5 class="mt-0">Hello! <br> Welcome to Katalog Test Case</h5>
                <h3>REGISTER</h3>
                <div class="card-access auth-card shadow-lg">
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your Full Name">
                                <input type="hidden" class="d-none" name="role_id" value="2">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="no_telepon" name="no_hp" placeholder="Enter your number telephone/WA">
                            </div>
                            <div class="input-group mb-3">
                                <input name="password" type="password" value="" class="form-control" id="password" placeholder="Password" required>
                                <span class="input-group-text" onclick="togglePasswordVisibility();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                            <div class="input-group mb-3">
                                <input name="password_confirmation" type="password" value="" class="form-control" id="password_confirmation" placeholder="Confirm Password" required>
                                <span class="input-group-text" onclick="confirmpasswordVisibility();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block w-100">Register</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function togglePasswordVisibility() {
            let passwordInput = document.getElementById('password');
            let showEyeIcon = document.getElementById('show_eye');
            let hideEyeIcon = document.getElementById('hide_eye');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showEyeIcon.classList.add('d-none');
                hideEyeIcon.classList.remove('d-none');
            } else {
                passwordInput.type = 'password';
                showEyeIcon.classList.remove('d-none');
                hideEyeIcon.classList.add('d-none');
            }
        }

        function confirmpasswordVisibility() {
            let passwordS = document.getElementById('password_confirmation');
            let showEye = document.getElementById('show_eye');
            let hideEye = document.getElementById('hide_eye');
            if (passwordS.type === 'password') {
                passwordS.type = 'text';
                showEye.classList.add('d-none');
                hideEye.classList.remove('d-none');
            } else {
                passwordS.type = 'password';
                showEye.classList.remove('d-none');
                hideEye.classList.add('d-none');
            }
        }
    </script>
@endsection
