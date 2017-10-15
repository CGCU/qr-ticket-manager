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
//$correct_password_hash = '$2y$10$/.E5UEd5JtnaC02Pvw6L1.mOf2VDcDtmWrqs9DDdvK3/fsHBWMBeW';
//$correctUsername = 'guilds';

if(isset($_POST['sub'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    /* Open DB Connection */

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

    /* Query finds if username is in db */
    $query = "SELECT * FROM qr_users WHERE username = '" . $username . "'";

    /* prepare sql statement */
    $stmt = $mysqli->prepare($query);

    /* execute prepared statement */
    $stmt->execute();

    /* get result obj */
    $result = $stmt->get_result();

    /* If there's a row present, one row should be present and it should contain the username */
    $num_rows = $result->num_rows;
    if($num_rows != 0) {
        /* Error check: if more than one row something is wrong */
        if ($num_rows > 1) {
            printf("Error on login script: more than one username row\n");
            printf("Please email guilds@imperial.ac.uk\n");
            $stmt->close();
            $mysqli->close();
            die();
        }

        /* Get Row */
        $row = $result->fetch_assoc();

        /* Error Check: if username isnt the one we're expecting */
        if ($row['username'] !== $username) {
            printf("Error on login script: username != username\n");
            printf("Please email guilds@imperial.ac.uk\n");
            $stmt->close();
            $mysqli->close();
            die();
        }

        /* If correct password, allow entry */
        if(password_verify($password, $row['password_hash'])) {
            /* Close db connections */
            $stmt->close();
            $mysqli->close();

            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            header('LOCATION:index.php');
            die();

        } else {
            $err = 'Your username or password is incorrect. Please try again!';
        }

    } else {
        $err = 'Your username or password is incorrect. Please try again!';
    }

    /* Close db connections */
    $stmt->close();
    $mysqli->close();

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

    <title>CGCU Admin Login</title>

</head>

<body>

<form name='form-signin' class="form-signin" action='<?php echo $_SERVER['PHP_SELF'];?>' method='post'>
    <h2 class="form-signin-heading">CGCU QR Ticket System</h2>
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