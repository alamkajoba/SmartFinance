<?php

namespace App\Livewire\Module\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class UserCreate extends Component
{
    public function render()
    {
        return view('livewire.module.user.user-create');
    }
}
