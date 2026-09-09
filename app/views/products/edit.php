<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Edit Product</h2>
        <form action="/products/update/<?php echo $product['id']; ?>" method="POST">
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Product Name</label>
                <input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Description</label>
                <textarea name="description" class="w-full p-2 border rounded"><?php echo $product['description']; ?></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Price</label>
                <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" class="w-full p-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Quantity</label>
                <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" class="w-full p-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</body>
</html>
