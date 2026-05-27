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
                <li class="dropdown chats-dropdown hide-mb-xs">
                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                        <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                        <div class="dropdown-head">
                            <span class="sub-title nk-dropdown-title">Recent Chats</span>
                            <a href="#">Setting</a>
                        </div>
                        <div class="dropdown-body">
                            <ul class="chat-list">
                                <li class="chat-item is-unread">
                                    <a class="chat-link" href="html/apps-chats.html">
                                        <div class="chat-media user-avatar bg-pink">
                                            <span>AB</span>
                                            <span class="status dot dot-lg dot-success"></span>
                                        </div>
                                        <div class="chat-info">
                                            <div class="chat-from">
                                                <div class="name">Abu Bin Ishtiyak</div>
                                                <span class="time">4:49 AM</span>
                                            </div>
                                            <div class="chat-context">
                                                <div class="text">Hi, I am Ishtiyak, can you help me with this problem ?</div>
                                                <div class="status unread">
                                                    <em class="icon ni ni-bullet-fill"></em>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- .chat-item -->
                                <li class="chat-item">
                                    <a class="chat-link" href="html/apps-chats.html">
                                        <div class="chat-media user-avatar">
                                            <img src="./images/avatar/b-sm.jpg" alt="">
                                        </div>
                                        <div class="chat-info">
                                            <div class="chat-from">
                                                <div class="name">George Philips</div>
                                                <span class="time">6 Apr</span>
                                            </div>
                                            <div class="chat-context">
                                                <div class="text">Have you seens the claim from Rose?</div>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- .chat-item -->
                            </ul><!-- .chat-list -->
                        </div><!-- .nk-dropdown-body -->
                        <div class="dropdown-foot center">
                            <a href="html/apps-chats.html">View All</a>
                        </div>
                    </div>
                </li>
                {{-- <li class="dropdown notification-dropdown hide-mb-xs">
                    @php $alertCount = Auth::check() ? Auth::user()->alertes()->where('is_read', false)->count() : 0; @endphp
                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                        <div class="icon-status icon-status-warning"><em class="icon ni ni-bell-fill"></em></div>
                        @if($alertCount > 0)
                            <span class="badge badge-dot bg-warning"></span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">
                        <div class="dropdown-head">
                            <span class="sub-title nk-dropdown-title">Alertes</span>
                            <a href="{{ route('alerte.index') }}">Voir</a>
                        </div>
                        <div class="dropdown-body">
                            <div class="nk-notification">
                                @if($alertCount > 0)
                                    @foreach(Auth::user()->alertes()->where('is_read', false)->orderBy('date_alerte', 'desc')->limit(5)->get() as $alerte)
                                        <div class="nk-notification-item dropdown-inner">
                                            <div class="nk-notification-icon">
                                                <em class="icon ni ni-alert-fill"></em>
                                            </div>
                                            <div class="nk-notification-content">
                                                <div class="nk-notification-text">{{ $alerte->message }}</div>
                                                <div class="nk-notification-time">{{ $alerte->date_alerte->format('d/m/Y') }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="nk-notification-item">
                                        <div class="nk-notification-content">
                                            <div class="nk-notification-text">Aucune alerte</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="dropdown-foot center">
                            <a href="{{ route('alerte.index') }}">Voir toutes les alertes</a>
                        </div>
                    </div>
                </li> --}}
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