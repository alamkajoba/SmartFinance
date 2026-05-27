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

    // #[Validate('string|min:3')]
    public $nom;

    // #[Validate('string|email|min:3')]
    public $email;

    // #[Validate('string|min:6')]
    public $motDePasse;

    public function ajouterUtilisateur()
    {
        $this->validate();
        $inserer = User::create([
            'name' => $this->nom,
            'email' => $this->email,
            'password' => Hash::make($this->motDePasse),
        ]);

        session();
        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.module.user.user-create');
    }
}
