<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<body>

  <div class="w3-sidebar w3-bar-block w3-dark-grey w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>



    <div class="w3-dropdown-hover">
      <button class="w3-button">Manage Student
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="w3-dropdown-content w3-bar-block">
        <a href="manage-student.php" class="w3-bar-item w3-button">Manage Student </a>
      </div>
    </div>
    <a href="dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
    <div class="w3-dropdown-hover">
      <button class="w3-button">Bus Booking Management
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="w3-dropdown-content w3-bar-block">
        <a href="bookings.php" class="w3-bar-item w3-button">All Bus Booking </a>
        <a href="approvedbook-history.php" class="w3-bar-item w3-button">Approved Bus Booking </a>
        <a href="pendingbook-history.php" class="w3-bar-item w3-button">Pending Bus Booking </a>
        <a href="notapprovedbook-history.php" class="w3-bar-item w3-button">Rejected Bus Booking </a>
      </div>
    </div>

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