<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Practice</title>
    <link rel="stylesheet" href="#"/>
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

    <div style="border:3px solid black;">
        <h2>Create new post</h2>
        <form action="/create-post" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Post Title"><br>
            <textarea name="body" placeholder="Write something here.." style="width: 300px;"></textarea><br>
            <input type="submit" value="Create Post" style="width: 100px; margin-top: 10px;">
        </form>
    </div>

    <div style="border:3px solid black; margin-top:10px;">
        <h2>All Posts</h2>
        @foreach ($posts as $post)
        <div style="background-color:blue; padding:10px; margin:5px; color:white;">
            <h3>{{$post['title']}}</h3>
            {{$post['body']}}
            <p><a href="/edit-post/{{$post->id}}" style="background-color:black; text-decoration:none; color:white; outline: medium none; border: 1px solid black;">Edit</a></p>
            <form action="/delete-post/{{$post->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button>DELETE</button>
            </form>
        </div>
        @endforeach
    </div>

    @else
    <h1 class="header" style="textcen">THIS IS USER LOGIN PAGE</h1>
   <!-- <a href="/admin_login"><h4>Button</h4></a> -->
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