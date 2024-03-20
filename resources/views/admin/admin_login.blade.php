<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Practice</title>
    <link rel="stylesheet" href="css/app.css">
    <?php
        //if(DB::connection()->getDatabaseName())
        //        {
        //            echo "Nice Dann, you are successfully connected to the database named ".DB::connection()->getDatabaseName(). " in the phpmyadmin <br>"; 
        //            echo "<strong>Hello Dan</strong>";
        //        }
    ?>
</head>
<body>

    @auth
    <p>Congrats, you are logged in</p>
    <form action="/logout" method="POST">
        @csrf
        <button>Log Out</button>
    </form>

    @else
    <h1>THIS IS ADMIN PAGE</h1>
    <div style="border:3px solid black;">
    <h2>Register as User</h2>
    <form action ="/register" method="POST">
        @csrf
        <label>Full Name:</label>
        <input name="name" type="text" placeholder="Full Name"><br>
        <label>Email:</label>
        <input name="email" type="text" placeholder="Your Email"><br>
        <label>Password:</label>
        <input name="password" type="password" placeholder="Your Password">
        <br>
        <input type="submit" value="Register" style="width: 100px; margin-top: 10px;">
    </form>
    </div>

    <div style="border:3px solid black;">
        <h2>Login as User</h2>
        <form action ="/login" method="POST">
            @csrf
            <label>Email:</label>
            <input name="login_email" type="text" placeholder="Your Email"><br>
            <label>Password:</label>
            <input name="login_password" type="password" placeholder="Your Password">
            <br>
            <input type="submit" value="login" style="width: 100px; margin-top: 10px;">
        </form>
        </div>

    @endauth

</body>
</html>