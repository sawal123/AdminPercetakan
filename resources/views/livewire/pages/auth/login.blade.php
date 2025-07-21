<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        try {
            $this->form->authenticate();

            Session::regenerate();

            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: false);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tampilkan pesan error di Livewire
            $this->addError('form.email', 'Email atau password salah.');
        }
    }
}; ?>

<div>


    <div class="card-body">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <div class="card">
                    <div class="card-body p-0 bg-black auth-header-box rounded-top">
                        <div class="text-center p-3">
                            <a href="index.html" class="logo logo-admin">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" height="50" alt="logo"
                                    class="auth-logo">
                            </a>
                            <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Let's Get Started Mifty</h4>
                            <p class="text-muted fw-medium mb-0">Sign in to continue to Mifty.</p>
                        </div>
                    </div>
                    <div class="card-body pt-0 mt-2">
                        @if ($errors->has('form.email'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first('form.email') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif


                        <form class="my-4" wire:submit="login">
                            <div class="form-group mb-2">
                                <label class="form-label" for="username">Username</label>
                                <input type="email" class="form-control" id="username" wire:model="form.email"
                                    placeholder="Enter username">
                            </div><!--end form-group-->

                            <div class="form-group">
                                <label class="form-label" for="userpassword">Password</label>
                                <input type="password" class="form-control" name="password" id="userpassword"
                                    wire:model="form.password" placeholder="Enter password">
                            </div><!--end form-group-->

                            <div class="form-group row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" wire:model="form.remember" type="checkbox"
                                            id="customSwitchSuccess">
                                        <label class="form-check-label" for="customSwitchSuccess">Remember
                                            me</label>
                                    </div>
                                </div><!--end col-->
                            </div><!--end form-group-->

                            <div class="form-group mb-0 row">
                                <div class="col-12">
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary" type="submit">Log In <i
                                                class="fas fa-sign-in-alt ms-1"></i></button>
                                    </div>
                                </div><!--end col-->
                            </div> <!--end form-group-->
                        </form><!--end form-->

                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end card-body-->
</div>
