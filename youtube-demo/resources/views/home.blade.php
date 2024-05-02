<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel CRUD</title>
    <style>
        body {
            width: auto;
            height: 100vh
        }

        .auth {
            padding: 10px;
            border: 2px solid black;
            display: flex;
            flex-direction: column;
            text-align: center;
            align-items: center;
        }

        .registerForm {}

        .fields {
            padding: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="auth">
        <div class="registerForm">
            <h4>Register New Account</h1>
                <form action="/register" method="POST">
                    <input class="fields" type="text" required name="name" placeholder="Enter Your Name"><br>
                    <input class="fields" type="text" required name="email" placeholder="Enter Your Email"><br>
                    <input class="fields" type="password" required name="password" placeholder="Enter Your Password"><br>
                    <input type="submit" name="submit" id="submit">
                </form>
        </div>
        <div class="loginForm">
            <h4>Login to continue</h1>
                <form action="">
                    <input class="fields" type="text" required name="useremail" placeholder="Enter Your Email"><br>
                    <input class="fields" type="password" required name="userpassword" placeholder="Enter Your Password"><br>
                    <input type="submit" name="submit" id="submit">
                </form>
        </div>
    </div>
</body>

</html>