<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">   
    <link rel="stylesheet" href="new_forms.css">
    <title>Homepage</title>
</head>
<body>
    <div class="d-flex" style="background-color: #e0e0e0;">
        <ul class="nav nav-tabs ms-auto">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="employee_dir.php">Employee Directory</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_employee.php">Add Employee</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="payroll.php">Payroll</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="leave.php">Leave requests</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sign-in.php">Sign Out</a>
            </li>
        </ul> 
    </div> 
    <!-- add notification of new leave request-->
    <?php
        include "test_conn.php";

        global $host2;
        global $dbname2;
        global $password2;
        global $username2;

        $pdo = new PDO("mysql:host=$host2;dbname=$dbname2;charset=utf8", $username2, $password2);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // write query to return all pending requests
        $sql = "SELECT COUNT(*) FROM absence_requests WHERE request_status = 'pending'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            echo'<p style="text-align: right; color: red; margin-right: 20px;">[You have '.$count. ' new Leave request(s)]</p>';
        }
    ?>

    <h1 style="text-align: center; font-family: 'Playfair Display', serif; font-size: 3rem; font-weight: 600;">Kilburnazon Workspace</h1>
    <div class="container border border-secondary" style="display: flex; justify-content: center; align-items: flex-start;">
        <div class="col border border-dark p-3" style="margin-right: 1%;">
            <!-- WHO IS ABSENT -->
            <div class="form-container" style="margin-bottom: 3%">
                <form name="leave_request" action="all_exec_forms.php" method="POST">
                    <p style="text-decoration: underline; text-decoration-style: dotted; font-weight: 5%; font-size: 15px; text-align: center; color: rgb(61, 139, 234);"> 
                        Want to approve a leave request? View dates that have already been given out for leave</p>

                    <label for="leave_type" class="l1">Leave Type (optional)</label>
                    <select id="leave_type" name="leave_type" class="in">
                        <option value="">--Select--</option>
                        <option value="sick">Sick</option>
                        <option value="vacation">Vacation</option>
                        <option value="personal">Personal</option>
                    </select>

                    <label for="start_date" class="l1">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required class="in">

                    <label for="end_date" class="l1">End Date</label>
                    <input type="date" id="end_date" name="end_date" required class="in">

                    <input type="submit" value="View" name="exec_leave" class="send">
                </form>
            </div>
            <!-- get all promotions -->
            <div class="form-container" style="margin-bottom: 3%">
                <form name="promotion_list" action="all_promotions.php" method="POST">
                    <input type="submit" value="Get All Promotions" name="all_new_promotions" class="send">
                </form>
            </div>
            <!-- get All EMPLOYEES: goes to birthdays add php code there-->
            <div class="form-container" style="margin-bottom: 2%">
                <form name="new_employees" action="birthdays.php" method="post"> 
                    <input type="submit" value="Get All Employees" name="all_employees" class="send">
                </form>
            </div>
            <!-- Get Employees who join within the past specifified date -->
            <div class="form-container">
                <form name="new_employees_spec" action="birthdays.php" method="post">
                    <p style="text-decoration: underline; text-decoration-style: dotted; font-weight: 5%; font-size: 15px; text-align: center; color: rgb(61, 139, 234);"> 
                        Get new employees since specified date</p> 
                    <label for="hired_date" class="l1">Date</label>
                    <input type="date" id="specified_date" name="specified_date" required class="in">

                    <input type="submit" value="Get Employees" name="all_employees_new" class="send">
                </form>
            </div>
        </div> 
        <div class="col border border-dark p-3" style="margin-right: 1%;">
            <!--  PROMOTE AN EMPLOYEE-->
            <div class="form-container" style="margin-bottom: 3%">
                <form name="promotion" action="all_exec_forms.php" method="post">
                    <p style="text-decoration: underline; text-decoration-style: dotted; font-weight: 5%; font-size: 15px; text-align: center; color: rgb(61, 139, 234);"> 
                            Promote an Employee...</p>
                    <?php
                        if (isset($_GET["promoted"])){
                            if ($_GET["promoted"] == "yes"){echo "<p style='text-align: center;'>Employee promoted successfully. (Click 'Get All Promotions' to view your recent entry)</p>";}
                            else{echo "<p style='color: red; text-align: center;'>Unable to promote employee. Check credentials and try again..</p>";}
                        }
                    ?>
                    <label style="text-align: center; font-size: 13px; font-family: 'Playfair Display', serif;">Rewarding hard work...</label>
                    <label for="worker_id" class="l1">Employee ID</label>
                    <input type="text" id="worker_id" name="worker_id" required class="in">

                    <label for="old_position" class="l1">Previous Position</label>
                    <input type="text" id="old_position" name="old_position" required class="in">

                    <label for="new_position" class="l1">New Position</label>
                    <input type="text" id="new_position" name="new_position" required class="in" placeholder="Enter prev position if position does not change">

                    <label for="raise_perc" class="l1">Salary Raise % </label>
                    <input type="text" id="raise_perc" name="raise_perc" required class="in">

                    <input type="submit" value="Promote Employee" name="promotions" class="send">
                </form>
            </div>

            <!--  absenttoday-->
            <div class="form-container" style="margin-bottom: 3%">
                <form name="not_working" action="all_exec_forms.php" method="post">
                    <p style="text-decoration: underline; text-decoration-style: dotted; font-weight: 5%; font-size: 15px; text-align: center; color: rgb(61, 139, 234);"> 
                        Not reporting to work today? Check absent..</p>
                    <?php 
                        if (isset($_GET["employee_id"])){
                            if ($_GET["employee_id"] == "invalid"){echo "<p style='color: red; text-align: center;'>Invalid employee ID</p> ";}
                            else if ($_GET["employee_id"] == "failed"){echo "<p style='color: red; text-align: center;'>Could not mark absent. Try again</p>";}
                            else{echo "<p style='text-align: center;'>Successfully marked Absent</p>";}
                        }
                    ?>
                    <label for="worker_id" class="l1">Employee ID</label>
                    <input type="text" id="worker_id" name="worker_id" required class="in">
                    <input type="checkbox" name="absent_check" value="absent" required><label for="absent_check" style="font-size: 14px">Check box if you are NOT reporting to work today</label>
                    <input type="submit" value="Mark Absent" name="mark_absent" class="send">
                </form>
            </div>
        </div>
        <div class="col border border-dark p-3" >
            <!--  birthday forms-->
            <div class="form-container" style="margin-bottom: 3%">
                <form name="birthdays" action="birthdays.php" method="POST">
                    <p style="text-decoration: underline; text-decoration-style: dotted; font-weight: 5%; font-size: 15px; text-align: center; color: rgb(61, 139, 234);"> 
                        Celebrating our hardworking employees</p>
                    <label style="text-align: center; font-size: 13px; font-family: 'Playfair Display', serif;">Find birthday celebrants this month...</label>
                    <label for="month" class="l1">Select birth month</label>
                    <select id="month" name="month" required class="in">
                        <option value="">--Select--</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <input type="submit" value="Find People" name="birthdays" class="send">
                </form>
            </div>

            <!--  deleting employee data-->
            <div class="form-container" style="margin-bottom: 3%">
                <form name="delete_employee" action="all_exec_forms.php" method="POST">
                    <p style="text-decoration: underline; text-decoration-style: dotted; font-weight: 5%; font-size: 15px; text-align: center; color: rgb(61, 139, 234);"> 
                        Not working here anymore? Delete account..</p>
                    <?php
                        if (isset($_GET["delete"])){
                            if ($_GET["delete"] == "deleter"){echo "<p style='text-align: center; color: red;'>Could not delete employee account; Make sure your employee ID is for an Executive</p>";}
                            else if ($_GET["delete"] == "not_found"){echo "<p style='text-align: center; color: red;'>The employee you want to delete does not exist. Check employee ID..</p>";}
                            else if ($_GET["delete"] == "failed"){echo "<p style='text-align: center; color: red;'>Could not delete employee. Try again..</p>";}
                            else{echo "<p style='text-align: center;'>Employee deleted successfully..</p>";}
                        }
                    ?>
                    <label for="worker_id" class="l1">Enter Your Worker ID</label>
                    <input type="text" id="worker_id" name="worker_id" required class="in">
                    <label style="text-align: center; color: red; font-size: 14px; font-family: 'Playfair Display', serif;">Now enter credentials of employee no longer working with us...</label>
                    
                    <label for="ex_worker_id" class="l1">Employee ID</label>
                    <input type="text" id="ex_worker_id" name="ex_worker_id" required class="in">

                    <input type="submit" value="Delete Account" name="delete_account" class="send">
                </form>
            </div>
            <!--PAST EMPLOYEES-->
            <div class="form-container" style="margin-bottom: 3%">
                <form name="past_employees_list" action="birthdays.php" method="POST">
                    <input type="submit" value="Get Past Employees" name="past_employees" class="send">
                </form>
            </div>
            <!--ATTENDANCE RECORDS-->
            <div class="form-container">
                <form name="attendance" action="birthdays.php" method="POST">
                    <input type="submit" value="Get Attendance Records" name="attendance_records" class="send">
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>

