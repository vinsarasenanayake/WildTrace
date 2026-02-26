<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-12">
            <h1 class="text-3xl font-serif text-stone-900 italic">Add New Artifact</h1>
            <p class="text-stone-500 mt-2">Publish a new masterpiece to your digital gallery.</p>
        </div>

        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm p-10">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 gap-8">
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Artifact
                            Title</label>
                        <input type="text" name="title" required
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. The Whispering Forest">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label
                            class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Category</label>
                        <select name="category" required
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold appearance-none">
                            <option value="Wildlife">Wildlife</option>
                            <option value="Landscape">Landscape</option>
                            <option value="Portrait">Portrait</option>
                            <option value="Macro">Macro</option>
                            <option value="Reptiles">Reptiles</option>
                            <option value="Mammals">Mammals</option>
                            <option value="Aquatics">Aquatics</option>
                            <option value="Birds">Birds</option>
                            <option value="Flora">Flora</option>
                            <option value="Amphibians">Amphibians</option>
                            <option value="Butterflies & Insects">Butterflies & Insects</option>
                        </select>
                    </div>

                    <div class="space-y-3">
                        <label
                            class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Photographer
                            Name</label>
                        <select name="photographer_id" required
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold appearance-none">
                            <option value="">Select Photographer</option>
                            @foreach ($photographers as $photographer)
                                <option value="{{ $photographer->id }}">{{ $photographer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-3">
                        <label
                            class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Location</label>
                        <input type="text" name="location"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. Yala National Park">
                    </div>
                    <div class="space-y-3">
                        <label
                            class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Aperture</label>
                        <input type="text" name="aperture"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. f/2.8">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Shutter
                            Speed</label>
                        <input type="text" name="shutter_speed"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. 1/2000s">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">ISO</label>
                        <input type="number" name="iso"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. 400">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Focal
                            Length</label>
                        <input type="text" name="focal_length"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. 85mm">
                    </div>
                </div>

                <div class="space-y-3" x-data="{ photoSelected: false, previewUrl: null }">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Artifact
                        Image</label>

                    <div class="mb-4">
                        <div x-show="!photoSelected"
                            class="w-full max-w-md h-64 bg-stone-50 border-2 border-dashed border-stone-200 rounded-2xl flex items-center justify-center text-stone-300">
                            <span class="text-[10px] font-bold uppercase tracking-widest">No Image Selected</span>
                        </div>
                        <div x-show="photoSelected" x-cloak>
                            <p class="text-[10px] text-stone-400 mb-2 uppercase tracking-widest font-bold">New Preview
                            </p>
                            <img :src="previewUrl"
                                class="w-full max-w-md h-64 object-cover rounded-2xl border-2 border-green-500 shadow-sm">
                        </div>
                    </div>

                    <input type="file" name="image_file" accept="image/*" required
                        @change="let file = $event.target.files[0]; if (file) { previewUrl = URL.createObjectURL(file); photoSelected = true }"
                        class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:uppercase file:bg-stone-900 file:text-white hover:file:bg-stone-700">

                    @error('image_file')
                        <p class="text-red-500 text-[10px] mt-1 font-bold italic">{{ $message }}</p>
                    @enderror
                    <p class="text-[10px] text-stone-400 mt-1">Accepted: JPG, PNG, WEBP.</p>
                </div>

                <div class="space-y-4">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Frame Option
                        Prices (USD)</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-stone-400 tracking-widest ml-1">12 × 18
                                in</label>
                            <input type="number" name="frame_price_1" step="0.01" min="0" required
                                class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-4 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                                placeholder="90">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-stone-400 tracking-widest ml-1">18 × 24
                                in</label>
                            <input type="number" name="frame_price_2" step="0.01" min="0" required
                                class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-4 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                                placeholder="135">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-stone-400 tracking-widest ml-1">24 × 36
                                in</label>
                            <input type="number" name="frame_price_3" step="0.01" min="0" required
                                class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-4 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                                placeholder="180">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-stone-400 tracking-widest ml-1">40 × 60
                                in</label>
                            <input type="number" name="frame_price_4" step="0.01" min="0" required
                                class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-4 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                                placeholder="315">
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Long
                        Description</label>
                    <textarea name="long_description" rows="3"
                        class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                        placeholder="Detailed story..."></textarea>
                </div>

                <div class="space-y-3">
                    <label
                        class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Description</label>
                    <textarea name="description" rows="5"
                        class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                        placeholder="Tell the story behind this artifact..."></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-4">
                    <a href="{{ route('admin.dashboard') }}"
                        class="px-8 py-4 text-[11px] font-black uppercase tracking-widest text-stone-400 hover:text-stone-600 transition-colors">Cancel</a>
                    <button type="submit"
                        class="px-12 py-4 bg-stone-900 hover:bg-stone-800 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl transition-all shadow-xl shadow-stone-200 active:scale-[0.98]">
                        Publish Artifact
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>