<?php
session_start();

/* Registration Process */
$username = "";
$email = "";
$errors = array();

if (isset($_POST['registration_submit'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the input data from the registration form
        $username = trim($dbc->real_escape_string($_POST['inputUsername']));
        $password = trim($dbc->real_escape_string($_POST['inputPassword']));
        $email = trim($dbc->real_escape_string($_POST['inputEmail']));
        $cpassword = trim($dbc->real_escape_string($_POST['inputConfirmPassword']));

        /* Client-Side Validation Process*/
        // Ensure form fields are filled properly
        // If username | email | password fields are empty, add error message to error array
        if (empty($username)) {
            array_push($errors, "*Username is required");
        }
        if (empty($email)) {
            array_push($errors, "*Email is required");
        }
        if (empty($password)) {
            array_push($errors, "*Password is required");
        }

        /* Server-Side Validation Process using regex expressions*/
        // Username Field
        if (!preg_match("/^[a-zA-Z]*$/", $username)) {
            array_push($errors, "*Only Letters allowed in username");
        }

        if ((!preg_match("#[A-Z]+#", $password))) {
            array_push($errors, "*Password must contain at least 1 uppercase letter");
        }

        if (strlen($password) <= '8') {
            array_push($errors, "*Password must contain at least 8 characters");
        }

        // Email Field
        if (!empty($email)) {
            $email = trim(htmlspecialchars($email));
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email === false) {
                array_push($errors, "*Invalid Email format");
            }
        }

        // Password Field
        // If password match
        if ($password != $cpassword) {
            array_push($errors, "*The two password do not match");
        }

        //If no errors, user is saved to the database
        if (count($errors) == 0) {
            // Encrypt password before storing in the database
            $hash = md5($password);

            // Insert into database using prepared statement
            $sql = "INSERT INTO tbl_users(username, email, password) VALUES (?,?,?)";
            if ($stmt = mysqli_prepare($dbc, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash);
                mysqli_stmt_execute($stmt);
            } else {
                echo "ERROR: Could not prepare query: $sql. " . mysqli_error($dbc);
            }

            /* Creating session */
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header("Location:home.php");
        }
    }
}

/* Login Process */
if (isset($_POST['login_submit'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($dbc->real_escape_string($_POST['inputUsername']));
        $password = trim($dbc->real_escape_string($_POST['inputPassword']));
        $rememberMe = trim($dbc->real_escape_string($_POST['rememberMe']));
        $id = 0;
        $status = "";

        /* Remember me using cookie*/
        // setting the cookie
        $week = new DateTime('+1 week'); // will expire in 1 week
        // https has been set to true i.e The cookie should only be transmitted over a secure HTTPS connection from the client.
        // if set to false you will be able to see the cookie by going to F12 - APPLICATION - COOKIES - LOCALHOST
        // e.g setcookie("user_cookie", $username, $week->getTimestamp(), '/', null, false, null);
        setcookie("user_cookie", $username, $week->getTimestamp(), '/', null, false, null);

        /* Fields Validations */
        if (empty($username)) {
            array_push($errors, "*Username is required");
        }
        if (empty($password)) {
            array_push($errors, "*Password is required");
        }

        /* Log user in using prepared statement*/
        if (count($errors == 0)) {
            //Encrypt password
            $hash = md5($password);
            $stmt = $dbc->prepare("SELECT id, username, password, status FROM tbl_users WHERE username=? AND password=? LIMIT 1");
            $stmt->bind_param('ss', $username, $hash);
            $stmt->execute();

            $stmt->bind_result($id, $username, $hash, $status);
            $stmt->store_result();

            //To check if the row exists
            if ($stmt->num_rows == 1) {
                //fetching the contents of the row
                if ($stmt->fetch()) {

                    if ($status == '1') {
                        echo "YOUR account has been DEACTIVATED.";
                        exit();
                    } else {
                        // this line of code will prevent session fixation i.e it will regenerate the user
                        // session if once they had sucessfully logged in. therefore the attacker cannot get their session id
                        // we deleted the old session and regenerate a new one
                        // in short we keep the user data but change its session id
                        session_regenerate_id(true);
                        $_SESSION['login'] = 1;
                        $_SESSION['user_id'] = $id;
                        $_SESSION['username'] = $username;
                        header('Location:home.php');
                        exit();
                    }
                }
            } else {
                array_push($errors, "Invalid Username/Password Combinations");
                header('index.php');
            }
            $stmt->close();
        }
        $dbc->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    /* Logout */
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location:../index.php');
    }
}