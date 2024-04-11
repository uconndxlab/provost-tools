<?php
$db = new SQLite3('salaries.db');

// prepare query string to also get netid by joining payroll_ids table on emplid, noting that it's Emplid in faculty_salaries_fy_2025

$query = 'SELECT * FROM faculty_salaries_fy_2025 LEFT JOIN payroll_ids ON faculty_salaries_fy_2025.Emplid = payroll_ids.payroll_id';

// execute the query
$results = $db->query($query);

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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Faculty Salaries FY 2025 (<?php echo count($data); ?>)</h2>
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
            <th>Empl Class Description - REMOVE FIELD FROM SCATTERPLOT DATA</th>
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
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo $row['Academic_School_College']; ?></td>
                <td><?php echo $row['Academic_Department']; ?></td>
                <td><?php echo $row['Emplid']; ?></td>
                <td><?php echo $row['netid']; ?></td>
                <td><?php echo $row['Full_Name']; ?></td>
                <td><?php echo $row['TT_NTT']; ?></td>
                <td><?php echo $row['Rank_Description']; ?></td>
                <td><?php echo $row['Faculty_Role']; ?></td>
                <td><?php echo $row['Affiliated_Department_Name_Administrative_Roles']; ?></td>
                <td><?php echo $row['Union_Name']; ?></td>
                <td><?php echo $row['Empl_Class_Description']; ?></td>
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