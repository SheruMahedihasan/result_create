<?php

session_start();
include 'mysqli.config.php';
if (isset($_SESSION['user_data'])) {
    // $student_id = $_SESSION['id'];
    $name = $_SESSION['user_data']['name'];
    // $student_id = $_SESSION['id'];

    $currentYear = date('Y');

    // Create an array of month names
    $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    ];

    if (isset($_POST["submit"])) {
        $selectedMonth = $_POST["month"];
        $selectedYear = $_POST["year"];

        if (!empty($selectedMonth) && !empty($selectedYear)) {
            $_SESSION['month'] = $selectedMonth;
            $_SESSION['year'] = $selectedYear;

            header("Location: result.php?month=$selectedMonth&year=$selectedYear");
            exit();
        } else {
            echo "Please select a month and year.";
        }
    }
?>

    <html>

    <head>
        <title>Result</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>

    <body>
        <form action="" method="post">
            <!-- Month dropdown -->
            <select name="month">
                <?php foreach ($months as $monthNumber => $monthName) : ?>
                    <option value="<?php echo $monthNumber; ?>"><?php echo $monthName; ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Year dropdown -->
            <select name="year">
                <?php for ($year = $currentYear; $year >= $currentYear - 100; $year--) : ?>
                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                <?php endfor; ?>
            </select>
            <button type="submit" name="submit">Submit</button>
        </form>
    </body>

    </html>
<?php } else {
    header("location: login_student.php"); // Redirect to the login page if session data is not available
    exit;
}
?>