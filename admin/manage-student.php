<?php
session_start();
error_reporting(0);
include('includes/dbconnect.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // code for Inactive  employee    
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $status = 0;
        $sql = "update student set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:managestudent.php');
    }

    //code for active employee
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = 1;
        $sql = "update student set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:managestudent.php');
    }
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

                <h3>Manage Student</h3>
               
                <table id="managestudent">

                    <tr>
                        <th>Sr no</th>
                        <th> Matric</th>
                        <th>Username</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Reg Date</th>
                        
                    </tr>

                    <tbody>
                        <?php $sql = "SELECT Matric, Fullname, Address, Status, RegDate, id from  student";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {               ?>
                                <tr>
                                    <td> <?php echo htmlentities($cnt); ?></td>
                                    <td><?php echo htmlentities($result->Matric); ?></td>
                                    <td><?php echo htmlentities($result->Fullname); ?></td>
                                    <td><?php echo htmlentities($result->Address); ?></td>
                                    <td><?php $stats = $result->Status;
                                        if ($stats) {
                                        ?>
                                            <a class="waves-effect waves-green btn-flat m-b-xs">Active</a>
                                        <?php } else { ?>
                                            <a class="waves-effect waves-red btn-flat m-b-xs">Inactive</a>
                                        <?php } ?>


                                    </td>
                                    <td><?php echo htmlentities($result->RegDate); ?></td>
                                   
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