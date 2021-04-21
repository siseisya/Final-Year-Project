<?php
session_start();
error_reporting(0);
include('dbconnect.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {

    // Code for change password 
    if (isset($_POST['change'])) {
        $password = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $username = $_SESSION['emplogin'];
        $sql = "SELECT Password FROM student WHERE EmailId=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $con = "update student set Password=:newpassword where EmailId=:username";
            $chngpwd1 = $dbh->prepare($con);
            $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
            $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
            $chngpwd1->execute();
            $msg = "Your Password succesfully changed";
        } else {
            $error = "Your current password is wrong";
        }
    }
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Student | Change Password</title>

        <!-- Theme Styles -->
        <link href="alpha.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="background.css" rel="stylesheet" type="text/css" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Project">
        <meta name="author" content="Farisha">
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <div style="margin-left:15%">
            <div class="w3-container">
                <a href="myprofile.php" class="button3">Back</a>
                <h3>Change Password</h3>
                <div class="leftcolumn">
                    <div class="card">

                        <form class="col s12" name="chngpwd" method="post">
                            <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                            <div class="row">
                                <div class="input-field col s12">
                                <label for="password">Current Password</label>
                                    <input id="password" type="password" class="validate" autocomplete="off" name="password" required>
                                    
                                </div>

                                <div class="input-field col s12">
                                <label for="password">New Password</label>
                                    <input id="password" type="password" name="newpassword" class="validate" autocomplete="off" required>
                                  
                                </div>

                                <div class="input-field col s12">
                                <label for="password">Confirm Password</label>
                                    <input id="password" type="password" name="confirmpassword" class="validate" autocomplete="off" required>

                                </div>


                                <div class="input-field col s12">
                                    <button type="submit" name="change" onclick="return valid();">Change</button>

                                </div>




                            </div>

                        </form>
                    </div>
                </div>
            </div>


            <?php include('calendar.php'); ?>
        </div>


    </body>

    </html>
<?php } ?>