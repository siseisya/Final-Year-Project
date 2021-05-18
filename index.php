<?php
session_start();
error_reporting(0);
include('dbconnect.php');
if (isset($_POST['signin'])) {
  $uname = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT EmailId,Password,Status,id FROM student WHERE EmailId=:uname and Password=:password";
  $query = $dbh->prepare($sql);
  $query->bindParam(':uname', $uname, PDO::PARAM_STR);
  $query->bindParam(':password', $password, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      $status = $result->Status;
      $_SESSION['eid'] = $result->id;
    }
    if ($status == 0) {
      $msg = "Your account is Inactive. Please contact admin";
    } else {
      $_SESSION['emplogin'] = $_POST['username'];
      echo "<script type='text/javascript'> document.location = 'myprofile.php'; </script>";
    }
  } else {

    echo "<script>alert('Invalid Details');</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Theme Styles -->
  <link href="alpha.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Project">
  <meta name="author" content="Farisha">

  <title>Student Login</title>

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
      <h2 align="center"><b>Student Login</b></h2>
      <form method="post" name="signin">
        <table class="table table-bordered table-inverse table-responsive">
          <tbody>

            <tr>

            <tr>
              <td><b>Email :</b> <input type="text" name="username" value="" required> </td>
            </tr>

            <tr>
              <td><b>Password :</b> <input type="password" name="password" value="" required> </td>
            </tr>

            <tr>
              <td>
                <a href="forgotpassword1.php"></b>Forgot Password</b></a>
              </td>
            </tr>

            <tr>
              <td><input type="submit" name="signin" value="Log in"> </td>
            </tr>

          </tbody>
        </table>
        <form>
    </div>

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