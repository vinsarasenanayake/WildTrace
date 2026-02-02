@section('header', 'Add Milestone')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 p-8">
        <form wire:submit.prevent="save" class="space-y-6">
            <!-- Milestone Details Form Section -->

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="col-span-1">
                    <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Year</label>
                    <input type="text" wire:model="year"
                        class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                        placeholder="2024">
                    @error('year') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-3">
                    <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Title</label>
                    <input type="text" wire:model="title"
                        class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                        placeholder="Milestone Title">
                    @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-stone-500 mb-2">Description</label>
                <textarea wire:model="description" rows="4"
                    class="w-full bg-stone-50 border border-stone-200 rounded-lg px-4 py-3 text-stone-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                    placeholder="Describe the milestone..."></textarea>
                @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex items-center justify-end gap-4 border-t border-stone-100 mt-8">
                <a href="{{ route('admin.milestones.index') }}"
                    class="text-stone-500 hover:text-stone-700 text-xs font-bold uppercase tracking-wider">Cancel</a>
                <button type="submit" class="bg-green-600 hover:bg-green-500 text-white text-xs font-bold uppercase tracking-wider px-6
                    py-3 rounded-lg shadow-lg shadow-green-600/20 transition-all flex items-center gap-2">
                    <span wire:loading.remove>Save Milestone</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>