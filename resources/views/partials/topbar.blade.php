<div class="container-fluid">
    <div class="nk-header-wrap">
        <div class="nk-menu-trigger d-xl-none ms-n1">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-header-brand d-xl-none">
            <a href="" class="logo-link">
                <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
            </a>
        </div><!-- .nk-header-brand -->
        <div class="nk-header-search ms-3 ms-xl-0 d-none d-md-flex">
            <em class="icon ni ni-search"></em>
            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">
        </div><!-- .nk-header-news -->
        <div class="nk-header-tools">
            <ul class="nk-quick-nav">
                
                <li class="dropdown user-dropdown">
                    <a href="" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                        <div class="user-toggle">
                            <div class="user-avatar sm">
                                <em class="icon ni ni-user-alt"></em>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                        <div class="dropdown-inner user-card-wrap bg-lighter">
                            <div class="user-card">
                                <div class="user-avatar">
                                    <span>AB</span>
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">{{Auth::user()->name}}</span>
                                    <span class="sub-text">{{Auth::user()->email}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                <li><a href="{{route('profile')}}"><em class="icon ni ni-user-alt"></em><span>Profil</span></a></li>
                                <li><a href="{{route('profile')}}"><em class="icon ni ni-setting-alt"></em><span>paramètres du compte</span></a></li>
                            </ul>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                <li><a href=""><em class="icon ni ni-signout"></em><span>Déconnexion</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div><!-- .nk-header-wrap -->
</div><!-- .container-fliud -->