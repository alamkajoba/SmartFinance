<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Enregistrer une dépense</h3>
                            <div class="nk-block-des text-soft">
                                <p>Ajoutez une nouvelle dépense à votre suivi budgétaire.</p>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('depense.index') }}" class="btn btn-outline-secondary"><em class="icon ni ni-arrow-left"></em><span>Retour à la liste</span></a>
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
                                            <label class="form-label" for="description">Description de la dépense</label>
                                            <div class="form-control-wrap">
                                                <input wire:model.defer="description" type="text" id="description" class="form-control" placeholder="Ex. Courses au supermarché">
                                            </div>
                                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="montant">Montant (USD)</label>
                                            <div class="form-control-wrap">
                                                <input wire:model.defer="montant" type="number" id="montant" step="0.01" min="0.01" class="form-control" placeholder="Ex. 50.00">
                                            </div>
                                            @error('montant') <span class="text-danger">{{ $message }}</span> @enderror
                                            @if($transaction_id && $maxMontant && $montant > $maxMontant)
                                                <small class="text-warning">⚠️ Le montant ne peut pas dépasser {{ number_format($maxMontant, 2, ',', ' ') }} USD (montant de la transaction liée)</small>
                                            @elseif($transaction_id && $maxMontant)
                                                <small class="text-info">💡 Montant maximum disponible : {{ number_format($maxMontant, 2, ',', ' ') }} €</small>
                                            @endif
                                            <small class="text-{{ $soldeRestant >= 0 ? 'success' : 'danger' }}">
                                                💰 Solde restant : {{ number_format($soldeRestant, 2, ',', ' ') }} €
                                            </small>
                                            @if($montant > $soldeRestant)
                                                <small class="text-danger">❌ Solde insuffisant pour ce montant !</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="date_depense">Date de la dépense</label>
                                            <div class="form-control-wrap">
                                                <input wire:model.defer="date_depense" type="date" id="date_depense" class="form-control">
                                            </div>
                                            @error('date_depense') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="transaction_id">Transaction liée (optionnel)</label>
                                            <div class="form-control-wrap">
                                                <select wire:model.defer="transaction_id" id="transaction_id" class="form-control">
                                                    <option value="">-- Aucune transaction liée --</option>
                                                    @foreach($transactions as $transaction)
                                                        <option value="{{ $transaction->id }}">
                                                            [{{ $transaction->type === 'revenu' ? 'REVENU' : 'DÉPENSE' }}] {{ $transaction->description }} ({{ number_format($transaction->montant, 2, ',', ' ') }} €)
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('transaction_id') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                                class="btn btn-primary"
                                                @if(($transaction_id && $maxMontant && $montant > $maxMontant) || $montant > $soldeRestant) disabled @endif>
                                            Enregistrer la dépense
                                        </button>
                                        <a href="{{ route('depense.index') }}" class="btn btn-outline-secondary">Annuler</a>
                                        @if($transaction_id && $maxMontant && $montant > $maxMontant)
                                            <div class="mt-2">
                                                <small class="text-danger">❌ Veuillez réduire le montant pour pouvoir enregistrer la dépense.</small>
                                            </div>
                                        @elseif($montant > $soldeRestant)
                                            <div class="mt-2">
                                                <small class="text-danger">❌ Solde insuffisant ! Votre solde restant est de {{ number_format($soldeRestant, 2, ',', ' ') }} USD.</small>
                                            </div>
                                        @endif
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
