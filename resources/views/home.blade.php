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
        <h1>Welcome to Reciepe Page</h1>
        <a href="{{ route('Mylogin') }}">Login</a>
        <a href="{{ route('Myregister') }}">Register</a>
    </div>
</body>
</html>