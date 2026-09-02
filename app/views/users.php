<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e8f5e9, #f1f8e9);
            min-height: 100vh;
            padding: 50px;
            color: #26352b;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            background: linear-gradient(135deg, #1b5e20, #43a047);
            color: white;
            padding: 30px 35px;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 8px 25px rgba(27, 94, 32, 0.2);
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
        }

        .header p {
            margin: 8px 0 0;
            opacity: 0.9;
        }

        .table-card {
            background: white;
            padding: 25px;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
        }

        thead {
            background: #e8f5e9;
        }

        th {
            color: #1b5e20;
            text-align: left;
            padding: 16px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #e5eee6;
            font-size: 15px;
        }

        tbody tr {
            transition: 0.2s ease;
        }

        tbody tr:hover {
            background: #f1f8f2;
            transform: scale(1.005);
        }

        .id {
            font-weight: bold;
            color: #2e7d32;
        }

        .username {
            background: #e8f5e9;
            color: #1b5e20;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6b7d70;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .table-card {
                overflow-x: auto;
            }

            table {
                min-width: 750px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1> User Management</h1>
        <p>Manage and view registered users</p>
    </div>

    <div class="table-card">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td class="id">
                <?= htmlspecialchars($user['id']); ?>
            </td>

            <td>
                <?= htmlspecialchars($user['firstname']); ?>
            </td>

            <td>
                <?= htmlspecialchars($user['lastname']); ?>
            </td>

            <td>
                <?= htmlspecialchars($user['email']); ?>
            </td>

            <td>
                <span class="username">
                    @<?= htmlspecialchars($user['username']); ?>
                </span>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>    

        </table>

        <div class="footer">
            LavaLust • User Management System
        </div>

    </div>

</div>

</body>
</html>