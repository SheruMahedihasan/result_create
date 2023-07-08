<?php
include 'mysqli.config.php';
$id = $_GET['id'];

$query = "delete from tbl_subject where id='$id'";
$result = mysqli_query($con, $query);
if ($result) {
    header("location:subject_index.php");
}
