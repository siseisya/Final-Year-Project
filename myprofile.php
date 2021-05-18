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

    </head>

    <body>
        <?php include('includes/header.php'); ?>


        <div style="margin-left:15%">

            <div class="w3-container">
            <a href="update-student1.php" class="button3">Update Profiles</a>
                <h3 > My Profile</h3>

                <div class="row">
                    <div class="leftcolumn">
                        <div class="card" >
                            <table id="myprofile" align="center" >
                            <img src="a.jpg" alt="Avatar" class="avatar">
                              
                            <tbody>
                                    <?php
                                    $eid = $_SESSION['emplogin'];
                                    $sql = "SELECT * from  student where EmailId=:eid";
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
                                                <td style="font-size:16px;"><b> Username :</b></td>
                                                <td><?php echo htmlentities($result->Username); ?></td>

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
                                                <td style="font-size:16px;">  <b> College Of :</b></td>
                                                <td><?php echo htmlentities($result->Faculty); ?></td>

                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b> Year :</b></td>
                                                <td><?php echo htmlentities($result->Semester); ?></td>

                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;">  <b> Address :</b></td>
                                                <td><?php echo htmlentities($result->Address); ?></td>

                                            </tr>

                                    <?php $cnt++;
                                        }
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
            
            <?php include('calendar.php'); ?>
        </div>

    </body>

    </html>
<?php } ?>