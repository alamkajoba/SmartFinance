<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Gestion des Dépenses</h3>
                <div class="nk-block-des text-soft">
                    <p>Suivez vos dépenses et votre budget restant.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ route('depense.create') }}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Enregistrer une dépense</span></a>
            </div>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Résumé des totaux -->
    <div class="nk-block">
        <div class="row g-3">
            <div class="col-lg-4">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-2">
                            <div class="card-title">
                                <h6 class="title">Total Revenus</h6>
                            </div>
                        </div>
                        <div class="align-end flex-sm-wrap g-4 align-items-center">
                            <div class="nk-sale-data">
                                <span class="amount text-success">+ {{ number_format($totalRevenus, 2, ',', ' ') }} USD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-2">
                            <div class="card-title">
                                <h6 class="title">Total Dépenses</h6>
                            </div>
                        </div>
                        <div class="align-end flex-sm-wrap g-4 align-items-center">
                            <div class="nk-sale-data">
                                <span class="amount text-danger">- {{ number_format($totalDepenses, 2, ',', ' ') }} USD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <div class="card-title-group align-start mb-2">
                            <div class="card-title">
                                <h6 class="title">Solde Restant</h6>
                            </div>
                        </div>
                        <div class="align-end flex-sm-wrap g-4 align-items-center">
                            <div class="nk-sale-data">
                                <span class="amount {{ $soldeRestant >= 0 ? 'text-success' : 'text-danger' }}">
                                    {{ $soldeRestant >= 0 ? '+' : '' }}{{ number_format($soldeRestant, 2, ',', ' ') }} USD
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des dépenses -->
    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner">
                <div class="row g-3 align-center">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input wire:model.live="search" type="text" class="form-control" placeholder="Rechercher une dépense...">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input wire:model.live="filterMois" type="month" class="form-control" placeholder="Filtrer par mois">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Description</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Catégorie</span></div>
                        
                        <div class="nk-tb-col"><span class="sub-text">Montant</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Date</span></div>
                        <div class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span></div>
                    </div>

                    @forelse($depenses as $depense)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead">{{ $depense->description }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{ $depense->categorie?->nomCategorie ?? '-' }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{ $depense->transaction?->description ?? '-' }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-danger">
                                    - {{ number_format($depense->montant, 2, ',', ' ') }} €
                                </span>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{ \Carbon\Carbon::parse($depense->date_depense)->format('d/m/Y') }}</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1 justify-end">
                                    <li>
                                        <button wire:click="destroy({{ $depense->id }})" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                            <em class="icon ni ni-trash"></em><span>Supprimer</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @empty
                        <div class="nk-tb-item">
                            <div class="nk-tb-col" colspan="6">
                                <p class="text-center text-muted">Aucune dépense trouvée.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card-inner">
                {{ $depenses->links() }}
            </div>
        </div>
    </div>
</div>
