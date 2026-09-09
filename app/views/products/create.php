<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body class="bg-gray-50 p-8">
    <div>
        <h2>Add Product</h2>
        <form action="/products/store" method="POST">
            <div><label>Product Name</label><input type="text" name="product_name" required></div>
            <div><label>Description</label><textarea name="description"></textarea></div>
            <div><label>Price</label><input type="number" step="0.01" name="price" required></div>
            <div><label>Quantity</label><input type="number" name="quantity" required></div>
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>
