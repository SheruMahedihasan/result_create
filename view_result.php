    <?php
    session_start();
    include 'mysqli.config.php';
    $id = $_GET['id'];



    $min_marks = 33;



    $math1 = "SELECT * FROM tbl_result WHERE tbl_data_id = $id";
    $result_math1 = $con->query($math1);
    $row_math1 = mysqli_fetch_assoc($result_math1);



    $p_f_subject = ($row_math1['obtain'] >= 33) ? 'pass' : 'fail';
    $math = "SELECT * FROM tbl_result WHERE tbl_data_id = $id";
    $result_math = $con->query($math);
    $total_marks = 0;
    $total_max = 0;
    while ($row_math = mysqli_fetch_assoc($result_math)) {
        // print_r($row_math);
        $total_marks += $row_math['obtain'];
        $total_max += $row_math['total'];
    }
    // echo $total_max;
    $p_f = ($total_marks > 132) ? 'pass' : 'fail';
    $persentage = $total_marks * 100 / $total_max;
    if ($persentage >= 90) {
        $grade = 'A+';
    } elseif ($persentage >= 85) {
        $grade = 'A';
    } elseif ($persentage >= 80) {
        $grade = 'B+';
    } elseif ($persentage >= 70) {
        $grade = 'B';
    } elseif ($persentage >= 60) {
        $grade = 'C';
    } elseif ($persentage >= 50) {
        $grade = 'D';
    } else {
        $grade = 'F';
    }

    // echo $p_f;
    // exit;
    // echo $total_max;




    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <style>
            #table {
                margin: 50px 0px 0px 200px;
                /* border: 1px solid black; */
            }
        </style>
    </head>

    <body>

        <div class="bg-light-subtle">
            <div class=" mt-5 text-center">

                <h2> Student Result </h2>
                <div class="text-center">
                    <!-- <button class="btn btn-primary"><a href="add_student.php" class="text-light ">Add Student</a></button>
                <button class="btn btn-danger "><a href="subject_add.php" class="text-light ">Add Subject</a></button>
                <button class="btn btn-primary"><a href="subject_index.php" class="text-light ">Show Subject tbl</a></button>
                <button class="btn btn-danger"><a href="login_student.php" class="text-light ">Login</a></button> -->

                </div>

            </div>
            <form action="" method="post">
                <table id="table" class="table bg-light border text-center  w-75 ">
                    <?php
                    $query = "SELECT * FROM tbl_result WHERE tbl_data_id = $id";
                    $result = $con->query($query);
                    $data = mysqli_num_rows($result);

                    if ($data > 0) {
                        $row_stud = mysqli_fetch_assoc($result);
                        $std_id = $row_stud['student_id'];
                    ?>
                        <thead>
                            <tr>
                                <th>student Name :-</th>
                                <?php
                                $query_name = "SELECT * from student_detail where id=$std_id";
                                $result_name = $con->query($query_name);
                                $row_name = $result_name->fetch_assoc();
                                ?>
                                <td><?php echo $row_name['name']; ?></td>
                            </tr>
                            <tr>
                                <th>Student Contact:-</th>
                                <td><?php echo $row_name['mobile']; ?></td>
                            </tr>
                            <tr>
                                <th>Month/Year:-</th>
                                <?php
                                $query_year = "SELECT * from tbl_data where id = $id";
                                $result_year = $con->query($query_year);
                                $row_year = $result_year->fetch_assoc();

                                ?>
                                <td><?php echo $row_year['month'] . "/" . $row_year['year']; ?></td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <th>Max </th>
                                <th>Min </th>
                                <th>Obtain</th>
                                <th>pass/fail</th>
                            </tr>
                            <!-- <table id="inner_table"> -->
                            <thead>

                                <?php

                                ?>

                                <?php
                                $query_student = "SELECT * FROM tbl_result WHERE tbl_data_id = $id";
                                $result_student = $con->query($query_student);
                                if (mysqli_num_rows($result_student) > 0) {
                                    while ($row_student = mysqli_fetch_assoc($result_student)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row_student['subject']; ?></td>
                                            <td><?php echo $row_student['total']; ?></td>
                                            <td><?php echo $min_marks; ?></td>
                                            <td><?php echo $row_student['obtain']; ?></td>
                                            <td><?php echo $p_f_subject; ?></td>
                                        </tr>


                                <?php
                                    }
                                } ?>
                                <tr>
                                    <th>-</th>
                                    <th>Total</th>
                                    <th>-</th>
                                    <th>total-Obtain</th>
                                    <th>Pass/Fail</th>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td><?php echo $total_max; ?></td>
                                    <td>-</td>
                                    <td><?php echo $total_marks; ?></td>
                                    <td><?php echo $p_f; ?></td>
                                </tr>
                                <tr>
                                    <th>-</th>
                                    <th>Persentage</th>
                                    <th>-</th>
                                    <th>Grade</th>
                                    <th>-</th>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td><?php echo $persentage; ?></td>
                                    <td>-</td>
                                    <td><?php echo $grade; ?></td>
                                    <td>-</td>
                                </tr>
                            </thead>
                            <!-- </table> -->
                        </thead>


                    <?php
                    } else {
                        die('Student not register');
                    }
                    ?>
                </table>
            </form>
            <div class=" text-end">
                <button class="btn btn-info"><a href="resultlist.php" class="text-light ">Back To Home</a></button>

            </div>

        </div>
    </body>

    </html>