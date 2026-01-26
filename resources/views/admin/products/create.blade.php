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
                        </select>
                    </div>

                    <!-- Photographer -->
                    <div class="space-y-3">
                        <label
                            class="text-[11px] font-black uppercase text-stone-500 tracking-[0.1em] ml-1">Photographer
                            Name</label>
                        <input type="text" name="photographer" required
                            class="w-full bg-stone-50 border border-stone-200 rounded-2xl px-6 py-4 text-sm text-stone-900 focus:outline-none focus:border-green-500 hover:border-stone-300 transition-all font-bold"
                            placeholder="Author Name">
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