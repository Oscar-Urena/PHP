<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information</title>
    <style>
        .card { width: 60%; margin: auto; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 8px; border: 1px solid #ddd; }
        td:first-child { font-weight: bold; text-align: right; width: 30%; }
    </style>
</head>
<body>
<x-titulo></x-titulo>
<div class="card">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Product Information</h2>
        <a href="/"><button>← Back</button></a>
    </div>
    <table>
        <tr><td>Code:</td><td>{{ $product->code }}</td></tr>
        <tr><td>Name:</td><td>{{ $product->name }}</td></tr>
        <tr><td>Quantity:</td><td>{{ $product->quantity }}</td></tr>
        <tr><td>Price:</td><td>{{ number_format($product->price, 2) }}</td></tr>
        <tr><td>Description:</td><td>{{ $product->description }}</td></tr>
        <tr><td>Category:</td><td>{{ $product->category->description }}</td></tr>
    </table>
</div>
</body>
</html>
