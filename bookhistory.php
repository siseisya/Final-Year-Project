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
        <title>STUDENT | Boooking History</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Project">
        <meta name="author" content="Farisha">


    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <?php include('includes/sidebar.php'); ?>

        <div style="margin-left:20%">

            <div class="row">
                <div class="leftcolumn" style="background-color:white;">
                    <div class="card">

                        <h3>History Booking Applications</h3>
                        <section>
                            <table id="bookhistory" align="center">

                                <tr>
                                    <th>#</th>
                                    <th width="120">Programme</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Vehicle</th>
                                    <th width="120">Destination</th>
                                    <th width="250">Admin Remark</th>
                                    <th>Status</th>
                                </tr>


                                <tbody>
                                    <?php
                                    $eid = $_SESSION['eid'];
                                    $sql = "SELECT vehicle,ToDate,FromDate,Programme,Destination,AdminRemarkDate,AdminRemark,Status from trybook where empid=:eid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>
                                            <tr>
                                                <td> <?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($result->Programme); ?></td>
                                                <td><?php echo htmlentities($result->FromDate); ?></td>
                                                <td><?php echo htmlentities($result->ToDate); ?></td>
                                                <td><?php echo htmlentities($result->vehicle); ?></td>
                                                <td><?php echo htmlentities($result->Destination); ?></td>
                                                <td><?php if ($result->AdminRemark == "") {
                                                        echo htmlentities('waiting for approval');
                                                    } else {

                                                        echo htmlentities(($result->AdminRemark) . " " . "at" . " " . $result->AdminRemarkDate);
                                                    }

                                                    ?></td>
                                                <td><?php $stats = $result->Status;
                                                    if ($stats == 1) {
                                                    ?>
                                                        <span style="color: green">Approved</span>
                                                    <?php }
                                                    if ($stats == 2) { ?>
                                                        <span style="color: red">Not Approved</span>
                                                    <?php }
                                                    if ($stats == 0) { ?>
                                                        <span style="color: blue">waiting for approval</span>
                                                    <?php } ?>

                                                </td>

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
        



    </body>

    </html>
<?php } ?>