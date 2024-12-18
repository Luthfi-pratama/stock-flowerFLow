<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Login - Toko Bunga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font.awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/linearicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body>
    <div class="login-register-area mt-no-text">
        <div class="container custom-area">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                    <div class="login-register-wrapper">
                        <div class="section-content text-center mb-5">
                            <h2 class="title-4 mb-2">Login</h2>
                            <p class="desc-content">Please login using account detail below.</p>
                        </div>

                        <!-- Laravel Login Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email -->
                            <div class="single-input-item mb-3">
                                <input type="email" name="email" placeholder="Email or Username"
                                    value="{{ old('email') }}" required autofocus />
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="single-input-item mb-3">
                                <input type="password" name="password" placeholder="Enter your Password" required />
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="single-input-item mb-3">
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="remember-meta mb-3">
                                        <input type="checkbox" id="rememberMe" name="remember" />
                                        <label for="rememberMe">Remember Me</label>
                                    </div>
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forget-pwd mb-3">Forgot
                                        Password?</a>
                                    @endif
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="single-input-item mb-3">
                                <button type="submit" class="btn flosun-button secondary-btn theme-color rounded-0">
                                    Login
                                </button>
                            </div>

                            <!-- Register Link -->
                            <div class="single-input-item">
                                <a href="{{ route('register') }}">Create Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>