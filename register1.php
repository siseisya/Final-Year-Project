<?php
session_start();
error_reporting(0);
include('dbconnect.php');

$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Matric = $_POST['Matric'];
$EmailId = $_POST['EmailId'];
$Faculty = $_POST['Faculty'];
$Status  = $_POST['Status'];
$Phonenumber = $_POST['Phonenumber'];
$Address = $_POST['Address'];
$Semester = $_POST['Semester'];
$Fullname = $_POST['Fullname'];
$TypeS  = $_POST['TypeS'];

if (!empty($_FILES['uploaded_file'])) {
    $path = "profileimages/";
    //$path = $path . basename( $_FILES['uploaded_file']['name']);
    $path = $path . $username . '.jpg';
    if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
        try {
            $sql = "INSERT INTO student( Username, Password, Matric, EmailId, Faculty, Status, Phonenumber, Address, Semester, Fullname, TypeS )
          VALUES ('$Username', '$Password', '$Matric', '$EmailId', '$Faculty', '$Status', '$Phonenumber'', '$Address', '$Semester', '$Fullname', '$TypeS')";

            // use exec() because no results are returned
            $conn->exec($sql);
            echo "<script> alert('Registration Success')</script>";
            echo "<script> window.location.replace('index.php') </script>;";
        } catch (PDOException $e) {
            echo "<script> alert('Registration Error')</script>";
            echo "<script> window.location.replace('register1.html') </script>;";
        }
        $conn = null;
    } else {
        echo "<script> alert('Image upload error')</script>";
        echo "<script> window.location.replace('index.html') </script>;";
    }
}
