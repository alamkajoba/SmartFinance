<?php

namespace App\Livewire\Module\Transaction;

use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class TransactionIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public ?string $search = '';
    public ?string $filterType = '';
    public ?string $filterMois = '';

    public function render()
    {
        $transactions = Transaction::query()
            ->where('user_id', Auth::id())
            ->when($this->search, fn($query) => $query->where('description', 'like', '%'.$this->search.'%'))
            ->when($this->filterType, fn($query) => $query->where('type', $this->filterType))
            ->when($this->filterMois, function($query) {
                $date = \Carbon\Carbon::createFromFormat('Y-m', $this->filterMois);
                $query->whereYear('created_at', $date->year)
                      ->whereMonth('created_at', $date->month);
            })
            ->with('categorie')
            ->latest()
            ->paginate(10);

        return view('livewire.module.transaction.transaction-index', ['transactions' => $transactions]);
    }

    public function destroy(int $id)
    {
        $transaction = Transaction::findOrFail($id);
        
        // Vérifier que l'utilisateur est propriétaire de la transaction
        if ($transaction->user_id !== Auth::id()) {
            session()->flash('error', 'Vous n\'avez pas la permission de supprimer cette transaction.');
            return;
        }

        $transaction->delete();
        session()->flash('message', 'Transaction supprimée avec succès.');
    }
}
