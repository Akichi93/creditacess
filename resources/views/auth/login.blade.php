<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin">
    <meta name="author" content="AKICHI JEAN-PHILIPPE">
    <title>Connexion - Gestion RH</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.png') }}">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/material.css">

    <link rel="stylesheet" href="assets/css/line-awesome.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">

            <div class="container">

                <div class="account-logo">
                    <a href="/"><img src="{{ asset('logo.png') }}" alt="LOGO"></a>
                </div>

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Connexion</h3>


                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-block mb-4">
                                <label class="col-form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-block mb-4">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <label class="col-form-label">Mot de passe</label>
                                    </div>
                                    <div class="col-auto">
                                        <a class="text-muted" href="{{ url('/reset') }}">
                                            Mot de passe oublié?
                                        </a>
                                    </div>
                                </div>
                                <div class="position-relative">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="input-block mb-4 text-center">
                                <button class="btn btn-primary account-btn" type="submit">Se connecter</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.7.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/app.js"></script>
</body>

</html>
