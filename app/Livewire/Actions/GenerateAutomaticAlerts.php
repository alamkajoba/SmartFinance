<?php

namespace App\Livewire\Actions;

use App\Models\Alerte;
use App\Models\Depense;
use App\Models\Prediction;
use Carbon\Carbon;

class GenerateAutomaticAlerts
{
    /**
     * Générer les alertes automatiques pour un utilisateur
     */
    public static function execute(int $userId): array
    {
        $alertes = [];
        $now = Carbon::now();
        $currentMonth = $now->format('Y-m');
        
        // Récupérer la prédiction du mois actuel
        $prediction = Prediction::where('user_id', $userId)
            ->where('mois', $currentMonth)
            ->first();

        // Si pas de prédiction, vérifier le mois précédent ou créer
        if (!$prediction) {
            $previousMonth = $now->copy()->subMonth()->format('Y-m');
            $prediction = Prediction::where('user_id', $userId)
                ->where('mois', $previousMonth)
                ->first();
        }

        // Récupérer les dépenses du mois actuel
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $now->copy()->endOfMonth();
        
        $depenses = Depense::where('user_id', $userId)
            ->whereBetween('date_depense', [$monthStart, $monthEnd])
            ->get();

        $totalDepensesActuelles = $depenses->sum('montant');

        // Alerte 1: Dépenses totales dépassent la prédiction
        if ($prediction && $totalDepensesActuelles > $prediction->montantPrevu) {
            $depassement = $totalDepensesActuelles - $prediction->montantPrevu;
            // Éviter la division par zéro si la prédiction est nulle ou négative
            if (floatval($prediction->montantPrevu) > 0) {
                $pourcentage = ($depassement / $prediction->montantPrevu) * 100;
            } else {
                $pourcentage = 100;
            }

            $niveau = $pourcentage > 50 ? 'danger' : ($pourcentage > 20 ? 'warning' : 'info');

            $alerte = self::createOrUpdateAlert([
                'user_id' => $userId,
                'type' => 'prediction_depassee',
                'categorie' => 'total',
                'niveau' => $niveau,
                'message' => "Attention! Vos dépenses actuelles ({$totalDepensesActuelles} USD) dépassent la prédiction ({$prediction->montantPrevu} USD) de " . number_format($pourcentage, 1) . "%",
                'montant' => $totalDepensesActuelles,
                'date_alerte' => now()->toDateString(),
            ]);
            
            $alertes[] = $alerte;
        }

        // Alerte 2: Dépenses par catégorie
        $depensesParCategorie = $depenses->groupBy('categorie_id');
        
        foreach ($depensesParCategorie as $categorieId => $categoryDepenses) {
            $totalCat = $categoryDepenses->sum('montant');
            $depense = $categoryDepenses->first();
            $categorieName = ($depense && $depense->categorie) ? $depense->categorie->nomCategorie : 'Sans catégorie';
            
            // Comparer avec le même mois l'année précédente ou avec une moyenne
            $lastYearDate = $now->copy()->subYear();
            $depensesLastYear = Depense::where('user_id', $userId)
                ->where('categorie_id', $categorieId)
                ->whereYear('date_depense', $lastYearDate->year)
                ->whereMonth('date_depense', $lastYearDate->month)
                ->sum('montant');

            if ($depensesLastYear > 0) {
                $depassement = $totalCat - $depensesLastYear;
                $pourcentage = ($depassement / $depensesLastYear) * 100;
                
                if ($pourcentage > 30) { // Alerte si dépassement > 30%
                    $niveau = $pourcentage > 50 ? 'danger' : 'warning';
                    
                    $alerte = self::createOrUpdateAlert([
                        'user_id' => $userId,
                        'type' => 'categorie_depassee',
                        'categorie' => $categorieName,
                        'niveau' => $niveau,
                        'message' => "La catégorie '{$categorieName}' a augmenté de " . number_format($pourcentage, 1) . "% par rapport au même mois l'année précédente",
                        'montant' => $totalCat,
                        'date_alerte' => now()->toDateString(),
                    ]);
                    
                    $alertes[] = $alerte;
                }
            }
        }

        return $alertes;
    }

    /**
     * Créer ou mettre à jour une alerte
     */
    private static function createOrUpdateAlert(array $data): Alerte
    {
        // Vérifier si une alerte similaire existe déjà pour ce jour
        $existingAlert = Alerte::where('user_id', $data['user_id'])
            ->where('type', $data['type'])
            ->where('categorie', $data['categorie'] ?? null)
            ->where('date_alerte', $data['date_alerte'])
            ->where('is_read', false)
            ->first();

        if ($existingAlert) {
            $existingAlert->update([
                'message' => $data['message'],
                'montant' => $data['montant'],
                'niveau' => $data['niveau'],
            ]);
            return $existingAlert;
        }

        return Alerte::create($data);
    }

    /**
     * Récupérer les alertes non lues pour un utilisateur
     */
    public static function getUnreadAlerts(int $userId): array
    {
        return Alerte::where('user_id', $userId)
            ->where('is_read', false)
            ->orderBy('niveau', 'desc')
            ->orderBy('date_alerte', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * Marquer une alerte comme lue
     */
    public static function markAsRead(int $alertId): bool
    {
        $alerte = Alerte::find($alertId);
        if ($alerte) {
            $alerte->update(['is_read' => true]);
            return true;
        }
        return false;
    }
}
