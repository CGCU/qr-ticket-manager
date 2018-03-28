<?php
/**
 * Created by PhpStorm.
 * User: andrewhill
 * Date: 14/10/2017
 * Time: 00:40
 */

session_start();
session_destroy();
session_start();

/* Initialise all strings to the empty string */
$username = $password = $err = '';

if(isset($_POST['sub'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    /* If correct password, allow entry
     * (union ldap auth functions at dougal.union.ic.ac.uk/sysadmin) */
    if (pam_auth($username, $password)) {

        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $username;


        /* Load databse config info */
        $db_ini = parse_ini_file('not-public/database.ini');
        $mysqli = new mysqli($db_ini['server_name'],
            $db_ini['db_user'],
            $db_ini['db_password'],
            $db_ini['db_name']
        );
        /* Delete database config info */
        unset($db_ini);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Database connection failed: %s\n", mysqli_connect_error());
            printf("Please email guilds@imperial.ac.uk!\n");
            exit();
        }

        //TODO: SQL INJECTION STOP

        $username = $mysqli->real_escape_string($username);

        // Add user to database if not there
        $query = 'INSERT IGNORE INTO `qr_users` (`username`) VALUES (?)';

        /* prepare sql statement */
        $stmt = $mysqli->prepare($query);

        $stmt->bind_param("s", $username);

        /* execute prepared statement */
        $stmt->execute();

        /* Close db connections */
        $stmt->close();
        $mysqli->close();

        /* Redirect to logged in page */
        header('LOCATION:index.php');
        die();

    } else {

        /* TODO: Temporary while pam_auth is fixed by sysadmin */
        $correct_password_hash = '$2y$10$/.E5UEd5JtnaC02Pvw6L1.mOf2VDcDtmWrqs9DDdvK3/fsHBWMBeW';
        $correct_username = 'guilds';
        /* If correct password, allow entry */
        if ($username === $correct_username && password_verify($password, $correct_password_hash)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            header('LOCATION:index.php');
            die();
        }
        /* End Temporary */

        unset($password);
        unset($_POST['password']);
        $err = 'Your username or password is incorrect. Please try again!';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }
        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin {
            margin-bottom: 10px;
        }
        .form-signin {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type="text"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        .error {
            padding-top: 5px;
        }
    </style>

    <title>CGCU QR System Login</title>

</head>

<body>

<form name='form-signin' class="form-signin" action='<?php echo $_SERVER['PHP_SELF'];?>' method='post'>
    <h2 class="form-signin-heading">CGCU QR Ticket System - CSP Login</h2>
    <label for='username'></label>
    <input type='text' value='<?php echo $username;?>' id='username' class="form-control" name='username' placeholder="Username" required autofocus />
    <label for='password'></label>
    <input type='password' value='<?php/* echo $password; */?>' class="form-control" id='password' name='password' placeholder="Password" required />
    <input type='submit' value='Submit' name='sub' class="btn btn-primary" />
    <div class="error"><?php echo "<p class='text-danger'>$err</p>";?> </div>
</form>

</body>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap: Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</html>