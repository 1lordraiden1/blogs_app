<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
    <h2>Register</h2>
    <form action='/register' method="POST">
    @csrf

    <input type="text" placeholder="name">
    <input type="text" placeholder="email">
    <input type="password" placeholder="password">
    <button type="submit">Register</button>
</form>
</body>

</html>