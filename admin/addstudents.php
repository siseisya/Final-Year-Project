<?php
session_start();
error_reporting(0);
include('includes/dbconnect.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        // Count total files
        $countfiles = count($_FILES['file']['name']);

        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];

            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i], 'admin/profileimages/' . $filename);
        }
    }

    if (isset($_POST['add'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $matric = $_POST['matric'];
        $emailid = $_POST['emailid'];
        $faculty = $_POST['faculty'];
        $status = 1;
        $mobileno = $_POST['mobileno'];
        $address = $_POST['address'];
        $semester = $_POST['semester'];
        $fullname = $_POST['fullname'];



        $sql = "INSERT INTO student(Username,Password,Matric,EmailId,Faculty,Status,Phonenumber,Address,Semester,Fullname) 
        VALUES(:username,:password,:matric,:emailid,:faculty,:status,:mobileno,:address,:semester,:fullname)";
        $query = $dbh->prepare($sql);

        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':matric', $matric, PDO::PARAM_STR);
        $query->bindParam(':emailid', $emailid, PDO::PARAM_STR);
        $query->bindParam(':faculty', $faculty, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':semester', $semester, PDO::PARAM_STR);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);


        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Student record updated Successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <!-- Title -->
        <title>Admin | Add Student</title>

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
        <a href="manage-student.php" class="button3">Back</a>

        <div style="margin-left:20%">

            <div class="w3-container">

                <h3>Insert Student Info</h3>
                <div class="leftcolumn">
                    <div class="card">

                        <form method="post" name="addemp">
                            <?php if ($error) { ?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

                       
                                    <label for="username"><b>Username :</b></label><br>
                                    <input type="text" name="username" id="username" value="" required> <br>

                                    <b> Matric :</b> <br>
                                    <input type="text" name="matric" id="matric" value="" required> <br>

                                    <b> Full Name :</b><br>
                                    <input type="text" name="fullname" id="fullname" value="" required> <br>

                                    <b> Email :</b><br>
                                    <input type="text" name="emailid" id="emailid" value="" required> <br>

                                    <b>Password</b><br>
                                    <input id="password" name="password" type="password" autocomplete="off" required><br>

                                    <b> Mobile number :</b><br>
                                    <input type="text" name="mobileno" id="mobileno" value="" required> <br>

                                    <b> Year :</b><br>
                                    <select name="semester" autocomplete="off">
                                        <option value=""></option>
                                        <option value="Year 1">Year 1</option>
                                        <option value="Year 2">Year 2</option>
                                        <option value="Year 3">Year 3</option>
                                        <option value="Year 3">Year 4</option>
                                    </select>
                                    <br>

                                    <b> School of :</b><br>
                                    <select name="faculty" autocomplete="off">
                                        <option value=""></option>
                                        <option value="CAS">---College of Arts (CAS)---</option>

                                        <option value="COB">---College of Bussiness (COB)---</option>
                                        <option value="COLGIS">---College of Government (COLGIS)---</option>
                                    </select>
                                    <br>

                                    <b> Address :</b><br>
                                    <input type="text" name="address" id="address" value="" required> <br>


                                    <input type="submit" name="add" id="add" value="Add">
                        </form>

                        <script>
                            var fileTypes = ['pdf', 'docx', 'rtf', 'jpg', 'jpeg', 'png', 'txt']; //acceptable file types
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var extension = input.files[0].name.split('.').pop().toLowerCase(), //file extension from input file
                                        isSuccess = fileTypes.indexOf(extension) > -1; //is extension in acceptable types

                                    if (isSuccess) { //yes
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            if (extension == 'pdf') {
                                                $(input).closest('.fileUpload').find(".icon").attr('src', 'https://image.flaticon.com/icons/svg/179/179483.svg');
                                            } else if (extension == 'docx') {
                                                $(input).closest('.fileUpload').find(".icon").attr('src', 'https://image.flaticon.com/icons/svg/281/281760.svg');
                                            } else if (extension == 'rtf') {
                                                $(input).closest('.fileUpload').find(".icon").attr('src', 'https://image.flaticon.com/icons/svg/136/136539.svg');
                                            } else if (extension == 'png') {
                                                $(input).closest('.fileUpload').find(".icon").attr('src', 'https://image.flaticon.com/icons/svg/136/136523.svg');
                                            } else if (extension == 'jpg' || extension == 'jpeg') {
                                                $(input).closest('.fileUpload').find(".icon").attr('src', 'https://image.flaticon.com/icons/svg/136/136524.svg');
                                            } else if (extension == 'txt') {
                                                $(input).closest('.fileUpload').find(".icon").attr('src', 'https://image.flaticon.com/icons/svg/136/136538.svg');
                                            } else {
                                                //console.log('here=>'+$(input).closest('.uploadDoc').length);
                                                $(input).closest('.uploadDoc').find(".docErr").slideUp('slow');
                                            }
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    } else {
                                        //console.log('here=>'+$(input).closest('.uploadDoc').find(".docErr").length);
                                        $(input).closest('.uploadDoc').find(".docErr").fadeIn();
                                        setTimeout(function() {
                                            $('.docErr').fadeOut('slow');
                                        }, 9000);
                                    }
                                }
                            }
                            $(document).ready(function() {

                                $(document).on('change', '.up', function() {
                                    var id = $(this).attr('id'); /* gets the filepath and filename from the input */
                                    var profilePicValue = $(this).val();
                                    var fileNameStart = profilePicValue.lastIndexOf('\\'); /* finds the end of the filepath */
                                    profilePicValue = profilePicValue.substr(fileNameStart + 1).substring(0, 20); /* isolates the filename */
                                    //var profilePicLabelText = $(".upl"); /* finds the label text */
                                    if (profilePicValue != '') {
                                        //console.log($(this).closest('.fileUpload').find('.upl').length);
                                        $(this).closest('.fileUpload').find('.upl').html(profilePicValue); /* changes the label text */
                                    }
                                });

                                $(".btn-new").on('click', function() {
                                    $("#uploader").append('<div class="row uploadDoc"><div class="col-sm-3"><div class="docErr">Please upload valid file</div><!--error--><div class="fileUpload btn btn-orange"> <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon"><span class="upl" id="upload">Upload document</span><input type="file" class="upload up" id="up" onchange="readURL(this);" /></div></div><div class="col-sm-8"><input type="text" class="form-control" name="" placeholder="Note"></div><div class="col-sm-1"><a class="btn-check"><i class="fa fa-times"></i></a></div></div>');
                                });

                                $(document).on("click", "a.btn-check", function() {
                                    if ($(".uploadDoc").length > 1) {
                                        $(this).closest(".uploadDoc").remove();
                                    } else {
                                        alert("You have to upload at least one document.");
                                    }
                                });
                            });
                        </script>
    </body>

    </html>
<?php } ?>