<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<style>
  img {
    border-radius: 5px;
  }

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

<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Bus Booking System | Admin | Student Accommodation Centre (SAC) </a><br>
        <img src="includes/sac.jpg" alt="header">
      </div>

    </div>
  </nav>

  <a href="dashboard.php" class="button3">Dashboard</a>
  <a href="manage-student.php" class="button3">Manages Students</a>

  <a href="bookings.php" class="button3">List of Bus Booking Applications</a>

  <a href="logout.php" class="button3">Logout</a>

  <div class="container">
    <h3>BBS | Admin Portal | Student Accommodation Centre (SAC)</h3>

  </div>

</body>

</html>