<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Alertes</h3>
                <div class="nk-block-des text-soft">
                    <p>Consultez vos alertes automatiques de dépassement budget et de suivi des dépenses.</p>
                </div>
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
                                <input wire:model.live="search" type="text" class="form-control" placeholder="Rechercher dans les alertes">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Message</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Niveau</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Montant</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Date</span></div>
                        <div class="nk-tb-col nk-tb-col-tools text-end"><span class="sub-text">Actions</span></div>
                    </div>

                    @forelse($alertes as $alerte)
                        <div class="nk-tb-item {{ $alerte->is_read ? 'bg-light' : '' }}">
                            <div class="nk-tb-col">
                                <span class="tb-lead">{{ $alerte->message }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-{{ $alerte->niveau == 'danger' ? 'danger' : ($alerte->niveau == 'warning' ? 'warning' : 'success') }}">
                                    {{ ucfirst($alerte->niveau) }}
                                </span>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{ $alerte->montant ? number_format($alerte->montant, 2, ',', ' ') . ' USD' : '-' }}</span>
                            </div>
                            <div class="nk-tb-col">
                                <span>{{ $alerte->date_alerte?->format('d/m/Y') ?? $alerte->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                @if(! $alerte->is_read)
                                    <button class="btn btn-sm btn-outline-primary" wire:click="markAsRead({{ $alerte->id }})">
                                        <em class="icon ni ni-check-circle"></em><span>Marquer lu</span>
                                    </button>
                                @else
                                    <span class="text-soft">Lu</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                Aucune alerte disponible.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="card-inner">
                {{ $alertes->links() }}
            </div>
        </div>
    </div>
</div>
