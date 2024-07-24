<div class="product-card" onclick="handleClick({{ json_encode($product) }})">
    <h5>{{ $product['name'] }}</h5>
    <p>Price: ${{ number_format($product['price']) }}</p>
</div>

<script>
    async function handleClick(product){
        let r = await axios.post('http://localhost:8001/api/cart', {
            product_id: product.id,
            // Include any additional data you need to send
        });

        console.log(r);
    }
</script>

<style>
    .product-card {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        cursor:pointer;
    }

    .product-card:hover{
        background-color: #d8cdcd;
    }
</style>