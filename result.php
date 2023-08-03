<?php
include 'mysqli.config.php';
// include 'welcome_login.php';
session_start();
if (isset($_SESSION['year']) && isset($_SESSION['month']) && isset($_SESSION['user_data'])) {
    $selectedMonth = $_SESSION["month"];
    $selectedYear = $_SESSION["year"];
    $student_id = $_SESSION["user_data"]["id"];

    $subjects_sql = "SELECT * FROM tbl_subject WHERE status = '1'";
    $subjects_result = $con->query($subjects_sql);
    $data = $subjects_result->num_rows;
    $subjects = array();
    if ($data > 0) {
        while ($row = $subjects_result->fetch_assoc()) {
            $subjects[] = $row['subject_name'];
        }
    }

    if (isset($_POST['submit'])) {
        $total = 400;
        $marks = $_POST['obtain'];
        $marksString = implode(',', $marks); // Convert the array to a comma-separated string

        $totalMarks = 0;
        foreach ($marks as $value) {
            $totalMarks += $value;
        }

        $query = "INSERT INTO tbl_data (student_id	,month, year, total, obtain) VALUES ('$student_id','$selectedMonth', '$selectedYear', '$total', '$totalMarks')";
        $result = $con->query($query);

        if ($result) {
            $tbl_data_id = $con->insert_id;

            foreach ($marks as $key => $subject_marks) {
                $subject = $subjects[$key];

                $query1 = "INSERT INTO tbl_result (student_id,tbl_data_id, subject, total, obtain) VALUES ('$student_id','$tbl_data_id', '$subject', '100', '$subject_marks')";
                $result1 = $con->query($query1);
                // $_SESSION['tbl_result']= mysqli_fetch_array($result1);
                if ($result1 !== true) {
                    die('query failed');
                }
            }
            header("location:resultlist.php");
        } else {
            echo "error";
        }
    }

?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Result</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <h2>Result Form</h2>
            <form method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Obtain Marks</th>
                                    <th scope="col">Marks</th>
                                </tr>
                            </thead>
                            <tbody id="subjectTable">
                                <?php
                                foreach ($subjects as $key => $subject) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $subject; ?><input type="hidden" name="subject[]" value="<?php echo $subject; ?>">
                                        </td>
                                        <td>100/</td>
                                        <td><input type="text" class="form-control" name="obtain[]" placeholder="Marks"></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class=" text-end">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <button class="btn btn-primary" id="backButton"><a href="resultlist.php" class="text-light ">View Detail</a></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
<?php
} else {
    echo "error";
}
?>