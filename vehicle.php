<?php
session_start();
error_reporting(0);
include('dbconnect.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Theme Styles -->
        <link href="alpha.css" rel="stylesheet" type="text/css" />
        <link href="table.css" rel="stylesheet" type="text/css" />
        <link href="background.css" rel="stylesheet" type="text/css" />


        <!-- Title -->
        <title>Student | Student Profile</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <meta charset="UTF-8">


        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Project">
        <meta name="author" content="Farisha">
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            /* Float four columns side by side */
            .column {
                float: left;
                width: 25%;
                padding: 0 10px;
            }

            /* Remove extra left and right margins, due to padding */
            .row {
                margin: 0 -5px;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Responsive columns */
            @media screen and (max-width: 600px) {
                .column {
                    width: 100%;
                    display: block;
                    margin-bottom: 20px;
                }
            }

            /* Style the counter cards */
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                padding: 16px;
                text-align: center;
                background-color: #f1f1f1;
            }
        </style>
    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <div style="margin-left:15%">
            <div class="w3-container">
                <h2>Student Accommodation Centre </h2>
                <p>Student Accommodation Centre (SAC) provides good quality accommodation to local and international students.
                    In addition, SAC also manages on campus bus services.</p>

                
                    <div class="column">
                        <div class="card">
                            <h3>UUM Bus</h3>
                            <p>Total Passengers: 40 peoples</p>
                            <p>Total Bus: 10</p>
                            <p> <img src="avatar.jpg" alt="Avatar" class="avatar"></p>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <h3>UNIC Bus</h3>
                            <p>Total Passengers: 40 peoples</p>
                            <p>Total Bus: 10</p>
                            <p> <img src="unic.jpg" alt="Avatar" class="avatar"></p>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <h3>UNIC Shuttle Bus</h3>
                            <p>Total Passengers: 40 peoples</p>
                            <p>Total Bus: 10</p>
                            <p> <img src="unic.jpg" alt="Avatar" class="avatar"></p>
                        </div>
                    </div>

                    <div class="column">
                        <div class="card">
                            <h3>Van</h3>
                            <p>Total Passengers: 40 peoples</p>
                            <p>Total Bus: 10</p>
                            <p> <img src="avatar.jpg" alt="Avatar" class="avatar"></p>
                        </div>
                    </div>



                

            </div> 
        </div>
       
    </body>

    </html>
<?php } ?>