<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ajouter une catégorie</h3>
                            <div class="nk-block-des text-soft">
                                <p>Créez une nouvelle catégorie pour organiser vos transactions.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('categorie.index') }}" class="btn btn-outline-secondary"><em class="icon ni ni-arrow-left"></em><span>Retour à la liste</span></a>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form wire:submit.prevent="store">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="nomCategorie">Nom de la catégorie</label>
                                            <div class="form-control-wrap">
                                                <input wire:model.defer="nomCategorie" type="text" id="nomCategorie" class="form-control" placeholder="Ex. Alimentation">
                                            </div>
                                            @error('nomCategorie') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
