<?php
include 'mysqli.config.php';

$id = $_GET['id'];



$query = "SELECT * from student_detail where id='$id'";

$result = mysqli_query($con, $query);

$row = mysqli_fetch_array($result);

if (!$row) {
    echo "Record not Found";
    die();
}
?>

<html>

<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="row m-auto p-4 mt-4">
            <div class="col-ml-6  offset-m-4">

                <form class="p-3  bg-light-subtle" method="post" action=" ">
                    <div class=" header text-center">
                        <h1>Student Information</h1>
                    </div>

                    <br>
                    <table class=" table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <td><?php echo $row['id']; ?></td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td><?php echo $row['name']; ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td><?php echo $row['mobile']; ?></td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td><?php echo $row['password']; ?></td>
                            </tr>
                        </thead>

                    </table>

                    <div class="text-end">
                        <button class="btn btn-light"><a href="index.php" class="text-dark ">Back To Home</a></button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</body>

</html>

<?php


?>