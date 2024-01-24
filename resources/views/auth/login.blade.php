{{-- <x-guest-layout>
    <!-- Session Status -->


    <div class="text-center mb-4">
        Sistem Infomasi Perpustakaan
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<x-guest-layout>

    <div class="page-content d-flex align-items-center justify-content-center"
        style="background-image: url({{ asset('assets/images/bg-library.jpg') }}); background-size: cover; background-position: center;">
        <div class="row w-100 mx-0 auth-page">
            <div class="col-md-8 col-xl-6 mx-auto">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-2">
                                    {{-- <a href="#" class="noble-ui-logo d-block mb-2">Sistem Informasi<span
                                            class="ml-1">Perpustakaan</span></a> --}}
                                    <div class="d-flex justify-content-center mb-3">
                                        <img src="{{ asset('assets/images/logo-ponpes.png') }}" alt="Logo Miftahul Ulum"
                                            width="200px">
                                    </div>
                                    <div class="d-flex justify-content-center mb-3">
                                        <h6 class="text-center">Selamat datang di Perpustakaan Miftahul'ulum </h6>
                                    </div>
                                    <h6 class="alert alert-info">Silahkan login menggunakan
                                        akun
                                        yang terdaftar.</h6>
                                    <form class="forms-sample">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Email">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="userPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                autocomplete="current-password" placeholder="Password" name="password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <a class="btn btn-link"
                                                href="{{ route('view_pengunjung') }}">Buku Tamu</a>
                                            <button class="btn btn-success">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-guest-layout>
