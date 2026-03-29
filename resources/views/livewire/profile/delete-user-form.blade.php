<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('login');
    }
}; ?>



<div class="nk-block">
    <div class="card card-bordered border-danger">
        <div class="card-inner">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="title text-danger">Supprimer le compte</h5>
                    <p>Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez télécharger les données que vous souhaitez conserver avant de procéder.</p>
                </div>
            </div>
            <div class="nk-block-content mt-3">
                <button 
                    class="btn btn-danger" 
                    x-data="" 
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                >
                    Supprimer mon compte
                </button>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <div class="card card-bordered">
            <form wire:submit="deleteUser" class="card-inner p-4">
                <div class="nk-block-head">
                    <h4 class="nk-block-title">Êtes-vous sûr de vouloir supprimer votre compte ?</h4>
                    <p class="text-soft">
                        Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.
                    </p>
                </div>

                <div class="form-group mt-4">
                    <label class="form-label" for="password">Mot de passe</label>
                    <div class="form-control-wrap">
                        <input 
                            type="password" 
                            wire:model="password" 
                            id="password" 
                            class="form-control @error('password') error @enderror" 
                            placeholder="Entrez votre mot de passe"
                        >
                    </div>
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mt-4 d-flex justify-content-end gx-3">
                    <li>
                        <button 
                            type="button" 
                            class="btn btn-outline-light btn-white" 
                            x-on:click="$dispatch('close')"
                        >
                            Annuler
                        </button>
                    </li>
                    
                    <li>
                        <button type="submit" class="btn btn-danger">
                            Supprimer définitivement
                        </button>
                    </li>
                </div>
            </form>
        </div>
    </x-modal>
</div>
