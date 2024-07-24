<x-app-layout>
    <div class="d-flex align-items-center justify-content-center gap-2 h-100">
        <button class="btn btn-outline-success btn-lg" onclick="window.location.href='{{route('shop')}}'">SHOP</button>
        <button class="btn btn-outline-success btn-lg" onclick="window.location.href='{{route('cart')}}'">CART</button>
        <button class="btn btn-outline-success btn-lg" onclick="handleCookie()">COOKIE</button>
    </div>
</x-app-layout>

<Script>
    function handleCookie(){
        console.log(document.cookie);
    }
</Script>