<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input wire:model="password" id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="password-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section> --}}

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Modifier le mot de passe</h3>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner-group">
                            <form wire:submit="updateProfileInformation">
                                <div class="card-inner">
                                    <div class="nk-block">
                                        <div class="row gy-4">
                                            <div class="col-xxl-3 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name">Mot de passe actuel</label>
                                                    <div class="form-control-wrap">
                                                        <input type="password" wire:model="current_password" id="update_password_current_password" class="form-control" id="name">
                                                    </div>
                                                </div>
                                            </div><!--col-->
                                            <div class="col-xxl-3 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name">Nouveau mot de passe</label>
                                                    <div class="form-control-wrap">
                                                        <input type="password" wire:model="password" id="update_password_password" class="form-control" id="current_password">
                                                    </div>
                                                </div>
                                            </div><!--col-->
                                            <div class="col-xxl-3 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name">Confirmer le mot de passe</label>
                                                    <div class="form-control-wrap">
                                                        <input type="password" wire:model="password_confirmation" id="update_password_password_confirmation" class="form-control" id="email">
                                                    </div>
                                                </div>
                                            </div><!--col-->
                                        </div><!--row-->
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                        <x-action-message class="me-3" on="profile-updated">
                                            <span class="text-success small">Enregistré</span>
                                        </x-action-message>
                                    </div><!--col-->
                                </div><!-- .card-inner -->
                            </form>
                        </div>
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
