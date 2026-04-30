<?php

namespace App\Livewire\Module\Depense;

use App\Models\Depense;
use App\Models\Transaction;
use App\Models\Categorie;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class DepenseIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public ?string $search = '';
    public ?string $filterMois = '';

    public function render()
    {
        $depenses = Depense::query()
            ->where('user_id', Auth::id())
            ->when($this->search, fn($query) => $query->where('description', 'like', '%'.$this->search.'%'))
            ->when($this->filterMois, function($query) {
                $date = \Carbon\Carbon::createFromFormat('Y-m', $this->filterMois);
                $query->whereYear('date_depense', $date->year)
                      ->whereMonth('date_depense', $date->month);
            })
            ->with(['categorie', 'transaction'])
            ->latest('date_depense')
            ->paginate(10);

        // Calculs des totaux
        $totalDepenses = Depense::where('user_id', Auth::id())->sum('montant');

        // Calcul du solde comme somme algébrique de toutes les transactions
        $soldeTransactions = Transaction::where('user_id', Auth::id())
            ->selectRaw('SUM(CASE WHEN type = "revenu" THEN montant ELSE -montant END) as solde')
            ->value('solde') ?? 0;

        $soldeRestant = $soldeTransactions - $totalDepenses;

        // Pour l'affichage séparé (optionnel)
        $totalRevenus = Transaction::where('user_id', Auth::id())
            ->where('type', 'revenu')
            ->sum('montant');

        return view('livewire.module.depense.depense-index', [
            'depenses' => $depenses,
            'totalDepenses' => $totalDepenses,
            'totalRevenus' => $totalRevenus,
            'soldeRestant' => $soldeRestant
        ]);
    }

    public function destroy(int $id)
    {
        $depense = Depense::findOrFail($id);

        // Vérifier que l'utilisateur est propriétaire
        if ($depense->user_id !== Auth::id()) {
            session()->flash('error', 'Vous n\'avez pas la permission de supprimer cette dépense.');
            return;
        }

        $depense->delete();
        session()->flash('message', 'Dépense supprimée avec succès.');
    }
}