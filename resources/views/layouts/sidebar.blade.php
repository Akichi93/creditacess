<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                <!-- Tableau de bord -->

                <li class="submenu">

                    <a href="#" class="active"><i class="la la-dashboard"></i> <span> Tableau de
                            bord</span>
                        <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li>
                            <a href="{{ url('home') }}" class="active">Synthèse</a>
                        </li>


                    </ul>

                </li>

                <li class="submenu">
                    <a href="#"><i class="la la-user"></i> <span> Collaborateurs</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('/conges') }}">Conges</a></li>
                        <li><a href="{{ url('/missions') }}">Mission</a></li>
                        <li><a href="{{ url('/demandes') }}">Documents</a></li>
                    </ul>
                </li>
                @if (Auth::user()->respo == 'OUI')
                    <li class="submenu">
                        <a href="#"><i class="la la-rocket"></i> <span> Reponsables</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('respoconge') }}">Validation des conges</a></li>
                            <li><a href="{{ url('respomission') }}">Validation des missions</a></li>
                        </ul>
                    </li>
                @endif


                <li class="submenu">
                    <a href="#"><i class="la la-rocket"></i> <span> RH</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('/allconge') }}">Validation des conges</a></li>
                        <li><a href="{{ url('allmission') }}">Validation des missions</a></li>
                        <li><a href="{{ url('/personnel') }}">Gestions du personnels</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="la la-cog"></i> <span> Parametre </span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('/users') }}"> Utilisateurs </a></li>
                        <li><a href="{{ url('/services') }}"> Services </a></li>
                    </ul>
                </li>





            </ul>
        </div>
    </div>
</div>
