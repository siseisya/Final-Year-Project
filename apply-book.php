<?php
session_start();
error_reporting(0);
include('dbconnect.php');

if (strlen($_SESSION['emplogin']) == 0) {
    header('location:index.php');
} else {


    if (isset($_POST['apply'])) {
        // Count total files
        $countfiles = count($_FILES['file']['name']);

        // Looping all files
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];

            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i], 'uploads/' . $filename);
        }
    }


    if (isset($_POST['apply'])) {
        $empid = $_SESSION['eid'];
        $vehicle = $_POST['vehicle'];
        $fromdate = $_POST['fromdate'];
        $todate = $_POST['todate'];
        $fromtime = $_POST['fromtime'];
        $totime = $_POST['totime'];
        $destination = $_POST['destination'];
        $programme = $_POST['programme'];
        $status = 0;
        $isread = 0;
        if ($fromdate > $todate) {
            $error = " ToDate should be greater than FromDate ";
        }
        $sql = "INSERT INTO trybook (vehicle,ToDate,FromDate,FromTime,ToTime,Programme,Destination,Status,IsRead,empid) VALUES(:vehicle,:todate,:fromdate,:fromtime,:totime,:programme,:destination,:status,:isread,:empid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vehicle', $vehicle, PDO::PARAM_STR);
        $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
        $query->bindParam(':todate', $todate, PDO::PARAM_STR);
        $query->bindParam(':fromtime', $fromtime, PDO::PARAM_STR);
        $query->bindParam(':totime', $totime, PDO::PARAM_STR);
        $query->bindParam(':programme', $programme, PDO::PARAM_STR);
        $query->bindParam(':destination', $destination, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':isread', $isread, PDO::PARAM_STR);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Book applied successfully";
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
        <title>STUDENT | Apply Booking</title>
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
                            <h4> <b>Borang UUM/SAC/11</b></h4>

                            <form id="example-form" enctype="multipart/form-data" method="post" name="addemp">

                                <table id="applybook" align="center">

                                    <tbody>

                                        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

                                        <tr>
                                            <td style="font-size:16px;"> <b> Select Vehicle :</b> </td>
                                            <td>
                                                <select name="vehicle" autocomplete="off">
                                                    <option value="">Select vehicle type...</option>
                                                    <?php $sql = "SELECT vehicle from vehicletype";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result) {   ?>
                                                            <option value="<?php echo htmlentities($result->vehicle); ?>"><?php echo htmlentities($result->vehicle); ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                                </select>
                                            </td>


                                        </tr>

                                        <tr>
                                            <td style="font-size:16px;"> <b> From Date :</b> </td>
                                            <td>
                                                <input placeholder="" id="mask1" name="fromdate" type="date" data-inputmask="'alias': 'date'" required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="font-size:16px;"> <b> To Date :</b> </td>
                                            <td>
                                                <input placeholder="" id="mask1" name="todate" type="date" data-inputmask="'alias': 'date'" required>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td style="font-size:16px;"> <b> From Time:</b> </td>
                                            <td>
                                                <input id="textarea1" name="fromtime" type="text" length="100" required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="font-size:16px;"> <b> To Time:</b> </td>
                                            <td>
                                                <input id="textarea2" name="totime" type="text" length="100" required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="font-size:16px;"> <b> Destination:</b> </td>
                                            <td>
                                                <input id="textarea3" name="destination" type="text" length="500" required>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="font-size:16px;"> <b> Programme:</b> </td>
                                            <td>
                                                <input id="textarea4" name="programme" type="text" required>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>


                                <div class="row it">
                                    <div class="col-sm-offset-1 col-sm-10" id="one">
                                        <p>
                                            Please upload documents only in 'pdf', 'docx', 'rtf', 'jpg', 'jpeg', 'png' & 'text' format.
                                        </p><br>
                                        <div class="row">
                                            <div class="col-sm-offset-4 col-sm-4 form-group">
                                                <h3 class="text-center">My Documents</h3>
                                            </div>
                                            <!--form-group-->
                                        </div>
                                        <!--row-->
                                        <div id="uploader">
                                            <div class="row uploadDoc">
                                                <div class="col-sm-3">
                                                    <div class="docErr">Please upload valid file</div>
                                                    <!--error-->
                                                    <div class="fileUpload btn btn-orange">
                                                        <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon">
                                                        <span class="upl" id="upload">Upload document</span>
                                                        <input type="file" class="upload up" id="up" onchange="readURL(this);" name="file[]" id="file" multiple />


                                                        <a download="<?php echo $files[$a] ?>" href="uploads/<?php echo $files[$a] ?>"><?php echo $files[$a] ?></a>
                                                    </div><!-- btn-orange -->

                                                </div><!-- col-3 -->


                                            </div>
                                            <!--row-->
                                        </div>
                                        <!--uploader-->
                                        <div class="text-center">
                                            <a class="btn btn-new"><i class="fa fa-plus"></i> Add new</a>
        

                                            <button type="submit" name="apply" id="apply" align="center" class="btn btn-next"><i class="fa fa-paper-plane">Apply</button>
                                        </div>
                                    </div>
                                    <!--one-->
                                </div><!-- row -->





                            </form>


                        </div>
                    </div>

                    <div class="rightcolumn" style="background-color:grey;">
                        <h2>Reminder:</h2>

                        <p> 1. The application form must be completed and certified by the authorised University official and submitted to
                            the Student Accommodation Centre(SAC) UUM <br> at the latest within seven(7) days prior to the use of the vehicle.</p>
                        <p> 2. Each application must be accompanied by a letter of approval of programmes/activites of the relevant authorities.</p>
                        <p> 3. Approval is based on the concept "the first priority". Applications that are not in accordance with the conditions and incomplete
                            will be no approved.</p>
                        <p> 4. verification of trave; and vehicle rental payments must be made within three(3) days prior to travel.</p>
                        <p> 5. Applications that do not follow item 1 is subject to vehicle availibility on that date.</p>


                    </div>



                </div>

            </div>
            <?php include('calendar.php'); ?>

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