<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ajouter un utilisateur</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <form wire:submit.prevent="ajouterUtilisateur" method="POST">
                                @csrf
                                <div class="card-inner">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="title nk-block-title">Personal Info</h5>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="row gy-4">
                                            <div class="col-xxl-3 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="nom">Nom complet</label>
                                                    <div class="form-control-wrap">
                                                        <input wire:model="nom" type="text" class="form-control" id="nom" placeholder="Nom complet">
                                                    </div>
                                                    @error('nom')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div><!--col-->
                                            <div class="col-xxl-3 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input wire:model="email" type="email" class="form-control" id="email" placeholder="Email">
                                                    </div>
                                                    @error('email')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div><!--col-->
                                            <div class="col-xxl-3 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="motDePasse">Mot de passe</label>
                                                    <div class="form-control-wrap">
                                                        <input wire:model="motDePasse" type="password" class="form-control" id="motDePasse" placeholder="Mot de passe">
                                                    </div>
                                                    @error('motDePasse')
                                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div><!--col-->
                                        </div><!--row-->
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Ajouter un utilisateur</button>
                                        </div>
                                    </div><!--col-->
                                </div><!-- .card-inner -->
                            </form>
                        </div>
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
