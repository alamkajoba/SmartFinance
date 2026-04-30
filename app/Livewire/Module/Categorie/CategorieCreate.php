<?php

namespace App\Livewire\Module\Categorie;

use App\Models\Categorie;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class CategorieCreate extends Component
{
    public string $nomCategorie = '';

    public function store()
    {
        $this->validate([
            'nomCategorie' => 'required|string|max:255',
        ]);

        Categorie::create(['nomCategorie' => $this->nomCategorie]);

        session()->flash('message', 'Catégorie créée avec succès.');

        return redirect()->route('categorie.index');
    }

    public function render()
    {
        return view('livewire.module.categorie.categorie-create');
    }
}
