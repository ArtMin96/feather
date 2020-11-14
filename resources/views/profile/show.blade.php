<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }} - User
        </h2>
    </x-slot>

    <div>

        <div class="mx-auto pt-10 sm:px-6 lg:px-8">
            @if (\Session::has('success'))
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-start-2 col-span-4">
                        <x-success-alert type="green-200" :dismissible="'true'" class="px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center mx-auto w-full">
                            {!! \Session::get('success') !!}
                        </x-success-alert>
                    </div>
                </div>
            @endif
        </div>

        <!-- Update Profile Information -->
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div class="md:grid md:grid-cols-3 md:gap-6">

                <x-section-title>
                    <x-slot name="title">{{ __('Profile Information') }}</x-slot>
                    <x-slot name="description">{{ __('Update your account\'s profile information and email address.') }}</x-slot>
                </x-section-title>

                <div class="mt-5 md:mt-0 md:col-span-2">

                    <div class="shadow overflow-hidden sm:rounded-md">

                        @include('profile.update-profile-information-form')

                    </div>

                </div>
            </div>

        </div>

        <!-- Update Profile Optional Information -->
        @if($user->profile)
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="md:grid md:grid-cols-3 md:gap-6">

                    <x-section-title>
                        <x-slot name="title">{{ __('Profile Optional Information') }}</x-slot>
                        <x-slot name="description">{{ __('Update your account\'s profile optional information.') }}</x-slot>
                    </x-section-title>

                    <div class="mt-5 md:mt-0 md:col-span-2">

                        <div class="shadow overflow-hidden sm:rounded-md">

                            @include('profile.update-profile-optional-information-form')

                        </div>

                    </div>
                </div>

            </div>
        @else

            <div class="w-full">
                <div class="px-12 py-6">
                    <div class="text-center">
                        <h1 class="font-normal text-3xl text-grey-darkest leading-loose my-3 w-full">{{ __('profile.no_profile_yet') }}</h1>
                    </div>
                </div>
            </div>

        @endif

        <!-- Update Profile Password -->
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div class="md:grid md:grid-cols-3 md:gap-6">

                <x-section-title>
                    <x-slot name="title">{{ __('Update Password') }}</x-slot>
                    <x-slot name="description">{{ __('Ensure your account is using a long, random password to stay secure.') }}</x-slot>
                </x-section-title>

                <div class="mt-5 md:mt-0 md:col-span-2">

                    <div class="shadow overflow-hidden sm:rounded-md">

                        @include('profile.update-password-form')

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
