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
            'categorie_id' => 'nullable|exists:categorie,id',
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
                session()->flash('error', 'Le montant de la dépense ne peut pas dépasser le montant de la transaction liée (' . number_format($transaction->montant, 2, ',', ' ') . ' €).');
                return;
            }
        }

        // Calculer le solde restant (somme algébrique de toutes les transactions - dépenses directes)
        $soldeTransactions = Transaction::where('user_id', Auth::id())
            ->selectRaw('SUM(CASE WHEN type = "revenu" THEN montant ELSE -montant END) as solde')
            ->value('solde') ?? 0;

        $totalDepenses = Depense::where('user_id', Auth::id())->sum('montant');
        $soldeRestant = $soldeTransactions - $totalDepenses;

        // Vérifier que le solde restant est suffisant pour cette dépense
        if ($this->montant > $soldeRestant) {
            session()->flash('error', 'Solde insuffisant ! Votre solde restant est de ' . number_format($soldeRestant, 2, ',', ' ') . ' €. Impossible d\'enregistrer une dépense de ' . number_format($this->montant, 2, ',', ' ') . ' €.');
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
                // Optionnel : on peut suggérer un montant maximum mais pas l'imposer automatiquement
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
        $totalTransactions = Transaction::where('user_id', Auth::id())
            ->where('type', 'revenu')
            ->sum('montant');

        $totalDepenses = Depense::where('user_id', Auth::id())->sum('montant');

        return $totalTransactions - $totalDepenses;
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