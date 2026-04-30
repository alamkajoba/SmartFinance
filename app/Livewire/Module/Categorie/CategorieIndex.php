<?php

namespace App\Livewire\Module\Categorie;

use App\Models\Categorie;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

#[Layout('layouts.app')]
class CategorieIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public ?string $search = '';

    public function render()
    {
        $categories = Categorie::query()
            ->when($this->search, fn($query) => $query->where('nomCategorie', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(10);

        return view('livewire.module.categorie.categorie-index', ['categories' => $categories]);
    }

    public function destroy(int $id)
    {
        Categorie::findOrFail($id)->delete();
        session()->flash('message', 'Catégorie supprimée avec succès.');
    }
}
