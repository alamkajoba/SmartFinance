<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ajouter une transaction</h3>
                            <div class="nk-block-des text-soft">
                                <p>Créez une nouvelle transaction de dépense ou revenu.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('transaction.index') }}" class="btn btn-outline-secondary"><em class="icon ni ni-arrow-left"></em><span>Retour à la liste</span></a>
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
                                            <label class="form-label" for="type">Type de transaction</label>
                                            <div class="form-control-wrap">
                                                <select wire:model.defer="type" id="type" class="form-control">
                                         
                                                    <option value="revenu">Revenu</option>
                                                </select>
                                            </div>
                                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="montant">Montant (USD)</label>
                                            <div class="form-control-wrap">
                                                <input wire:model.defer="montant" type="number" id="montant" step="0.01" min="0.01" class="form-control" placeholder="Ex. 50.00">
                                            </div>
                                            @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="categorie_id">Catégorie</label>
                                            <div class="form-control-wrap">
                                                <select wire:model.defer="categorie_id" id="categorie_id" class="form-control">
                                                    <option value="">-- Sélectionner une catégorie --</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->nomCategorie }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('categorie_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="description">Description</label>
                                            <div class="form-control-wrap">
                                                <textarea wire:model.defer="description" id="description" class="form-control" rows="4" placeholder="Ex. Achat de fournitures..."></textarea>
                                            </div>
                                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="custom-control custom-checkbox">
                                                    <input wire:model.defer="cumuler" type="checkbox" id="cumuler" class="custom-control-input">
                                                    <label class="custom-control-label" for="cumuler">
                                                        Cumuler avec la dernière transaction du même type
                                                    </label>
                                                </div>
                                                <small class="form-text text-muted">
                                                    Si coché, le montant sera ajouté à votre dernière transaction {{ $type }} au lieu d'en créer une nouvelle.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        <a href="{{ route('transaction.index') }}" class="btn btn-outline-secondary">Annuler</a>
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
