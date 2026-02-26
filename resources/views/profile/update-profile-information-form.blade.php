<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo" x-on:change="
                                                                                                    photoName = $refs.photo.files[0].name;
                                                                                                    const reader = new FileReader();
                                                                                                    reader.onload = (e) => {
                                                                                                        photoPreview = e.target.result;
                                                                                                    };
                                                                                                    reader.readAsDataURL($refs.photo.files[0]);
                                                                                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full size-20 object-cover">
                </div>

                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <input id="name" type="text"
                class="mt-1 block w-full px-5 py-3 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                wire:model="state.name" required autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <input id="email" type="email"
                class="mt-1 block w-full px-5 py-3 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                wire:model="state.email" required autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="col-span-6 sm:col-span-3 relative z-50">
            <x-label for="contact_number" value="{{ __('Contact Number') }}" />
            <x-contact-input id="contact_number" wire:model="state.contact_number" placeholder="771234567" />
            <x-input-error for="contact_number" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3 relative z-40">
            <x-label for="address" value="{{ __('Address') }}" />
            <input id="address" type="text"
                class="mt-1 block w-full px-5 py-3 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                wire:model="state.address" placeholder="123 Wild St, Colombo" />
            <x-input-error for="address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3 relative z-30">
            <x-label for="city" value="{{ __('City') }}" />
            <input id="city" type="text"
                class="mt-1 block w-full px-5 py-3 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                wire:model="state.city" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
            <x-input-error for="city" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3 relative z-20">
            <x-label for="postal_code" value="{{ __('Postal Code') }}" />
            <input id="postal_code" type="text"
                class="mt-1 block w-full px-5 py-3 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                wire:model="state.postal_code" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
            <x-input-error for="postal_code" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3 relative z-10">
            <x-label for="country" value="{{ __('Country') }}" />
            <x-country-select id="country" wire:model="state.country" :selected="$this->user->country ?? 'Sri Lanka'" />
            <x-input-error for="country" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>