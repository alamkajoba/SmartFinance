<?php

namespace App\Livewire\Module\User;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class UserIndex extends Component
{

    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]

    public ?string $search = '';
    
    public function render()
    {
        $user = User::latest()->search($this->search)->paginate(1);
        return view('livewire.module.user.user-index',['user' => $user]);
    }
}
