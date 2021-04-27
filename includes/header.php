<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    /* Style the body */
    body {
      font-family: Arial;
      margin: 0;
    }

    /* Header/Logo Title */
    .header {
      padding: 20px;
      text-align: left;
      background: black;
      color: white;
      font-size: 30px;
    }

    /* Page Content */
    .content {
      padding: 15px;
    }

    a.button3 {
      display: inline-block;
      padding: 1.5em 2.5em;
      margin: 0 0.9em 0.9em 0;
      border-radius: 2em;
      box-sizing: border-box;
      text-decoration: none;
      font-family: 'Roboto', sans-serif;
      font-weight: 300;
      color: #FFFFFF;
      background-color: #4eb5f1;
      text-align: center;
      transition: all 0.2s;
    }

    a.button3:hover {
      background-color: #4095c6;
    }

    @media all and (max-width:30em) {
      a.button3 {
        display: block;
        margin: 0.2em auto;
      }
    }
  </style>
</head>

<body>
  <div class="header">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Bus Booking System | Student | Student Accommodation Centre (SAC)</a>
          <?php
          $eid = $_SESSION['eid'];
          $sql = "SELECT Fullname,Matric from student where id=:eid";
          $query = $dbh->prepare($sql);
          $query->bindParam(':eid', $eid, PDO::PARAM_STR);
          $query->execute();
          $results = $query->fetchAll(PDO::FETCH_OBJ);
          $cnt = 1;
          if ($query->rowCount() > 0) {
            foreach ($results as $result) {               ?>
              <a class="navbar-brand" href="#">User : <?php echo htmlentities($result->Fullname); ?></a>
              <a class="navbar-brand" href="#">Matric : <?php echo htmlentities($result->Matric); ?></a>

          <?php }
          } ?>

        </div>
      </div>

    </nav>
    <p>Student Portal</p>
  </div>


  <a href="myprofile.php" class="button3">My Profile</a>
  <a href="apply-book.php" class="button3">Bus Booking Applications </a>
  
  <a href="vehicle.php" class="button3">Vehicle</a>
  <a href="homepage.php" class="button3">Home</a>
  <a href="bookhistory.php" class="button3">Bus Booking History</a>
  <a href="changepassword.php" class="button3">Change Password</a>
  <a href="logout.php" class="button3">Logout</a>



</body>

</html>