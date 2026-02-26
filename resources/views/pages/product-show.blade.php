<x-guest-layout title="Product Details" :fullWidth="true" :hasFooter="false">
    @livewire('product-show', ['id' => $id])
</x-guest-layout>