<?php
session_start();
error_reporting(0);
include('includes/dbconnect.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    // code for update the read notification status
    $isread = 1;
    $did = intval($_GET['bookid']);
    date_default_timezone_set('Asia/Kolkata');
    $admremarkdate = date('Y-m-d G:i:s ', strtotime("now"));
    $sql = "update trybook set IsRead=:isread where id=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':isread', $isread, PDO::PARAM_STR);
    $query->bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();

    // code for action taken on leave
    if (isset($_POST['update'])) {
        $did = intval($_GET['bookid']);
        $description = $_POST['description'];
        $status = $_POST['status'];
        date_default_timezone_set('Asia/Kolkata');
        $admremarkdate = date('Y-m-d G:i:s ', strtotime("now"));
        $sql = "update trybook set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:did";
        $query = $dbh->prepare($sql);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':admremarkdate', $admremarkdate, PDO::PARAM_STR);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->execute();
        $msg = "Booking Applications updated Successfully";
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
                
                <h4> <b>Borang UUM/SAC/11</b></h4>

                <table id="bookings-details">


                    <tbody>
                        <?php
                        $lid = intval($_GET['bookid']);
                        $sql = "SELECT trybook.id as lid, student.Fullname, student.Matric, student.id, student.Phonenumber, student.EmailId, trybook.Programme, trybook.FromDate, trybook.ToDate, trybook.Destination, trybook.PostingDate, trybook.Status, 
trybook.AdminRemark,trybook.AdminRemarkDate from trybook join student on trybook.empid=student.id where trybook.id=:lid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':lid', $lid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {
                        ?>

                                <tr>
                                    <td style="font-size:16px;"> <b> Student Name :</b> </td>
                                    <td>
                                        <?php echo htmlentities($result->Fullname); ?></a>
                                    </td>

                                    <td style="font-size:16px;"><b> Matric :</b></td>
                                    <td><?php echo htmlentities($result->Matric); ?>
                                    </td>

                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b> Email :</b></td>
                                    <td><?php echo htmlentities($result->EmailId); ?></td>

                                    <td style="font-size:16px;"><b> Contact No. :</b></td>
                                    <td><?php echo htmlentities($result->Phonenumber); ?></td>

                                </tr>

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

                                <tr>
                                    <td><button onclick="window.print()">Print this page</button></td>
                                    <td>
                                    <td><button onclick="document.location='email.php'">Email</button>
                                    <td><button onclick="document.location='bookings.php'">Back</button></td>

                                </tr>
                                <?php
                                if ($stats == 0) {

                                ?>
                                    <tr>
                                        <td colspan="5">

                                            <form name="adminaction" method="post">

                                                <h4>Booking Applications Action</h4>
                                                <select name="status" required="">
                                                    <option value="">Choose your option</option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Not Approved</option>
                                                </select></p>

                                                <textarea name="description" placeholder="Description" length="500" required>Description...</textarea>

                                                <div class="modal-footer" style="width:90%">
                                                    <input type="submit" class="waves-effect waves-light btn blue m-b-xs" name="update" value="Submit">
                                                </div>
                                        </td>
                                    </tr>

                                <?php } ?>
                                </form>
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