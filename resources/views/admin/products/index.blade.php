<x-admin-layout>
    <div class="flex items-center justify-between mb-12">
        <div>
            <h1 class="text-3xl font-serif text-stone-900 italic">Inventory Management</h1>
            <p class="text-stone-500 mt-2">Manage your collective's digital artifacts and print collections.</p>
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="flex items-center gap-2 bg-green-600 text-white px-6 py-3 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-green-700 transition-all shadow-lg shadow-green-900/10">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Artifact
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-stone-200 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-stone-50 border-b border-stone-100">
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-stone-400">Artifact</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-stone-400">Category</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-stone-400">Photographer
                    </th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-stone-400">Price</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-stone-400 text-right">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @forelse($products as $product)
                    <tr class="hover:bg-stone-50/50 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-16 rounded-lg overflow-hidden bg-stone-100 flex-shrink-0">
                                    <img src="{{ Str::startsWith($product->image_url, ['http', 'https']) ? $product->image_url : asset($product->image_url) }}"
                                        onerror="this.src='https://placehold.co/100'" alt="{{ $product->title }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <span class="font-bold text-stone-800 tracking-tight">{{ $product->title }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <span
                                class="px-3 py-1 bg-stone-100 rounded-full text-[10px] font-bold uppercase tracking-widest text-stone-500">{{ $product->category }}</span>
                        </td>
                        <td class="px-8 py-6 text-sm text-stone-600 font-medium">
                            {{ $product->photographer?->name ?? 'Unknown' }}
                        </td>
                        <td class="px-8 py-6 text-sm font-black text-stone-900 tracking-tighter">${{ $product->price }}</td>
                        <td class="px-8 py-6 text-right">
                            <div
                                class="flex items-center justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="p-2 text-stone-400 hover:text-green-600 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    onsubmit="return confirm('Archive this artifact forever?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-stone-400 hover:text-red-600 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-24 text-center">
                            <p class="text-stone-400 italic font-serif">The gallery is empty. Begin by adding your first
                                masterpiece.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>