<?php

namespace App\Livewire\Module\Depense;

use App\Models\Depense;
use App\Models\Transaction;
use App\Models\Categorie;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class DepenseCreate extends Component
{
    public float $montant = 0.0;
    public ?int $categorie_id = null;
    public ?int $transaction_id = null;
    public string $description = '';
    public string $date_depense = '';

    public function mount()
    {
        $this->date_depense = now()->format('Y-m-d');
    }

    public function store()
    {
        $this->validate([
            'montant' => 'required|numeric|min:0.01',
            'categorie_id' => 'nullable|exists:categories,id',
            'transaction_id' => 'nullable|exists:transactions,id',
            'description' => 'required|string|max:500',
            'date_depense' => 'required|date|before_or_equal:today',
        ]);

        // Vérifier que la transaction appartient à l'utilisateur si elle est spécifiée
        if ($this->transaction_id) {
            $transaction = Transaction::findOrFail($this->transaction_id);
            if ($transaction->user_id !== Auth::id()) {
                session()->flash('error', 'Transaction non valide.');
                return;
            }

            // Vérifier que le montant de la dépense ne dépasse pas le montant de la transaction
            // seulement si c'est un revenu
            if ($transaction->type === 'revenu' && $this->montant > $transaction->montant) {
                session()->flash('error', 'Le montant de la dépense ne peut pas dépasser le montant de la transaction liée (' . number_format($transaction->montant, 2, ',', ' ') . ' USD).');
                return;
            }
        }

        // Calculer le solde restant uniquement à partir des revenus, puis soustraire les dépenses enregistrées
        $totalRevenus = Transaction::where('user_id', Auth::id())
            ->where('type', 'revenu')
            ->sum('montant') ?? 0;

        $totalDepenses = Depense::where('user_id', Auth::id())->sum('montant') ?? 0;
        $soldeRestant = $totalRevenus - $totalDepenses;

        // Vérifier que le solde restant est suffisant pour cette dépense
        if ($this->montant > $soldeRestant) {
            session()->flash('error', 'Solde insuffisant ! Revenus totaux : ' . number_format($totalRevenus, 2, ',', ' ') . ' EUR - Dépenses totales : ' . number_format($totalDepenses, 2, ',', ' ') . ' EUR = ' . number_format($soldeRestant, 2, ',', ' ') . ' EUR. Impossible d\'enregistrer une dépense de ' . number_format($this->montant, 2, ',', ' ') . ' EUR.');
            return;
        }

        Depense::create([
            'user_id' => Auth::id(),
            'montant' => $this->montant,
            'categorie_id' => $this->categorie_id,
            'transaction_id' => $this->transaction_id,
            'description' => $this->description,
            'date_depense' => $this->date_depense,
        ]);

        session()->flash('message', 'Dépense enregistrée avec succès.');

        return redirect()->route('depense.index');
    }

    public function updatedTransactionId()
    {
        // Réinitialiser le montant si la transaction change
        if ($this->transaction_id) {
            $transaction = Transaction::find($this->transaction_id);
            if ($transaction && $transaction->user_id === Auth::id()) {
                
                // $this->montant = min($this->montant, $transaction->montant);
            }
        }
    }

    public function getMaxMontantProperty()
    {
        if ($this->transaction_id) {
            $transaction = Transaction::find($this->transaction_id);
            if ($transaction && $transaction->user_id === Auth::id() && $transaction->type === 'revenu') {
                return $transaction->montant;
            }
        }
        return null;
    }

    public function getSoldeRestantProperty()
    {
        $totalRevenus = Transaction::where('user_id', Auth::id())
            ->where('type', 'revenu')
            ->sum('montant') ?? 0;

        $totalDepenses = Depense::where('user_id', Auth::id())->sum('montant');

        return $totalRevenus - $totalDepenses;
    }

    public function render()
    {
        $categories = Categorie::all();
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.module.depense.depense-create', [
            'categories' => $categories,
            'transactions' => $transactions,
            'soldeRestant' => $this->soldeRestant,
            'maxMontant' => $this->maxMontant
        ]);
    }
}