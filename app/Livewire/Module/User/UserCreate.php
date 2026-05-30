<?php

namespace App\Livewire\Module\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class UserCreate extends Component
{
    public $nom = '';
    public $email = '';
    public $motDePasse = '';

    protected array $rules = [
        'nom' => 'required|string|min:3',
        'email' => 'required|string|email|unique:users,email',
        'motDePasse' => 'required|string|min:6',
    ];

    public function ajouterUtilisateur()
    {
        $this->validate();

        User::create([
            'name' => $this->nom,
            'email' => $this->email,
            'password' => Hash::make($this->motDePasse),
        ]);

        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.module.user.user-create');
    }
}
