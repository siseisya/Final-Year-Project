<?php
session_start();
error_reporting(0);
include('includes/dbconnect.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Theme Styles -->
        <link href="css/alpha-admin.css" rel="stylesheet" type="text/css" />
        <link href="css/table-alpha-admin.css" rel="stylesheet" type="text/css" />


        <!-- Title -->
        <title>Admin | Dashboard</title>
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

            <h3>Student Details </h3>
                <table id="edit">
                    <tbody>
                        <?php

                        $eid = intval($_GET['empid']);
                        $sql = "SELECT * from  student where id=:eid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {

                        ?>
                                <tr>
                                    <td style="font-size:16px;"> <b> Name :</b> </td>
                                    <td>
                                        <?php echo htmlentities($result->Fullname); ?></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b> Email :</b></td>
                                    <td><?php echo htmlentities($result->EmailId); ?></td>

                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b> Matric :</b></td>
                                    <td><?php echo htmlentities($result->Matric); ?></td>

                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b> Contact No. :</b></td>
                                    <td><?php echo htmlentities($result->Phonenumber); ?></td>

                                </tr>

                                <tr>
                                    <td style="font-size:16px;"> <b> Faculty :</b></td>
                                    <td><?php echo htmlentities($result->Faculty); ?></td>

                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b> Semester :</b></td>
                                    <td><?php echo htmlentities($result->Semester); ?></td>

                                </tr>

                                <tr>
                                    <td style="font-size:16px;"> <b> Address :</b></td>
                                    <td><?php echo htmlentities($result->Address); ?></td>

                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b> Type of : </b></td>
                                    <td colspan="5"><?php echo htmlentities($result->TypeS); ?></td>
                                    <td><button onclick="document.location='bookings.php'">Back</button></td>
                                </tr>

                        <?php $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>




            </div>
        </div>


    </body>

    </html>
<?php } ?>