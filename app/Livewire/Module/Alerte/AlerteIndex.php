<?php

namespace App\Livewire\Module\Alerte;

use App\Models\Alerte;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class AlerteIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public ?string $search = '';

    public function render()
    {
        $alertes = Alerte::query()
            ->where('user_id', Auth::id())
            ->when($this->search, fn($query) => $query->where('message', 'like', '%'.$this->search.'%'))
            ->orderBy('date_alerte', 'desc')
            ->paginate(10);

        return view('livewire.module.alerte.alerte-index', [
            'alertes' => $alertes,
        ]);
    }

    public function markAsRead(int $id)
    {
        $alerte = Alerte::where('user_id', Auth::id())->find($id);

        if ($alerte && ! $alerte->is_read) {
            $alerte->update(['is_read' => true]);
            session()->flash('message', 'Alerte marquée comme lue.');
        }
    }
}
