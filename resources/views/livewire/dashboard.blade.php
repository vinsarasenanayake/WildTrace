<div class="min-h-screen relative overflow-x-hidden bg-stone-50 flex flex-col">

    <!-- Background global -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-[-20%] left-[-10%] w-[800px] h-[800px] bg-green-600/5 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-[-20%] right-[-10%] w-[600px] h-[600px] bg-stone-400/10 rounded-full blur-[100px]">
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="fixed top-6 left-0 right-0 z-50 mx-auto w-[95%]">
        <div
            class="flex items-center justify-between relative px-8 py-2 rounded-2xl bg-green-900/80 backdrop-blur-md border border-green-500/20 shadow-[0_8px_32px_0_rgba(0,0,0,0.36)] transition-all duration-300 hover:bg-green-900/90 hover:border-green-500/30">
            <!-- LEFT: LOGO -->
            <a href="/" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo.png') }}"
                    class="w-10 h-10 object-contain opacity-90 group-hover:opacity-100 transition-opacity">
            </a>

            <!-- CENTER: TABS -->
            <div class="hidden md:flex items-center gap-12 absolute left-1/2 -translate-x-1/2">
                <a href="{{ url('/') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Home</a>
                <a href="{{ url('/journey') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Journey</a>
                <a href="{{ url('/gallery') }}"
                    class="text-xs font-bold uppercase tracking-[0.2em] text-white hover:text-green-400 transition-colors relative group">Gallery</a>
            </div>

            <!-- RIGHT: ICONS -->
            <div class="flex items-center gap-6 text-white">
                <a href="{{ url('/cart') }}"
                    class="hover:text-green-400 transition-colors transform hover:scale-110 duration-200 p-2 hover:bg-white/5 rounded-full relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                    </svg>
                    @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count(); @endphp
                    @if($cartCount > 0)
                        <span
                            class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 text-white text-[10px] flex items-center justify-center rounded-full font-bold">{{ $cartCount }}</span>
                    @endif
                </a>

                <!-- Profile Link (Dashboard) -->
                <a href="{{ url('/dashboard') }}" class="relative group focus:outline-none" title="Dashboard">
                    <img src="{{ Auth::user()->profile_photo_url }}"
                        class="w-8 h-8 rounded-full border-2 border-green-500/30 hover:border-green-400 transition-all">
                    <!-- Online Indicator -->
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-green-900 rounded-full"></span>
                </a>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline-flex">
                    @csrf
                    <button type="submit" 
                        class="hover:text-red-500 transition-colors transform hover:scale-110 duration-200 p-2 hover:bg-white/5 rounded-full" 
                        title="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- DASHBOARD CONTENT -->
    <main class="relative z-10 pt-32 pb-24 px-6 md:px-12 w-full flex-grow min-h-[70vh]">

        <!-- Welcome Header -->
        <div class="mb-10 animate-fade-in-up">
            <div>
                <span class="text-green-600 font-black tracking-[0.4em] text-[10px] uppercase mb-2 block">My
                    Account</span>
                <h1 class="text-4xl md:text-6xl font-serif italic text-stone-900 leading-none">
                    Welcome, {{ ucfirst(explode(' ', $user->name)[0]) }}
                </h1>
            </div>
        </div>

        <!-- Tabs & Action -->
        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-stone-200 mb-10 pb-1 gap-4" wire:ignore.self>
            <div class="flex gap-8 overflow-x-auto">
                <button wire:click="setTab('favorites')"
                    class="pb-4 text-xs font-black uppercase tracking-[0.2em] transition-all relative {{ $activeTab === 'favorites' ? 'text-green-600' : 'text-stone-400 hover:text-stone-600' }}">
                    Favorites
                    @if($activeTab === 'favorites')
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.5)]"></span>
                    @endif
                </button>
                <button wire:click="setTab('orders')"
                    class="pb-4 text-xs font-black uppercase tracking-[0.2em] transition-all relative {{ $activeTab === 'orders' ? 'text-green-600' : 'text-stone-400 hover:text-stone-600' }}">
                    Order History
                    @if($activeTab === 'orders')
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-green-500 shadow-[0_0_10px_rgba(34,197,94,0.5)]"></span>
                    @endif
            </div>

            <div class="mb-2">
                <a href="{{ route('profile.show') }}"
                    class="px-6 py-2 rounded-xl border border-stone-200 hover:border-stone-400 bg-white hover:bg-stone-50 text-[10px] font-bold uppercase tracking-widest transition-all text-stone-600 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                    Edit Profile
                </a>
            </div>
        </div>

        <!-- Favorites Tab -->
        @if($activeTab === 'favorites')
            <div class="animate-fade-in space-y-8">
                @if($favorites->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($favorites as $fav)
                            @if($fav->product)
                                <div
                                    class="group relative bg-white rounded-3xl p-4 shadow-sm border border-stone-100 hover:shadow-xl hover:border-green-500/30 transition-all duration-500">
                                    <!-- Image Card -->
                                    <div class="relative h-64 rounded-2xl overflow-hidden mb-6">
                                        <img src="{{ asset($fav->product->image_url) }}"
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                        <div
                                            class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors duration-500">
                                        </div>

                                        <!-- Remove From Favorites -->
                                        <button wire:click="removeFavorite({{ $fav->id }})"
                                            class="absolute top-4 right-4 p-2 bg-white/90 backdrop-blur-sm rounded-full text-red-500 hover:text-red-600 hover:bg-white transition-all shadow-lg z-10">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                                class="w-4 h-4">
                                                <path
                                                    d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="px-2 pb-2">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <p class="text-[10px] font-bold text-green-600 uppercase tracking-widest mb-1">
                                                    {{ ucfirst($fav->product->category) }}</p>
                                                <h3 class="text-xl font-serif italic text-stone-900 leading-tight">
                                                    <a href="{{ route('product.show', $fav->product->id) }}"
                                                        class="hover:text-green-700 transition-colors">
                                                        {{ $fav->product->title }}
                                                    </a>
                                                </h3>
                                            </div>
                                            <span class="font-bold text-stone-900">${{ $fav->product->price }}</span>
                                        </div>
                                        <p class="text-xs text-stone-500 font-medium mb-4">
                                            by {{ $fav->product->photographer ? $fav->product->photographer->name : 'Unknown Artist' }}
                                        </p>

                                        <a href="{{ route('product.show', $fav->product->id) }}"
                                            class="block w-full py-3 text-center bg-stone-100 hover:bg-green-600 text-stone-600 hover:text-white text-xs font-black uppercase tracking-widest rounded-xl transition-all">
                                            View Product
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div
                        class="flex flex-col items-center justify-center py-20 text-center bg-white rounded-[3rem] border border-stone-100 shadow-sm">
                        <div class="w-16 h-16 bg-stone-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-stone-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-serif italic text-stone-900 mb-2">No Favorites Yet</h3>
                        <p class="text-stone-500 max-w-md mx-auto mb-8">Start exploring the gallery to curate your own
                            collection of wild moments.</p>
                        <a href="{{ route('gallery') }}"
                            class="px-8 py-4 bg-green-600 hover:bg-green-500 text-white text-xs font-black uppercase tracking-widest rounded-full transition-all shadow-lg shadow-green-600/20">
                            Explore Gallery
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <!-- Order History Tab -->
        @if($activeTab === 'orders')
            <div class="animate-fade-in space-y-6 max-w-4xl mx-auto">
                @if($orders->count() > 0)
                    @foreach($orders as $order)
                        <div class="bg-white rounded-3xl p-8 border border-stone-100 shadow-sm hover:shadow-lg transition-shadow">
                            <!-- Order Header -->
                            <div
                                class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 pb-6 border-b border-stone-100">
                                <div>
                                    <span class="text-[10px] font-black uppercase tracking-widest block mb-2 {{ in_array(strtolower($order->status ?? 'pending'), ['confirmed', 'paid', 'delivered']) ? 'text-green-600' : 
                                        (in_array(strtolower($order->status), ['declined', 'cancelled', 'failed']) ? 'text-red-500' : 'text-amber-500') }}">
                                        {{ ucfirst($order->status ?? 'Pending') }}
                                    </span>
                                    <p class="text-[10px] font-black text-stone-400 uppercase tracking-widest mb-1">Order
                                        #{{ $order->id }}</p>
                                    <p class="text-sm font-bold text-stone-900">{{ $order->created_at->format('F j, Y') }}</p>
                                </div>
                                <div class="flex items-center gap-6">
                                    <div class="text-right">
                                        <p class="text-[10px] font-black text-stone-400 uppercase tracking-widest mb-1">Total</p>
                                        <p class="text-lg font-black text-green-600">${{ $order->total_price }}</p>
                                    </div>
                                    
                                    <!-- Order Actions -->
                                    <div class="flex items-center gap-4">
                                        <div class="flex flex-col items-end gap-2">
                                        @php
                                            $effectiveStatus = strtolower($order->status ?? 'pending');
                                            $paymentStatus = strtolower($order->payment_status ?? 'pending');
                                            
                                            $isGrayedOut = in_array($effectiveStatus, ['declined', 'cancelled']);
                                            $isVisible = $effectiveStatus === 'pending' || $isGrayedOut;
                                        @endphp
                                    
                                        @if($isVisible)
                                            <div class="flex flex-col gap-2">
                                                <!-- Pay Now Button -->
                                                @if($isGrayedOut)
                                                    <button disabled class="px-6 py-2 bg-stone-200 text-stone-400 text-[10px] font-bold uppercase tracking-widest rounded-full cursor-not-allowed text-center shadow-none border border-stone-200">
                                                        Pay Now
                                                    </button>
                                                @else
                                                    <a href="{{ route('order.repay', $order->id) }}" class="px-6 py-2 bg-green-600 hover:bg-green-500 text-white text-[10px] font-bold uppercase tracking-widest rounded-full transition-all shadow-lg shadow-green-600/20 active:scale-95 text-center">
                                                        Pay Now
                                                    </a>
                                                @endif

                                                <!-- Cancel Button -->
                                                @if($isGrayedOut)
                                                    <button disabled class="px-6 py-2 bg-stone-100 text-stone-300 text-[10px] font-bold uppercase tracking-widest rounded-full cursor-not-allowed text-center border border-stone-100">
                                                        Cancel Order
                                                    </button>
                                                @else
                                                     <button 
                                                        wire:click="cancelOrder({{ $order->id }})"
                                                        wire:confirm="Are you sure you want to cancel this order?"
                                                        class="px-6 py-2 bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 text-[10px] font-bold uppercase tracking-widest rounded-full transition-all active:scale-95 text-center">
                                                        Cancel Order
                                                    </button>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="space-y-4">
                                @foreach($order->items as $item)
                                        <div class="flex items-center gap-4">
                                            @php
                                            $imagePath = $item->product_image;

                                            if ($imagePath) {
                                                $imagePath = str_replace(['http://10.0.2.2:8000/', 'http://192.168.1.191:8000/'], '', $imagePath);
                                            }
                                            
                                            if (empty($imagePath) && $item->product) {
                                                $imagePath = $item->product->image_url;
                                            }
                                                
                                            if (empty($imagePath) && $item->product_name) {
                                                    $cleanName = explode(' (', $item->product_name)[0];
                                                    $fuzzyProduct = \App\Models\Product::where('title', 'like', $cleanName . '%')->first();
                                                    if ($fuzzyProduct) {
                                                        $imagePath = $fuzzyProduct->image_url;
                                                    }
                                            }
                                                
                                                $productTitle = $item->product->title ?? ($item->product_name ?? 'Product');
                                            @endphp
                                            
                                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-stone-100 flex-shrink-0">
                                                @if($imagePath)
                                                    <img src="{{ asset($imagePath) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-red-50 flex items-center justify-center text-red-300 text-xs text-center leading-none">
                                                        <span class="text-[10px] font-black uppercase">No<br>Image</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex-grow">
                                                <div class="flex items-center justify-between gap-4">
                                                    <div>
                                                        <h4 class="text-sm font-bold text-stone-900 font-serif italic">{{ $productTitle }}</h4>
                                                        <p class="text-[10px] text-stone-500 font-medium">{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</p>
                                                    </div>
                                                    <div class="text-right">
                                                        <p class="text-sm font-black text-stone-900">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Empty State -->
                    <div
                        class="flex flex-col items-center justify-center py-20 text-center bg-white rounded-[3rem] border border-stone-100 shadow-sm">
                        <div class="w-16 h-16 bg-stone-100 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-8 h-8 text-stone-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-serif italic text-stone-900 mb-2">No Past Orders</h3>
                        <p class="text-stone-500 max-w-md mx-auto mb-8">You haven't purchased any artifacts yet. Your journey
                            awaits.</p>
                        <a href="{{ route('gallery') }}"
                            class="px-8 py-4 bg-green-600 hover:bg-green-500 text-white text-xs font-black uppercase tracking-widest rounded-full transition-all shadow-lg shadow-green-600/20">
                            Browse Collection
                        </a>
                    </div>
                @endif
            </div>
        @endif

    </main>

</div>
