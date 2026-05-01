<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register - To-Do List</title>
    <style>
        body { font-family: sans-serif; max-width: 400px; margin: 80px auto; padding: 20px; color: #333; }
        h2 { border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px; }
        .auth-form { display: flex; flex-direction: column; gap: 15px; margin-bottom: 30px; padding: 20px; border: 1px solid #eee; background: #fafafa; }
        input { padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px; font-size: 16px; cursor: pointer; background: #333; color: white; border: none; border-radius: 4px; }
        .error { color: #ff4444; font-size: 14px; }
        .toggle { font-size: 14px; text-align: center; color: #666; cursor: pointer; text-decoration: underline; }
    </style>
</head>
<body>

    <div id="login-section">
        <h2>Login</h2>
        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf
            <input type="email" name="email" placeholder="Email" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            @if ($errors->has('login')) <div class="error">{{ $errors->first('login') }}</div> @endif
        </form>
        <div class="toggle" onclick="toggleAuth()">Don't have an account? Register</div>
    </div>

    <div id="register-section" style="display: none;">
        <h2>Register</h2>
        <form action="{{ route('register') }}" method="POST" class="auth-form">
            @csrf
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <div class="toggle" onclick="toggleAuth()">Already have an account? Login</div>
    </div>

    <script>
        function toggleAuth() {
            const login = document.getElementById('login-section');
            const register = document.getElementById('register-section');
            if (login.style.display === 'none') {
                login.style.display = 'block';
                register.style.display = 'none';
            } else {
                login.style.display = 'none';
                register.style.display = 'block';
            }
        }
    </script>
</body>
</html>
