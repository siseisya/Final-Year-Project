<?php
session_start();
error_reporting(0);
include('dbconnect.php');
// Code for change password 
if (isset($_POST['change'])) {
    $newpassword = $_POST['newpassword'];
    $empid = $_SESSION['empid'];

    $con = "update student set Password=:newpassword where id=:empid";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1->bindParam(':empid', $empid, PDO::PARAM_STR);
    $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    $msg = "Your Password succesfully changed";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Theme Styles -->
    <link href="alpha.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Title -->
    <title>BBS | Password Recovery</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Project">
    <meta name="author" content="Farisha">

</head>

<body>

    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
        <a href="admin/index.php" class="w3-bar-item w3-button">Admin Login</a>
        <a href="https://learning5.uum.edu.my/ss2021/" class="w3-bar-item w3-button">UUM Online Learning</a>

    </div>

    <div id="main">

        <div class="w3-grey">
            <button id="openNav" class="w3-button w3-grey w3-xlarge" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>Bus Booking System | UUM Portal</h1>
            </div>
        </div>

        <div class="w3-container" align="center">
            <img src="header.jpg" alt="header" width="1000" height="300" align="center">

         
            <h2 align="center"><b>Student Password Recovery</b></h2>
            <form method="post" name="signin">

                <table align="center">
                    <tr>
                        <td>Matric : <input type="text" name="empid" value="" required> </td>
                    </tr>

                 
                    <tr>
                        <td><input type="submit" name="submit" value="Submit"> </td>
                    </tr>

                    <tr>
                        <td><button onclick="document.location='index.php'">Back</button></td>
            
                    </tr>
                </table>
            </form>

        </div>


        <?php if (isset($_POST['submit'])) {
            $empid = $_POST['empid'];
        
            $sql = "SELECT id FROM student WHERE  Matric=:empid";
            $query = $dbh->prepare($sql);
          
            $query->bindParam(':empid', $empid, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {
                    $_SESSION['empid'] = $result->id;
                }
        ?>

                <h2 align="center"><b>Change Password</b></h2>
                <form method="post" name="udatepwd">

                    <table align="center">
                        <tr>
                            <td>New Password : <input type="password" name="newpassword" value="" required> </td>
                        </tr>

                        <tr>
                            <td>Confirm Password : <input type="password" name="confirmpassword" value="" required> </td>
                        </tr>

                        <tr>
                            <td><input type="submit" name="change" value="Change"> </td>
                        </tr>
                    </table>
                    <form>


                    <?php } else { ?>

                        <strong>ERROR</strong> : <?php echo htmlentities("Invalid details");
                                                } ?>

    </div>
<?php } ?>
<script>
    function w3_open() {
        document.getElementById("main").style.marginLeft = "25%";
        document.getElementById("mySidebar").style.width = "25%";
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("openNav").style.display = 'none';
    }

    function w3_close() {
        document.getElementById("main").style.marginLeft = "0%";
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("openNav").style.display = "inline-block";
    }
</script>


</body>

</html>