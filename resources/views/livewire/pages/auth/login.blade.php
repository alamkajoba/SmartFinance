<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

       return redirect()->route('user.index');
    }
}; ?>

<div>
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="brand-logo pb-4 text-center">
                <a href="#" class="logo-link">
                    <img class="logo-light logo-img logo-img-lg" src="{{asset('images/logo.png')}}" srcset="{{asset('images/logo2x.png 2x')}}" alt="logo">
                    <img class="logo-dark logo-img logo-img-lg" src="{{asset('images/logo-dark.png')}}" srcset="{{asset('images/logo-dark2x.png 2x')}}" alt="logo-dark">
                </a>
            </div>
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Sign-In</h4>
                            <div class="nk-block-des">
                                <p>Access the DashLite panel using your email and passcode.</p>
                            </div>
                        </div>
                    </div>
                    <form wire:submit="login">
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="default-01">Email</label>
                            </div>
                            <div class="form-control-wrap">
                                <input wire:model="form.email" type="email" class="form-control form-control-lg" id="default-01" placeholder="Enter your email address or username">
                            </div>
                            @error('form.email') 
                                <span class="text-danger small">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password">Passcode</label>
                            </div>
                            <div class="form-control-wrap">
                                <input wire:model="form.password" type="password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode">
                            </div>
                            @error('form.password') 
                                <span class="text-danger small">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="nk-footer nk-auth-footer-full">
            <div class="container wide-lg">
                <div class="row g-3">
                    <div class="nk-block-content text-center text-lg-left">
                        <p class="text-soft">&copy; 2026 Smart Finance. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>