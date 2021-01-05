<?php
include 'config/database.php';
include 'actions/action-server.php';
?>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/app.css"/>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<main class="form-signin">
    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
        <h1 class="mb-4 text-center">Creative Clocks</h1>
        <!--Display Validation error message-->
        <?php
        include 'error/error.php';
        ?>
        <h5 class="h3 mb-3 fw-normal">Sign In</h5>

        <label for="inputUsername" class="visually-hidden">Username</label>
        <input type="text" id="inputUsername" maxlength="25" class="form-control mt-2" placeholder="Username"
               name="inputUsername"
               autofocus="" value="<?= htmlspecialchars($username); ?>">

        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" id="inputPassword" maxlength="50" class="form-control mt-2" name="inputPassword"
               placeholder="Password">

        <div class="checkbox mb-3 mt-2">
            <label>
                <input type="checkbox"
                       name="rememberMe" <?php if (isset($_COOKIE['user_cookie'])) { ?> checked <?php } ?>> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="login_submit">Sign in</button>
        <p class="mt-1">Not a member? <a href="register.php"> Sign up </a></p>
    </form>
</main>

<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>