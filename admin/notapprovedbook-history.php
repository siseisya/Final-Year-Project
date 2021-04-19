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

                <h3>Rejected Bus Booking Applications History</h3>
                    <?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                    <table id="notapproved">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="200">Student Name</th>
                                <th width="120"> Programme</th>
                                <th width="180">Posting Date</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $status = 2;
                            $sql = "SELECT trybook.id as lid, student.Fullname, student.Matric, student.id, trybook.Programme, trybook.PostingDate, trybook.Status 
from trybook join student on trybook.empid=student.id where trybook.Status=:status order by lid desc";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':status', $status, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {
                            ?>

                                    <tr>
                                        <td> <b><?php echo htmlentities($cnt); ?></b></td>
                                        <td><a href="editstudent.php?empid=<?php echo htmlentities($result->id); ?>" target="_blank"><?php echo htmlentities($result->FirstName . " " . $result->Fullname); ?>(<?php echo htmlentities($result->Matric); ?>)</a></td>
                                        <td><?php echo htmlentities($result->Programme); ?></td>
                                        <td><?php echo htmlentities($result->PostingDate); ?></td>
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


                                        <td><a href="booking-details.php?bookid=<?php echo htmlentities($result->lid); ?>" class="waves-effect waves-light btn blue m-b-xs"> Details</a></td>
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