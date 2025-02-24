<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite('resources/css/User_data.css')
</head>
<body>
    <div class="container">
        <h1>Welcome to GymBro</h1>
        <a href="{{ route('MYlogin') }}">Login</a>
        <a href="{{ route('MYregister') }}">Register</a>
    </div>
</body>
</html>