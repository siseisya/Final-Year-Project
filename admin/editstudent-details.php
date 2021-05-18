<?php
session_start();
error_reporting(0);
include('includes/dbconnect.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $eid = intval($_GET['empid']);
    if (isset($_POST['update'])) {


        $fullname = $_POST['fullname'];
        $faculty = $_POST['faculty'];
        $address = $_POST['address'];

        $semester = $_POST['semester'];
        $mobileno = $_POST['mobileno'];
        $sql = "update student set Fullname=:fullname, Faculty=:faculty, Address=:address, Semester=:semester,
        Phonenumber=:mobileno where id=:eid";
        $query = $dbh->prepare($sql);

        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        
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

        <!-- Title -->
        <title>Admin | Update Student Information </title>

        <head>
            <!-- Theme Styles -->
            <link href="css/alpha-admin.css" rel="stylesheet" type="text/css" />
            <link href="css/table-alpha-admin.css" rel="stylesheet" type="text/css" />
            <link href="css/background-admin.css" rel="stylesheet" type="text/css" />

            <!-- Title -->
            <title>Student | Update Details</title>
            <meta charset="UTF-8">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="Project">
            <meta name="author" content="Farisha">

            <style>
                /*table updateprofile */

                #updateprofile {
                    font-family: Arial, Helvetica, sans-serif;
                    border-collapse: collapse;
                    width: 50%;
                }

                #updateprofile td,
                #updateprofile th {
                    border: 1px solid #ddd;
                    padding: 8px;
                }

                #updateprofile tr:nth-child(even) {
                    background-color: #f2f2f2;
                }

                #updateprofile tr:hover {
                    background-color: #ddd;
                }

                #updateprofile th {
                    padding-top: 12px;
                    padding-bottom: 12px;
                    text-align: left;
                    background-color: #283128;
                    color: white;
                }
            </style>

        </head>



    <body>
        <?php include('includes/header.php'); ?>

        <div style="margin-left:15%">

            <div class="w3-container">
                <a href="manage-student.php" class="button3">Back</a>
                <h3>Update Student Info</h3>
                <div class="leftcolumn">
                    <div class="card">
                        <form method="post" name="update">

                            <table id="updateprofile" align="center">

                                <tbody>

                                    <?php
                                    $eid = intval($_GET['empid']);
                                    $sql = "SELECT * from  student where id=:eid";
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
                                                    <input name="eid" type="email" id="email" value="<?php echo htmlentities($result->EmailId); ?>" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"> <b> Mobile number :</b> </td>
                                                <td>
                                                    <input id="mobileno" name="mobileno" type="tel" value="<?php echo htmlentities($result->Phonenumber); ?>" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"> <b> Year :</b> </td>
                                                <td>
                                                    <select name="semester" autocomplete="off">
                                                        <option value="<?php echo htmlentities($result->Semester); ?>"><?php echo htmlentities($result->Semester); ?></option>
                                                        <option value="Year 1">Year 1</option>
                                                        <option value="Year 2">Year 2</option>
                                                        <option value="Year 3">Year 3</option>
                                                        <option value="Year 3">Year 4</option>
                                                    </select>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td style="font-size:16px;"> <b> College of :</b> </td>
                                                <td>
                                                    <select name="faculty" autocomplete="off">
                                                        <option value="<?php echo htmlentities($result->Faculty); ?>"><?php echo htmlentities($result->Faculty); ?></option>
                                                        <option value="CAS">---College of Arts (CAS)---</option>

                                                        <option value="COB">---College of Bussiness (COB)---</option>
                                                        <option value="COLGIS">---College of Government (COLGIS)---</option>



                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td style="font-size:16px;"> <b> Address :</b> </td>
                                                <td>
                                                    <input id="address" name="address" type="text" value="<?php echo htmlentities($result->Address); ?>" required>
                                                </td>
                                            </tr>

                                            <tr>

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