<form action="{{ route('profile.updateProfile', $user->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="px-4 py-5 bg-white sm:p-6">

        <div class="grid grid-cols-6 gap-6">

            <div x-data="{photoName: null, photoPreview: null}" class="col-start-1 col-span-6 flex flex-col justify-center items-center">
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
            <div class="col-start-1 col-span-6">
                <x-label for="first-name" value="{{ __('profile.show_profile_first_name') }}" />
                <x-input id="first-name" type="text" name="first_name" class="mt-1 block w-full" value="{{ $user->first_name }}" autocomplete="first-name" required />
                <x-input-error for="first_name" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div class="col-start-1 col-span-6">
                <x-label for="last-name" value="{{ __('profile.show_profile_last_name') }}" />
                <x-input id="last-name" type="text" name="last_name" class="mt-1 block w-full" value="{{ $user->last_name }}" autocomplete="last-name" required />
                <x-input-error for="last_name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-start-1 col-span-6">
                <x-label for="email" value="{{ __('profile.show_profile_email') }}" />
                <x-input id="email" type="text" name="email" class="mt-1 block w-full" value="{{ $user->email }}" autocomplete="email" required />
                <x-input-error for="email" class="mt-2" />
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
