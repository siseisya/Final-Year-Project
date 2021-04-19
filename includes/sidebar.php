<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<body>

  <div class="w3-sidebar w3-bar-block w3-dark-grey w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>

    <div class="w3-dropdown-hover">
      <button class="w3-button">Student Profile
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="w3-dropdown-content w3-bar-block">
        <a href="myprofile.php" class="w3-bar-item w3-button">My Profile</a>
        <a href="myprofile1.php" class="w3-bar-item w3-button">My Profile1</a>
        <a href="update-student1.php" class="w3-bar-item w3-button">Update Profile</a>
      </div>
    </div>

    <div class="w3-dropdown-hover">
      <button class="w3-button">Bus Application
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="w3-dropdown-content w3-bar-block">
        <a href="apply-book.php" class="w3-bar-item w3-button">New Application</a>
        <a href="bookhistory.php" class="w3-bar-item w3-button">Booking History</a>
        <a href="bookhistory1.php" class="w3-bar-item w3-button">Booking History 1</a>
      </div>
    </div>
    <a href="vehicle.php" class="w3-bar-item w3-button">Type Vehicle</a>
    <a href="logout.php" class="w3-bar-item w3-button">Logout</a>
  </div>



  <div>
    <button class="w3-button w3-white w3-xxlarge" onclick="w3_open()">&#9776;</button>
    <div class="w3-container">


    </div>
  </div>

  <script>
    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
    }

    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
    }
  </script>

</body>

</html>