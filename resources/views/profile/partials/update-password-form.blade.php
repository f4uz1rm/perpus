<section>
    @if (session('status') === 'password-updated')
        {{-- <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p> --}}
        <div class="alert alert-success" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
            Berhasil! Password berhasil diubah.
        </div>
    @endif
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <div class="input-group">
                <div class="input-group-text">
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" class="my-auto" />
                </div>
                <x-text-input id="update_password_current_password" name="current_password" type="password"
                    class="form-control" autocomplete="current-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="mt-2">
            <div class="input-group">
                <div class="input-group-text">
                    <x-input-label for="update_password_password" :value="__('New Password')" class="my-auto" />
                </div>
                <x-text-input id="update_password_password" name="password" type="password" class="form-control"
                    autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="mt-2">
            <div class="input-group">
                <div class="input-group-text">
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="my-auto" />
                </div>
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="form-control" autocomplete="new-password" />
            </div>

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4 mt-2 d-flex justify-content-end">
            {{-- <x-primary-button>{{ __('Save') }}</x-primary-button> --}}
            <button class="btn btn-sm btn-success">{{ __('Simpan') }}</button>
        </div>

    </form>
</section>
