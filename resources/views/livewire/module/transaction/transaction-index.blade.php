<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Transactions</h3>
                <div class="nk-block-des text-soft">
                    <p>Gérez et consultez toutes vos transactions financières.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{ route('transaction.create') }}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Ajouter une transaction</span></a>
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

    <div class="nk-block">
        <div class="card card-bordered card-stretch">
            <div class="card-inner">
                <div class="row g-3 align-center">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input wire:model.live="search" type="text" class="form-control" placeholder="Rechercher une transaction...">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <select wire:model.live="filterType" class="form-control">
                                    <option value="">Tous les types</option>
                                    <option value="depense">Dépenses</option>
                                    <option value="revenu">Revenus</option>
                                </select>
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
                        <div class="nk-tb-col"><span class="sub-text">Type</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Date</span></div>
                        <div class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span></div>
                    </div>

                    @forelse($transactions as $transaction)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead">{{ $transaction->description ?? 'Sans description' }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{ $transaction->categorie?->nomCategorie ?? '-' }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-{{ $transaction->type === 'revenu' ? 'success' : 'danger' }}">
                                    {{ $transaction->type === 'revenu' ? '+' : '-' }} {{ number_format($transaction->montant, 2, ',', ' ') }} USD
                                </span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-{{ $transaction->type === 'revenu' ? 'light-success' : 'light-danger' }}">
                                    {{ $transaction->type === 'revenu' ? 'Revenu' : 'Dépense' }}
                                </span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="text-muted">{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1 justify-end">
                                    <li>
                                        <a href="{{ route('transaction.update', $transaction->id) }}" class="btn btn-sm btn-outline-primary"><em class="icon ni ni-edit"></em><span>Modifier</span></a>
                                    </li>
                                    <li>
                                        <button wire:click="destroy({{ $transaction->id }})" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr ?')"><em class="icon ni ni-trash"></em><span>Supprimer</span></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @empty
                        <div class="nk-tb-item">
                            <div class="nk-tb-col" colspan="6">
                                <p class="text-center text-muted">Aucune transaction trouvée.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="card-inner">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
