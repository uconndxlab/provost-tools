<?php
$db = new SQLite3('salaries.db');

// prepare query string to also get netid by joining payroll_ids table on emplid, noting that it's Emplid in faculty_salaries_fy_2025

$query = 'SELECT * FROM faculty_salaries_fy_2025 
LEFT JOIN payroll_ids 
ON faculty_salaries_fy_2025.Emplid = payroll_ids.payroll_id';

// prepare the statement, there might be department, rank, or school/college filters

if (isset($_GET['department'])) {
    $query .= ' WHERE Academic_Department = :department';
}

if (isset($_GET['rank'])) {
    $query .= ' WHERE Rank_Description = :rank';
}

if (isset($_GET['school'])) {
    $query .= ' WHERE Academic_School_College = :school';
}

$stmt = $db->prepare($query);

// bind the parameters
if (isset($_GET['department'])) {
    $stmt->bindValue(':department', $_GET['department']);
}

if (isset($_GET['rank'])) {
    $stmt->bindValue(':rank', $_GET['rank']);
}

if (isset($_GET['school'])) {
    $stmt->bindValue(':school', $_GET['school']);
}






// execute the query
$results = $stmt->execute();

// create an array to hold the data
$data = array();

// loop through the results and add them to the data array
while ($row = $results->fetchArray(
    SQLITE3_ASSOC
)) {
    if ($row['Emplid'] == 'Emplid') {
        continue;
    }
    $data[] = $row;
}


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


        <h4>Number of records: <?php echo count($data); ?></h4>
    </div>
    <table>
        <tr>
            <th>Academic School/College</th>
            <th>Academic Department</th>
            <th>Emplid</th>
            <th>NetID</th>
            <th>Full Name</th>
            <th>TT/NTT</th>
            <th>Rank Description</th>
            <th>Faculty Role</th>
            <th>Affiliated Department Name (Administrative Roles)</th>
            <th>Union Name</th>
            <th>Payroll FTE</th>
            <th>Faculty Base Appointment Term</th>
            <th>Appointment Term</th>
            <th>Faculty Base (UCANNL)</th>
            <th>Additional 1 Month (UC1MTH)</th>
            <th>Additional 2 Months (UC2MTH)</th>
            <th>Admin Supplement (UCADM)</th>
            <th>Full Time Annual Salary</th>
            <th>Nine Month Equivalent of Annual Salary</th>
            <th>Nine Month Equivalent of Base Salary</th>
            <th>Gender</th>
            <th>Years of Service</th>
            <th>Assistant Professor Year</th>
            <th>Associate Professor Year</th>
            <th>Professor Year</th>
            <th>Years In Rank</th>
        </tr>
        <?php foreach ($data as $row) : ?>
            <tr>
                <td>
                    <a href="index.php?school=<?php echo $row['Academic_School_College']; ?>">
                        <?php echo $row['Academic_School_College']; ?>
                    </a>
                </td>
                <td>
                    <a href="index.php?department=<?php echo $row['Academic_Department']; ?>">
                        <?php echo $row['Academic_Department']; ?>
                    </a>
                </td>
                <td><?php echo $row['Emplid']; ?></td>
                <td><?php echo $row['netid']; ?></td>
                <td><?php echo $row['Full_Name']; ?></td>
                <td><?php echo $row['TT_NTT']; ?></td>
                <td>
                    <a href="index.php?rank=<?php echo $row['Rank_Description']; ?>">
                        <?php echo $row['Rank_Description']; ?>
                    </a>
                </td>
                <td><?php echo $row['Faculty_Role']; ?></td>
                <td><?php echo $row['Affiliated_Department_Name_Administrative_Roles']; ?></td>
                <td><?php echo $row['Union_Name']; ?></td>
                <td><?php echo $row['Payroll_FTE']; ?></td>
                <td><?php echo $row['Faculty_Base_Appointment_Term']; ?></td>
                <td><?php echo $row['Appointment_Term']; ?></td>
                <td><?php echo $row['Faculty_Base_UCANNL']; ?></td>
                <td><?php echo $row['Additional_1_Month_UC1MTH']; ?></td>
                <td><?php echo $row['Additional_2_Months_UC2MTH']; ?></td>
                <td><?php echo $row['Admin_Supplement_UCADM']; ?></td>
                <td><?php echo $row['Full_Time_Annual_Salary']; ?></td>
                <td><?php echo $row['Nine_mo_equivalent_of_annual_salary']; ?></td>
                <td><?php echo $row['Nine_mo_equivalent_of_base_salary']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td><?php echo $row['years_of_service']; ?></td>
                <td><?php echo $row['Assistant_Professor_Year']; ?></td>
                <td><?php echo $row['Associate_Professor_Year']; ?></td>
                <td><?php echo $row['Professor_Year']; ?></td>
                <td><?php echo $row['Years_In_Rank']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>