<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-12">
            <h1 class="text-3xl font-serif text-stone-900 italic">Add New Artifact</h1>
            <p class="text-stone-500 mt-2">Publish a new masterpiece to your digital gallery.</p>
        </div>

        <div class="bg-white rounded-3xl border border-stone-200 shadow-sm p-10">
            <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Title -->
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Artifact
                            Title</label>
                        <input type="text" name="title" required
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. The Whispering Forest">
                    </div>

                    <!-- Price -->
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Price
                            (USD)</label>
                        <input type="number" name="price" step="0.01" required
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="0.00">
                    </div>

                    <!-- Category -->
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

                    <!-- Photographer -->
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
                    <!-- Location -->
                    <div class="space-y-3">
                        <label
                            class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Location</label>
                        <input type="text" name="location"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. Yala National Park">
                    </div>
                    <!-- Aperture -->
                    <div class="space-y-3">
                        <label
                            class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Aperture</label>
                        <input type="text" name="aperture"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. f/2.8">
                    </div>
                    <!-- Shutter Speed -->
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Shutter
                            Speed</label>
                        <input type="text" name="shutter_speed"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. 1/2000s">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- ISO -->
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">ISO</label>
                        <input type="number" name="iso"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. 400">
                    </div>
                    <!-- Focal Length -->
                    <div class="space-y-3">
                        <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Focal
                            Length</label>
                        <input type="text" name="focal_length"
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="e.g. 85mm">
                    </div>
                </div>

                <!-- Image URL -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Artifact Image
                        URL</label>
                    <input type="url" name="image_url" required
                        class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                        placeholder="https://example.com/image.jpg">
                </div>

                <!-- Options (JSON) -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Frame Options
                        (JSON)</label>
                    <textarea name="options" rows="4"
                        class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold font-mono text-xs"
                        placeholder='{"frames":[{"size":"12 x 18 in","price":90},{"size":"18 x 24 in","price":135},{"size":"24 x 36 in","price":180},{"size":"40 x 60 in","price":315}]}'></textarea>
                </div>

                <!-- Long Description -->
                <div class="space-y-3">
                    <label class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Long
                        Description</label>
                    <textarea name="long_description" rows="3"
                        class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                        placeholder="Detailed story..."></textarea>
                </div>

                <!-- Description -->
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