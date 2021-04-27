<?php
session_start();
error_reporting(0);
include('dbconnect.php');

if (isset($_POST['register'])) {

    $fullname = $_POST['fullname'];
    $types = $_POST['types'];

    $faculty = $_POST['faculty'];
    $address = $_POST['address'];

    $semester = $_POST['semester'];
    $mobileno = $_POST['mobileno'];
    $status = 1;

    $sql = "INSERT INTO student (Fullname, TypeS, Faculty, Address, Semester, Phonenumber, Status)
        VALUES (:fullname, :types, :faculty, :address, :semester, :mobileno, :status)";


    $query = $dbh->prepare($sql);

    $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $query->bindParam(':types', $types, PDO::PARAM_STR);
    $query->bindParam(':faculty', $faculty, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':semester', $semester, PDO::PARAM_STR);
    $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    $msg = "Student record updated Successfully";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <!-- Theme Styles -->
        <link href="alpha.css" rel="stylesheet" type="text/css" />
        <link href="table.css" rel="stylesheet" type="text/css" />
        <link href="background.css" rel="stylesheet" type="text/css" />

        <!-- Title -->
        <title>Student</title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Project">
        <meta name="author" content="Farisha">


    </head>


<body>

    <div style="margin-left:15%">

        <div class="w3-container">

            <h3>Insert Student Info</h3>
            <div class="leftcolumn">
                <div class="card">
                    <form method="post" name="register">

                        <table id="updateprofile" align="center">

                            <tbody>


                                <tr>
                                    <td style="font-size:16px;"> <b> Username :</b> </td>
                                    <td>
                                        <input id="textarea3" name="destination" type="text" length="500" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"> <b> Matric :</b> </td>
                                    <td>
                                        <input id="textarea3" name="destination" type="text" length="500" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"> <b> Full Name :</b> </td>
                                    <td>
                                        <input id="textarea3" name="destination" type="text" length="500" required>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="font-size:16px;"> <b> Email :</b> </td>
                                    <td>
                                        <input id="textarea3" name="destination" type="text" length="500" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"> <b> Mobile number :</b> </td>
                                    <td>
                                        <input id="mobileno" name="mobileno" type="tel" value="" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"> <b> Year :</b> </td>
                                    <td>
                                        <select name="semester" autocomplete="off">
                                            <option value=""></option>
                                            <option value="Year 1">Year 1</option>
                                            <option value="Year 2">Year 2</option>
                                            <option value="Year 3">Year 3</option>
                                            <option value="Year 3">Year 4</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"> <b> School of :</b> </td>
                                    <td>
                                        <select name="faculty" autocomplete="off">
                                            <option value=""></option>
                                            <option value="CAS">---College of Arts (CAS)---</option>
                                            <option value="SOC">School Of Computing (SOC)</option>
                                            <option value="SMMTC">School Of </option>
                                            <option value="COB">---College of Bussiness (COB)---</option>
                                            <option value="COLGIS">---College of Government (COLGIS)---</option>



                                        </select>
                                    </td>
                                </tr>


                                <tr>
                                    <td style="font-size:16px;"> <b> Address :</b> </td>
                                    <td>
                                        <input id="address" name="address" type="text" value="" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"> <b> Type of :</b> </td>
                                    <td>
                                        <select name="types" autocomplete="off">
                                            <option value=""></option>
                                            <option value="Local">Local</option>
                                            <option value="International">International</option>
                                            <option value="Other">Other</option>
                                        </select>


                            </tbody>
                        </table>
                        <input type="submit" name="register" id="register" value="Register">
                    </form>
                    </section>



                </div>



            </div>




</body>

</html>