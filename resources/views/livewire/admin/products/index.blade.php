@section('header', 'Products')

<div class="space-y-6">
    <!-- Search and Filter Section -->
    <div class="flex justify-between items-center">
        <div>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search products..."
                class="pl-4 pr-4 py-2 border border-stone-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>
        <a href="{{ route('admin.products.create') }}"
            class="bg-green-600 hover:bg-green-500 text-white text-xs font-bold uppercase tracking-wider px-6 py-3 rounded-lg shadow-lg shadow-green-600/20 transition-all flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add New Product
        </a>
    </div>

    <!-- Products Table Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <table class="w-full text-left text-sm text-stone-600">
            <thead class="bg-stone-50 text-xs uppercase font-bold text-stone-500">
                <tr>
                    <th class="px-6 py-4">Image</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Price</th>
                    <th class="px-6 py-4">Photographer</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($products as $product)
                    <tr class="hover:bg-stone-50 transition-colors">
                        <td class="px-6 py-4">
                            <img src="{{ asset($product->image_url) }}"
                                class="w-12 h-12 rounded-lg object-cover border border-stone-200">
                        </td>
                        <td class="px-6 py-4 font-bold text-stone-900">{{ $product->title }}</td>
                        <td class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-green-600">
                            {{ $product->category }}
                        </td>
                        <td class="px-6 py-4 font-mono font-medium">${{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4 text-xs text-stone-500">
                            {{ $product->photographer ? $product->photographer->name : 'Unknown' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-4">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="text-green-600 hover:text-green-700 transition-colors font-bold text-xs uppercase">Edit</a>
                                <button wire:click="delete({{ $product->id }})" wire:confirm="Delete this product?"
                                    class="text-red-500 hover:text-red-600 transition-colors font-bold text-xs uppercase">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="text-xs text-stone-400 font-bold uppercase tracking-wider text-center">
        Showing all {{ $products->count() }} products
    </div>
</div>