<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
</head>
<body class="bg-gray-50 p-8">
    <div>
        <h1>Product List</h1>
        <a href="/products/create">+ Add Product</a>
        <a href="/logout">Logout</a>
        <table border="1">
            <thead>
                <tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Qty</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php if(!empty($products)): ?>
                    <?php foreach($products as $p): ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><?php echo $p['product_name']; ?></td>
                        <td><?php echo $p['description']; ?></td>
                        <td><?php echo $p['price']; ?></td>
                        <td><?php echo $p['quantity']; ?></td>
                        <td>
                            <a href="/products/edit/<?php echo $p['id']; ?>">Edit</a>
                            <a href="/products/delete/<?php echo $p['id']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
