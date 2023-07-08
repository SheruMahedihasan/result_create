<?php
include 'mysqli.config.php';
$id = $_GET['id'];

$query = "delete from student_detail where id='$id'";
$result = mysqli_query($con, $query);
if ($result) {
    header("location:index.php");
}
