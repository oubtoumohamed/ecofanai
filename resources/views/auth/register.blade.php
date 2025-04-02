<!doctype html>
<html>
<head>

    <meta charset="utf-8" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper p-4 d-flex justify-content-center align-items-center min-vh-100" style="background-image: url('https://wallpaperaccess.com/full/1463431.jpg');">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-5">

                        <div class="card mt-4">

                            <div class="card-body">
                                <div class="text-center">
                                    <img class="mt-4 mb-4" src="{{ asset('assets/images/logo-dark.png') }}">
                                    <h5 class="text-primary">{{ env('APP_FULL_NAME') }}</h5>
                                    <p class="text-muted">{{ __('auth.login_text') }}</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="POST" action="{{ route('login') }}">

                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('auth.email') }}</label>
                                            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control @error('email') is-invalid @enderror" placeholder="Saisissez votre nom d'utilisateur">

                                            @error('email')<span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('auth.password') }}</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name="password" id="password-input" required class="form-control pe-5" placeholder="Saisissez votre mot de passe">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted shadow-none" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">{{ __('auth.remember') }}</label>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">{{ __('auth.login') }}</button>
                                        </div>
                                        <br>
                                        
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
    </div>
    <!-- end auth-page-wrapper -->

    <script type="text/javascript">document.getElementById("password-addon")&&document.getElementById("password-addon").addEventListener("click",function(){var e=document.getElementById("password-input");"password"===e.type?e.type="text":e.type="password"});</script>

</body>
</html>
