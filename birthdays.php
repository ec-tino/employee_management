<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">   
    <link rel="stylesheet" href="new_forms.css">
    <title>Display</title>
</head>
<body>
<!-- <h2 style="text-align: center;">Promotion record </h2> -->
<table class="table table-striped">

<?php
    include("base_php.php");

    global $pdo;

    if (isset($_POST["birthdays"])) {  //generating birthdays in the month
        $this_month = $_POST["month"];

        $sql = "SELECT employees.employee_id, first_name, last_name, job_title,office, DATE_FORMAT(birth_date, '%M %d') AS birthday
                FROM employees JOIN personal_info ON employees.employee_id = personal_info.employee_id
                WHERE MONTH(birth_date) = :this_month";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":this_month", $this_month, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) {
            echo'<h2 style="text-align: center;">The are no birthday celebrants this month <br> </h2>';
        }else{
            echo '<h4 style="text-align: center;"> Birthday celebrants this month <br></h4>';
            $i = 1;
            $build_table = '<thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employee id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Date of Birth</th>
                                </tr>
                            </thead>
                            <tbody>';
        $build_rows = '';
            foreach ($result as $row) {
                $build_rows .= '<tr>
                                    <th scope="row">'.$i.'</th>
                                    <td>'.$row["employee_id"].'</td>
                                    <td>'.$row["first_name"].'</td>
                                    <td>'.$row["last_name"].'</td>
                                    <td>'.$row["job_title"].'</td>
                                    <td>'.$row["birthday"].'</td>
                                </tr>'; $i ++;
            }
            $display = $build_table.$build_rows;
            echo $display;
        }
    }
    else if (isset($_POST["past_employees"])) { //getting ALL FORMER employees
        $sql1 = "SELECT * FROM former_employees JOIN former_employees_details 
                    ON former_employees.employee_id = former_employees_details.employee_id";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $i = 1;
        $build_table = '<thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employee id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Deleter.</th>
                                <th scope="col">Date removed</th>
                                <th scope="col">Time</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Email</th>
                                <th scope="col">Location</th>
                                <th scope="col">Hired Date</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Home Address</th>
                                <th scope="col">Contact</th>
                                </tr>
                            </thead>
                            <tbody>';
        $build_rows = '';
        foreach ($result1 as $row) {
                $build_rows .= '<tr>
                                    <th scope="row">'.$i.'</th>
                                    <td>'.$row["employee_id"].'</td>
                                    <td>'.$row["first_name"].'</td>
                                    <td>'.$row["last_name"].'</td>
                                    <td>'.$row["deleter_id"].'</td>
                                    <td>'.$row["date_deleted"].'</td>
                                    <td>'.$row["time_deleted"].'</td>
                                    <td>'.$row["job_title"].'</td>
                                    <td>'.$row["email"].'</td>
                                    <td>'.$row["office"].'</td>
                                    <td>'.$row["hired_date"].'</td>
                                    <td>'.$row["salary"].'</td>
                                    <td>'.$row["home_address"].'</td>
                                    <td>'.$row["contact"].'</td>
                                </tr>'; $i ++;
        }
        $display = $build_table.$build_rows;
        echo '<h2 style="text-align: center;">Past Employees</h2>';
        echo $display;
    }


    //ALL ABSENCES
    else if (isset($_POST["attendance_records"])) {  //getting ALL ATTENDANCE RECORDS
        $sql0 = "SELECT * FROM attendance";
        $stmt0 = $pdo->prepare($sql0);
        $stmt0->execute();
        $result0 = $stmt0->fetchAll(PDO::FETCH_ASSOC);
        $i = 1;
        if (count($result0) == 0) { 
            echo '<h2 style="text-align: center;">No entry in attendance register <br> </h2>';
            exit();
        }
        $build_table = '<thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Date</th>
                                <th scope="col">Employee id</th>
                                <th scope="col">Status</th>
                                <th scope="col">Days Worked</th>
                                <th scope="col">No. Leave days Avail.</th>
                                <th scope="col">No. Absences</th>
                                <th scope="col">Leave request ID</th>
                                </tr>
                            </thead>
                            <tbody>';
        $build_rows = '';
        foreach ($result0 as $row) {
                $build_rows .= '<tr>
                                    <th scope="row">'.$i.'</th>
                                    <td>'.$row["date_today"].'</td>
                                    <td>'.$row["employee_id"].'</td>
                                    <td>'.$row["status_today"].'</td>
                                    <td>'.$row["no_days_worked"].'</td>
                                    <td>'.$row["leave_days_avail"].'</td>
                                    <td>'.$row["no_days_absent"].'</td>
                                    <td>'.$row["absence_request_id"].'</td>
                                </tr>'; $i ++;
        }
        $display = $build_table.$build_rows;
        echo '<h2 style="text-align: center;">Absence Records</h2>';
        echo $display;
    }


    else if (isset($_POST["all_employees"])) {  //getting ALL employees
        $sql2 = "SELECT * FROM employees JOIN personal_info ON employees.employee_id = personal_info.employee_id ORDER BY first_name";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute();
        $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $i = 1;
        $build_table = '<thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employee id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Email</th>
                                <th scope="col">Office</th>
                                <th scope="col">Hired Date</th>
                                <th scope="col">Salary</th>
                                </tr>
                            </thead>
                            <tbody>';
        $build_rows = '';
        foreach ($result2 as $row) {
            $build_rows .= '<tr>
                                <th scope="row">'.$i.'</th>
                                <td>'.$row["employee_id"].'</td>
                                <td>'.$row["first_name"].'</td>
                                <td>'.$row["last_name"].'</td>
                                <td>'.$row["job_title"].'</td>
                                <td>'.$row["email"].'</td>
                                <td>'.$row["office"].'</td>
                                <td>'.$row["hired_date"].'</td>
                                <td>'.$row["salary"].'</td>
                            </tr>'; $i ++;
        }
        $display = $build_table.$build_rows;
        echo '<h2 style="text-align: center;">Employees</h2>';
        echo $display;
    }

    //ALL NEW EMPLOYEES
    else if (isset($_POST["all_employees_new"])) {  //getting NEW employees
        $specified_date = $_POST["specified_date"];
        if ($specified_date > date("Y-m-d")) {
            echo '<h2 style="text-align: center;">You entered an invalid date <br> </h2>';
        }else{
            $sql3 = "SELECT * FROM employees JOIN personal_info ON employees.employee_id = personal_info.employee_id WHERE hired_date > :specified_date ORDER BY hired_date";
            $stmt3 = $pdo->prepare($sql3);
            $stmt3->bindParam(":specified_date", $specified_date, PDO::PARAM_STR);
            $stmt3->execute();
            $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
            $i = 1;
            $build_table = '<thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Employee id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Email</th>
                                <th scope="col">Office</th>
                                <th scope="col">Hired Date</th>
                                <th scope="col">Salarye</th>
                                </tr>
                            </thead>
                            <tbody>';
            $build_rows = '';
            foreach ($result3 as $row) {
                $build_rows .= '<tr>
                                    <th scope="row">'.$i.'</th>
                                    <td>'.$row["employee_id"].'</td>
                                    <td>'.$row["first_name"].'</td>
                                    <td>'.$row["last_name"].'</td>
                                    <td>'.$row["job_title"].'</td>
                                    <td>'.$row["email"].'</td>
                                    <td>'.$row["office"].'</td>
                                    <td>'.$row["hired_date"].'</td>
                                    <td>'.$row["salary"].'</td>
                                </tr>'; $i ++;
            }
            $display = $build_table.$build_rows;
            echo '<h2 style="text-align: center;">Employees</h2>';
            echo $display;
        }
    }

?>

</table>