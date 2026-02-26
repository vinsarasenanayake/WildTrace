@section('header', 'Orders')

<div class="space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <table class="w-full text-left text-sm text-stone-600">
            <thead class="bg-stone-50 text-xs uppercase font-bold text-stone-500">
                <tr>
                    <th class="px-6 py-4">Order #</th>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Date</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($orders as $order)
                            <tr class="hover:bg-stone-50 transition-colors">
                                <td class="px-6 py-4 font-mono text-xs font-bold text-stone-900">
                                    {{ $order->id }}
                                </td>
                                <td class="px-6 py-4 font-bold text-stone-900">
                                    {{ $order->user ? $order->user->name : 'Guest' }}
                                    <div class="text-[10px] text-stone-400 font-normal">
                                        {{ $order->user ? $order->user->email : '' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider 
                                                                                                    {{ ($order->status ?? 'pending') === 'confirmed' ? 'bg-green-100 text-green-700' :
                    (($order->status === 'declined' || $order->status === 'cancelled') ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ $order->status ?? 'Pending' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-mono font-medium text-stone-900">
                                    ${{ number_format($order->total_price, 2) }}</td>
                                <td class="px-6 py-4 text-xs">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="delete('{{ $order->id }}')" wire:confirm="Delete this order?"
                                        class="text-red-500 hover:text-red-600 transition-colors font-bold text-xs uppercase">Delete</button>
                                </td>
                            </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 border-t border-stone-100">
            {{ $orders->links() }}
        </div>
    </div>
</div>