<?php
if (!isset($_SESSION)) session_start();

if (($_SESSION['userlevel'] === NULL) OR ($_SESSION['userlevel'] == 0)) {
    die ("<h3 style='text-align: center; color: coral; margin-bottom: 10px'><span style='color: red'>Haha</span>! C'mon you can do better!</h3><form style='text-align: center' action=\"logout.php\" method=\"post\"><button style='font-size: larger' class=\"form1 btn btn-info btn-block\">Back</button><br/><br/></form>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Save others' username (Admin) : CCNB</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="icon" href="img/logo.png" type="image/x-icon">
</head>
<body>

    <?php
        require 'connect.php';

        if (isset($_POST['username']) && isset($_POST['username2']) && isset($_POST['password'])) {
            $username = addslashes($_POST['username']);
            $username2 = addslashes($_POST['username2']);
            $pass = md5($_POST['password']);
            $departmentID = $_SESSION['departId'];

            if ($username === $username2) {

                $query2 = "SELECT * FROM login_details WHERE departmentId='$departmentID'";
                $result2 = mysqli_query($mysql, $query2) or die ('<h3>Sorry! Couldn\'t connect!.1</h3>');
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $user = $row2['username'];
                    $name = $row2['name'];

                    if ($username2 != $user) {

                        if ($_SESSION['password'] === $pass) {

                            $query = "SELECT * FROM login_details WHERE username='$user'";
                            $result = mysqli_query($mysql, $query) or die ('<h3>Sorry! Couldn\'t connect!.1</h3>');

                            $query1 = "UPDATE login_details SET username='$username2' WHERE username='$user'";
                            $result1 = mysqli_query($mysql, $query1) or die ("<h4 style='color: red; text-align: center'>or</h4><h3 style='text-align: center; color: coral; margin-bottom: 10px'>Username <span style='color: red'>not</span> available!</h3><div class=\"form\">
                                                            <a href=\"edit_others_username.php\" class=\"form2 btn btn-info btn-block\">Change username</a>
                                                            <a href=\"edit_others_password.php\" class=\"form2 btn btn-danger btn-block\">Change password</a><br/>
                                                            <a href=\"edit_others_department.php\" class=\"form2 btn btn-warning btn-block\">Change Department's name</a>
                                                            <a href=\"edit_others_description.php\" class=\"form2 btn btn-warning btn-block\">Change Department's description</a>
                                                            <a href=\"edit_others_link.php\" class=\"form2 btn btn-warning btn-block\">Change Department's link</a><br/>
                                                            <a href=\"edit_others_name.php\" class=\"form2 btn btn-info btn-block\">Change Profile Name</a>
                                                            <a href=\"edit_others_designation.php\" class=\"form2 btn btn-primary btn-block\">Change Designation</a>
                                                            <a href=\"edit_others_website.php\" class=\"form2 btn btn-primary btn-block\">Change Website</a> 
                                                            <a href=\"edit_others_phone.php\" class=\"form2 btn btn-primary btn-block\">Change Phone number</a>
                                                            <a href=\"edit_others_email.php\" class=\"form2 btn btn-primary btn-block\">Change E-mail</a><br/>
                                                            <a href=\"edit_userlevel.php\" class=\"form2 btn btn-danger btn-block\">Change level : Admin or User</a>
                                                        </div>
                                                        <form action=\"edit_others_user.php\" method=\"post\">
                                                            <button class=\"form1 btn btn-success btn-block\">Back</button>
                                                        </form>");

                            echo "<h3 style='text-align: center; color: #2daae4; margin-bottom: 10px'>Dear <span style='color: dodgerblue'>" . $_SESSION['name'] . "</span>, you've updated <span style='color: dodgerblue'>".$name."</span>'s username successfully!</h3>";
                            echo '
                                                        <div class="form">
                                                            <a href="edit_others_username.php" class="form2 btn btn-info btn-block">Change username</a>
                                                            <a href="edit_others_password.php" class="form2 btn btn-danger btn-block">Change password</a><br/>
                                                            <a href="edit_others_department.php" class="form2 btn btn-warning btn-block">Change Department\'s name</a>
                                                            <a href="edit_others_description.php" class="form2 btn btn-warning btn-block">Change Department\'s description</a>
                                                            <a href="edit_others_link.php" class="form2 btn btn-warning btn-block">Change Department\'s link</a><br/>
                                                            <a href="edit_others_name.php" class="form2 btn btn-info btn-block">Change Profile Name</a>
                                                            <a href="edit_others_designation.php" class="form2 btn btn-primary btn-block">Change Designation</a>
                                                            <a href="edit_others_website.php" class="form2 btn btn-primary btn-block">Change Website</a> 
                                                            <a href="edit_others_phone.php" class="form2 btn btn-primary btn-block">Change Phone number</a>
                                                            <a href="edit_others_email.php" class="form2 btn btn-primary btn-block">Change E-mail</a><br/>
                                                            <a href="edit_userlevel.php" class="form2 btn btn-danger btn-block">Change level : Admin or User</a>
                                                        </div>
                                                        <form action="edit_others_user.php" method="post">
                                                            <button class="form1 btn btn-success btn-block">Back</button>
                                                        </form>
                                                
                                                    ';
                        } else {
                            echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>Make sure your <span style='color: red'>password</span> is correct!</h3>";
                            include 'edit_others_username.php';
                        }
                    } else {
                        echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>New and old username <span style='color: red'>shouldn't</span>  be same!</h3>";
                        include 'edit_others_username.php';
                    }
                }
            } else {
                echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'>New username(s) <span style='color: red'>don't</span> match!</h3>";
                include 'edit_others_username.php';
            }

        } else {
            echo "<h3 style='text-align: center; color: coral; margin-bottom: 10px'><span style='color: red'>Sorry</span>! Couldn't read data.</h3>";
            include "edit_others_username.php";
        }

    ?>

</body>
</html>