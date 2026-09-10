<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Console</title>

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

        .navbar {
            background: #16a34a;
            color: white;
            padding: 16px 38px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 22px;
        }

        .nav-buttons {
            display: flex;
            gap: 8px;
        }

        .nav-buttons a {
            background: white;
            color: #166534;
            padding: 9px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            max-width: 1000px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            margin-bottom: 25px;
        }

        h2 {
            color: #166534;
            margin-top: 0;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 12px;
            align-items: end;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 15px;
        }

        button {
            border: none;
            border-radius: 7px;
            padding: 11px 18px;
            font-weight: bold;
            cursor: pointer;
        }

        .add {
            background: #16a34a;
            color: white;
        }

        .add:hover {
            background: #15803d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #15803d;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .action {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            font-weight: bold;
        }

        .delete {
            background: #dc2626;
        }

        .delete:hover {
            background: #b91c1c;
        }

        .recover {
            background: #2563eb;
        }

        .recover:hover {
            background: #1d4ed8;
        }

        .empty {
            text-align: center;
            color: #6b7280;
            padding: 20px;
        }

        @media (max-width: 700px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 15px 20px;
            }

            .container {
                padding: 0 10px;
            }

            table {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<div class="navbar">

    <h1>User Console</h1>

    <div class="nav-buttons">
        <a href="<?= site_url('products'); ?>">
            Products
        </a>

        <a href="<?= site_url('logout'); ?>">
            Logout
        </a>
    </div>

</div>


<div class="container">

    <!-- =========================================
         ADD USER
    ========================================== -->

    <div class="card">

        <h2>Add User</h2>

        <form
            action="<?= site_url('users/store'); ?>"
            method="POST"
        >

            <div class="form-row">

                <div>

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter username"
                        required
                    >

                </div>


                <div>

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter password"
                        required
                    >

                </div>


                <div>

                    <button
                        type="submit"
                        class="add"
                    >
                        + Add User
                    </button>

                </div>

            </div>

        </form>

    </div>


    <!-- =========================================
         ACTIVE USERS
    ========================================== -->

    <div class="card">

        <h2>Active Users</h2>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                <?php if (!empty($active_users)): ?>

                    <?php foreach ($active_users as $user): ?>

                        <?php
                        if (is_object($user)) {
                            $user = (array) $user;
                        }

                        if (!is_array($user)) {
                            continue;
                        }
                        ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($user['id'] ?? ''); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($user['username'] ?? ''); ?>
                            </td>

                            <td>

                                <?php if (!empty($user['id'])): ?>

                                    <a
                                        href="<?= site_url('users/delete/' . $user['id']); ?>"
                                        class="action delete"
                                        onclick="return confirm('Are you sure you want to delete this user?');"
                                    >
                                        Delete
                                    </a>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="3"
                            class="empty"
                        >
                            No active users found.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>


    <!-- =========================================
         DELETED USERS
    ========================================== -->

    <div class="card">

        <h2>Deleted Users</h2>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>

                <?php if (!empty($trashed_users)): ?>

                    <?php foreach ($trashed_users as $user): ?>

                        <?php
                        if (is_object($user)) {
                            $user = (array) $user;
                        }

                        if (!is_array($user)) {
                            continue;
                        }
                        ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($user['id'] ?? ''); ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($user['username'] ?? ''); ?>
                            </td>

                            <td>

                                <?php if (!empty($user['id'])): ?>

                                    <a
                                        href="<?= site_url('users/recover/' . $user['id']); ?>"
                                        class="action recover"
                                    >
                                        Recover
                                    </a>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="3"
                            class="empty"
                        >
                            No deleted users.
                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>