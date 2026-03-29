<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Administrateurs</h3>
                <div class="nk-block-des text-soft">
                    <p>Vous avez un total de 163 utilisants le système</p>
                </div>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <a href="html/hospital/patient-add.html" class="btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                <a href="html/hospital/patient-add.html" class="btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Ajouter un admnistrateur</span></a>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                    <div class="card-title-group">
                        <div class="card-tools">
                            <div class="form-inline flex-nowrap gx-3">
                                <div class="form-wrap w-150px">
                                    <select class="form-select js-select2" data-search="off" data-placeholder="Bulk Action">
                                        <option value="">Bulk Action</option>
                                        <option value="email">Send Email</option>
                                        <option value="discharged">Discharged</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                </div>
                                <div class="btn-wrap">
                                    <span class="d-none d-md-block"><button class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                    <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                </div>
                            </div><!-- .form-inline -->
                        </div><!-- .card-tools -->
                        <div class="card-tools me-n1">
                            <ul class="btn-toolbar gx-1">
                                <li>
                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                </li><!-- li -->
                                <li class="btn-toolbar-sep"></li><!-- li -->
                                <li>
                                    <div class="toggle-wrap">
                                        <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                        <div class="toggle-content" data-content="cardTools">
                                            <ul class="btn-toolbar gx-1">
                                                <li class="toggle-close">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                </li><!-- li -->
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .toggle-content -->
                                    </div><!-- .toggle-wrap -->
                                </li><!-- li -->
                            </ul><!-- .btn-toolbar -->
                        </div><!-- .card-tools -->
                    </div><!-- .card-title-group -->
                    <div class="card-search search-wrap" data-search="search">
                        <div class="card-body">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input wire:model.live="search" type="text" class="form-control border-transparent form-focus-none" placeholder="chercher par nom ou email">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div>
                    </div><!-- .card-search -->
                </div><!-- .card-inner -->
                <div class="card-inner p-0">
                    <div class="nk-tb-list nk-tb-ulist">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span class="sub-text">Identifiants</span></div>
                        </div><!-- .nk-tb-item -->
                        @forelse ($user as $users)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary">
                                            <span>User</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">{{$users->name}}</span>
                                            <span>{{$users->email}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a data-bs-toggle="modal" href="#"><em class="icon ni ni-edit"></em><span>Editer</span></a></li>
                                                        <li><a data-bs-toggle="modal" href="#"><em class="icon ni ni-trash"></em><span>Supprimer</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .nk-tb-item -->
                        @empty
                            Aucun !...
                        @endforelse
                    </div><!-- .nk-tb-list -->
                </div><!-- .card-inner -->
                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        <div class="g">
                            <ul class="pagination justify-content-center justify-content-md-start">
                                {{ $user->links() }}
                            </ul><!-- .pagination -->
                        </div>
                        
                    </div><!-- .nk-block-between -->
                </div><!-- .card-inner -->
            </div><!-- .card-inner-group -->
        </div><!-- .card -->
    </div><!-- .nk-block -->
</div>
