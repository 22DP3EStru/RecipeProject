<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @vite('resources/css/User_data.css')
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="email" name="email" class="input-field" placeholder="Email" required><br>
        <input type="password" name="password" class="input-field" placeholder="Password" required><br>
        <button type="submit" class="submit-btn">Login</button>
    </form>

    <?php
    // Simulate login validation (just for frontend, no actual backend)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // For demonstration, check if email and password match a dummy pair
        if ($email == 'test@example.com' && $password == 'password123') {
            echo "<p class='error-msg'>Login successful! Redirecting...</p>";
        } else {
            echo "<p class='error-msg'>Invalid credentials. Please try again.</p>";
        }
    }
    ?>
</div>

</body>
</html>