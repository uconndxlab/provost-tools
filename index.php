<?php
$db = new SQLite3('salaries.db');




?>
<!DOCTYPE html>
<html>

<head>
    <title>Faculty Salaries FY 2025</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>


    <div class="container">
        <h2>
            <a href="/">Faculty Salaries FY 2025 </a>
        </h2>
        <?php
        if (isset($_GET['department'])) {
            echo '<h3>Department: ' . $_GET['department'] . '</h3>';
        }

        if (isset($_GET['rank'])) {
            echo '<h3>Rank: ' . $_GET['rank'] . '</h3>';
        }

        if (isset($_GET['school'])) {
            echo '<h3>School/College: ' . $_GET['school'] . '</h3>';
        }
        ?>
        <div class="filters">
            <form action="index.php" method="get">
                <!-- school/college filter -->
                <label for="school">Filter by School/College:</label>
                <select name="school" id="school" onchange="this.form.submit()">
                    <option value="">All</option>
                    <?php
                    $schools = $db->query('SELECT DISTINCT Academic_School_College FROM faculty_salaries_fy_2025');
                    while ($school = $schools->fetchArray(SQLITE3_ASSOC)) {
                        $selected = isset($_GET['school']) && $_GET['school'] == $school['Academic_School_College'] ? 'selected' : '';
                        echo '<option value="' . $school['Academic_School_College'] . '" ' . $selected . '>' . $school['Academic_School_College'] . '</option>';
                    }
                    ?>
                </select>
                <noscript><button type="submit">Filter</button></noscript>
            </form>

            <?php
            if (isset($_GET['school'])) {
                $school = $_GET['school'];
                $departments = $db->query('SELECT DISTINCT Academic_Department FROM faculty_salaries_fy_2025 WHERE Academic_School_College = "' . $school . '"');
                if ($departments->numColumns() > 0) {
                    echo '<h3>Departments in ' . $school . '</h3>';
                    echo '<ul>';
                    while ($department = $departments->fetchArray(SQLITE3_ASSOC)) {
                        echo '<li><a href="index.php?department=' . urlencode($department['Academic_Department']) . '">' . $department['Academic_Department'] . '</a></li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p>No departments found for ' . $school . '</p>';
                }
            }

            $query = 'SELECT * FROM faculty_salaries_fy_2025 
LEFT JOIN payroll_ids 
ON faculty_salaries_fy_2025.Emplid = payroll_ids.payroll_id';

            if (isset($_GET['school'])) {
                $query .= ' WHERE Academic_School_College = "' . $_GET['school'] . '"';
            }

            if (isset($_GET['department'])) {
                $query .= ' WHERE Academic_Department = "' . $_GET['department'] . '"';
            }

            $stmt = $db->prepare($query);
            $result = $stmt->execute();
            $data = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $data[] = $row;
            }
            ?>
        </div>
    </div>
    <table>
        <tr>
            <th class="academic-school">Academic School/College</th>
            <th class="academic-department">Academic Department</th>
            <th class="emplid">Emplid</th>
            <th class="netid">NetID</th>
            <th class="full-name">Full Name</th>
            <th class="tt-ntt">TT/NTT</th>
            <th class="rank-description">Rank Description</th>
            <th class="faculty-role">Faculty Role</th>
            <th class="affiliated-department">Affiliated Department Name (Administrative Roles)</th>
            <th class="union-name">Union Name</th>
            <th class="payroll-fte">Payroll FTE</th>
            <th class="faculty-base-appointment">Faculty Base Appointment Term</th>
            <th class="appointment-term">Appointment Term</th>
            <th class="faculty-base-ucannl">Faculty Base (UCANNL)</th>
            <th class="additional-1-month">Additional 1 Month (UC1MTH)</th>
            <th class="additional-2-months">Additional 2 Months (UC2MTH)</th>
            <th class="admin-supplement">Admin Supplement (UCADM)</th>
            <th class="full-time-annual-salary">Full Time Annual Salary</th>
            <th class="nine-month-equivalent-annual-salary">Nine Month Equivalent of Annual Salary</th>
            <th class="nine-month-equivalent-base-salary">Nine Month Equivalent of Base Salary</th>
            <th class="gender">Gender</th>
            <th class="years-of-service">Years of Service</th>
            <th class="assistant-professor-year">Assistant Professor Year</th>
            <th class="associate-professor-year">Associate Professor Year</th>
            <th class="professor-year">Professor Year</th>
            <th class="years-in-rank">Years In Rank</th>
        </tr>
        </tr>
        <?php foreach ($data as $row) : ?>
            <tr>
                <td class="academic-school">
                    <a href="index.php?school=<?php echo $row['Academic_School_College']; ?>">
                        <?php echo $row['Academic_School_College']; ?>
                    </a>
                </td>
                <td class="academic-department">
                    <a href="index.php?department=<?php echo $row['Academic_Department']; ?>">
                        <?php echo $row['Academic_Department']; ?>
                    </a>
                </td>
                <td class="emplid"><?php echo $row['Emplid']; ?></td>
                <td class="netid"><?php echo $row['netid']; ?></td>
                <td class="full-name"><?php echo $row['Full_Name']; ?></td>
                <td class="tt-ntt"><?php echo $row['TT_NTT']; ?></td>
                <td class="rank-description">
                    <a href="index.php?rank=<?php echo $row['Rank_Description']; ?>">
                        <?php echo $row['Rank_Description']; ?>
                    </a>
                </td>
                <td class="faculty-role"><?php echo $row['Faculty_Role']; ?></td>
                <td class="affiliated-department"><?php echo $row['Affiliated_Department_Name_Administrative_Roles']; ?></td>
                <td class="union-name"><?php echo $row['Union_Name']; ?></td>
                <td class="payroll-fte"><?php echo $row['Payroll_FTE']; ?></td>
                <td class="faculty-base-appointment"><?php echo $row['Faculty_Base_Appointment_Term']; ?></td>
                <td class="appointment-term"><?php echo $row['Appointment_Term']; ?></td>
                <td class="faculty-base-ucannl">
                    <!-- format as currency -->
                    $<?php echo number_format($row['Faculty_Base_UCANNL'], 2); ?>
                </td>
                <td class="additional-1-month"><?php echo $row['Additional_1_Month_UC1MTH']; ?></td>
                <td class="additional-2-months"><?php echo $row['Additional_2_Months_UC2MTH']; ?></td>
                <td class="admin-supplement"><?php echo $row['Admin_Supplement_UCADM']; ?></td>
                <td class="full-time-annual-salary"><?php echo $row['Full_Time_Annual_Salary']; ?></td>
                <td class="nine-month-equivalent-annual-salary"><?php echo $row['Nine_mo_equivalent_of_annual_salary']; ?></td>
                <td class="nine-month-equivalent-base-salary"><?php echo $row['Nine_mo_equivalent_of_base_salary']; ?></td>
                <td class="gender"><?php echo $row['gender']; ?></td>
                <td class="years-of-service"><?php echo $row['years_of_service']; ?></td>
                <td class="assistant-professor-year"><?php echo $row['Assistant_Professor_Year']; ?></td>
                <td class="associate-professor-year"><?php echo $row['Associate_Professor_Year']; ?></td>
                <td class="professor-year"><?php echo $row['Professor_Year']; ?></td>
                <td class="years-in-rank"><?php echo $row['Years_In_Rank']; ?></td>
            </tr>
            </tr>
        <?php endforeach; ?>
    </table>


</body>

</html>