<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    include 'mysqli.config.php';
    ?>
    <div class="bg-light-subtle">
        <table class="table bg-light border-light-subtle text-center">
            <div class=" mt-5 text-center">

                <h2> User Data </h2>
                <div class="text-center">
                    <button class="btn btn-primary"><a href="add_student.php" class="text-light ">Add Student</a></button>
                    <button class="btn btn-danger "><a href="subject_add.php" class="text-light ">Add Subject</a></button>
                    <button class="btn btn-primary"><a href="subject_index.php" class="text-light ">Show Subject tbl</a></button>
                    <button class="btn btn-danger"><a href="login_student.php" class="text-light ">Login</a></button>

                </div>

            </div>

            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $query = "select * from student_detail";
            $result = mysqli_query($con, $query);
            $data = mysqli_num_rows($result);
            if ($data != 0) {
                $data = mysqli_num_rows($result);

                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['mobile']; ?></td>
                        <td><?php echo $row['password']; ?></td>
                        <td> <a href='student_detail_show.php?id=<?php echo $row['id']; ?>'><input type='submit' value='View' class='update'></a>
                            <a href='delete_student.php?id=<?php echo $row['id']; ?>'>
                                <button onclick='return confirm("Are you sure delete?")'>DELETE</button>
                            </a>
                        </td>
                    </tr>
                <?php   }
            } else { ?>
                <tr>
                    <td><b>No Result...........</b></td>
                </tr>
            <?php

            }
            ?>

        </table>
        <div class="py-3 m-auto text-center">

        </div>

    </div>
</body>

</html>