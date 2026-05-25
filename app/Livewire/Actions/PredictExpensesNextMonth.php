<?php

namespace App\Livewire\Actions;

use App\Models\Depense;
use App\Models\Prediction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PredictExpensesNextMonth
{
    /**
     * Calculer les prédictions de dépenses pour le mois suivant
     * basées sur le mois précédent
     */
    public static function execute(int $userId): ?Prediction
    {
        $now = Carbon::now();
        $nextMonth = $now->copy()->addMonth();
        $nextMonthLabel = $nextMonth->format('Y-m');
        
        // Mois qui précède le mois suivant (mois actuel)
        $previousMonth = $now->copy();
        $previousMonthStart = $previousMonth->copy()->startOfMonth();
        $previousMonthEnd = $previousMonth->copy()->endOfMonth();

        // Vérifier si une prédiction existe déjà pour ce mois
        $existingPrediction = Prediction::where('user_id', $userId)
            ->where('mois', $nextMonthLabel)
            ->first();

        if ($existingPrediction) {
            return $existingPrediction;
        }

        // Récupérer les dépenses du mois précédent
        $depenses = Depense::where('user_id', $userId)
            ->whereBetween('date_depense', [$previousMonthStart, $previousMonthEnd])
            ->get();

        if ($depenses->isEmpty()) {
            // Pas de dépenses le mois précédent, créer une prédiction par défaut
            return Prediction::create([
                'user_id' => $userId,
                'mois' => $nextMonthLabel,
                'montantPrevu' => 0,
                'precision' => 0,
            ]);
        }

        // Calculer le montant total du mois précédent
        $montantTotal = $depenses->sum('montant');

        // Créer la prédiction basée sur le mois précédent
        return Prediction::create([
            'user_id' => $userId,
            'mois' => $nextMonthLabel,
            'montantPrevu' => round($montantTotal, 2),
            'precision' => 0, // Précision = 0 car c'est une projection directe du mois précédent
        ]);
    }

    /**
     * Calculer les prédictions par catégorie pour le mois suivant
     * basées sur le mois précédent
     */
    public static function executeByCategory(int $userId): array
    {
        $now = Carbon::now();
        
        // Mois qui précède le mois suivant (mois actuel)
        $previousMonth = $now->copy();
        $previousMonthStart = $previousMonth->copy()->startOfMonth();
        $previousMonthEnd = $previousMonth->copy()->endOfMonth();

        $depenses = Depense::where('user_id', $userId)
            ->whereBetween('date_depense', [$previousMonthStart, $previousMonthEnd])
            ->with('categorie')
            ->get();

        if ($depenses->isEmpty()) {
            return [];
        }

        $predictions = [];
        
        // Grouper par catégorie
        $depensesByCategory = $depenses->groupBy('categorie_id');

        foreach ($depensesByCategory as $categoryId => $categoryDepenses) {
            $montantTotal = $categoryDepenses->sum('montant');
            
            $categorie = $categoryDepenses->first()->categorie;
            $predictions[] = [
                'categorie' => $categorie->nomCategorie ?? 'Sans catégorie',
                'montantPrevu' => round($montantTotal, 2),
                'precision' => 0, // Projection directe du mois précédent
                'montants_historiques' => [$montantTotal],
            ];
        }

        return $predictions;
    }
}
