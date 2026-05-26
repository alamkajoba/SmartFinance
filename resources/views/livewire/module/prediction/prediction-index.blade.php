<div>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Prédictions de Dépenses</h3>
                <div class="nk-block-des text-soft">
                    <p>Prédiction des dépenses pour le mois suivant basée sur l'historique.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                @if($showRefreshButton)
                    <button wire:click="refreshPrediction" class="btn btn-primary">
                        <em class="icon ni ni-reload"></em><span>Actualiser</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Prédiction globale du mois -->
    @if($nextMonthPrediction)
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-3">
                        <div class="card-title">
                            <h6 class="title">Prédiction Globale - {{ $nextMonthLabel }}</h6>
                            <p class="text-soft text-sm">Estimation des dépenses totales</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="card card-bordered bg-light">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-2">
                                        <div class="card-title">
                                            <h6 class="title">Montant Prévu</h6>
                                        </div>
                                    </div>
                                    <div class="align-end flex-sm-wrap g-4 align-items-center">
                                        <div class="nk-sale-data">
                                            <span class="amount text-primary">
                                                {{ number_format($nextMonthPrediction->montantPrevu, 2, ',', ' ') }} USD
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card card-bordered bg-light">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-2">
                                        <div class="card-title">
                                            <h6 class="title">Précision de la Prédiction</h6>
                                        </div>
                                    </div>
                                    <div class="align-end flex-sm-wrap g-4 align-items-center">
                                        <div class="nk-sale-data">
                                            <span class="amount">{{ number_format($nextMonthPrediction->precision, 2, ',', ' ') }}%</span>
                                            <small class="text-soft d-block mt-1">
                                                @if($nextMonthPrediction->precision < 20)
                                                    <span class="badge badge-success">Très fiable</span>
                                                @elseif($nextMonthPrediction->precision < 40)
                                                    <span class="badge badge-info">Fiable</span>
                                                @elseif($nextMonthPrediction->precision < 60)
                                                    <span class="badge badge-warning">Modérée</span>
                                                @else
                                                    <span class="badge badge-danger">Peu fiable</span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <p class="text-sm text-soft">
                            <em class="icon ni ni-info-circle"></em>
                            Cette prédiction est basée sur l'analyse de vos 6 derniers mois de dépenses. 
                            Un pourcentage faible indique une prédiction plus fiable et cohérente.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            Pas de dépenses historiques pour générer une prédiction.
        </div>
    @endif

    <!-- Prédictions par catégorie -->
    @if(!empty($predictionsByCategory))
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-3">
                        <div class="card-title">
                            <h6 class="title">Prédictions par Catégorie</h6>
                            <p class="text-soft text-sm">Estimation par catégorie de dépenses</p>
                        </div>
                    </div>

                    <div class="row g-3">
                        @foreach($predictionsByCategory as $prediction)
                            <div class="col-lg-4 col-md-6">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title">{{ $prediction['categorie'] }}</h6>
                                            </div>
                                        </div>

                                        <div class="nk-sale-data mb-3">
                                            <span class="amount text-primary">
                                                {{ number_format($prediction['montantPrevu'], 2, ',', ' ') }} USD
                                            </span>
                                            <small class="text-soft d-block mt-1">Montant prévu</small>
                                        </div>

                                        <div class="progress">
                                            @php
                                                $precisionClass = $prediction['precision'] < 20 ? 'bg-success' : 
                                                                  ($prediction['precision'] < 40 ? 'bg-info' : 
                                                                   ($prediction['precision'] < 60 ? 'bg-warning' : 'bg-danger'));
                                                $precisionWidth = min($prediction['precision'], 100);
                                            @endphp
                                            <div class="progress-bar {{ $precisionClass }}" role="progressbar" 
                                                 style="width: {{ 100 - $precisionWidth }}%" 
                                                 aria-valuenow="{{ 100 - $precisionWidth }}" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                        <small class="text-soft">Précision: {{ number_format($prediction['precision'], 1, ',', ' ') }}%</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
