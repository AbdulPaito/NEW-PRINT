<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Save form data into session variables from Page 2
    $_SESSION['sex'] = isset($_POST['sex']) ? $_POST['sex'] : [];
    $_SESSION['civil_status'] = isset($_POST['civil_status']) ? $_POST['civil_status'] : [];
    $_SESSION['employment_status'] = $_POST['employment_status'] ?? '';
    $_SESSION['month_of_birth'] = $_POST['month_of_birth'] ?? '';
    $_SESSION['day_of_birth'] = $_POST['day_of_birth'] ?? '';
    $_SESSION['year_of_birth'] = $_POST['year_of_birth'] ?? '';
    $_SESSION['age'] = $_POST['age'] ?? '';
    $_SESSION['birthplace_city_municipality'] = $_POST['birthplace_city_municipality'] ?? '';
    $_SESSION['birthplace_province'] = $_POST['birthplace_province'] ?? '';
    $_SESSION['birthplace_region'] = $_POST['birthplace_region'] ?? '';
    $_SESSION['educational_attainment'] = $_POST['educational_attainment'] ?? [];
    $_SESSION['parent_guardian_name'] = $_POST['parent_guardian_name'] ?? '';
    $_SESSION['parent_guardian_address'] = $_POST['parent_guardian_address'] ?? '';
    $_SESSION['classification'] = $_POST['classification'] ?? [];
    

    // Validate required fields
    if (
        empty($_POST['sex']) ||
        empty($_POST['civil_status']) ||
        empty($_POST['employment_status']) ||
        empty($_POST['month_of_birth']) ||
        empty($_POST['day_of_birth']) ||
        empty($_POST['year_of_birth']) ||
        empty($_POST['birthplace_city_municipality']) ||
        empty($_POST['birthplace_province']) ||
        empty($_POST['birthplace_region']) ||
        empty($_POST['educational_attainment']) ||
        empty($_POST['parent_guardian_name']) ||
        empty($_POST['parent_guardian_address']) ||
        empty($_POST['classification'])
    ) {
        echo '<script>alert("Please complete all required fields before proceeding.");</script>';
    } else {
        // Save form data into session variables from Page 2
        $_SESSION['sex'] = $_POST['sex'];
        $_SESSION['civil_status'] = $_POST['civil_status'];
        $_SESSION['employment_status'] = $_POST['employment_status'];
        $_SESSION['month_of_birth'] = $_POST['month_of_birth'];
        $_SESSION['day_of_birth'] = $_POST['day_of_birth'];
        $_SESSION['year_of_birth'] = $_POST['year_of_birth'];
        $_SESSION['age'] = $_POST['age'] ?? '';
        $_SESSION['birthplace_city_municipality'] = $_POST['birthplace_city_municipality'];
        $_SESSION['birthplace_province'] = $_POST['birthplace_province'];
        $_SESSION['birthplace_region'] = $_POST['birthplace_region'];
        $_SESSION['educational_attainment'] = $_POST['educational_attainment'];
        $_SESSION['parent_guardian_name'] = $_POST['parent_guardian_name'];
        $_SESSION['parent_guardian_address'] = $_POST['parent_guardian_address'];
        $_SESSION['classification'] = $_POST['classification'];

        // Redirect to Page 3
        header('Location: page3.php');
        exit();
    }
}
// Prepopulate the form fields with session data if it exists
$birthplace_city_municipality = $_SESSION['birthplace_city_municipality'] ?? '';
$birthplace_province = $_SESSION['birthplace_province'] ?? '';
$birthplace_region = $_SESSION['birthplace_region'] ?? '';

// Predefined options
$cities = [
    'Arayat',
    'Arenas', 'Baliti', 'Batasan', 'Buensuceso', 'Candating', 'Gatiawin', 
            'Guemasan', 'La Paz (Turu)', 'Lacmit', 'Lacquios', 'Mangga-Cacutud', 
            'Mapalad', 'Panlinlang', 'Paralaya', 'Plazang Luma', 'Poblacion', 
            'San Agustin Norte', 'San Agustin Sur', 'San Antonio', 'San Jose Mesulo', 
            'San Juan Bano', 'San Mateo', 'San Nicolas', 'San Roque Bitas', 
            'Cupang (Santa Lucia)', 'Matamo (Santa Lucia)', 'Santo Niño Tabuan', 
            'Suclayin', 'Telapayong', 'Kaledian (Camba)'
];

