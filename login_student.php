<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row m-auto p-4 mt-4">
            <div class="col-md-4 bg-light  offset-md-4">

                <form class="p-3" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class=" header">

                        <h1>Login</h1>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" name="name" value="<?php if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
                                                                    echo $_REQUEST['name'];
                                                                } ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" value="<?php if (isset($_REQUEST['password']) && $_REQUEST['password'] != "") {
                                                                            echo $_REQUEST['password'];
                                                                        } ?>" class="form-control">
                    </div>

                    <div class="py-3 m-auto text-center">
                        <button type="submit" name="submit" class="btn btn-success w-100">login</button>
                    </div>
                    <div class="text-center">
                        <label>Don't have an account?<a href="add_student.php">Register</a></label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<?php
include 'mysqli.config.php';
session_start();
// if (!isset($_SESSION["username"])) {
//     header("Location: login.php");
//     exit();
// }

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    $query = "select * from student_detail where name = '$name' and password = '$password'";
    $result = mysqli_query($con, $query);
    $row = mysqli_num_rows($result);
    if ($row == 1) {

        $_SESSION['user_data'] = mysqli_fetch_array($result);

        header("location:welcome_login.php");
    } else {
        // header("location:login.php?error=incorrect username and password");
        echo '<script>alert("invalide username and passwird")</script>';
        die();
    }
}
?>

</html>