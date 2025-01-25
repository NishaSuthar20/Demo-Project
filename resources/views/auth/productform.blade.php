<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="{{ asset('assets\css\productform.css') }}"></link>
    <title>Add Product</title>
</head>
<body>
<style>
    a.button {
        padding: 8px 12px;
        text-decoration: none;
        color: #fff;
        background-color: #007BFF;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button {
    padding: 8px 12px;
    text-decoration: none;
    color: #fff;
    background-color: #007BFF;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem
}

</style>
    <h1>Product Management</h1>
    <h2>Add New Product</h2>
    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="price">Product Price:</label><br>
        <input type="number" id="price" name="price" required><br><br>
        <button class="button">Add Product</button>
        <a href="{{ route('productlisting') }}" class="button" >Cancel</a>
    </form>
</body>
</html>
