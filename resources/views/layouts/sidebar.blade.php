<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <!-- Tableau de bord -->

                <li class="submenu">

                    <a href="#"><i class="la la-dashboard"></i> <span> Tableau de
                            bord</span>
                        <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li id="home">
                            <a href="{{ url('home') }}">Synthèse</a>
                        </li>


                    </ul>

                </li>
                @if (Auth::user()->rh != 'OUI')
                    <li class="submenu">
                        <a href="#"><i class="la la-user"></i> <span> Collaborateurs</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li id="conges"><a href="{{ url('/conges') }}">Conges</a></li>
                            <li id="missions"><a href="{{ url('/missions') }}">Mission</a></li>
                            <li id="demandes"><a href="{{ url('/demandes') }}">Documents</a></li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->respo == 'OUI')
                    <li class="submenu">
                        <a href="#"><i class="la la-rocket"></i> <span> Reponsables</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li id="respoconge"><a href="{{ url('respoconge') }}">Validation des conges</a></li>
                            <li id="respomission"><a href="{{ url('respomission') }}">Validation des missions</a></li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->rh == 'OUI')
                    <li class="submenu">
                        <a href="#"><i class="la la-rocket"></i> <span> RH</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li id="allconge"><a href="{{ url('/allconge') }}">Validation des conges</a></li>
                            <li id="allmission"><a href="{{ url('allmission') }}">Validation des missions</a></li>
                            <li id="personnel"><a href="{{ url('/personnel') }}">Gestions du personnels</a></li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->role == 'ADMIN')
                    <li class="submenu">
                        <a href="#"><i class="la la-cog"></i> <span> Parametre </span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li id="users"><a href="{{ url('/users') }}"> Utilisateurs </a></li>
                            <li id="services"><a href="{{ url('/services') }}"> Services </a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
