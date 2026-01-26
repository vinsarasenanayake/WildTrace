<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo" x-on:change="
                                                                                    photoName = $refs.photo.files[0].name;
                                                                                    const reader = new FileReader();
                                                                                    reader.onload = (e) => {
                                                                                        photoPreview = e.target.result;
                                                                                    };
                                                                                    reader.readAsDataURL($refs.photo.files[0]);
                                                                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full size-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
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

        <!-- Contact Number -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="contact_number" value="{{ __('Contact Number') }}" />
            <div
                class="mt-1 flex rounded-2xl border border-stone-200 bg-white shadow-sm overflow-hidden focus-within:ring-2 focus-within:ring-green-600/20 focus-within:border-green-600 transition-all">
                <span
                    class="inline-flex items-center px-4 border-r border-stone-100 bg-stone-50/50 text-stone-500 text-[13px] font-semibold select-none">
                    +94
                </span>
                <input id="contact_number" type="text"
                    class="w-full px-5 py-3 bg-transparent border-none outline-none focus:ring-0 text-stone-800 text-[13px] font-medium placeholder-stone-300"
                    wire:model="state.contact_number" placeholder="771234567" maxlength="9"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
            </div>
            <x-input-error for="contact_number" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="address" value="{{ __('Address') }}" />
            <input id="address" type="text"
                class="mt-1 block w-full px-5 py-3 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                wire:model="state.address" placeholder="123 Wild St, Colombo" />
            <x-input-error for="address" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="city" value="{{ __('City') }}" />
            <input id="city" type="text"
                class="mt-1 block w-full px-5 py-3 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                wire:model="state.city" maxlength="50" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" />
            <x-input-error for="city" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3">
            <x-label for="postal_code" value="{{ __('Postal Code') }}" />
            <input id="postal_code" type="text"
                class="mt-1 block w-full px-5 py-3 bg-white border border-stone-200 rounded-2xl focus:ring-2 focus:ring-green-600/20 focus:border-green-600 outline-none transition-all text-stone-800 text-[13px] font-medium placeholder-stone-300 shadow-sm"
                wire:model="state.postal_code" maxlength="5" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
            <x-input-error for="postal_code" class="mt-2" />
        </div>

        <!-- Country -->
        <div class="col-span-6 sm:col-span-3">
            <x-label for="country" value="{{ __('Country') }}" />
            <div class="relative mt-1">
                <x-input id="country" type="text"
                    class="block w-full border-stone-100 bg-stone-50 text-stone-400 font-semibold cursor-not-allowed rounded-2xl"
                    value="Sri Lanka" readonly />
                <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-stone-300">DEFAULTED</span>
                </div>
            </div>
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