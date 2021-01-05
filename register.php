<?php
include 'config/database.php';
include 'actions/action-server.php';
?>
<html>
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/app.css"/>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<main class="form-signin">
    <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>" autocomplete="off">
        <h1 class="mb-4 text-center">Creative Clocks</h1>
        <!--Display Validation error message-->
        <?php
        include 'error/error.php';
        ?>

        <h5 class="h3 mb-3 fw-normal">Sign up</h5>
        <label for="inputUsername" class="visually-hidden">Username</label>
        <input type="text" id="inputUsername" maxlength="25" class="form-control mt-2" placeholder="Username"
               name="inputUsername"
               autofocus="" value="<?= htmlspecialchars($username); ?>"
        >

        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input type="text" id="inputEmail" maxlength="100" class="form-control mt-2" name="inputEmail"
               placeholder="Email address"
               autofocus="" value="<?= htmlspecialchars($email); ?>">

        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" id="inputPassword" maxlength="50" class="form-control mt-2" name="inputPassword"
               placeholder="Password">

        <label for="inputConfirmPassword" class="visually-hidden">Confirm Password</label>
        <input type="password" id="inputConfirmPassword" maxlength="50" name="inputConfirmPassword"
               class="form-control mt-2 mb-2"
               placeholder="Confirm Password">

        <button class="w-100 btn btn-lg btn-primary" type="submit" name="registration_submit">Sign up</button>
        <p class="mt-1">Already a member? <a href="index.php"> Sign in </a></p>
    </form>
</main>

<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>