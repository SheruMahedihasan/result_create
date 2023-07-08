<?php

include 'mysqli.config.php';

$sql = "SELECT * from student_detail";
$sql_con = $con->query($sql);
// $row_sql=mysqli_fetch_assoc($sql_con);
// $row_sql = $sql_con->fetch_assoc();
while ($row_sql = $sql_con->fetch_assoc()) {
    $get_name = $row_sql['name'];
    $get_mobile = $row_sql['mobile'];
    // print_r($get_mobile);
}

session_start();
$err_email = $err_name = $err_password = $err_phone = "";
if (isset($_POST['insert'])) {
    // $id = $_POST['id'];
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($name == "") {
        $err_name = "<span class='error'>Please enter your name.</span>";
    } elseif ($phone == "") {
        $err_phone = "<span class='error'>Please enter your phone.</span>";
    } elseif ($phone == $get_mobile) {
        $err_phone = "<span class='error'>Mobile Number is Already Exist.</span>";
    } elseif (!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $phone)) {
        $err_phone == "<span class='error'> enter valid phone.</span>";
    } elseif ($email == "") {
        $err_email = "<span class='error'>Please enter your email</span>";
    } elseif (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
        $err_email = "<span class='error'>Please enter valide email, like your@abc.com</span>";
    } elseif ($password == "") {
        $err_password =  "<span class='error'>Please enter password</span>";
    } else {

        if ($name !== $get_name) {
            $query = "INSERT INTO student_detail(id,name,email,mobile,password) VALUES ('$name','$email','$phone','$password')";
            $student_id = mysqli_insert_id($con); // Get the inserted ID
            // $_SESSION["id"] = $student_id;
            $result = mysqli_query($con, $query);

            if ($result) {
                // $_SESSION['id'] = $student_id;
                header("location:index.php");
            }
        } else {
            // echo "<span class='error'>Name Already Exist.</span>";
            echo "<script>alert('Name Already Exist');</script>";
        }
    }
}
// if ($name && $phone !== $get_name && $get_mobile) {
//     # code...
// }

mysqli_close($con);
?>

<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row m-auto p-4 mt-4">
            <div class="col-ml-6  offset-m-4">


                <form class="p-3  bg-light-subtle" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class=" header text-center">
                        <h1>Add User</h1>

                    </div>

                    <br>
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
                                                                                        echo $_REQUEST['name'];
                                                                                    } ?>"><br>
                        <?php echo $err_name; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="number" name="phone" class="form-control" value="<?php if (isset($_REQUEST['phone']) && $_REQUEST['phone'] != "") {
                                                                                            echo $_REQUEST['phone'];
                                                                                        }  ?>"><br>
                        <?php echo $err_phone; ?>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php if (isset($_REQUEST['email']) && $_REQUEST['email'] != "") {
                                                                                            echo $_REQUEST['email'];
                                                                                        } ?>"><br>
                        <?php echo $err_email; ?>

                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" value="<?php if (isset($_REQUEST['password']) && $_REQUEST['password'] != "") {
                                                                                                echo $_REQUEST['password'];
                                                                                            } ?>"><br>
                        <?php echo $err_password; ?>

                    </div>

                    <div class="py-3 m-auto text-center">
                        <button type="submit" name="insert" value="" class="btn btn-primary w-100">Insert</button>
                        <div class="py-3 m-auto text-center">
                            <!-- <button class="btn btn-success"><a href="display.php" class="text-light ">Display</a></button>
                            <button class="btn btn-success"><a href="index.php" class="text-light ">Back To Home</a></button> -->
                        </div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-light"><a href="index.php" class="text-dark ">Back To Home</a></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>