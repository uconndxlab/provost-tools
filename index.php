<?php
$db = new SQLite3('salaries.db');

// use a password on the app using basic auth

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Provost Office"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Contact the Provost Office for access to this page.';
    exit;
} else {
    if ($_SERVER['PHP_AUTH_USER'] == 'i3admin' && $_SERVER['PHP_AUTH_PW'] == 'FY2025MVP!') {
    } else {
        header('WWW-Authenticate: Basic realm="Provost Office"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Contact the Provost Office for access to this page.';
        exit;
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faculty Salary Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome 5 CDN (required for some components) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://uconn.edu/content/themes/lobo/vendor/uconn/banner/_site/banner.css?ver=6.3.1">
    <link href="banner.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>

<body class="bg-light">
    <div id="uconn-banner" style="background-color:#000E2F;">
        <div id="uconn-header-container" class="row-container row-fluid container">
            <div id="home-link-container">
                <a id="home-link" href="https://uconn.edu/">
                    <span id="wordmark" aria-hidden="true">UConn</span>
                    <span id="university-of-connecticut" style="text-transform: uppercase;">
                        University of Connecticut
                    </span>
                </a>
            </div>
            <div id="button-container">
                <div class="icon-container" id="icon-container-search">
                    <a class="btn" id="uconn-search" href="https://uconn.edu/search">
                        <span class="no-css">Search University of Connecticut</span>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" aria-hidden="true" class="banner-icon">
                            <title>Search UConn</title>
                            <path d="M28.072 24.749l-6.046-6.046c0.912-1.499 1.437-3.256 1.437-5.139 0-5.466-4.738-10.203-10.205-10.203-5.466 0-9.898 4.432-9.898 9.898 0 5.467 4.736 10.205 10.203 10.205 1.818 0 3.52-0.493 4.984-1.349l6.078 6.080c0.597 0.595 1.56 0.595 2.154 0l1.509-1.507c0.594-0.595 0.378-1.344-0.216-1.938zM6.406 13.258c0-3.784 3.067-6.853 6.851-6.853 3.786 0 7.158 3.373 7.158 7.158s-3.067 6.853-6.853 6.853-7.157-3.373-7.157-7.158z"></path>
                        </svg>
                    </a>
                    <div id="uconn-search-tooltip"></div>
                </div>
                <div class="icon-container" id="icon-container-az">
                    <a class="btn" id="uconn-az" href="https://uconn.edu/az">
                        <span class="no-css">A to Z Index</span>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 32 32" aria-hidden="true" class="banner-icon">
                            <title>UConn A to Z Search</title>
                            <path d="M5.345 8.989h3.304l4.944 13.974h-3.167l-0.923-2.873h-5.147l-0.946 2.873h-3.055l4.989-13.974zM5.152 17.682h3.579l-1.764-5.499-1.815 5.499zM13.966 14.696h5.288v2.56h-5.288v-2.56zM20.848 20.496l7.147-9.032h-6.967v-2.474h10.597v2.341l-7.244 9.165h7.262v2.466h-10.798v-2.466h0.004z"></path>
                        </svg>
                    </a>
                    <div id="uconn-az-tooltip"></div>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color:#000E2F;">
        <div class="container ps-3">
            <nav class="upper-nav">
                <a class="parent-title" href="https://provost.uconn.edu/">
                    Office of the Provost
                </a>
            </nav>
            <!--Level 1 Title-->
            <nav class="navbar navbar-expand-lg navbar-light shift">
                <a class="navbar-brand" href="/">
                    Faculty Salary Tables
                </a>
            </nav>
        </div>
        <div class="bg-provost-blue">
            <div class="container mt-2">
                <div class="filters d-flex py-3">
                    <div class="dropdown mx-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="schoolDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            if (isset($_GET['school'])) {
                                echo $_GET['school'];
                            } else {
                                echo 'Filter by School';
                            }
                            ?>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="schoolDropdown">
                            <li><a class="dropdown-item" href="index.php">All Schools</a></li>
                            <?php
                            $schools = $db->query('SELECT DISTINCT Academic_School_College FROM faculty_salaries_fy_2025');
                            while ($school = $schools->fetchArray(SQLITE3_ASSOC)) {
                                $selected = isset($_GET['school']) && $_GET['school'] == $school['Academic_School_College'] ? 'selected' : '';
                                echo '<li><a class="dropdown-item" href="index.php?school=' . urlencode($school['Academic_School_College']) . '">' . $school['Academic_School_College'] . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <noscript><button type="submit">Filter</button></noscript>

                    <?php
                    if (isset($_GET['school'])) {
                        $school = $_GET['school'];
                        $departments = $db->query('SELECT DISTINCT Academic_Department FROM faculty_salaries_fy_2025 WHERE Academic_School_College = "' . $school . '"');
                        if ($departments->numColumns() > 0) {
                            echo '<div class="dropdown">';
                            echo '<button class="btn btn-secondary dropdown-toggle" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">';
                            if (isset($_GET['department'])) {
                                echo $_GET['department'];
                            } else {
                                echo 'Filter by Department';
                            }
                            echo '</button>';
                            echo '<ul class="dropdown-menu" aria-labelledby="departmentDropdown">';
                            while ($department = $departments->fetchArray(SQLITE3_ASSOC)) {
                                echo '<li><a class="dropdown-item" 
                                href="index.php?school=' . urlencode($school) . '&department=' . urlencode($department['Academic_Department']) . '">' . $department['Academic_Department'] . '</a></li>';
                            }
                            echo '</ul>';
                            echo '</div>';
                        } else {
                            echo '<p>No departments found for ' . $school . '</p>';
                        }
                    }

                    $query = 'SELECT * FROM faculty_salaries_fy_2025 
LEFT JOIN payroll_ids 
ON faculty_salaries_fy_2025.Emplid = payroll_ids.payroll_id';

                    if (isset($_GET['school']) && !isset($_GET['department'])) {
                        $query .= ' WHERE Academic_School_College = "' . $_GET['school'] . '"';
                    }

                    if (isset($_GET['department'])) {
                        $query .= ' WHERE Academic_Department = "' . $_GET['department'] . '"';
                    }

                    $query .= ' ORDER BY Academic_School_College, Academic_Department, Full_Name';

                    $stmt = $db->prepare($query);
                    $result = $stmt->execute();
                    $data = [];
                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        $data[] = $row;
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>


    <div class="container bg-light">
        <div class="row bg-light">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="academic-school">Academic School/College</th>
                            <th class="academic-department">Academic Department</th>
                            <th class="emplid hide">Emplid</th>
                            <th class="netid hide">NetID</th>
                            <th class="full-name">Full Name</th>
                            <th class="tt-ntt hide">TT/NTT</th>
                            <th class="rank-description">Rank Description</th>
                            <th class="faculty-role hide">Faculty Role</th>
                            <th class="affiliated-department hide">Affiliated Department Name (Administrative Roles)</th>
                            <th class="union-name hide">Union Name</th>
                            <th class="payroll-fte hide">Payroll FTE</th>
                            <th class="faculty-base-appointment hide">Faculty Base Appointment Term</th>
                            <th class="appointment-term hide">Appointment Term</th>
                            <th class="faculty-base-ucannl">Faculty Base</th>
                            <th class="additional-1-month">Additional 1 Month</th>
                            <th class="additional-2-months">Additional 2 Months</th>
                            <th class="admin-supplement">Admin Supplement</th>
                            <th class="full-time-annual-salary">Full Time Annual Salary</th>
                            <th class="nine-month-equivalent-annual-salary hide">Nine Month Equivalent of Annual Salary</th>
                            <th class="nine-month-equivalent-base-salary hide">Nine Month Equivalent of Base Salary</th>
                            <th class="gender hide">Gender</th>
                            <th class="years-of-service">Years of Service</th>
                            <th class="assistant-professor-year hide">Assistant Professor Year</th>
                            <th class="associate-professor-year hide">Associate Professor Year</th>
                            <th class="professor-year hide">Professor Year</th>
                            <th class="years-in-rank">Years In Rank</th>
                        </tr>
                    </thead>
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
                            <td class="emplid hide"><?php echo $row['Emplid']; ?></td>
                            <td class="netid hide"><?php echo $row['netid']; ?></td>
                            <td class="full-name"><?php echo $row['Full_Name']; ?></td>
                            <td class="tt-ntt hide"><?php echo $row['TT_NTT']; ?></td>
                            <td class="rank-description">

                                <?php echo $row['Rank_Description']; ?>

                            </td>
                            <td class="faculty-role hide"><?php echo $row['Faculty_Role']; ?></td>
                            <td class="affiliated-department hide"><?php echo $row['Affiliated_Department_Name_Administrative_Roles']; ?></td>
                            <td class="union-name hide"><?php echo $row['Union_Name']; ?></td>
                            <td class="payroll-fte hide"><?php echo $row['Payroll_FTE']; ?></td>
                            <td class="faculty-base-appointment hide"><?php echo $row['Faculty_Base_Appointment_Term']; ?></td>
                            <td class="appointment-term hide"><?php echo $row['Appointment_Term']; ?></td>
                            <td class="faculty-base-ucannl">
                                <!-- format as currency -->
                                $<?php echo number_format($row['Faculty_Base_UCANNL'], 2); ?>
                            </td>
                            <td class="additional-1-month">
                                <?php echo number_format($row['Additional_1_Month_UC1MTH'], 2); ?>
                            </td>
                            <td class="additional-2-months">
                                <?php
                                echo number_format($row['Additional_2_Months_UC2MTH'], 2);
                                ?>
                            </td>
                            <td class="admin-supplement"><?php echo $row['Admin_Supplement_UCADM']; ?></td>
                            <td class="full-time-annual-salary">
                                <?php echo '$' . number_format($row['Full_Time_Annual_Salary'], 2);
                                ?>
                            </td>
                            <td class="nine-month-equivalent-annual-salary hide"><?php echo $row['Nine_mo_equivalent_of_annual_salary']; ?></td>
                            <td class="nine-month-equivalent-base-salary hide"><?php echo $row['Nine_mo_equivalent_of_base_salary']; ?></td>
                            <td class="gender hide"><?php echo $row['gender']; ?></td>
                            <td class="years-of-service"><?php echo $row['years_of_service']; ?></td>
                            <td class="assistant-professor-year hide"><?php echo $row['Assistant_Professor_Year']; ?></td>
                            <td class="associate-professor-year hide"><?php echo $row['Associate_Professor_Year']; ?></td>
                            <td class="professor-year hide"><?php echo $row['Professor_Year']; ?></td>
                            <td class="years-in-rank"><?php echo $row['Years_In_Rank']; ?></td>
                        </tr>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>