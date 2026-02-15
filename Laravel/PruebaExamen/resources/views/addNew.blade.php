<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .card {
            width: 70%;
            margin: auto;
        }

        form, .titulo {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }
    </style>
</head>
<body>
<x-titulo></x-titulo>
<div class="card">
    <div class="titulo">
        <p>Add New Product</p>
        <button>Back</button>
    </div>
    <div>
        <form class="" action="">
            <p>Code</p>
            <input type="text" name="code">
            <p>Name</p>
            <input type="text" name="name">
            <p>Quantity</p>
            <input type="text" name="quantity">
            <p>Price</p>
            <input type="text" name="price">
            <p>Description</p>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
            <p>Categorie</p>
            <select>

            </select>
        </form>
    </div>
</div>
</body>
</html>
