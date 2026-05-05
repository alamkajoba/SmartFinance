<?php

namespace App\Livewire\Module\Transaction;

use App\Models\Transaction;
use App\Models\Categorie;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class TransactionCreate extends Component
{
    public float $montant = 0.0;
    public string $type = 'revenu';
    public ?int $categorie_id = null;
    public ?string $description = '';
    public bool $cumuler = false; // Nouvelle option pour cumuler

    public function store()
    {
        $this->validate([
            'montant' => 'required|numeric|min:0.01',
            'type' => 'required|in:revenu,depense',
            'categorie_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:500',
        ]);

        if ($this->cumuler) {
            // Trouver la dernière transaction du même type pour cet utilisateur
            $derniereTransaction = Transaction::where('user_id', Auth::id())
                ->where('type', $this->type)
                ->latest()
                ->first();

            if ($derniereTransaction) {
                // Ajouter le montant à la dernière transaction
                $nouveauMontant = $derniereTransaction->montant + $this->montant;
                $derniereTransaction->update([
                    'montant' => $nouveauMontant,
                    'description' => $derniereTransaction->description . ' + ' . $this->description,
                ]);

                session()->flash('message', 'Montant ajouté à la transaction existante avec succès.');
            } else {
                // Si aucune transaction du même type, créer une nouvelle
                Transaction::create([
                    'user_id' => Auth::id(),
                    'montant' => $this->montant,
                    'type' => $this->type,
                    'categorie_id' => $this->categorie_id,
                    'description' => $this->description,
                ]);

                session()->flash('message', 'Nouvelle transaction créée avec succès.');
            }
        } else {
            // Comportement normal : créer une nouvelle transaction
            Transaction::create([
                'user_id' => Auth::id(),
                'montant' => $this->montant,
                'type' => $this->type,
                'categorie_id' => $this->categorie_id,
                'description' => $this->description,
            ]);

            session()->flash('message', 'Transaction créée avec succès.');
        }

        return redirect()->route('transaction.index');
    }

    public function render()
    {
        $categories = Categorie::all();
        return view('livewire.module.transaction.transaction-create', ['categories' => $categories]);
    }
}
