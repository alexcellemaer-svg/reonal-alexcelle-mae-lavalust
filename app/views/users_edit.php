<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - User Console</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f0fdf4; color: #1f2937; }
        .navbar { background: #16a34a; color: white; padding: 16px 38px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { margin: 0; font-size: 22px; }
        .nav-buttons a { background: white; color: #166534; padding: 9px 15px; border-radius: 6px; text-decoration: none; font-weight: bold; }
        .container { max-width: 600px; margin: 40px auto; padding: 0 20px; }
        .card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 5px 20px rgba(0, 0, 0, .08); }
        h2 { color: #166534; margin-top: 0; margin-bottom: 25px; }
        label { display: block; font-weight: bold; margin-bottom: 6px; }
        input, select { width: 100%; padding: 11px; margin-bottom: 18px; border: 1px solid #d1d5db; border-radius: 7px; font-size: 15px; }
        .buttons { margin-top: 5px; }
        .btn { display: inline-block; padding: 10px 18px; border: none; border-radius: 7px; text-decoration: none; cursor: pointer; font-weight: bold; font-size: 15px; }
        .update { background: #16a34a; color: white; }
        .cancel { background: #e5e7eb; color: #374151; margin-left: 8px; }
        .update:hover { background: #15803d; }
        .cancel:hover { background: #d1d5db; }
    </style>
</head>
<body>

<div class="navbar">
    <h1>User Console</h1>
    <div class="nav-buttons">
        <a href="<?= site_url('users'); ?>">Back to Console</a>
    </div>
</div>

<div class="container">
    <div class="card">
        <h2>Edit User Profile</h2>

        <form action="<?= site_url('users/update/' . $user['id']); ?>" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']); ?>" required>

            <label for="password">Password (Plain-Text Mode)</label>
            <input type="text" id="password" name="password" value="<?= htmlspecialchars($user['password']); ?>" required>

            <label for="role">User Role</label>
            <select id="role" name="role" required>
                <option value="user" <?= ($user['role'] === 'user') ? 'selected' : ''; ?>>User (Read-Only Products)</option>
                <option value="admin" <?= ($user['role'] === 'admin') ? 'selected' : ''; ?>>Admin (Full CRUD Privileges)</option>
            </select>

            <div class="buttons">
                <button type="submit" class="btn update">Update User</button>
                <a href="<?= site_url('users'); ?>" class="btn cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
