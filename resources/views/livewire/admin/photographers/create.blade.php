@section('header', 'Add Photographer')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Photographer Personal Information Section -->

            <!-- Name -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Name</label>
                <input type="text" wire:model="name"
                    class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    placeholder="Photographer Name">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Profession -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Profession</label>
                <input type="text" wire:model="profession"
                    class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    placeholder="e.g. Wildlife Photographer">
                @error('profession') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Achievement -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Achievement
                    (Optional)</label>
                <input type="text" wire:model="achievement"
                    class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    placeholder="e.g. Award Winner 2024">
                @error('achievement') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Quote -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Quote
                    (Optional)</label>
                <textarea wire:model="quote" rows="3"
                    class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    placeholder="Favorite quote..."></textarea>
                @error('quote') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Post -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Post
                    (Optional)</label>
                <input type="text" wire:model="post"
                    class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    placeholder="e.g. Senior Photographer">
                @error('post') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Photographer Profile Image Section -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Image Path</label>

                @if ($image)
                    <div class="mb-4">
                        <p class="text-[10px] text-stone-400 mb-2">Preview:</p>
                        <img src="{{ asset($image) }}" onerror="this.src='https://placehold.co/100'"
                            class="w-20 h-20 rounded-full object-cover border-2 border-stone-200">
                    </div>
                @endif

                <input type="text" wire:model.live="image"
                    class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    placeholder="e.g. images/teammember1.jpg">
                @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-4">
                <a href="{{ route('admin.photographers.index') }}"
                    class="text-stone-500 hover:text-stone-700 text-xs font-bold uppercase tracking-wider">Cancel</a>
                <button type="submit" <!-- Form Submit Action -->
                    class="bg-green-600 hover:bg-green-500 text-white text-xs font-bold uppercase tracking-wider px-6
                    py-3 rounded-lg shadow-lg shadow-green-600/20 transition-all flex items-center gap-2">
                    <span wire:loading.remove>Save Photographer</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>