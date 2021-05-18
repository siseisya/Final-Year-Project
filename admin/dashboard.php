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
        <link href="css/background-admin.css" rel="stylesheet" type="text/css" />


        <!-- Title -->
        <title>Admin | Dashboard</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Project">
        <meta name="author" content="Farisha">
        
        <style>

            body {
                background-image: url('admin/uum3.jpg');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100% 100%;
            }
        </style>

    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <div style="margin-left:20%">

            <div class="w3-container">

                <div class="middle-content">
                    <div class="row no-m-t no-m-b">

                        <div class="col s12 m12 l4">
                            <div class="card stats-card">
                                <div class="card-content">
                                    <span class="card-title">Listed booking : </span>
                                    <?php
                                    $sql = "SELECT id from  trybook";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $leavtypcount = $query->rowCount();
                                    ?>
                                    <span class="stats-counter"><span class="counter"><?php echo htmlentities($leavtypcount); ?></span></span>

                                </div>
                                <div class="progress stats-card-progress">
                                    <div class="determinate" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3>Latest Booking Applications</h3>
                    <section>
                        <table id="dashboard">

                            <tr>
                                <th>#</th>
                                <th width="200">Full Name</th>
                                <th width="120">Programme</th>
                                <th width="180">Posting Date</th>
                                <th>Status</th>
                                <th>View</th>

                            </tr>


                            <tbody>
                                <?php $sql = "SELECT trybook.id as lid, student.Fullname, student.Matric, student.id, trybook.Programme, trybook.PostingDate, trybook.Status from trybook 
join student on trybook.empid=student.id order by lid desc limit 6";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results as $result) {
                                ?>

                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt); ?></b></td>
                                            <td><a href="viewstudents.php?empid=<?php echo htmlentities($result->id); ?>" target="_blank"><?php echo htmlentities($result->Fullname); ?>(<?php echo htmlentities($result->Matric); ?>)</a></td>
                                            <td><?php echo htmlentities($result->Programme); ?></td>
                                            <td><?php echo htmlentities($result->PostingDate); ?></td>
                                            <td><?php $stats = $result->Status;
                                                if ($stats == 1) {
                                                ?>
                                                    <span style="color: green">Approved</span>
                                                <?php }
                                                if ($stats == 2) { ?>
                                                    <span style="color: red">Rejected </span>
                                                <?php }
                                                if ($stats == 0) { ?>
                                                    <span style="color: blue">Pending</span>
                                                <?php } ?>
                                            </td>


                                            <td><a href="booking-details.php?bookid=<?php echo htmlentities($result->lid); ?>" class="waves-effect waves-light btn blue m-b-xs"> Details</a></td>
                                        </tr>
                                <?php $cnt++;
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>


    </body>

    </html>
<?php } ?>