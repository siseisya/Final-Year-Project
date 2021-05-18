<?php
session_start();
error_reporting(0);
include('dbconnect.php');
if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {
    $eid = $_SESSION['emplogin'];
    if (isset($_POST['update'])) {

        $faculty = $_POST['faculty'];
        $address = $_POST['address'];
        $semester = $_POST['semester'];
        $mobileno = $_POST['mobileno'];
        $sql = "UPDATE student set  Faculty=:faculty, Address=:address, Semester=:semester,
        Phonenumber=:mobileno where EmailId=:eid";
        $query = $dbh->prepare($sql);


        $query->bindParam(':faculty', $faculty, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':semester', $semester, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Student record updated Successfully";
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Theme Styles -->
        <link href="alpha.css" rel="stylesheet" type="text/css" />
        <link href="table.css" rel="stylesheet" type="text/css" />
        <link href="background.css" rel="stylesheet" type="text/css" />

        <!-- Title -->
        <title>Student | Update Details</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Project">
        <meta name="author" content="Farisha">


    </head>


    <body>
        <?php include('includes/header.php'); ?>

        <div style="margin-left:15%">

            <div class="w3-container">
                <a href="myprofile.php" class="button3">Back</a>
                <h3>Update Student Info</h3>
                <div class="leftcolumn">
                    <div class="card">
                        <form method="post" name="update">

                            <table id="updateprofile" align="center">
                                <img src="a.jpg" alt="Avatar" class="avatar">
                                <tbody>

                                    <?php if ($error) { ?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
                                    <?php
                                    $eid = $_SESSION['emplogin'];
                                    $sql = "SELECT * from  student where EmailId=:eid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {               ?>

                                            <tr>
                                                <td style="font-size:16px;"> <b> Username :</b> </td>
                                                <td>
                                                    <?php echo htmlentities($result->Username); ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"> <b> Matric :</b> </td>
                                                <td>
                                                    <?php echo htmlentities($result->Matric); ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"> <b> Full Name :</b> </td>
                                                <td>
                                                    <?php echo htmlentities($result->Fullname); ?>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="font-size:16px;"> <b> Email :</b> </td>
                                                <td>
                                                    <?php echo htmlentities($result->EmailId); ?>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"> <b> Mobile number :</b> </td>
                                                <td>
                                                    <input id="mobileno" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber); ?>" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"> <b> Semester :</b> </td>
                                                <td>
                                                    <select name="semester" autocomplete="off">
                                                        <option value="<?php echo htmlentities($result->Semester); ?>"><?php echo htmlentities($result->Semester); ?></option>
                                                        <option value="1-2">1-2</option>
                                                        <option value="3-4">3-4</option>
                                                        <option value="5-6">5-6</option>
                                                        <option value="7 - above">7 - above</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"> <b> College of :</b> </td>
                                                <td>
                                                    <select name="faculty" autocomplete="off">
                                                        <option value="<?php echo htmlentities($result->Faculty); ?>"><?php echo htmlentities($result->Faculty); ?></option>
                                                        <option value="CAS">College of Arts (CAS)</option>
                                                        <option value="COB">College of Bussiness (COB)</option>
                                                        <option value="COLGIS">College of Government (COLGIS)</option>



                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="font-size:16px;"> <b> Address :</b> </td>
                                                <td>
                                                    <input id="address" name="address" type="text" value="<?php echo htmlentities($result->Address); ?>" required>
                                                </td>
                                            </tr>

                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                            <input type="submit" name="update" id="update" value="Update">
                        </form>
                        </section>



                    </div>



                </div>




    </body>

    </html>
<?php } ?>