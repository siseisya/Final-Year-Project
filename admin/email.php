<?php
session_start();
error_reporting(0);
include('includes/dbconnect.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

     // Sending email
     if (mail($to, $subject, $message)) {
        echo 'Your mail has been sent successfully.';
    } else {
        echo 'Unable to send email. Please try again.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Title -->
    <title>Admin | Bus Applications Details</title>
    <!-- Theme Styles -->
    <link href="css/alpha-admin.css" rel="stylesheet" type="text/css" />
    <link href="css/table-alpha-admin.css" rel="stylesheet" type="text/css" />

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Project">
    <meta name="author" content="Farisha">


</head>

<body>
    <?php include('includes/header.php'); ?>

    <?php include('includes/sidebar.php'); ?>

    <div style="margin-left:20%">

        <div class="w3-container">

            <h3>Bus Applications Details</h3>

            <?php
            $to = 'siseisya@gmail.com';
            $subject = 'Student Bus Applications';
            $message = 'Sac?';
            $from = 'siseisya98@gmail.com';

           
            ?>


        </div>



    </div>

    </div>

</body>

</html>