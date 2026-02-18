@php $editing = $product !== null; @endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $editing ? 'Edit Product' : 'Add New Product' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .card {
            width: 60%;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
        }

        .titulo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 10px;
            align-items: center;
        }

        form p {
            margin: 0;
            text-align: right;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
            border: 1px solid #ccc;
        }

        .form-actions {
            grid-column: 2;
        }

        button[type="submit"] {
            padding: 6px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<x-titulo></x-titulo>

<div class="card">
    <div class="titulo">
        <p>{{ $editing ? 'Edit Product' : 'Add New Product' }}</p>
        <x-button href="/">Back</x-button>
    </div>


    <form method="POST" action="{{ $editing ? '/edit/'.$product->id : '/add' }}">
        @csrf
        @if($editing) @method('PUT') @endif

        <p>Code</p>
        <div>
            <input type="text" name="code" value="{{ old('code', $editing ? $product->code : '') }}">
            @error('code') <span style="color:red; font-size:0.85em;">{{ $message }}</span> @enderror
        </div>

        <p>Name</p>
        <div>
            <input type="text" name="name" value="{{ old('name', $editing ? $product->name : '') }}">
            @error('name') <span style="color:red; font-size:0.85em;">{{ $message }}</span> @enderror
        </div>

        <p>Quantity</p>
        <div>
            <input type="number" name="quantity" value="{{ old('quantity', $editing ? $product->quantity : '') }}">
            @error('quantity') <span style="color:red; font-size:0.85em;">{{ $message }}</span> @enderror
        </div>

        <p>Price</p>
        <div>
            <input type="number" step="0.01" name="price" value="{{ old('price', $editing ? $product->price : '') }}">
            @error('price') <span style="color:red; font-size:0.85em;">{{ $message }}</span> @enderror
        </div>

        <p>Description</p>
        <div>
            <textarea name="description" rows="4">{{ old('description', $editing ? $product->description : '') }}</textarea>
            @error('description') <span style="color:red; font-size:0.85em;">{{ $message }}</span> @enderror
        </div>

        <p>Category</p>
        <div>
            <select name="category_id">
                <option value="">-- Select a category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $editing ? $product->category_id : '') == $category->id ? 'selected' : '' }}>
                        {{ $category->description }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span style="color:red; font-size:0.85em;">{{ $message }}</span> @enderror
        </div>
        <div class="form-actions">
            <button type="submit">{{ $editing ? 'Update' : 'Save' }}</button>
        </div>
    </form>
</div>
</body>
</html>
