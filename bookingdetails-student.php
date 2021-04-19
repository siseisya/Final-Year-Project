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

                                <?php if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php } ?>
                                <table id="example" class="display responsive-table ">

                                    <tbody>
                                        <?php
                                        $eid = $_SESSION['eid'];

                                       
                                        $sql = "SELECT * FROM trybook WHERE empid=eid";


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
                                                    <td>
                                                        <?php echo htmlentities($result->Destination); ?></a></td>
                                                    <td style="font-size:16px;"><b> Matric :</b></td>
                                                    <td><?php echo htmlentities($result->Matric); ?></td>

                                                </tr>


                                        <?php $cnt++;
                                            }
                                        } ?>
                                    </tbody>
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