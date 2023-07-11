<?php

// include 'mysqli.config.php';

// $sql = "SELECT * from student_detail";
// $sql_con = $con->query($sql);
// while ($row_sql = $sql_con->fetch_assoc()) {
//     $get_mobile = $row_sql['mobile'];
// }

// session_start();
// $err_email = $err_name = $err_password = $err_phone = "";
// if (isset($_POST['insert'])) {
//     $name = trim($_POST['name']);
//     $phone = trim($_POST['phone']);
//     $email = trim($_POST['email']);
//     $password = trim($_POST['password']);

//     if ($name == "") {
//         $err_name = "<span class='error'>Please enter your name.</span>";
//     } elseif ($phone == "") {
//         $err_phone = "<span class='error'>Please enter your phone.</span>";
//     } elseif ($phone == $get_mobile) {
//         $err_phone = "<span class='error'>Mobile Number is Already Exist.</span>";
//     } elseif (!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $phone)) {
//         $err_phone == "<span class='error'> enter valid phone.</span>";
//     } elseif ($email == "") {
//         $err_email = "<span class='error'>Please enter your email</span>";
//     } elseif (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
//         $err_email = "<span class='error'>Please enter valide email, like your@abc.com</span>";
//     } elseif ($password == "") {
//         $err_password =  "<span class='error'>Please enter password</span>";
//     } else {

//         $query = "INSERT INTO student_detail(name,email,mobile,password) VALUES ('$name','$email','$phone','$password')";
//         $student_id = mysqli_insert_id($con); // Get the inserted ID
//         $result = mysqli_query($con, $query);

//         if ($result) {
//             header("location:index.php");
//         }
//     }
// }

// mysqli_close($con);
?>

<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#insert").on("click", function(e) {
                e.preventDefault();
                var name_add = $("#name").val();
                var mobile_add = $("#mobile").val();
                var email_add = $("#email").val();
                var password_add = $("#password").val();

                if (name_add == "" || mobile_add == "" || email_add == "" || password_add == "") {
                    $("#error_msg").html("All fields are required.").slideDown();
                } else {
                    $.ajax({
                        url: "insert_student_ajax.php",
                        type: "POST",
                        data: {
                            name: name_add,
                            phone: mobile_add,
                            email: email_add,
                            password: password_add
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                location.href = "index.php";
                                // alert("Insertion successful!");
                                // $("#success_msg").html("Insertion successful!.").slideDown();
                                // Redirect or perform any other action upon successful insertion
                            } else {
                                // Handle the error messages
                                // Display the error messages next to the corresponding form fields
                                if (response.errors.name) {
                                    $("#name_error").html(response.errors.name);
                                }
                                if (response.errors.phone) {
                                    $("#phone_error").html(response.errors.phone);
                                }
                                if (response.errors.email) {
                                    $("#email_error").html(response.errors.email);
                                }
                                if (response.errors.password) {
                                    $("#password_error").html(response.errors.password);
                                }
                            }
                        }
                    });
                }
            });
        });
    </script>







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
















                <form class="p-3  bg-light-subtle" id="addstudent" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div id="error_msg"></div>
                    <div id="success_msg"></div>
                    <div class=" header text-center">
                        <h1>Add User</h1>

                    </div>

                    <br>
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
                                                                                                    echo $_REQUEST['name'];
                                                                                                } ?>">
                        <div id="name_error" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone</label>
                        <input type="number" name="phone" id="mobile" class="form-control" value="<?php if (isset($_REQUEST['phone']) && $_REQUEST['phone'] != "") {
                                                                                                        echo $_REQUEST['phone'];
                                                                                                    }  ?>">
                        <div id="phone_error" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?php if (isset($_REQUEST['email']) && $_REQUEST['email'] != "") {
                                                                                                    echo $_REQUEST['email'];
                                                                                                } ?>">
                        <div id="email_error" class="error"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="<?php if (isset($_REQUEST['password']) && $_REQUEST['password'] != "") {
                                                                                                                echo $_REQUEST['password'];
                                                                                                            } ?>">
                        <div id="password_error" class="error"></div>
                    </div>

                    <div class="py-3 m-auto text-center">
                        <button type="submit" name="insert" id="insert" value="" class="btn btn-primary w-100">Insert</button>
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