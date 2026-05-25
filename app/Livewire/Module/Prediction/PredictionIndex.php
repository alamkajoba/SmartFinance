<?php

namespace App\Livewire\Module\Prediction;

use App\Livewire\Actions\PredictExpensesNextMonth;
use App\Models\Prediction;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class PredictionIndex extends Component
{
    public ?Prediction $nextMonthPrediction = null;
    public array $predictionsByCategory = [];
    public string $nextMonthLabel = '';
    public bool $showRefreshButton = true;

    public function mount()
    {
        $this->loadPredictions();
    }

    public function loadPredictions()
    {
        $now = Carbon::now();
        $nextMonth = $now->copy()->addMonth();
        $this->nextMonthLabel = $nextMonth->format('F Y'); // Ex: "June 2026"

        // Récupérer ou créer la prédiction
        $this->nextMonthPrediction = PredictExpensesNextMonth::execute(Auth::id());
        
        // Récupérer les prédictions par catégorie
        $this->predictionsByCategory = PredictExpensesNextMonth::executeByCategory(Auth::id());
    }

    public function refreshPrediction()
    {
        // Supprimer l'ancienne prédiction si elle existe
        if ($this->nextMonthPrediction) {
            $this->nextMonthPrediction->delete();
        }

        $this->loadPredictions();
        $this->dispatch('notify', message: 'Prédictions mises à jour avec succès!', type: 'success');
    }

    public function render()
    {
        return view('livewire.module.prediction.prediction-index');
    }
}
