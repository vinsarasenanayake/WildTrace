@section('header', 'Milestones')

<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div></div>
        <a href="{{ route('admin.milestones.create') }}"
            class="bg-green-600 hover:bg-green-500 text-white text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-lg shadow-lg shadow-green-600/20 transition-all flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add New Milestone
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <table class="w-full text-left text-sm text-stone-600">
            <thead class="bg-stone-50 text-xs uppercase font-bold text-stone-500">
                <tr>
                    <th class="px-6 py-4">Year</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Description</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($milestones as $milestone)
                    <tr class="hover:bg-stone-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-stone-900">{{ $milestone->year }}</td>
                        <td class="px-6 py-4 font-bold text-stone-900">{{ $milestone->title }}</td>
                        <td class="px-6 py-4 max-w-md">
                            <div class="line-clamp-2 leading-relaxed" title="{{ $milestone->description }}">
                                {{ $milestone->description }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <!-- Placeholder for status if it exists, else just active -->
                            <span
                                class="px-2 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider bg-green-100 text-green-700">Active</span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-4">
                                <a href="{{ route('admin.milestones.edit', $milestone->id) }}"
                                    class="text-green-600 hover:text-green-700 transition-colors font-bold text-xs uppercase">Edit</a>
                                <button wire:click="delete({{ $milestone->id }})" wire:confirm="Delete this milestone?"
                                    class="text-red-500 hover:text-red-600 transition-colors font-bold text-xs uppercase">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 border-t border-stone-100">
            {{ $milestones->links() }}
        </div>
    </div>
</div>