<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));
        // Beri role kepada pengguna setelah register, misalnya "kasir"
        $user->assignRole('kasir'); // Ganti 'kasir' dengan role yang sesuai
        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
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
                            <h4 class="mt-3 mb-1 fw-semibold text-white fs-18">Create an account</h4>
                            <p class="text-muted fw-medium mb-0">Enter your detail to Create your account today.</p>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <form class="my-4" wire:submit="register">
                            <div class="form-group mb-2">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control" wire:model="name" id="username"
                                    placeholder="Enter username">
                            </div><!--end form-group-->

                            <div class="form-group mb-2">
                                <label class="form-label" for="useremail">Email</label>
                                <input type="email" wire:model="email" class="form-control" id="useremail"
                                    placeholder="Enter email">
                            </div><!--end form-group-->

                            <div class="form-group mb-2">
                                <label class="form-label" for="userpassword">Password</label>
                                <input type="password" wire:model="password" class="form-control" id="userpassword"
                                    placeholder="Enter password">
                            </div><!--end form-group-->
                            <div class="form-group mb-2">
                                <label class="form-label" for="userpassword">Password Confirm</label>
                                <input type="password" wire:model="password_confirmation" class="form-control"
                                    id="userpassword" placeholder="Enter password">
                            </div><!--end form-group-->

                            <div class="form-group mb-0 row">
                                <div class="col-12">
                                    <div class="d-grid mt-3">
                                        <button class="btn btn-primary" type="submit">Sign Up <i
                                                class="fas fa-sign-in-alt ms-1"></i></button>
                                    </div>
                                </div><!--end col-->
                            </div> <!--end form-group-->
                        </form><!--end form-->
                        <div class="text-center">
                            <p class="text-muted">Already have an account ? <a href="/login" wire:navigate
                                    class="text-primary ms-2">Log in</a></p>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end card-body-->
</div>
