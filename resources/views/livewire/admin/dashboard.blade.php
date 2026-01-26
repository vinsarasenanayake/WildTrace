@section('header', 'Dashboard Overview')

<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="flex flex-row gap-6 w-full">
        <!-- Revenue -->
        <div class="flex-1 min-w-0 bg-white p-6 rounded-2xl shadow-sm border border-stone-100">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xs font-bold uppercase tracking-widest text-stone-400">Total Revenue</h3>
                <div class="p-2 bg-green-50 rounded-lg text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-black text-stone-900">${{ number_format($stats['revenue'], 2) }}</p>
        </div>

        <!-- Orders -->
        <a href="{{ route('admin.orders.index') }}"
            class="flex-1 min-w-0 block bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <h3
                    class="text-xs font-bold uppercase tracking-widest text-stone-400 group-hover:text-stone-600 transition-colors">
                    Total Orders</h3>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600 group-hover:bg-blue-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-black text-stone-900">{{ $stats['orders'] }}</p>
        </a>

        <!-- Products -->
        <a href="{{ route('admin.products.index') }}"
            class="flex-1 min-w-0 block bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <h3
                    class="text-xs font-bold uppercase tracking-widest text-stone-400 group-hover:text-stone-600 transition-colors">
                    Active Products</h3>
                <div class="p-2 bg-purple-50 rounded-lg text-purple-600 group-hover:bg-purple-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-black text-stone-900">{{ $stats['products'] }}</p>
        </a>

        <!-- Users -->
        <a href="{{ route('admin.users.index') }}"
            class="flex-1 min-w-0 block bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <h3
                    class="text-xs font-bold uppercase tracking-widest text-stone-400 group-hover:text-stone-600 transition-colors">
                    Total Users</h3>
                <div class="p-2 bg-orange-50 rounded-lg text-orange-600 group-hover:bg-orange-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-black text-stone-900">{{ $stats['users'] }}</p>
        </a>

        <!-- Subscribers -->
        <a href="{{ route('admin.subscribers.index') }}"
            class="flex-1 min-w-0 block bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group cursor-pointer">
            <div class="flex items-center justify-between mb-4">
                <h3
                    class="text-xs font-bold uppercase tracking-widest text-stone-400 group-hover:text-stone-600 transition-colors">
                    Subscribers</h3>
                <div class="p-2 bg-pink-50 rounded-lg text-pink-600 group-hover:bg-pink-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-black text-stone-900">{{ $stats['subscribers'] }}</p>
        </a>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <div class="p-6 border-b border-stone-100">
            <h3 class="text-lg font-bold text-stone-900">Recent Orders</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-stone-600">
                <thead class="bg-stone-50 text-xs uppercase font-bold text-stone-500">
                    <tr>
                        <th class="px-6 py-4">Order ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($stats['recent_orders'] as $order)
                                    <tr class="hover:bg-stone-50 transition-colors">
                                        <td class="px-6 py-4 font-mono text-xs font-bold text-stone-900">#{{ substr($order->id, 0, 8) }}
                                        </td>
                                        <td class="px-6 py-4">{{ $order->user ? $order->user->name : 'Guest' }}</td>
                                        <td class="px-6 py-4 font-medium text-stone-900">${{ number_format($order->total_price, 2) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider 
                                                                                    {{ ($order->status ?? 'pending') === 'confirmed' ? 'bg-green-100 text-green-700' :
                        (($order->status === 'declined' || $order->status === 'cancelled') ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                                {{ $order->status ?? 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-xs">{{ $order->created_at->format('M d, Y') }}</td>
                                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-stone-400 italic">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>