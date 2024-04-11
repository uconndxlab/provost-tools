<?php 
// create a sqlite3 db for salaries.db
$db = new SQLite3('salaries.db');

// select all the rows from the payroll_ids table and put them in an array
$results = $db->query('SELECT * FROM payroll_ids' 
    . ' ORDER BY payroll_id');


// create an array to hold the data
$data = array();

// loop through the results and add them to the data array
while ($row = $results->fetchArray()) {
    if ($row['netid'] == 'netid') {
        continue;
    }
    $data[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payroll IDs</title>
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
    <h2>Payroll IDs (<?php echo count($data); ?>)</h2>
    <table>
        <tr>
            <th>NetID</th>
            <th>Payroll ID</th>
        </tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo $row['netid']; ?></td>
                <td><?php echo $row['payroll_id']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>