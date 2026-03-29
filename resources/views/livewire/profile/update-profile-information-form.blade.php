<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Modifier les identifiants</h3>
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
                                                    <label class="form-label" for="full-name">Nom complet</label>
                                                    <div class="form-control-wrap">
                                                        <input wire:model="name" type="text" class="form-control" id="name">
                                                    </div>
                                                </div>
                                            </div><!--col-->
                                            <div class="col-xxl-3 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input wire:model="email" type="email" class="form-control" id="email">
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

