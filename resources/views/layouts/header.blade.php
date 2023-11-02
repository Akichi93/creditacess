<div class="header">

    <div class="header-left">
        <a href="admin-dashboard.html" class="logo">
            <img src="assets/img/logo.png" width="40" height="40" alt="Logo">
        </a>
        <a href="admin-dashboard.html" class="logo2">
            <img src="assets/img/logo2.png" width="40" height="40" alt="Logo">
        </a>
    </div>

    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <div class="page-title-box">
        <h3>CREDIT ACCESS</h3>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>

    <ul class="nav user-menu">

        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                <form action="search.html">
                    <input class="form-control" type="text" placeholder="Rechercher">
                    <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </li>


       




        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="User Image">
                    <span class="status online"></span></span>\
                    @auth
                    <span>{{ Auth::user()->name }}</span>  
                    @endauth
                
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="profile.html">Mon pofile</a>
                <a class="dropdown-item" href="index.html">Se deconnecter</a>
            </div>
        </li>
    </ul>


    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa-solid fa-ellipsis-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">Mon profile</a>
            <a class="dropdown-item" href="index.html">Se deconnecter</a>
        </div>
    </div>

</div>