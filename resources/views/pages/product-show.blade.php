<x-guest-layout title="Product Details" :hasFooter="true" :fullWidth="true">
    @livewire('product-show', ['id' => $id])
</x-guest-layout>