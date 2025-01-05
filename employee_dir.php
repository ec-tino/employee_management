<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link rel="stylesheet" href="<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="employee_dir.css">
        <script>
            function showResult(str) {
            if (str.length==0) {
                document.getElementById("employees_box").innerHTML="";
                document.getElementById("employees_box").style.border="0px";
                return;
            }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                document.getElementById("employees_box").innerHTML="";
                document.getElementById("employees_box").innerHTML=this.responseText;
                document.getElementById("employees_box").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","filter.php?q="+str,true);
            xmlhttp.send();
            }
        </script>
        <title>Employee Directory</title>

    </head>

    <body>
        <div class="d-flex" style="background-color: #e0e0e0;">
            <ul class="nav nav-tabs ms-auto">
                <li class="nav-item">
                    <a class="nav-link"  href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Employee Directory</a>
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
        <h1 style="text-align: center; font-family: 'Poppins', sans-serif; font-size: 3rem; font-weight: 700;">Employee Directory</h1>
        <div class="container border border-secondary" id="big_outer_box">
            <form name="search_employee" action="filter.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="search" class="form-control" id="livesearch" onkeyup="showResult(this.value)">
                </div>
            </form>
        </div>
        <div class="container border border-secondary" style="display: grid; grid-auto-flow: column;justify-items: center; align-items: start; gap: 10px;">
                <form id="filter_form" action="employee_dir.php" method="post"> <!-- think of a way -->
                    <nav class="navbar navbar-expand-lg bg-body-tertiary">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Filter Options: </a>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                <label> </label><br>
                                <select name="department">
                                    <option value="">--Department--</option>
                                    <option value="executive"> Executive</option>
                                    <option value="operation"> Operation</option>
                                    <option value="marketing"> Marketing</option>
                                    <option value="technology"> Technology</option>
                                    <option value="finance"> Finance</option>
                                </select>
                                </li>
                                <li class="nav-item">
                                    <label></label><br>
                                    <select name="contract">
                                        <option value="">--Contract--</option>
                                        <option value="full_time"> Full time</option>
                                        <option value="part_time"> Part time</option>
                                        <option value="freelance"> Freelance</option>
                                    </select>
                                </li>
                                <li class="nav-item">
                                    <label></label><br>
                                    <select name="position">
                                        <option value="">--Job Title--</option>
                                        <option value="hso"> Health & Safety Off.</option>
                                        <option value="factory worker"> Factory Worker</option>
                                        <option value="delivery driver"> Delivery Driver</option>
                                        <option value="accountant"> Accountant</option>
                                        <option value="analyst"> Analyst</option>
                                        <option value="brand developer">Brand Developer</option>
                                        <option value="industry researcher">Industry Researcher</option>
                                        <option value="product designer">Product Designer</option>
                                        <option value="front end developer">Front-end Developer</option>
                                        <option value="back end developer">Front-end Developer</option>
                                        <option value="cybersecurity">Cybersecurity</option>
                                        <option value="full stack developer">Full-Stack Developer</option>
                                        <option value="junior developer">Junior Developer</option>
                                        <option value="cfo">Chief Financial Officer (CFO)</option>
                                        <option value="ceo">Chief Executive Officer (CEO)</option>
                                        <option value="cmo">Chief Marketing Officer (CMO)</option>
                                        <option value="coo">Chief Operating Officer (COO)</option>
                                        <option value="cto">Chief Technology Officer (CTO)</option>
                                        <option value="pa">Personal Assistant (PA)</option>
                                    </select>
                                </li>
                                
                                <li class="nav-item">
                                    <label></label><br>
                                    <select name="office_location">
                                        <option value="">--Location--</option>
                                        <option value="Eng_south_dist">England South Dist. Center</option>
                                        <option value="wales_dist">Wales Distribution Center</option>
                                        <option value="london_office">London Office</option>
                                        <option value="kilburnazon_head">Kilburnazon Head Office</option>
                                        <option value="eng_central_dist">England Central Dist. Center</option>
                                        <option value="birmingham_office">Birmingham Office</option>
                                        <option value="north_england_dist">North England Dist. Center</option>
                                        <option value="scotland_dist">Scotland Dist. Center</option>
                                        <option value="northern_ireland_dist">Northern Ireland Distribution Center</option>
                                    </select>
                                </li>
                                <li class="nav-item">
                                    <label> Worked here since: </label><br>
                                    <input type="date" id="hired_date" name="hired_date"> <br> 
                                </li>
                            </ul>
                            <div class="d-flex" role="search">
                                <button class="btn btn-outline-success" type="submit" name="apply" >Filter</button>
                            </div>
                        </div>
                    </nav>                            
                </form>
            </div>
        </div>
        <div class="container border border-secondary" id="employees_box" style="display: flex; flex-wrap: wrap; gap: 20px;"> 
                
        <?php

                include("test_conn.php");

                global $dbname2;
                global $dbuser2;
                global $dbpass2;
                global $host2;

                    //this code should apply filters
                $pdo = new PDO("mysql:host=$host2;dbname=$dbname2;charset=utf8", $username2, $password2);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);  
                
                if (isset($_POST["apply"])) {
                    
                    $department = $_POST['department'] ?? null;
                    $job_title = $_POST['position'] ?? null;
                    $contract_type = $_POST['contract'] ?? null;
                    $office = $_POST['office_location'] ?? null;
                    $hired_date = $_POST['hired_date'] ?? null;
                

                    $query = "SELECT * FROM employees JOIN personal_info ON employees.employee_id = personal_info.employee_id 
                            JOIN departments ON employees.job_title = departments.job_title WHERE 1=1 ";

                    if (!empty($department)) {
                        $query .= "AND department = '".$department."' ";
                    }
                    if (!empty($job_title)) {
                        $query .= "AND employees.job_title = '".$job_title."' ";
                    }
                    if (!empty($office)) {
                        $query .= "AND office = '".$office."' ";
                    }
                    if (!empty($hired_date)) {
                        $query .= "AND hired_date < '".$hired_date."' ";
                    }
                    if (!empty($contract_type)) {
                        $query .= "AND contract_type = '".$contract_type."' ";
                    }
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 

                    foreach ($results as $row) {
                        $output .= '<div class="card" style="width: 18rem; background-color: #f5f5f5; text-align: center;">
                                <img src="./try_images/person-circle.svg" class="card-img-top" alt="..." style="width: 100px; height: 100px; margin-left: 30%">
                                    <div class="card-body">
                                    <h5 class="card-title">'.$row["first_name"].'  '.$row["last_name"].'</h5>
                                    <p class="card-text" style="line-height: 0.5;">'.$row["job_title"].'</p>
                                    <p class="card-text" style="line-height: 0.5;">'.$row["office"].'</p>
                                    <p class="card-text" style="line-height: 0.5;">'.$row["email"].'</p>
                                    <a href="details.php?employee='.$row["employee_id"].'" class="btn btn-primary">More..</a>
                                    </div>
                                    </div>';
                    }
                    echo $output;
                }
            ?>
                    
            </div>
        </div>
    </body>
</html>


