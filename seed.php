<?php
$db = new SQLite3('salaries.db');

$db->exec('CREATE TABLE IF NOT EXISTS payroll_ids (netid TEXT, payroll_id TEXT)');


// open the csv, payroll_ids.csv and insert the data into the payroll_ids table
// headres in the csv are payroll_id,netid

$csv = array_map('str_getcsv', file('payroll_ids.csv'));

// empty the table
$db->exec('DELETE FROM payroll_ids');

// insert the data
foreach ($csv as $row) {
    $db->exec("INSERT INTO payroll_ids (netid, payroll_id) VALUES ('$row[1]', '$row[0]')");

    echo "inserting: " . $row[1] . (", " . $row[0] . "\n");
}

echo "Payroll IDs inserted\n";



// create a faculty_salaries_fy_2025 table with spaces replaced by underscores
// Academic School/College	Academic Department	    Emplid	  Full Name	TT/NTT	Rank Description	Faculty Role	Affiliated Department Name (Administrative Roles)	    Union Name	Empl Class Description - REMOVE FIELD FROM SCATTERPLOT DATA	   Payroll FTE	Faculty Base Appointment Term	Appointment Term	Faculty Base (UCANNL)	  Additional 1 Month (UC1MTH)	  Additional 2 Months (UC2MTH)	Admin Supplement (UCADM)	   Full Time Annual Salary	9-mo equivalent of annual salary	9-mo equivalent of base salary	Gender	Years of Service	Assistant Professor Year 	Associate Professor Year	Professor Year	Years In Rank

$db->exec('CREATE TABLE IF NOT EXISTS faculty_salaries_fy_2025 (
    Academic_School_College TEXT,
    Academic_Department TEXT,
    Emplid TEXT,
    Full_Name TEXT,
    TT_NTT TEXT,
    Rank_Description TEXT,
    Faculty_Role TEXT,
    Affiliated_Department_Name_Administrative_Roles TEXT,
    Union_Name TEXT,
    Empl_Class_Description,
    Payroll_FTE TEXT,
    Faculty_Base_Appointment_Term TEXT,
    Appointment_Term TEXT,
    Faculty_Base_UCANNL TEXT,
    Additional_1_Month_UC1MTH TEXT,
    Additional_2_Months_UC2MTH TEXT,
    Admin_Supplement_UCADM TEXT,
    Full_Time_Annual_Salary TEXT,
    Nine_mo_equivalent_of_annual_salary TEXT,
    Nine_mo_equivalent_of_base_salary,
    gender TEXT,
    years_of_service TEXT,
    Assistant_Professor_Year TEXT,
    Associate_Professor_Year TEXT,
    Professor_Year TEXT,
    Years_In_Rank TEXT
)');


// open the csv, faculty_salaries_fy_2025.csv and insert the data into the faculty_salaries_fy_2025 table
// headers in the csv are above

$csv = array_map('str_getcsv', file('faculty_salaries_fy_2025.csv'));

// empty the table
$db->exec('DELETE FROM faculty_salaries_fy_2025');

// insert the data, skipping the header row

foreach ($csv as $row) {
    if ($row[0] == 'Academic School/College') {
        continue;
    }

   echo "inserting: " . $row[2] . (", " . $row[3] . "\n");
   echo "\n";

   $stmt = $db->prepare("INSERT INTO faculty_salaries_fy_2025 (
        Academic_School_College,
        Academic_Department,
        Emplid,
        Full_Name,
        TT_NTT,
        Rank_Description,
        Faculty_Role,
        Affiliated_Department_Name_Administrative_Roles,
        Union_Name,
        Empl_Class_Description,
        Payroll_FTE,
        Faculty_Base_Appointment_Term,
        Appointment_Term,
        Faculty_Base_UCANNL,
        Additional_1_Month_UC1MTH,
        Additional_2_Months_UC2MTH,
        Admin_Supplement_UCADM,
        Full_Time_Annual_Salary,
        Nine_mo_equivalent_of_annual_salary,
        Nine_mo_equivalent_of_base_salary,
        gender,
        years_of_service,
        Assistant_Professor_Year,
        Associate_Professor_Year,
        Professor_Year,
        Years_In_Rank
    ) VALUES (:Academic_School_College, 
    :Academic_Department, 
    :Emplid, 
    :Full_Name, 
    :TT_NTT, 
    :Rank_Description, 
    :Faculty_Role, 
    :Affiliated_Department_Name_Administrative_Roles, 
    :Union_Name, 
    :Empl_Class_Description, 
    :Payroll_FTE, 
    :Faculty_Base_Appointment_Term, 
    :Appointment_Term, 
    :Faculty_Base_UCANNL, 
    :Additional_1_Month_UC1MTH, 
    :Additional_2_Months_UC2MTH, 
    :Admin_Supplement_UCADM, 
    :Full_Time_Annual_Salary, 
    :Nine_mo_equivalent_of_annual_salary, 
    :Nine_mo_equivalent_of_base_salary, 
    :gender, :years_of_service, 
    :Assistant_Professor_Year, 
    :Associate_Professor_Year, 
    :Professor_Year, 
    :Years_In_Rank)");

    $stmt->bindValue(':Academic_School_College', $row[0]);
    $stmt->bindValue(':Academic_Department', $row[1]);
    $stmt->bindValue(':Emplid', $row[2]);
    $stmt->bindValue(':Full_Name', $row[3]);
    $stmt->bindValue(':TT_NTT', $row[4]);
    $stmt->bindValue(':Rank_Description', $row[5]);
    $stmt->bindValue(':Faculty_Role', $row[6]);
    $stmt->bindValue(':Affiliated_Department_Name_Administrative_Roles', $row[7]);
    $stmt->bindValue(':Union_Name', $row[8]);
    $stmt->bindValue(':Empl_Class_Description', $row[9]);
    $stmt->bindValue(':Payroll_FTE', $row[10]);
    $stmt->bindValue(':Faculty_Base_Appointment_Term', $row[11]);
    $stmt->bindValue(':Appointment_Term', $row[12]);
    $stmt->bindValue(':Faculty_Base_UCANNL', $row[13]);
    $stmt->bindValue(':Additional_1_Month_UC1MTH', $row[14]);
    $stmt->bindValue(':Additional_2_Months_UC2MTH', $row[15]);
    $stmt->bindValue(':Admin_Supplement_UCADM', $row[16]);
    $stmt->bindValue(':Full_Time_Annual_Salary', $row[17]);
    $stmt->bindValue(':Nine_mo_equivalent_of_annual_salary', $row[18]);
    $stmt->bindValue(':Nine_mo_equivalent_of_base_salary', $row[19]);
    $stmt->bindValue(':gender', $row[20]);
    $stmt->bindValue(':years_of_service', $row[21]);
    $stmt->bindValue(':Assistant_Professor_Year', $row[22]);
    $stmt->bindValue(':Associate_Professor_Year', $row[23]);
    $stmt->bindValue(':Professor_Year', $row[24]);
    $stmt->bindValue(':Years_In_Rank', $row[25]);
    $stmt->execute();
}

echo "Faculty Salaries inserted\n";

// close the database
$db->close();