<?php
include 'mysqli.config.php';

session_start();
$err_email = $err_name = $err_password = $err_phone = "";

if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['password'])) {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($name == "") {
        $err_name = "<span class='error'>Please enter your name.</span>";
    } elseif ($phone == "") {
        $err_phone = "<span class='error'>Please enter your phone.</span>";
    } elseif (!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $phone)) {
        $err_phone = "<span class='error'>Enter a valid phone number.</span>";
    } elseif ($email == "") {
        $err_email = "<span class='error'>Please enter your email</span>";
    } elseif (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
        $err_email = "<span class='error'>Please enter valid email, like your@abc.com</span>";
    } elseif ($password == "") {
        $err_password = "<span class='error'>Please enter password</span>";
    } else {
        $query = "INSERT INTO student_detail (name, email, mobile, password) VALUES ('$name', '$email', '$phone', '$password')";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['user_data'] = array(
                'name' => $name,
                'email' => $email,
                'mobile' => $phone
            );
            echo json_encode(array('success' => true));
            exit;
        }
    }
}

mysqli_close($con);
