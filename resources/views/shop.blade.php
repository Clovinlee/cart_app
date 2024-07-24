<x-app-layout>
    <div class="row p-2 m-2">
        @foreach($products as $product)
            <div class="col-3">
                <x-product-card :product="$product"></x-product-card>
            </div>
        @endforeach
    </div>
</x-app-layout>
