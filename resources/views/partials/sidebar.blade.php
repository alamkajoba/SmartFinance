<div class="nk-sidebar" data-content="sidebarMenu">
    <div class="nk-sidebar-bar">
        <div class="nk-apps-brand">
            <a href="" class="logo-link">
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
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navPharmacy">
                                    <span class="nk-menu-icon"><em class="icon ni ni-menu-circled"></em></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="nk-sidebar-profile nk-sidebar-profile-fixed">
                    <a href="#" class="toggle" data-target="profileDD">
                        <div class="user-avatar">
                            <span>AB</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md m-1 nk-sidebar-profile-dropdown" data-content="profileDD">
                        <div class="dropdown-inner user-card-wrap d-none d-md-block">
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
                                <li><a href="{{route('profile')}}"><em class="icon ni ni-setting-alt"></em><span>Paramètres du compte</span></a></li>
                            </ul>
                        </div>
                        <div class="dropdown-inner">
                            <ul class="link-list">
                                <li><a href="#"><em class="icon ni ni-signout"></em><span>Déconnexion</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-sidebar-main is-light">
        <div class="nk-sidebar-inner" data-simplebar>
            <div class="nk-menu-content" data-content="navPharmacy">
                <h5 class="title">Gestion Finance</h5>
                <ul class="nk-menu">
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                            <span class="nk-menu-text">Utilisateurs</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/add-customer.html" class="nk-menu-link"><span class="nk-menu-text">Add Customer</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/customer.html" class="nk-menu-link"><span class="nk-menu-text">Customer List</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/customer-ledger.html" class="nk-menu-link"><span class="nk-menu-text">Customer Ledger</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-capsule-fill"></em></span>
                            <span class="nk-menu-text">Catégories</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('categorie.create') }}" class="nk-menu-link"><span class="nk-menu-text">Ajouter une catégorie</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('categorie.index') }}" class="nk-menu-link"><span class="nk-menu-text">Voir les catégories</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-home-fill"></em></span>
                            <span class="nk-menu-text">Dépenses</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('depense.create') }}" class="nk-menu-link"><span class="nk-menu-text">Enregistrer une dépense</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('depense.index') }}" class="nk-menu-link"><span class="nk-menu-text">Voir les dépenses</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-repeat"></em></span>
                            <span class="nk-menu-text">Transactions</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('transaction.create') }}" class="nk-menu-link"><span class="nk-menu-text">Ajouter une transaction</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('transaction.index') }}" class="nk-menu-link"><span class="nk-menu-text">Voir les transactions</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-circle-fill"></em></span>
                            <span class="nk-menu-text">Prédictions</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/member.html" class="nk-menu-link"><span class="nk-menu-text">Member</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/members-profile-regular.html" class="nk-menu-link"><span class="nk-menu-text">Members Profile</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/attendence.html" class="nk-menu-link"><span class="nk-menu-text">Attendence</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/salary.html" class="nk-menu-link"><span class="nk-menu-text">Salary</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-coin-alt-fill"></em></span>
                            <span class="nk-menu-text">Alerte</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/income-list.html" class="nk-menu-link"><span class="nk-menu-text">Income</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/expense-list.html" class="nk-menu-link"><span class="nk-menu-text">Expence</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/invoice-list.html" class="nk-menu-link"><span class="nk-menu-text">Invoice List</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="html/pharmacy/invoice-details.html" class="nk-menu-link"><span class="nk-menu-text">Invoice Details</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    
                </ul><!-- .nk-menu -->
            </div>
        </div>
    </div>
</div>