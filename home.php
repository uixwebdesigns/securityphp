<?php include 'actions/action-server.php'; ?>

<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/app.css"/>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css"/>
</head>
<body>
<?php
// Check if has session success
if (isset($_SESSION['success'])) {
    ?>
    <div class="alert alert-success text-center">
        You are now logged in.
        <?php
        $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
    </div>
    <?php
}
?>
<nav id="topNav" class="navbar fixed-to navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand mx-auto" href="/">
        <!--Your logo goes here-->
        <img class="rounded-circle" height="50" width="50" src="img/logo.png" alt="logo/brand">
        <span class="text-dark">Creative Clocks</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="navbar-toggler-icon"></span></button>

    <div class="navbar-collapse collapse float-right">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Products/Services</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
        </ul>
    </div>

</nav>

<?php

// Check if has session username
if (isset($_SESSION['username'])) {
    ?>
    <p>Welcome <?= $_SESSION['username']; ?></p>
    <a href="index.php?logout='1'">Logout</a>
    <?php
}
?>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>