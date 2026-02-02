@section('header', 'Subscribers')

<div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
    <!-- Subscriber Table Header Section -->
    <div class="p-6 border-b border-stone-100 flex justify-between items-center">
        <h3 class="text-lg font-bold text-stone-900">Newsletter Subscribers</h3>
        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider">
            Total: {{ $subscribers->total() }}
        </span>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 text-green-600 px-6 py-4 text-sm font-bold">
            {{ session('message') }}
        </div>
    @endif

    <!-- Subscribers List Section -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-stone-600">
            <thead class="bg-stone-50 text-xs uppercase font-bold text-stone-500">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Email Address</th>
                    <th class="px-6 py-4">Subscribed At</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @forelse($subscribers as $subscriber)
                    <tr class="hover:bg-stone-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-stone-900">#{{ $subscriber->id }}</td>
                        <td class="px-6 py-4 font-medium text-stone-900">{{ $subscriber->email }}</td>
                        <td class="px-6 py-4 text-xs">{{ $subscriber->created_at->format('M d, Y h:i A') }}</td>
                        <td class="px-6 py-4">
                            <button wire:click="delete({{ $subscriber->id }})"
                                wire:confirm="Are you sure you want to remove this subscriber?"
                                class="text-red-400 hover:text-red-600 font-bold text-xs uppercase tracking-wider transition-colors">
                                Remove
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-stone-400 italic">No subscribers found yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t border-stone-100">
        {{ $subscribers->links() }}
    </div>
</div>