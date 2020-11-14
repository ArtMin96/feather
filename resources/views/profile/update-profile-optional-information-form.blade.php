<form action="{{ route('profile.update', $user->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <div class="px-4 py-5 bg-white sm:p-6">
        <div class="grid grid-cols-6 gap-6">

            <!-- Bio -->
            <div class="col-start-1 col-span-6">
                <x-label for="bio" value="{{ __('profile.show_profile_bio') }}" />
                <x-textarea id="bio" type="text" name="bio" class="mt-1 block w-full" autocomplete="bio">
                    <x-slot name="value">
                        {{ old('bio', $user->profile->bio) }}
                    </x-slot>
                </x-textarea>
                <x-input-error for="bio" class="mt-2" />
            </div>

            <!-- Twitter username -->
            <div class="col-start-1 col-span-6">
                <x-label for="twitter-username" value="{{ __('profile.show_profile_twitter_username') }}" />
                <x-input id="twitter-username" type="text" name="twitter_username" class="mt-1 block w-full" value="{{ old('twitter_username', $user->profile->twitter_username) }}" autocomplete="twitter_username" />
                <x-input-error for="twitter_username" class="mt-2" />
            </div>

            <!-- Github username -->
            <div class="col-start-1 col-span-6">
                <x-label for="github-username" value="{{ __('profile.show_profile_github_username') }}" />
                <x-input id="github-username" type="text" name="github_username" class="mt-1 block w-full" value="{{ old('github_username', $user->profile->github_username) }}" autocomplete="github_username" />
                <x-input-error for="github_username" class="mt-2" />
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
