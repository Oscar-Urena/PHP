<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product List</title>
    <style>
        .card {
            width: 70%;
            margin: auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        button {
            padding: 5px 10px;
            margin: 5px 2px;
            cursor: pointer;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-show {
            background-color: #ffc107;
            border: none;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        form {
            margin: 20px 0;
        }

        select {
            padding: 5px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
<x-titulo></x-titulo>
<div class="card">
    <div><h2>Product List</h2></div>
    <div>
        <a href="/add">
            <button class="btn-add">Add new Product</button>
        </a>

        <form method="GET" action="/">
            <label for="category">Category</label>
            <select name="category" id="category" onchange="this.form.submit()">
                <option value="0" {{ !isset($selectedCategory) || $selectedCategory == '0' ? 'selected' : '' }}>
                    All
                </option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                        {{ isset($selectedCategory) && $selectedCategory == $category->id ? 'selected' : '' }}>
                        {{$category->description}}
                    </option>
                @endforeach
            </select>
            <button type="submit">List of products</button>
        </form>

        <table>
            <thead>
            <tr>
                <th>S#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->category->description }}</td>
                    <td>
                        <a href="/show/{{ $product->id }}">
                            <button class="btn-show">Show</button>
                        </a>
                        <a href="/edit/{{ $product->id }}">
                            <button class="btn-edit">Edit</button>
                        </a>
                        <form action="/delete/{{ $product->id }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
