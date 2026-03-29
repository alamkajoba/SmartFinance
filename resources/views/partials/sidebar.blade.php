<div class="nk-sidebar" data-content="sidebarMenu">
    <div class="nk-sidebar-bar">
        <div class="nk-apps-brand">
            <a href="html/index.html" class="logo-link">
                <img class="logo-light logo-img" src="./images/logo-small.png" srcset="./images/logo-small2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="./images/logo-dark-small.png" srcset="./images/logo-dark-small2x.png 2x" alt="logo-dark">
            </a>
        </div>
        <div class="nk-sidebar-element">
            <div class="nk-sidebar-body">
                <div class="nk-sidebar-content" data-simplebar>
                    <div class="nk-sidebar-menu">
                        <!-- Menu -->
                        <ul class="nk-menu apps-menu">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navUser">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-circle-fill"></em></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="nk-sidebar-footer">
                        <ul class="nk-menu nk-menu-md apps-menu">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link" title="Settings">
                                    <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nk-sidebar-profile nk-sidebar-profile-fixed dropdown">
                    <a href="#" data-bs-toggle="dropdown" data-offset="50,-50">
                        <div class="user-avatar">
                            <span>AB</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md ms-4">
                        <div class="dropdown-inner user-card-wrap d-none d-md-block">
                            <div class="user-card">
                                <div class="user-avatar">
                                    <span>AB</span>
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">Abu Bin Ishtiyak</span>
                                    <span class="sub-text text-soft">info@softnio.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                <li><a href="#"><em class="icon ni ni-setting-alt"></em><span>Paramètres du compte</span></a></li>
                                <li><a href="html/user-profile.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                            </ul>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                <li><a href="#"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-sidebar-main is-light">
        <div class="nk-sidebar-inner" data-simplebar>

            {{-- USERS --}}
            <div class="nk-menu-content" data-content="navUser">
                <h5 class="title">Utilisateurs</h5>
                <ul class="nk-menu">
                    <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                        <span class="nk-menu-text">Patient</span>
                    </a>
                    <ul class="nk-menu-sub">
                        <li class="nk-menu-item">
                            <a href="{{route('user.create')}}" class="nk-menu-link"><span class="nk-menu-text">Ajouter un utilisateur</span></a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{route('user.index')}}" class="nk-menu-link"><span class="nk-menu-text">Liste des utilisateurs</span></a>
                        </li>
                    </ul><!-- .nk-menu-sub -->
                </ul><!-- .nk-menu -->
            </div>
        </div>
    </div>
</div>