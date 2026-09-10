<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>

    <h1>Products</h1>

    <a href="<?= site_url('products/create'); ?>">
        <button type="button">Add Product</button>
    </a>

    <br><br>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id']; ?></td>
                    <td><?= $product['product_name']; ?></td>
                    <td><?= $product['description']; ?></td>
                    <td><?= $product['price']; ?></td>
                    <td><?= $product['quantity']; ?></td>
                    <td><?= $product['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>