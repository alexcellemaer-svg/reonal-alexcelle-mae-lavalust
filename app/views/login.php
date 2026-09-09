<!DOCTYPE html>
<html>
<head><title>Login</title><script src="https://jsdelivr.net"></script></head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <form action="/authenticate" method="POST">
            <div class="mb-4"><label class="block text-sm font-semibold mb-2">Username</label><input type="text" name="username" class="w-full p-2 border rounded" required placeholder="admin"></div>
            <div class="mb-6"><label class="block text-sm font-semibold mb-2">Password</label><input type="password" name="password" class="w-full p-2 border rounded" required placeholder="password123"></div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Login</button>
        </form>
    </div>
</body>
</html>
