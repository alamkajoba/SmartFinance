<?php

namespace App\Livewire\Module\Categorie;

use App\Models\Categorie;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CategorieUpdate extends Component
{
    public int $id;
    public string $nomCategorie = '';

    public function mount()
    {
        $categorie = Categorie::findOrFail($this->id);
        $this->nomCategorie = $categorie->nomCategorie;
    }

    public function update()
    {
        $this->validate([
            'nomCategorie' => 'required|string|max:255',
        ]);

        $categorie = Categorie::findOrFail($this->id);
        $categorie->update(['nomCategorie' => $this->nomCategorie]);

        session()->flash('message', 'Catégorie mise à jour avec succès.');

        return redirect()->route('categorie.index');
    }

    public function render()
    {
        return view('livewire.module.categorie.categorie-update');
    }
}
