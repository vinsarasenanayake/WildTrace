@section('header', 'Photographers')

<div class="space-y-6">
    <!-- Action Header Section -->
    <div class="flex justify-between items-center">
        <div></div>
        <a href="{{ route('admin.photographers.create') }}"
            class="bg-green-600 hover:bg-green-500 text-white text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-lg shadow-lg shadow-green-600/20 transition-all flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add New Photographer
        </a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium">
            {{ session('message') }}
        </div>
    @endif

    <!-- Photographers DataTable Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <table class="w-full text-left text-sm text-stone-600">
            <thead class="bg-stone-50 text-xs uppercase font-bold text-stone-500">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Profession</th>
                    <th class="px-6 py-4">Image</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @forelse($photographers as $photographer)
                    <tr class="hover:bg-stone-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-stone-900">#{{ $photographer->id }}</td>
                        <td class="px-6 py-4 font-bold text-stone-900">{{ $photographer->name }}</td>
                        <td class="px-6 py-4 text-xs font-bold text-stone-500 uppercase tracking-wider">
                            {{ $photographer->profession }}
                        </td>
                        <td class="px-6 py-4">
                            @if($photographer->image)
                                <img src="{{ asset($photographer->image) }}"
                                    class="w-10 h-10 rounded-full object-cover border border-stone-200">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-stone-200 flex items-center justify-center text-stone-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-4">
                                <a href="{{ route('admin.photographers.edit', $photographer->id) }}"
                                    class="text-green-600 hover:text-green-700 transition-colors font-bold text-xs uppercase">Edit</a>
                                <button wire:click="delete({{ $photographer->id }})"
                                    wire:confirm="Are you sure you want to delete this photographer?"
                                    class="text-red-500 hover:text-red-600 transition-colors font-bold text-xs uppercase">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-stone-400 italic">No photographers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>