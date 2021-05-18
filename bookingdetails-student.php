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

        <!-- Title -->
        <title>Student | Bus Applications Details</title>
        <!-- Theme Styles -->
        <link href="alpha.css" rel="stylesheet" type="text/css" />

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

                <div class="row">
                    <div class="col s12">
                        <div class="page-title" style="font-size:24px;">Bus Applications Details</div>
                    </div>

                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <table>
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
                                                <td style="font-size:16px;"> <b>Student Name :</b></td>
                                                <td><?php echo htmlentities($result->Fullname); ?></td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b> Matric :</b></td>
                                                <td><?php echo htmlentities($result->Matric); ?></td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b> Phone Number :</b></td>
                                                <td><?php echo htmlentities($result->Phonenumber); ?></td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"><b> Email Address :</b></td>
                                                <td><?php echo htmlentities($result->EmailId); ?></td>
                                            </tr>
                                    <?php $cnt++;
                                        }
                                    } ?>
                                    <tbody>

                                        <?php
                                        $eid = $_SESSION['eid'];
                                        $sql = "SELECT * from trybook where empid=:eid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {
                                        ?>
                                                <tr>
                                                    <td style="font-size:16px;"><b> Programme/Activity :</b></td>
                                                    <td><?php echo htmlentities($result->Programme); ?></td>

                                                    <td style="font-size:16px;"><b> Date :</b></td>
                                                    <td>From <?php echo htmlentities($result->FromDate); ?></td>

                                                </tr>

                                                <tr>

                                                    <td style="font-size:16px;"><b> Destination : </b></td>
                                                    <td><?php echo htmlentities($result->Destination); ?></td>

                                                    <td style="font-size:16px;"><b>Posting Date</b></td>
                                                    <td colspan="5"><?php echo htmlentities($result->PostingDate); ?></td>

                                                </tr>

                                                <tr>
                                                    <td style="font-size:16px;"><b>Booking Status :</b></td>
                                                    <td colspan="5"><?php $stats = $result->Status;
                                                                    if ($stats == 1) {
                                                                    ?>
                                                            <span style="color: green">Approved</span>
                                                        <?php }
                                                                    if ($stats == 2) { ?>
                                                            <span style="color: red">Rejected</span>
                                                        <?php }
                                                                    if ($stats == 0) { ?>
                                                            <span style="color: blue">Waiting for approval</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size:16px;"><b>Officer Remark: </b></td>
                                                    <td colspan="5"><?php
                                                                    if ($result->AdminRemark == "") {
                                                                        echo "Waiting for Approval";
                                                                    } else {
                                                                        echo htmlentities($result->AdminRemark);
                                                                    }
                                                                    ?></td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size:16px;"><b>Admin Action taken date : </b></td>
                                                    <td colspan="5"><?php
                                                                    if ($result->AdminRemarkDate == "") {
                                                                        echo "NA";
                                                                    } else {
                                                                        echo htmlentities($result->AdminRemarkDate);
                                                                    }
                                                                    ?></td>
                                                </tr>
                                    </tbody>

                            <?php $cnt++;
                                            }
                                        } ?>
                                </table>
                                <button onclick="document.location='bookhistory1.php'">Back</button><br>
                                <button onclick="window.print()">Print this page</button>
                            </div>
                        </div>
                    </div>
                </div>











            </div>

        </div>

    </body>

    </html>
<?php } ?>