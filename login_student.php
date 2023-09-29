<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Result</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#login_btn").on("click", function() {
                var v_name = $("#name_input").val();
                var v_password = $("#pass_input").val();
                if (v_name === "" || v_password === "") {
                    $("#err_masg").html("Please Enter Username And Password.").slideDown();
                } else {
                    $.ajax({
                        type: "POST",
                        url: "login_backend.php",
                        data: {
                            name: v_name,
                            password: v_password
                        },
                        success: function(data) {
                            if (data == 1) {
                                location.href = "welcome_login.php";
                                // location.href = "welcome_login.php";
                            } else {
                                $("#err_masg").html("Please Enter Valid Username And Password.").slideDown();
                            }
                        }
                    });
                }


            });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="row m-auto p-4 mt-4">
            <div class="col-md-4 bg-light  offset-md-4">

                <!-- <form class="p-3" method="post" action="login_backend.php"> -->
                <div id="err_masg"></div>
                <div class=" header">

                    <h1>Login</h1>
                </div>
                <br>
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="name" id="name_input" value="<?php if (isset($_REQUEST['name']) && $_REQUEST['name'] != '') {
                                                                                echo $_REQUEST['name'];
                                                                            } ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" id="pass_input" name="password" value="<?php if (isset($_REQUEST['password']) && $_REQUEST['password'] != "") {
                                                                                        echo $_REQUEST['password'];
                                                                                    } ?>" class="form-control">
                </div>

                <div class="py-3 m-auto text-center">
                    <button type="submit" name="submit" id="login_btn" class="btn btn-success w-100">login</button>
                </div>
                <div class="text-center">
                    <label>Don't have an account?<a href="add_student.php">Register</a></label>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</body>


</html>