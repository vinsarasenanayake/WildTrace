@section('header', 'Users')

<div class="space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-stone-100 overflow-hidden">
        <table class="w-full text-left text-sm text-stone-600">
            <thead class="bg-stone-50 text-xs uppercase font-bold text-stone-500">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Joined</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100">
                @foreach($users as $user)
                    <tr class="hover:bg-stone-50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-stone-900">#{{ $user->id }}</td>
                        <td class="px-6 py-4 font-bold text-stone-900">
                            <div class="flex items-center gap-3">
                                <img src="{{ $user->profile_photo_url }}"
                                    class="w-8 h-8 rounded-full border border-stone-200">
                                {{ $user->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-stone-500">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-2 py-1 rounded-full text-[10px] uppercase font-bold tracking-wider {{ $user->is_admin ? 'bg-purple-100 text-purple-700' : 'bg-stone-100 text-stone-500' }}">
                                {{ $user->is_admin ? 'Admin' : 'Customer' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <!-- <a href="#" class="text-stone-400 hover:text-green-600 transition-colors font-bold text-xs uppercase">Edit</a> -->
                            @if($user->id !== auth()->id())
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Are you sure?"
                                    class="text-red-500 hover:text-red-600 transition-colors font-bold text-xs uppercase">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 border-t border-stone-100">
            {{ $users->links() }}
        </div>
    </div>
</div>