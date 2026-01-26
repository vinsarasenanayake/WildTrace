@section('header', 'Add Product')

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
        <form wire:submit.prevent="save" class="space-y-8">

            <!-- Basic Information -->
            <div class="space-y-6">
                <h3 class="text-sm font-black uppercase tracking-widest text-stone-400 border-b border-stone-100 pb-2">
                    Basic Info</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Title</label>
                        <input type="text" wire:model="title"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Price
                            ($)</label>
                        <input type="number" step="0.01" wire:model="price"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                        @error('price') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Category</label>
                        <select wire:model="category"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                            <option value="">Select Category</option>
                            <option value="Birds">Birds</option>
                            <option value="Mammals">Mammals</option>
                            <option value="Aquatics">Aquatics</option>
                            <option value="Reptiles">Reptiles</option>
                            <option value="Amphibians">Amphibians</option>
                            <option value="Butterflies">Butterflies</option>
                            <option value="Flora">Flora</option>
                        </select>
                        @error('category') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Short
                        Description</label>
                    <textarea wire:model="description" rows="3"
                        class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"></textarea>
                    @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Long
                        Description</label>
                    <textarea wire:model="long_description" rows="5"
                        class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"></textarea>
                    @error('long_description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Details & Specs -->
            <div class="space-y-6">
                <h3 class="text-sm font-black uppercase tracking-widest text-stone-400 border-b border-stone-100 pb-2">
                    Details & Specs</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Photographer</label>
                        <select wire:model="photographer_id"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all">
                            <option value="">Select Photographer</option>
                            @foreach($photographers as $photographer)
                                <option value="{{ $photographer->id }}">{{ $photographer->name }}</option>
                            @endforeach
                        </select>
                        @error('photographer_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Location</label>
                        <input type="text" wire:model="location"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                            placeholder="e.g. Yala National Park">
                        @error('location') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div>
                        <label
                            class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Aperture</label>
                        <input type="text" wire:model="aperture"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                            placeholder="f/2.8">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">ISO</label>
                        <input type="text" wire:model="iso"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                            placeholder="400">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Shutter
                            Speed</label>
                        <input type="text" wire:model="shutter_speed"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                            placeholder="1/2000s">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Focal
                            Length</label>
                        <input type="text" wire:model="focal_length"
                            class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                            placeholder="400mm">
                    </div>
                </div>
            </div>

            <!-- Image Path -->
            <div>
                <h3
                    class="text-sm font-black uppercase tracking-widest text-stone-400 border-b border-stone-100 pb-2 mb-6">
                    Product Image Path</h3>

                @if ($image)
                    <div class="mb-4">
                        <p class="text-[10px] text-stone-400 mb-2">Preview:</p>
                        <img src="{{ asset($image) }}" onerror="this.src='https://placehold.co/400x300'"
                            class="w-48 h-auto rounded-lg shadow-md border border-stone-200">
                    </div>
                @endif

                <input type="text" wire:model.live="image"
                    class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    placeholder="e.g. images/product1.jpg">
                @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-4 border-t border-stone-100 mt-8">
                <a href="{{ route('admin.products.index') }}"
                    class="text-stone-500 hover:text-stone-700 text-xs font-bold uppercase tracking-wider">Cancel</a>
                <button type="submit"
                    class="bg-green-600 hover:bg-green-500 text-white text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-lg shadow-lg shadow-green-600/20 transition-all flex items-center gap-2">
                    <span wire:loading.remove>Save Product</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>