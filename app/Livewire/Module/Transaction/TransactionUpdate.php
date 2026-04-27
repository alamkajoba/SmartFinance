<?php

namespace App\Livewire\Module\Transaction;

use App\Models\Transaction;
use App\Models\Categorie;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class TransactionUpdate extends Component
{
    public int $id;
    public float $montant = 0.0;
    public string $type = 'depense';
    public ?int $categorie_id = null;
    public ?string $description = '';

    public function mount()
    {
        $transaction = Transaction::findOrFail($this->id);
        
        // Vérifier que l'utilisateur est propriétaire
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $this->montant = $transaction->montant;
        $this->type = $transaction->type;
        $this->categorie_id = $transaction->categorie_id;
        $this->description = $transaction->description;
    }

    public function update()
    {
        $this->validate([
            'montant' => 'required|numeric|min:0.01',
            'type' => 'required|in:depense,revenu',
            'categorie_id' => 'nullable|exists:categorie,id',
            'description' => 'nullable|string|max:500',
        ]);

        $transaction = Transaction::findOrFail($this->id);

        // Vérifier que l'utilisateur est propriétaire
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        $transaction->update([
            'montant' => $this->montant,
            'type' => $this->type,
            'categorie_id' => $this->categorie_id,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Transaction mise à jour avec succès.');

        return redirect()->route('transaction.index');
    }

    public function render()
    {
        $categories = Categorie::all();
        return view('livewire.module.transaction.transaction-update', ['categories' => $categories]);
    }
}
