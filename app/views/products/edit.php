<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f0fdf4; color: #1f2937; }
        .navbar { background: #16a34a; color: white; padding: 18px 40px; }
        .navbar h1 { margin: 0; font-size: 22px; }
        .container { max-width: 600px; margin: 40px auto; padding: 0 20px; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0, 0, 0, .08); }
        h2 { color: #166534; margin-top: 0; margin-bottom: 25px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; }
        input, textarea { width: 100%; padding: 11px; margin-bottom: 18px; border: 1px solid #d1d5db; border-radius: 7px; font-size: 15px; }
        textarea { resize: vertical; }
        .buttons { margin-top: 5px; }
        .btn { display: inline-block; padding: 10px 18px; border: none; border-radius: 7px; text-decoration: none; cursor: pointer; font-weight: bold; }
        .update { background: #16a34a; color: white; }
        .cancel { background: #e5e7eb; color: #374151; margin-left: 8px; }
        .update:hover { background: #15803d; }
        .cancel:hover { background: #d1d5db; }
    </style>
</head>
<body>

<div class="navbar">
    <h1>Product Management</h1>
</div>

<div class="container">
    <div class="card">
        <h2>Edit Product</h2>

        <form action="<?= site_url('products/update/' . $product['id']); ?>" method="POST">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name']); ?>" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5"><?= htmlspecialchars($product['description'] ?? ''); ?></textarea>

            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" min="0" value="<?= htmlspecialchars($product['price']); ?>" required>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="0" value="<?= htmlspecialchars($product['quantity']); ?>" required>

            <div class="buttons">
                <button type="submit" class="btn update">Update Product</button>
                <a href="<?= site_url('products'); ?>" class="btn cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