$provinces = [
    'Pampanga',
   
];

$regions = [
    'Region 1', 'Region 2', 'Region 3', 'Region 4', 'Region 5', 
    'Region 6', 'Region 7', 'Region 8', 'Region 9', 'Region 10', 
    'Region 11', 'Region 12', 'Region 13', 'Region 14', 'Region 15', 
    'Region 16', 'Region 17', 'Region 18'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - Page 2</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f4f9;
        }

        .page {
            max-width: 1700px; /* Adjust as needed */
            height: 640px;
            margin: 0px auto;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden; /* Prevents overflow from breaking layout */
        }

        h2, h1, h3, p {
            text-align: center;
            margin-bottom: 10px;
        }

        form {
            width: 100%;
            margin-top: 20px; /* Provides space between headings and form */
        }
           .table-container {
            display: flex;
            justify-content: center; /* Centers the table horizontally */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .education{
            text-align: center;
            padding: 5px;
            width: 10px;
        }
        .learner{
            text-align: center;
        }

        th, td {
            padding: 3px; /* Adjust padding for tighter spacing */
            text-align: left;
            border: 2px solid #007bff;
            font-size: 22px;
          
        }

        
        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        td input[type="text"], td input[type="checkbox"], td input[type="radio"] {
            margin-top: 3px;
           
            
        }
        td input[type="text"] {
            width: calc(100% - 16px); /* Adjust width to fit table without overflow */
            padding: 6px;
            width: 100px;
            border: 1px solid black;
            border-radius: 4px;
            box-sizing: border-box; /* Ensure padding and border are included in the width */
        }
        .center {
            text-align: center;
            margin-top: 20px; /* Provides space for buttons */
        }

        button[type="submit"], button[type="button"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover, button[type="button"]:hover {
            background-color: #0056b3;
        }

      /* Adjust for smaller screens */
@media (max-width: 768px) {
    td input[type="text"] {
        width: 100%; /* Full width on smaller screens */
    }
}

@media (max-width: 480px) {
    td input[type="text"] {
        width: 100%; /* Full width on very small screens */
        padding: 4px; /* Reduce padding on very small screens */
    }
}
.header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
           
        }

        .header-container img {
            width: 120px; /* Adjust the width as needed */
            height: auto;
        }

        .page {
            max-width: 100%;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden; /* Prevents overflow from breaking layout */
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: center;
            }

            .header-container img {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="page">
    <div class="header-container">
        <img src="TESDA-Logo.jpg" alt="Left Logo">
       <div><h1>Technical Education and Skills Development Authority</h1>
        <h1><p>Pangasiwaan sa Edukasyong Teknikal at Pagpapaunlad ng Kasanayan</p></h1>
        <h1>Registration Form - Page 2/4</h1></div>
        <img src="images.jpg" alt="Right Logo">
        </div>
        <form action="" method="post" onsubmit="return validateForm()">

            <table>
                <tr>
                    <th colspan="2">ADDITIONAL PERSONAL INFORMATION</th>
                </tr>

                <tr>
            <td>3.1. Gender: 
                <select name="sex">
                    <option value="male" <?= (isset($_SESSION['sex']) && $_SESSION['sex'] == 'male') ? 'selected' : '' ?>>Male</option>
                    <option value="female" <?= (isset($_SESSION['sex']) && $_SESSION['sex'] == 'female') ? 'selected' : '' ?>>Female</option>
                </select>
         
        
            3.2. Civil Status:
                <select name="civil_status">
                    <option value="single" <?= (isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'single') ? 'selected' : '' ?>>Single</option>
                    <option value="married" <?= (isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'married') ? 'selected' : '' ?>>Married</option>
                    <option value="widow" <?= (isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'widow') ? 'selected' : '' ?>>Widow/er</option>
                    <option value="separated" <?= (isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'separated') ? 'selected' : '' ?>>Separated</option>
                    <option value="solo_parent" <?= (isset($_SESSION['civil_status']) && $_SESSION['civil_status'] == 'solo_parent') ? 'selected' : '' ?>>Solo Parent</option>
                </select>
    </td>
                <td>3.3. Employment Status:
                <select name="employment_status">
                    <option value="employed" <?= (isset($_SESSION['employment_status']) && $_SESSION['employment_status'] == 'employed') ? 'selected' : '' ?>>Employed</option>
                    <option value="unemployed" <?= (isset($_SESSION['employment_status']) && $_SESSION['employment_status'] == 'unemployed') ? 'selected' : '' ?>>Unemployed</option>
                </select>
            </td>
        </tr>
                
                <tr>
                
                </td>
                      
                                <td>3.4. Birthdate:
                   
                        <select name="month_of_birth" id="month_of_birth" onchange="calculateAge()">
                            <option value="">Month of Birth</option>
                            <?php
                            $months = [
                                '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                            ];
                            foreach ($months as $value => $name) {
                                $selected = (isset($_SESSION['month_of_birth']) && $_SESSION['month_of_birth'] == $value) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$name</option>";
                            }
                            ?>
                        </select>
                    
                        <select name="day_of_birth" id="day_of_birth" onchange="calculateAge()">
                            <option value="">Day of Birth</option>
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                $value = str_pad($i, 2, '0', STR_PAD_LEFT);
                                $selected = (isset($_SESSION['day_of_birth']) && $_SESSION['day_of_birth'] == $value) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$i</option>";
                            }
                            ?>
                        </select>
                    
                        <select name="year_of_birth" id="year_of_birth" onchange="calculateAge()">
                        <option value="">Year of Birth</option><br>
                            <?php
                            $currentYear = date('Y');
                            $startYear = $currentYear - 100; // For past 100 years
                            $futureYears = 50; // Include 10 future years

                            for ($i = $startYear; $i <= $currentYear + $futureYears; $i++) {
                                $selected = (isset($_SESSION['year_of_birth']) && $_SESSION['year_of_birth'] == $i) ? 'selected' : '';
                                echo "<option value=\"$i\" $selected>$i</option>";
                            }
                            ?>
                        </select>
                        
                    <input type="text" name="age" id="age" size="20" placeholder="Age" value="<?= htmlspecialchars($_SESSION['age'] ?? '') ?>" readonly>
                    
                </td>
               
                    <td>3.5. Birthplace
                    
                        <select name="birthplace_city_municipality">
                            <option value="">Select City/Municipality</option>
                            <?php
                            foreach ($cities as $city) {
                                $selected = ($birthplace_city_municipality == $city) ? 'selected' : '';
                                echo "<option value=\"$city\" $selected>$city</option>";
                            }
                            ?>
                        </select>
        
                        <select name="birthplace_province">
                            <option value="">Select Province</option>
                            <?php
                            foreach ($provinces as $province) {
                                $selected = ($birthplace_province == $province) ? 'selected' : '';
                                echo "<option value=\"$province\" $selected>$province</option>";
                            }
                            ?>
                        </select>
                 
                        <select name="birthplace_region">
                            <option value="">Select Region</option>
                            <?php
                            foreach ($regions as $region) {
                                $selected = ($birthplace_region == $region) ? 'selected' : '';
                                echo "<option value=\"$region\" $selected>$region</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

            <tr>
                <th colspan="2">Educational Attainment Before the Training (Trainee) and Parent/Guardian</th>
            </tr>
             
            <tr>
    <td colspan="2" class="education">
            Educational Attainment:
        <select name="educational_attainment">
            <option value="no_grade_completed" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'no_grade_completed' ? 'selected' : '' ?>>No Grade Completed</option>
            <option value="pre_school" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'pre_school' ? 'selected' : '' ?>>Pre-School (Nursery/Kinder/Prep)</option>
            <option value="elementary_undergraduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'elementary_undergraduate' ? 'selected' : '' ?>>Elementary Undergraduate</option>
            <option value="post_secondary_undergraduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'post_secondary_undergraduate' ? 'selected' : '' ?>>Post Secondary Undergraduate</option>
            <option value="elementary_graduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'elementary_graduate' ? 'selected' : '' ?>>Elementary Graduate</option>
            <option value="post_secondary_graduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'post_secondary_graduate' ? 'selected' : '' ?>>Post Secondary Graduate</option>
            <option value="high_school_undergraduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'high_school_undergraduate' ? 'selected' : '' ?>>High School Undergraduate</option>
            <option value="high_school_graduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'high_school_graduate' ? 'selected' : '' ?>>High School Graduate</option>
            <option value="college_undergraduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'college_undergraduate' ? 'selected' : '' ?>>College Undergraduate</option>
            <option value="college_graduate_or_higher" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'college_graduate_or_higher' ? 'selected' : '' ?>>College Graduate or Higher</option>
            <option value="junior_high_graduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'junior_high_graduate' ? 'selected' : '' ?>>Junior High Graduate</option>
            <option value="senior_high_graduate" <?= isset($_SESSION['educational_attainment']) && $_SESSION['educational_attainment'] == 'senior_high_graduate' ? 'selected' : '' ?>>Senior High Graduate</option>
        </select>
        
        Parent/Guardian Name:
        <input type="text" name="parent_guardian_name" size="50" placeholder="Name" value="<?= htmlspecialchars($_SESSION['parent_guardian_name'] ?? '') ?>"></td>
                
    </td>
</tr>


                
            <tr>
                <td>Complete Permanent Mailing Address:
                <input type="text" name="parent_guardian_address" size="50" placeholder="Complete Permanent Mailing Address" value="<?= htmlspecialchars($_SESSION['parent_guardian_address'] ?? '') ?>"></td>
           
         
            
                <td colspan="2" class="learner">Learner/Trainee Classification:
                    
            <select name="classification[]">
                <option value="Students" <?= isset($_SESSION['classification']) && in_array('Students', $_SESSION['classification']) ? 'selected' : '' ?>>Students</option>
                <option value="Out-of-School-Youth" <?= isset($_SESSION['classification']) && in_array('Out-of-School-Youth', $_SESSION['classification']) ? 'selected' : '' ?>>Out-of-School-Youth</option>
                <option value="Solo Parent" <?= isset($_SESSION['classification']) && in_array('Solo Parent', $_SESSION['classification']) ? 'selected' : '' ?>>Solo Parent</option>
                <option value="Solo Parent's Children" <?= isset($_SESSION['classification']) && in_array('Solo Parent\'s Children', $_SESSION['classification']) ? 'selected' : '' ?>>Solo Parent's Children</option>
                <option value="Senior Citizens" <?= isset($_SESSION['classification']) && in_array('Senior Citizens', $_SESSION['classification']) ? 'selected' : '' ?>>Senior Citizens</option>
                <option value="Displaced HEIs Teaching Personnel" <?= isset($_SESSION['classification']) && in_array('Displaced HEIs Teaching Personnel', $_SESSION['classification']) ? 'selected' : '' ?>>Displaced HEIs Teaching Personnel</option>
                <option value="Displaced Workers" <?= isset($_SESSION['classification']) && in_array('Displaced Workers', $_SESSION['classification']) ? 'selected' : '' ?>>Displaced Workers</option>
                <option value="TVET Trainers" <?= isset($_SESSION['classification']) && in_array('TVET Trainers', $_SESSION['classification']) ? 'selected' : '' ?>>TVET Trainers</option>
                <option value="Currently Employed Workers" <?= isset($_SESSION['classification']) && in_array('Currently Employed Workers', $_SESSION['classification']) ? 'selected' : '' ?>>Currently Employed Workers</option>
                <option value="Employees with Contractual/Job-Order Status" <?= isset($_SESSION['classification']) && in_array('Employees with Contractual/Job-Order Status', $_SESSION['classification']) ? 'selected' : '' ?>>Employees with Contractual/Job-Order Status</option>
                <option value="TESDA Alumni" <?= isset($_SESSION['classification']) && in_array('TESDA Alumni', $_SESSION['classification']) ? 'selected' : '' ?>>TESDA Alumni</option>
                <option value="Urban and Rural Poor" <?= isset($_SESSION['classification']) && in_array('Urban and Rural Poor', $_SESSION['classification']) ? 'selected' : '' ?>>Urban and Rural Poor</option>
                <option value="Informal Workers" <?= isset($_SESSION['classification']) && in_array('Informal Workers', $_SESSION['classification']) ? 'selected' : '' ?>>Informal Workers</option>
                <option value="Industry Workers" <?= isset($_SESSION['classification']) && in_array('Industry Workers', $_SESSION['classification']) ? 'selected' : '' ?>>Industry Workers</option>
                <option value="Cooperatives" <?= isset($_SESSION['classification']) && in_array('Cooperatives', $_SESSION['classification']) ? 'selected' : '' ?>>Cooperatives</option>
                <option value="Family Enterprises" <?= isset($_SESSION['classification']) && in_array('Family Enterprises', $_SESSION['classification']) ? 'selected' : '' ?>>Family Enterprises</option>
                <option value="Micro Entrepreneurs" <?= isset($_SESSION['classification']) && in_array('Micro Entrepreneurs', $_SESSION['classification']) ? 'selected' : '' ?>>Micro Entrepreneurs</option>
                <option value="Family Members of Microentrepreneur" <?= isset($_SESSION['classification']) && in_array('Family Members of Microentrepreneur', $_SESSION['classification']) ? 'selected' : '' ?>>Family Members of Microentrepreneur</option>
                <option value="Farmers and Fisherman" <?= isset($_SESSION['classification']) && in_array('Farmers and Fisherman', $_SESSION['classification']) ? 'selected' : '' ?>>Farmers and Fisherman</option>
                <option value="Family Members of Farmers and Fisherman" <?= isset($_SESSION['classification']) && in_array('Family Members of Farmers and Fisherman', $_SESSION['classification']) ? 'selected' : '' ?>>Family Members of Farmers and Fisherman</option>
                <option value="Community Tmg. & Employment Coordinator" <?= isset($_SESSION['classification']) && in_array('Community Tmg. & Employment Coordinator', $_SESSION['classification']) ? 'selected' : '' ?>>Community Tmg. & Employment Coordinator</option>
                <option value="Retuming/Repatriated Overseas Filipino Workers" <?= isset($_SESSION['classification']) && in_array('Retuming/Repatriated Overseas Filipino Workers', $_SESSION['classification']) ? 'selected' : '' ?>>Retuming/Repatriated Overseas Filipino Workers</option>
                <option value="Overseas Filipino Workers (OFW) Dependents" <?= isset($_SESSION['classification']) && in_array('Overseas Filipino Workers (OFW) Dependents', $_SESSION['classification']) ? 'selected' : '' ?>>Overseas Filipino Workers (OFW) Dependents</option>
                <option value="Persons with Disabilities" <?= isset($_SESSION['classification']) && in_array('Persons with Disabilities', $_SESSION['classification']) ? 'selected' : '' ?>>Persons with Disabilities</option>
                <option value="Indigenous People & Cultural Communities" <?= isset($_SESSION['classification']) && in_array('Indigenous People & Cultural Communities', $_SESSION['classification']) ? 'selected' : '' ?>>Indigenous People & Cultural Communities</option>
                <option value="Disadvantaged Women" <?= isset($_SESSION['classification']) && in_array('Disadvantaged Women', $_SESSION['classification']) ? 'selected' : '' ?>>Disadvantaged Women</option>
                <option value="Victim of Natural Disasters and Calamities" <?= isset($_SESSION['classification']) && in_array('Victim of Natural Disasters and Calamities', $_SESSION['classification']) ? 'selected' : '' ?>>Victim of Natural Disasters and Calamities</option>
                <option value="Victim or Survivor of Human Trafficking" <?= isset($_SESSION['classification']) && in_array('Victim or Survivor of Human Trafficking', $_SESSION['classification']) ? 'selected' : '' ?>>Victim or Survivor of Human Trafficking</option>
                <option value="Drug Dependent Surrenderers" <?= isset($_SESSION['classification']) && in_array('Drug Dependent Surrenderers', $_SESSION['classification']) ? 'selected' : '' ?>>Drug Dependent Surrenderers</option>
                <option value="Rebel Returnees or Decommissioned Combatants" <?= isset($_SESSION['classification']) && in_array('Rebel Returnees or Decommissioned Combatants', $_SESSION['classification']) ? 'selected' : '' ?>>Rebel Returnees or Decommissioned Combatants</option>
                <option value="Inmates and Detainees" <?= isset($_SESSION['classification']) && in_array('Inmates and Detainees', $_SESSION['classification']) ? 'selected' : '' ?>>Inmates and Detainees</option>
                <option value="Wounded-in-Action AFP & PNP Personnel" <?= isset($_SESSION['classification']) && in_array('Wounded-in-Action AFP & PNP Personnel', $_SESSION['classification']) ? 'selected' : '' ?>>Wounded-in-Action AFP & PNP Personnel</option>
                <option value="Family Members of AFP and PNP Killed-and-Wounded in-Action" <?= isset($_SESSION['classification']) && in_array('Family Members of AFP and PNP Killed-and-Wounded in-Action', $_SESSION['classification']) ? 'selected' : '' ?>>Family Members of AFP and PNP Killed-and-Wounded in-Action</option>
                <option value="Family Members of Inmates and Detainees" <?= isset($_SESSION['classification']) && in_array('Family Members of Inmates and Detainees', $_SESSION['classification']) ? 'selected' : '' ?>>Family Members of Inmates and Detainees</option>
                <option value="Uniformed Personnel" <?= isset($_SESSION['classification']) && in_array('Uniformed Personnel', $_SESSION['classification']) ? 'selected' : '' ?>>Uniformed Personnel</option>
            </select>
                </td>
            </tr>
            </table>
            <div class="center">
                <button type="button" onclick="window.location.href='page1.php'">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>
    <script>
function calculateAge() {
    var month = document.getElementById('month_of_birth').value;
    var day = document.getElementById('day_of_birth').value;
    var year = document.getElementById('year_of_birth').value;

    if (month && day && year) {
        var birthdate = new Date(year, month - 1, day);
        var today = new Date();
        var age = today.getFullYear() - birthdate.getFullYear();
        var monthDiff = today.getMonth() - birthdate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
            age--;
        }
        document.getElementById('age').value = age;
    } else {
        document.getElementById('age').value = '';
    }
}
</script>
<script>
function validateForm() {
    const sex = document.querySelector('select[name="sex"]').value;
    const civilStatus = document.querySelector('select[name="civil_status"]').value;
    const employmentStatus = document.querySelector('select[name="employment_status"]').value;
    const monthOfBirth = document.querySelector('select[name="month_of_birth"]').value;
    const dayOfBirth = document.querySelector('select[name="day_of_birth"]').value;
    const yearOfBirth = document.querySelector('select[name="year_of_birth"]').value;
    const birthplaceCityMunicipality = document.querySelector('select[name="birthplace_city_municipality"]').value;
    const birthplaceProvince = document.querySelector('select[name="birthplace_province"]').value;
    const birthplaceRegion = document.querySelector('select[name="birthplace_region"]').value;
    const educationalAttainment = document.querySelector('select[name="educational_attainment"]').value;
    const parentGuardianName = document.querySelector('input[name="parent_guardian_name"]').value;
    const parentGuardianAddress = document.querySelector('input[name="parent_guardian_address"]').value;
    const classification = document.querySelector('select[name="classification[]"]').value;

    if (!sex || !civilStatus || !employmentStatus || !monthOfBirth || !dayOfBirth || !yearOfBirth || !birthplaceCityMunicipality || !birthplaceProvince || !birthplaceRegion || !educationalAttainment || !parentGuardianName || !parentGuardianAddress || !classification) {
        alert("Please complete all required fields before proceeding.");
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
</script>

</body>
</html>