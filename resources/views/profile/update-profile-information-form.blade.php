<div class="md:grid md:grid-cols-3 md:gap-6">

    <x-section-title>
        <x-slot name="title">{{ __('Profile Information') }}</x-slot>
        <x-slot name="description">{{ __('Update your account\'s profile information and email address.') }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">

        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">

                @if (\Session::has('success'))
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-start-2 col-span-4">
                            <x-success-alert type="green-200" :dismissible="'true'" class="px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center mx-auto w-full">
                                {!! \Session::get('success') !!}
                            </x-success-alert>
                        </div>
                    </div>
                @endif

                <!-- Update Profile Information -->
                <form action="{{ route('profile.updateProfile', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-6 gap-6">

                        <div x-data="{photoName: null, photoPreview: null}" class="col-start-2 col-span-4 flex flex-col justify-center items-center">
                            <!-- Profile Photo File Input -->
                            <x-input type="file" class="hidden" name="avatar"
                                   x-ref="photo"
                                   x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);"
                            />

                            <!-- Current Profile Photo -->
                            <div class="mt-2" x-show="! photoPreview">
                                <img src="{{ auth()->user()->userAvatar() }}"
                                     alt="{{ $user->first_name }}" class="rounded-full h-20 w-20 object-cover"
                                >
                            </div>

                            <!-- New Profile Photo Preview -->
                            <div class="mt-2" x-show="photoPreview">
                                <span class="block rounded-full w-20 h-20"
                                      x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                </span>
                            </div>

                            <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                                {{ __('Select A New Photo') }}
                            </x-secondary-button>

                            @if ($user->profile->avatar_status == 1)
                                <x-secondary-button type="button" class="mt-2">
                                    {{ __('Remove Photo') }}
                                </x-secondary-button>
                            @endif

                            <x-input-error for="photo" class="mt-2" />
                        </div>

                        <!-- Name -->
                        <div class="col-start-2 col-span-4">
                            <x-label for="first-name" value="{{ __('profile.show_profile_first_name') }}" />
                            <x-input id="first-name" type="text" name="first_name" class="mt-1 block w-full" value="{{ $user->first_name }}" autocomplete="first-name" required />
                            <x-input-error for="first_name" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div class="col-start-2 col-span-4">
                            <x-label for="last-name" value="{{ __('profile.show_profile_last_name') }}" />
                            <x-input id="last-name" type="text" name="last_name" class="mt-1 block w-full" value="{{ $user->last_name }}" autocomplete="last-name" required />
                            <x-input-error for="last_name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-start-2 col-span-4">
                            <x-label for="email" value="{{ __('profile.show_profile_email') }}" />
                            <x-input id="email" type="text" name="email" class="mt-1 block w-full" value="{{ $user->email }}" autocomplete="email" required />
                            <x-input-error for="email" class="mt-2" />
                        </div>

                        <div class="col-start-2 col-span-4">
                            <div class="flex items-center justify-end py-3 text-right">

                                <x-button>
                                    {{ __('profile.submit_button') }}
                                </x-button>

                            </div>
                        </div>

                    </div>
                </form>

                <!-- Update Profile Optional Information -->
                <form action="{{ route('profile.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if($user->profile)

                        <div class="grid grid-cols-6 gap-6">

                            <!-- Bio -->
                            <div class="col-start-2 col-span-4">
                                <x-label for="bio" value="{{ __('profile.show_profile_bio') }}" />
                                <x-textarea id="bio" type="text" name="bio" class="mt-1 block w-full" autocomplete="bio">
                                    <x-slot name="value">
                                        {{ old('bio', $user->profile->bio) }}
                                    </x-slot>
                                </x-textarea>
                                <x-input-error for="bio" class="mt-2" />
                            </div>

                            <!-- Twitter username -->
                            <div class="col-start-2 col-span-4">
                                <x-label for="twitter-username" value="{{ __('profile.show_profile_twitter_username') }}" />
                                <x-input id="twitter-username" type="text" name="twitter_username" class="mt-1 block w-full" value="{{ old('twitter_username', $user->profile->twitter_username) }}" autocomplete="twitter_username" />
                                <x-input-error for="twitter_username" class="mt-2" />
                            </div>

                            <!-- Github username -->
                            <div class="col-start-2 col-span-4">
                                <x-label for="github-username" value="{{ __('profile.show_profile_github_username') }}" />
                                <x-input id="github-username" type="text" name="github_username" class="mt-1 block w-full" value="{{ old('github_username', $user->profile->github_username) }}" autocomplete="github_username" />
                                <x-input-error for="github_username" class="mt-2" />
                            </div>

                            <div class="col-start-2 col-span-4">
                                <div class="flex items-center justify-end py-3 text-right">

                                    <x-button>
                                        {{ __('profile.submit_button') }}
                                    </x-button>

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

                </form>

            </div>
        </div>

    </div>

</div>
