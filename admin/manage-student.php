<?php
session_start();
error_reporting(0);
include('includes/dbconnect.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    // code for Inactive  student    
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $status = 0;
        $sql = "update student set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:manage-student.php');
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
        header('location:manage-student.php');
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Theme Styles -->
        <link href="css/alpha-admin.css" rel="stylesheet" type="text/css" />
        <link href="css/table-alpha-admin.css" rel="stylesheet" type="text/css" />


        <!-- Title -->
        <title>Admin | Manage Students</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Project">
        <meta name="author" content="Farisha">


    </head>

    <body>
        <?php include('includes/header.php'); ?>

        <a href="addstudents.php" class="button3">Add Students</a>

        <div style="margin-left:20%">

            <div class="w3-container">

                <h3>Manage Student</h3>

                <table id="managestudent">

                    <tr>
                        <th>#</th>
                        <th> Matric</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Registration Date</th>
                        <th>Action</th>
                        <th>Status of Student</th>
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
                                    <td><a href="viewstudents.php?empid=<?php echo htmlentities($result->id); ?>" target="_blank"> <?php echo htmlentities($result->Matric); ?></td>

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
                      
                                    <td><a href="editstudent-details.php?empid=<?php echo htmlentities($result->id); ?>"> Edit </a></td>
                                    <td><a href="editstudent-details.php?empid=<?php echo htmlentities($result->id); ?>"></a>
                                        <?php if ($result->Status == 1) { ?>
                                            <a href="manage-student1.php?inid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to inactive this Employe?');" > 
                                            <i class=" material-icons" title="Inactive">Click to Inactive</i>
                                            <?php } else { ?>

                                                <a href="manage-student1.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to active this employee?');">
                                                <i class=" material-icons" title="Active">Click to Active</i>
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

    </body>

    </html>
<?php } ?>