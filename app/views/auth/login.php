<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Product Management</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f0fdf4;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            width: 380px;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
        }

        .logo {
            text-align: center;
            color: #16a34a;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #374151;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34,197,94,0.15);
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 18px;
            text-align: center;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background: #16a34a;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .login-btn:hover {
            background: #15803d;
        }

        .hint {
            margin-top: 18px;
            text-align: center;
            color: #9ca3af;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="logo">Product Management</div>

    <div class="subtitle">
        Sign in to continue
    </div>
   <?php if (!empty($error)): ?>
    <div class="error">
        <?= htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

    <form action="<?= site_url('authenticate'); ?>" method="POST">

        <label for="username">Username</label>

        <input
            type="text"
            id="username"
            name="username"
            minlength="4"
            required
            placeholder="Enter username"
        >

        <label for="password">Password</label>

        <input
            type="password"
            id="password"
            name="password"
            minlength="8"
            required
            placeholder="Enter password"
        >

        <button type="submit" class="login-btn">
            Login
        </button>

    </form>

    <div class="hint">
        Username must be at least 4 characters.<br>
        Password must be at least 8 characters.
    </div>

</div>

</body>
</html>