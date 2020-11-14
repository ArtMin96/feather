<form action="{{ route('profile.updateProfilePassword', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="px-4 py-5 bg-white sm:p-6">
        <div class="grid grid-cols-6 gap-6">

            <!-- Current Password -->
            <div class="col-start-1 col-span-6" x-data="{ show: true }">
                <x-label for="current-password" value="{{ __('forms.create_user_ph_current_password') }}" />
                <x-input-password id="current-password" type="password" name="current_password" class="mt-1 block w-full" autocomplete="current_password" required />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <!-- New Password -->
            <div class="col-start-1 col-span-6">
                <x-label for="password" value="{{ __('forms.create_user_ph_password') }}" />
                <x-input id="password" type="password" name="password" class="mt-1 block w-full" autocomplete="password" required />
                <x-input-error for="password" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="col-start-1 col-span-6">
                <x-label for="password-confirmation" value="{{ __('forms.create_user_ph_pw_confirmation') }}" />
                <x-input id="password-confirmation" type="password" name="password_confirmation" class="mt-1 block w-full" autocomplete="password_confirmation" required />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>

        </div>
    </div>

    <div class="col-start-1 col-span-6">
        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">

            <x-button>
                {{ __('profile.submit_button') }}
            </x-button>

        </div>
    </div>

</form>
