<!DOCTYPE html>
<html>
<head>
    <title>Su pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .order-details, .product-details {
            margin-bottom: 20px;
        }
        .product-details th, .product-details td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>¡Gracias por su orden!</h1>
        </div>

        <div class="order-details">
            <h2>Resumen del pedido</h2>
            <p><strong>Pedido ID:</strong> {{ $order->id }}</p>
            <p><strong>TOTAL GENERAL:</strong> BS{{ number_format($order->total_amount, 2) }}</p>
        </div>

        <div class="product-details">
            <h2>Detalles de los productos</h2>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Nombre del producto</th>
                        <th>Cantidad</th>
                        <th>Color</th>
                        <th>PRECIO</th>
                        <th>Total parcial</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($order->products as $product)
    @php
        $productVariation = \App\Models\ProductVariations::where('sku', $product->sku)->first();
        $color = $productVariation ? $productVariation->color : 'N/A'; // Set default color to 'N/A' if not found
    @endphp
    <tr>
        <td>{{ $product->title }}</td>
        <td>{{ $product->pivot->quantity }}</td>
        <td>{{ $color }}</td>
        <td>BS{{ number_format($product->pivot->price, 2) }}</td>
        <td>BS{{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
    </tr>
@endforeach

                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>Le notificaremos una vez que se envíe su pedido.</p>
            <p>Para cualquier consulta, contacta con nuestro equipo de soporte.</p>
        </div>
    </div>
</body>
</html>
