{{-- Login Page --}}
@extends('auth.auth_layout')

{{-- Title Section --}}
@section('title')
    Login Page
@endsection

{{-- Content Section --}}
@section('content')
    <div class="container">
        <div class="row justify-content-center row vh-100">
            <div class="col-lg-6 col-md-8 col-sm-10 text-center">
                <img src="{{ asset('images/logo_katalog.png') }}" alt="login" class="img-fluid mb-4" width="360px" height="240px">
                <h5 class="mt-0">Hello! <br> Welcome to Katalog Test Case</h5>
                <h3>LOG IN</h3>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-access auth-card shadow-lg">
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="input-group mb-4">
                                <input type="text" class="form-control" id="username" name="username" placeholder="username">
                            </div>
                            <div class="input-group mb-3">
                                <input name="password" type="password" value="" class="form-control" id="password" placeholder="password" required>
                                <span class="input-group-text" onclick="togglePasswordVisibility();">
                                    <i class="fas fa-eye" id="show_eye"></i>
                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                </span>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block w-100">Login</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register now</a></p>
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
    </script>
@endsection
