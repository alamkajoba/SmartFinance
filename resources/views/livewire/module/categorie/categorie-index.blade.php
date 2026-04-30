<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Catégories</h3>
                <div class="nk-block-des text-soft">
                    <p>Gérez ici vos catégories de dépenses et revenus.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ route('categorie.create') }}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Ajouter une catégorie</span></a>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner">
                <div class="row g-3 align-center">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input wire:model.live="search" type="text" class="form-control" placeholder="Rechercher une catégorie">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Nom de la catégorie</span></div>
                        <div class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span></div>
                    </div>

                    @forelse($categories as $categorie)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead">{{ $categorie->nomCategorie }}</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1 justify-end">
                                    <li>
                                        <a href="{{ route('categorie.update', $categorie->id) }}" class="btn btn-sm btn-outline-primary"><em class="icon ni ni-edit"></em><span>Modifier</span></a>
                                    </li>
                                    <li>
                                        <button type="button" class="btn btn-sm btn-outline-danger" wire:click="destroy({{ $categorie->id }})" onclick="return confirm('Supprimer cette catégorie ?');">
                                            <em class="icon ni ni-trash"></em><span>Supprimer</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @empty
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                Aucune catégorie trouvée.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card-inner">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
