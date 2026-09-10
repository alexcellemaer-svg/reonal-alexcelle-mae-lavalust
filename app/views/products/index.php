<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Products - Product Management</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0fdf4;
            color: #1f2937;
        }

        /* NAVBAR */
        .navbar {
            background: #16a34a;
            color: white;
            padding: 18px 40px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 22px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user {
            font-size: 14px;
            margin-right: 10px;
        }

        .nav-btn {
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            background: white;
            color: #15803d;
        }

        .nav-btn:hover {
            background: #dcfce7;
        }

        /* MAIN CONTAINER */
        .container {
            max-width: 1150px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* HEADER */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h2 {
            margin: 0;
            color: #166534;
        }

        .add-btn {
            background: #16a34a;
            color: white;
            padding: 11px 18px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
        }

        .add-btn:hover {
            background: #15803d;
        }

        /* TABLE */
        .table-container {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background: #15803d;
            color: white;
            padding: 14px;
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 13px 14px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #f0fdf4;
        }

        /* PRICE */
        .price {
            font-weight: bold;
            color: #166534;
        }

        /* ACTION BUTTONS */
        .actions {
            white-space: nowrap;
        }

        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .edit-btn {
            background: #2563eb;
            color: white;
            margin-right: 5px;
        }

        .edit-btn:hover {
            background: #1d4ed8;
        }

        .delete-btn {
            background: #dc2626;
            color: white;
        }

        .delete-btn:hover {
            background: #b91c1c;
        }

        /* EMPTY STATE */
        .empty {
            text-align: center;
            padding: 40px;
            color: #6b7280;
        }

        /* MOBILE */
        @media (max-width: 700px) {

            .navbar {
                padding: 15px 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .navbar-right {
                flex-wrap: wrap;
            }

            .container {
                margin-top: 25px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <div class="navbar">

        <h1>Product Management</h1>

        <div class="navbar-right">

          <span class="user">
            Welcome,
            <?= htmlspecialchars($username ?? 'User'); ?>
          </span>

            <a
                href="<?= site_url('users'); ?>"
                class="nav-btn"
            >
                User Console
            </a>

            <a
                href="<?= site_url('logout'); ?>"
                class="nav-btn"
            >
                Logout
            </a>

        </div>

    </div>


    <!-- MAIN CONTENT -->
    <div class="container">

        <!-- PAGE HEADER -->
        <div class="page-header">

            <h2>Products</h2>

            <a
                href="<?= site_url('products/create'); ?>"
                class="add-btn"
            >
                + Add Product
            </a>

        </div>


        <!-- PRODUCT TABLE -->
        <div class="table-container">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($products)): ?>

                        <?php foreach ($products as $product): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($product['id']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($product['product_name']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars(
                                        $product['description'] ?? ''
                                    ); ?>
                                </td>

                                <td class="price">
                                    ₱<?= number_format(
                                        (float) $product['price'],
                                        2
                                    ); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($product['quantity']); ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($product['created_at']); ?>
                                </td>

                                <td class="actions">

                                    <!-- EDIT -->
                                    <a
                                        href="<?= site_url(
                                            'products/edit/' . $product['id']
                                        ); ?>"
                                        class="edit-btn"
                                    >
                                        Edit
                                    </a>

                                    <!-- DELETE -->
                                    <a
                                        href="<?= site_url(
                                            'products/delete/' . $product['id']
                                        ); ?>"
                                        class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this product?');"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="7"
                                class="empty"
                            >
                                No products found.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>