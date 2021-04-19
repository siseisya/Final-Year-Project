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

        <!-- Title -->
        <title>Admin | Dashboard</title>

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

                <h3>Bus Applications </h3>


                <table id="bookings">

                    <tr>
                        <th># </th>
                        <th width="200">Student Name</th>
                        <th width="120">Programme</th>
                        <th width="180">Posting Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        <?php $sql = "SELECT trybook.id as lid, student.Fullname, student.Matric, trybook.Programme,trybook.PostingDate,trybook.Status 
                        from trybook
                        join student on trybook.empid=student.id order by lid desc";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                        ?>

                                <tr>
                                    <td> <b><?php echo htmlentities($cnt); ?></b></td>
                                    
                                    <td><?php echo htmlentities($result->Fullname); ?></a></td>
                                    <td><?php echo htmlentities($result->Programme); ?></td>
                                    <td><?php echo htmlentities($result->PostingDate); ?></td>
                                    <td><?php $stats = $result->Status;
                                        if ($stats == 1) {
                                        ?>
                                            <span style="color: green">Approved</span>
                                        <?php }
                                        if ($stats == 2) { ?>
                                            <span style="color: red">Rejected</span>
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