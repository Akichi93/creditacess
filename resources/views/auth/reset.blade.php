<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <title>Mot de passe oublie - Gestion Rh</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.png') }}">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/material.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="account-page">

    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">

                <div class="account-logo">
                    <a href="{{ url('/reset') }}"><img src="{{ asset('logo.png') }}"
                            alt="LOGO"></a>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger alert-square">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-square">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('message'))
                    <div class="alert alert-info alert-square">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Mot de passe oublié?</h3>
                        <p class="account-subtitle">Saisissez votre courriel pour obtenir un lien de réinitialisation du
                            mot de passe</p>

                        <form method="POST" action="{{ route('user.reset') }}">
                            @csrf
                            <div class="input-block mb-4">
                                <label class="col-form-label">Email</label>
                                <input class="form-control" type="text" name="email">
                            </div>
                            <div class="input-block mb-4 text-center">
                                <button class="btn btn-primary account-btn" type="submit">Renitialiser</button>
                            </div>
                            <div class="account-footer">
                                <p>Je me rappel de mon mot de passe <a href="{{ url('home') }}">Connexion</a></p>
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
