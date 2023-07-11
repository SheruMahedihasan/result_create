
<?php
include 'mysqli.config.php';
session_start();
// if (!isset($_SESSION["username"])) {
//     header("Location: login.php");
//     exit();
// } 
if (isset($_POST['name']) && $_POST['name'] != '') {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $query = "select * from student_detail where name = '$name' and password = '$password'";
    $result = mysqli_query($con, $query);
    $row = mysqli_num_rows($result);
    if ($row == 1) {
        //  echo 'vdvdf';exit;
        $_SESSION['user_data'] = mysqli_fetch_array($result);
        // $return['status'] = 'success';
        // $return['msg'] = 'Login Successfully';

        echo 1;
        exit;
        // header("location:welcome_login.php");
    } else {
        echo 0;
        exit;

        // $return['status'] = 'error';
        // $return['msg'] = 'User not find';
        // return 0;
    }
    // return $return;
}
?>