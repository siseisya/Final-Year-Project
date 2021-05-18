<?php
session_start();
error_reporting(0);
include('dbconnect.php');

if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {


    if (isset($_POST['fd'])) {
        $empid = $_SESSION['eid'];
        $feedback = $_POST['feedback'];

        $sql = "INSERT INTO response (Feedback) VALUES(:feedback)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':feedback', $feedback, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Feedback updated successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>


        <!-- Theme Styles -->
        <link href="alpha.css" rel="stylesheet" type="text/css" />
        <link href="table.css" rel="stylesheet" type="text/css" />
        <link href="background.css" rel="stylesheet" type="text/css" />
        <link href="apply.css" rel="stylesheet" type="text/css" />


        <!-- Title -->
        <title>STUDENT | Feedback Form</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Project">
        <meta name="author" content="Farisha">


    </head>


    <body>
        <?php include('includes/header.php'); ?>



        <div style="margin-left:15%">
            <div class="w3-container">

                <div class="row">
                    <div class="leftcolumn" style="background-color:white;">
                        <div class="card">
                            <h1> <b>Feedback Form</b></h1>

                            <?php
                            $eid = $_SESSION['eid'];
                            $sql = "SELECT Username,Matric from student where id=:eid";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) {               ?>
                                    <h3>User : <?php echo htmlentities($result->Username); ?> <h3>
                                            <h3>Matric : <?php echo htmlentities($result->Matric); ?> <h3>

                                            <?php }
                                    } ?>

                                            <form id="example-form" method="post" name="feed">

                                                <?php if ($error) { ?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

                                                <h3 style="font-size:16px;"> <b>Any comments or suggestion, please state in the box below</b> </h3>

                                                <input id="textarea3" name="feedback" type="text" length="500" required>

                                                <button type="submit" name="fd" id="fd">Submit</button>


                                            </form>
                        </div>
                    </div>

                    <div class="rightcolumn" style="background-color:grey;">
                        <h2>Reminder:</h2>

                        <p> 1.Thank you for participating in this study </p>

                    </div>
                </div>

            </div>
            <?php include('calendar.php'); ?>

    </body>

    </html>
<?php } ?>