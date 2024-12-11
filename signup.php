<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup_wrapper">
        <div class="signup_header">Signup</div>
        <div id="error"></div>
        <form action="" id="my_form">
            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <div class="gender-container">
                <br>Gender<br>
                <input type="radio" value="Male" name="gender" value="male">Male<br>
                <input type="radio" value="Female" name="gender" value="female">Female<br>
            </div>
            <input type="password" name="password" placeholder="Password"><br>
            <input type="password" name="password2" placeholder="Retype Password"><br>
            <input type="button" value="Sign Up" id="signup_btn"><br>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>