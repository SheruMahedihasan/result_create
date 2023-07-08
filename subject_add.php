<?php

include 'mysqli.config.php';

$err_subject = $err_status = "";

if (isset($_POST['insert'])) {

    $subject_name = trim($_POST['subject_name']);
    $status = trim($_POST['status']);


    if ($subject_name == "") {
        $err_subject = "<span class='error'>Please enter your subject_name.</span>";
    } elseif ($status == "") {
        $err_status = "<span class='error'>Please enter your subject_name.</span>";
    } elseif ($status != 0 && $status != 1) {
        $err_status = "<span class='error'>Enter Status 0 and 1</span>";
    } else {

        $query = "INSERT INTO tbl_subject(subject_name,status) VALUES ('$subject_name','$status')";

        $result = mysqli_query($con, $query);

        if ($result) {
            header("location:subject_index.php");
        }
    }
}


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
                        <label class="form-label">Subject_Name</label>
                        <input type="text" name="subject_name" class="form-control" value="<?php if (isset($_REQUEST['subject_name']) && $_REQUEST['subject_name'] != '') {
                                                                                                echo $_REQUEST['subject_name'];
                                                                                            } ?>"><br>
                        <?php echo $err_subject; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <input type="text" name="status" class="form-control" value="<?php if (isset($_REQUEST['status']) && $_REQUEST['status'] != '') {
                                                                                            echo $_REQUEST['status'];
                                                                                        } ?>"><br>
                        <?php echo $err_status; ?>
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