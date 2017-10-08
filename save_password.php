<?php
if (!isset($_SESSION)) session_start();

    if (($_SESSION['userlevel'] === NULL) OR ($_SESSION['userlevel'] == 0)) {
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <title>Save password (Non-Admin) : CCNB</title>
                    <meta charset=\"utf-8\">
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                    <link rel=\"stylesheet\" href=\"css/style.css\">
                    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
                    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
                    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
                    <link href=\"//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css\" rel=\"stylesheet\">
                    <link rel=\"shortcut icon\" href=\"img/logo.png\" type=\"image/x-icon\">
                    <link rel=\"icon\" href=\"img/logo.png\" type=\"image/x-icon\">
                </head>
                <body>";
    } else {
        echo "<!DOCTYPE html>
                <html lang=\"en\">
                <head>
                    <title>Save password (Admin) : CCNB</title>
                    <meta charset=\"utf-8\">
                    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
                    <link rel=\"stylesheet\" href=\"css/style.css\">
                    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
                    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
                    <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
                    <link href=\"//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css\" rel=\"stylesheet\">
                    <link rel=\"shortcut icon\" href=\"img/logo.png\" type=\"image/x-icon\">
                    <link rel=\"icon\" href=\"img/logo.png\" type=\"image/x-icon\">
                </head>
                <body>";
    }

?>



    <?php
        require 'connect.php';

        if (isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['password2'])) {
            $password = md5($_POST['password']);
            $password1 = md5($_POST['password1']);
            $password2 = md5($_POST['password2']);
            $user = $_SESSION['username'];
            $pass = $_SESSION['password'];

            if ($password === $pass) {

                if ($password1 === $password2) {

                    $query = "SELECT * FROM login_details WHERE username='$user'";
                    $result = mysqli_query($mysql, $query) or die ('<h3>Sorry! Couldn\'t connect!.1</h3>');

                    $query1 = "UPDATE login_details SET password='$password2' WHERE username='$user'";
                    $result1 = mysqli_query($mysql, $query1) or die ("<form action=\"edit_password.php\" method=\"post\"><button class=\"form1 btn btn-success btn-block\">Back</button></form>");

                    if (($_SESSION['userlevel'] === NULL) OR ($_SESSION['userlevel'] == 0)) {

                        echo "<h3 style='text-align: center; color: #2daae4; margin-bottom: 10px'>Dear <span style='color: dodgerblue'>" . $_SESSION['name'] . "</span>, your <span style='color: dodgerblue'>password</span> has been updated successfully!</h3>";
                        echo '
                                                            <form action="edit_profile.php" method="post">
                                                                <button class="form1 btn btn-warning btn-block">Edit profile</button>
                                                            </form>
                                                            <div class="form">
                                                                <a href="write_post.php" class="form2 btn btn-info btn-block">Write a post</a>
                                                                <a href="view_post.php" class="form2 btn btn-success btn-block">View posts</a>
                                                            </div>
                                                            <form action="logout.php" method="post">
                                                                <button class="form1 btn btn-danger btn-block">Logout</button>
                                                            </form>
                                                        
                                                            ';

                        $_SESSION['password'] = $password2;
                    } else {
                        echo "<h3 style='text-align: center; color: #2daae4; margin-bottom: 10px'>Dear <span style='color: dodgerblue'>" . $_SESSION['name'] . "</span>, your <span style='color: dodgerblue'>password</span> has been updated successfully!</h3>";
                        echo '
                                                            <form action="edit_profile.php" method="post">
                                                                <button class="form1 btn btn-warning btn-block">Edit profile</button>
                                                            </form>
                                                            <form action="edit_others_profile.php" method="post">
                                                                <button class="form1 btn btn-danger btn-block">Edit others\' profile</button>
                                                            </form>
                                                            <form action="add.php" method="post">
                                                                <button class="form1 btn btn-primary btn-block">Add Account</button>
                                                            </form>
                                                            <div class="form">
                                                                <a href="write_post.php" class="form2 btn btn-info btn-block">Write a post</a>
                                                                <a href="view_post.php" class="form2 btn btn-success btn-block">View posts</a>
                                                            </div>
                                                            <form action="logout.php" method="post">
                                                                <button class="form1 btn btn-danger btn-block">Logout</button>
                                                            </form>
                                                        
                                                            ';

                        $_SESSION['password'] = $password2;
                    }

                } else {
                    echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Your new <span style='color: red'>passwords</span>  don't match!</h3>";
                    include 'edit_password.php';
                }
            } else {
                echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Your <span style='color: red'>password</span> is incorrect!</h3>";
                include 'edit_password.php';
            }

        } else {
            echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'><span style='color: red'>Sorry</span>! Couldn't read data.</h3>";
            include "edit_password.php";
        }

    ?>
