<?php
// Database connection setup
$host = 'localhost'; 
$user = 'your_username'; 
$password = 'your_password'; 
$database = 'tesda'; 

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get ID from URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Invalid ID provided.");
}

// Fetch data from database
$query = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($connection, $query);

if (!$stmt) {
    die("Statement preparation failed: " . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Query execution failed: " . mysqli_error($connection));
}

$data = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
mysqli_close($connection);

if (!$data) {
    die("No data found for ID $id");
}

// Convert the comma-separated list to an array if necessary
$education = !empty($data['educational_attainment']) ? explode(',', $data['educational_attainment']) : [];

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .print-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .data-table th {
            background-color: #f4f4f4;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
    <style>
           /* General styles */
           body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        .page {
            max-width: 800px; /* Adjust maximum width to fit content */
            padding: 10px; /* Reduced padding for better spacing */
            margin: 0 auto; /* Center the div horizontally */
        }

        h2, h3, h4 {
            text-align: center;
            margin-bottom: 5px;
            font-size: 16px; /* Reduced font size */
        }

        p {
            text-align: center;
            margin-top: 0;
            font-size: 14px; /* Reduced font size */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            
        }

        th, td {
            padding: 2px; /* Reduced padding */
            border: 1px solid #000000;
            text-align: left;
            font-size: 12px; /* Reduced font size */
        }

        .box {
            width: 100px;
            height: 80px;
            border: 1px solid black;
            text-align: center;
            font-size: 10px;
            padding: 2px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto; /* sets left and right margins to auto */
        }

        .picture-box {
            text-align: left;
        }

        th {
            background-color: rgb(42, 170, 255);
            color: black;
            border-bottom: none;
        }

        tr:nth-child(even) {
            background-color: white;
        }

        input[type="text"] {
            width: calc(100% - px); /* Adjusted width to account for padding and border */
            padding: 2px; /* Reduced padding */
            width: 165px;
            font-size: 12px; /* Reduced font size */
            border: 1px solid black;
        }

        .center {
            text-align: center;
            margin-top: 10px; /* Add margin to separate from the table */
        }

        .center button {
            padding: 5px 10px; /* Reduced padding */
            font-size: 14px; /* Reduced font size */
            background-color: rgb(255, 255, 255);
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition for background color */
        }

        .center button:hover {
            background-color: rgb(14, 147, 236); /* Change background color on hover */
        }
        .text1 {  
         font-weight: bold; /* or use 700 */
        }
        .one{
        border: 1px solid black; /* Adds a solid border with a light gray color */
        color: blue;
        padding: 10px; /* Adds padding inside the container */
        width: 100%; /* Sets the width to 100% of the containing element */
        font-weight: bold; /* or use 700 */
       
    }
    .image {
    max-width: 140px; /* Ensures the image doesn't exceed the width of its container */
    height: 60px; /* Maintains the aspect ratio */
    text-align: center;
  }

    .image img {
        max-width: 100%; /* Ensure the image fits within the container */
        max-height: 100%; /* Ensure the image fits within the container */
        height: auto; /* Maintain aspect ratio */
        width: auto; /* Maintain aspect ratio */
    }
    .italic-text {
    font-style: italic;
    font-weight: bold;
    color: black;
    }
    .tesda{
        text-align: center;
    }
    .r th {
  font-size: 40px; /* Font size */
  padding: 0; /* Remove padding */
  margin: 0; /* Remove margins */
  width: 100%; /* Full width */
  text-align: center; /* Center text */
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); /* Text shadow */
}
.picture-box {
text-align: right;
position: relative;
left: -45px;
    justify-content: center;
    align-items: center;
    height: 100px;
    width: 790px;
    max-height: 150px;

}

.picture-box img {
    width: 150px;
    height: auto;
    max-height: 150px;
}




.picture-box1 {
  padding: 30px;
  display: flex; /* Enables flexbox layout */
  justify-content: space-evenly; /* Distributes space between the boxes */
  align-items: center; /* Centers items vertically */
}

.thumbmark-box1 {
  padding: 1px;
  border: 1px solid black;
  width: 100px;
  height: 100px;
  text-align: center;
}

.image-box1 {
  padding: 1px;
  width: 100px;
  height: 100px;
  text-align: center;
  
}
.image-box1 img {
    width: 100px;
    height: 100px;
    position: relative;
    top: -14px;
    
}

.thumbmark-label, .file-upload-label {
  display: block;
  font-weight: bold;
  color: #007bff;
  position: relative;
  top: 103px;
}

.center {
            text-align: center;
            margin-top: 10px; /* Add margin to separate from the table */
        }

        .center button {
            padding: 5px 10px; /* Reduced padding */
            font-size: 14px; /* Reduced font size */
            background-color: rgb(255, 255, 255);
            color: red;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Smooth transition for background color */
        }

        .center button:hover {
            background-color: rgb(14, 147, 236); /* Change background color on hover */
        }
        .test1{
          padding: 10px;
          font-weight: bold; /* or use 700 */
        }
        .tet1 input[type="text"]{
          margin-top: 1px; /* Add margin to separate from the table */
          font-weight: bold; /* or use 700 */
          width: 200px;
        }
        .name-container {
        display: flex;
        gap: 20px;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            align-items: center; /* Center the input and label within each container */
        }


        .address-container {
          display: flex;
          flex-wrap: wrap;
          gap: 10px; /* Adjusts space between each input-container */
            }

            .input-container {
                display: flex;   

            }

            .input-container label {
                text-align: center;
            }


            .input-container {
              display: inline-flex;
              flex-direction: column;
              align-items: center;
              margin-right: 10px; /* Space between each input-container */
          }

          .input-container input {
              width: 150px; /* Adjust the width of the input box */
              padding: 4px; /* Optional: Add padding inside the input box */
            
          }

          .input-container label {
              
              text-align: center;
            
            
          }
          .quali input{
           width: 250px;
          }
    </style>
    
</head>
<body onload="window.print()">
    <div class="page">
    <table class="one">
            <tr>
                <td class="image"><img src="TESDA-Logo.png" alt="Logo" class="logo"></td>
                <td class="tesda">Technical Education and Skills Development Authority<br>Pangasiwaan sa Edukasyong Teknikal at Pagpapaunlad ng Kasanayan</td>
                <td><p class="italic-text">MIS 03 - 01<br>(ver.2018)</p></td>
            </tr>
        </table>
        <table class="r">
            <tr>
                <th>Registration Form</th>
            </tr>
        </table>
        <table>
            <tr>
            <td colspan="2" class="picture-box">
                    <?php if (!empty($data['profile_image'])): ?>
                        <img src="<?php echo htmlspecialchars($data['profile_image']); ?>" alt="ID Picture">
                    <?php elseif (!empty($data['profile_image'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($data['profile_image']); ?>" alt="ID Picture">
                    <?php else: ?>
                    <?php endif; ?>
                </td>
                </tr>
                    </table>

                  
                    <table>       
           
            <tr>
                <th colspan="2">1. T2MIS Auto Generated</th>
            </tr>
                    </table>
                    <table>
            <tr>
                <td class="tet1">1.1. Unique Learner Identifier (ULI) Number:</td>
                <td class="tet1"><input type="text" value="<?php echo htmlspecialchars($data['uli_number']); ?>" size="20"></td>
            </tr>
            </table>
            <table>
            <tr>
                <td class="text1">1.2. Entry Date:</td>
                <td><input type="text" value="<?php echo htmlspecialchars($data['entry_date']); ?>" size="10" placeholder="mm/dd/yy"></td>
            </tr>
            <tr>
                <th colspan="2">2. Learner/Manpower Profile</th>
            </tr>
            <tr>
                <td class="test1">2.1. Name:</td>
                <td >
    <div class="name-container">
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['last_name']); ?>" size="15" placeholder="Last Name, Extension Name (Jr., Sr.)">
            <label>Last Name</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['first_name']); ?>" size="15" placeholder="First Name">
            <label>First Name</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['middle_name']); ?>" size="15" placeholder="Middle Name">
            <label>Middle Name</label>
        </div>
    </div>
                </td>
            </tr>
            <tr>
            <td class="text1">2.2. Complete Permanent Mailing Address:</td>
<td>
    <div class="address-container">
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['address_number_street']); ?>" size="20" placeholder="Number, Street">
            <label>Number, Street</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['address_barangay']); ?>" size="20" placeholder="Barangay">
            <label>Barangay</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['address_district']); ?>" size="20" placeholder="District">
            <label>District</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['address_city_municipality']); ?>" size="20" placeholder="City/Municipality">
            <label>City/Municipality</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['address_province']); ?>" size="20" placeholder="Province">
            <label>Province</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['address_region']); ?>" size="20" placeholder="Region">
            <label>Region</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['email_facebook']); ?>" size="20" placeholder="Email Address/Facebook Account">
            <label>Email Address/Facebook Acc</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['contact_no']); ?>" size="20" placeholder="Contact No">
            <label>Contact No</label>
        </div>
        <div class="input-container">
            <input type="text" value="<?php echo htmlspecialchars($data['nationality']); ?>" size="20" placeholder="Nationality">
            <label>Nationality</label>
        </div>
    </div>
</td>

            </tr>
         <table>  
            <tr>
                <th colspan="3">3. Personal Information</th>
            </tr>
            <tr>
                <td class="text1">3.1. Sex</td>
                <td class="text1">3.2. Civil Status</td>
                <td class="text1">3.3. Employment Status (before the training)</td>
            </tr>
            <tr>
                <td><label><input type="checkbox" name="sex" value="male" <?php echo $data['sex'] === 'male' ? 'checked' : ''; ?>> Male</label></td>
                <td><label><input type="checkbox" name="civil_status" value="single" <?php echo $data['civil_status'] === 'single' ? 'checked' : ''; ?>> Single</label></td>
                <td> <label><input type="checkbox" name="employment_status" value="employed" <?php echo $data['employment_status'] === 'employed' ? 'checked' : ''; ?>> Employed</label></td>
            </tr>
            <tr>
                <td><label><input type="checkbox" name="sex" value="female" <?php echo $data['sex'] === 'female' ? 'checked' : ''; ?>> Female</label></td>
                <td><label><input type="checkbox" name="civil_status" value="married" <?php echo $data['civil_status'] === 'married' ? 'checked' : ''; ?>> Married</label></td>
                <td><label><input type="checkbox" name="employment_status" value="unemployed" <?php echo $data['employment_status'] === 'unemployed' ? 'checked' : ''; ?>> Unemployed</label></td>
            </tr>
            <tr>
                <td></td>
                <td> <label><input type="checkbox" name="civil_status" value="widow" <?php echo $data['civil_status'] === 'widow' ? 'checked' : ''; ?>> Widow/Widower</label></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><label><input type="checkbox" name="civil_status" value="separated" <?php echo $data['civil_status'] === 'separated' ? 'checked' : ''; ?>> Separated</label></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td><label><input type="checkbox" name="civil_status" value="solo_parent" <?php echo $data['civil_status'] === 'solo_parent' ? 'checked' : ''; ?>> Solo Parent</label></td>
                <td></td>
            </tr>
            
                
                   
            
        </table> 
        <table>
            
           
              <tr>
          <td class="text1">3.4. Birthdate</td>
          <td>
              <div class="input-container">
                  <input type="text" size="10" placeholder="Month of Birth" value="<?php echo $data['month_of_birth']; ?>">
                  <label>Month of Birth</label>
              </div>
              <div class="input-container">
                  <input type="text" size="10" placeholder="Day of Birth" value="<?php echo $data['day_of_birth']; ?>">
                  <label>Day of Birth</label>
              </div>
              <div class="input-container">
                  <input type="text" size="10" placeholder="Year of Birth" value="<?php echo $data['year_of_birth']; ?>">
                  <label>Year of Birth</label>
              </div>
              <div class="input-container">
                  <input type="text" size="10" placeholder="Age" value="<?php echo $data['age']; ?>">
                  <label>Age</label>
              </div>
          </td>
      </tr>

            <tr>
                <td class="text1">3.5. Birthplace</td>
                <td>
                <div class="input-container">
                <input type="text" size="20" placeholder="City/Municipality" 
                    value="<?php echo isset($data['birthplace_city_municipality']) ? htmlspecialchars($data['birthplace_city_municipality']) : ''; ?>"> 
                    <label>City/Municipality</label>
                    </div>
                    <div class="input-container">
                <input type="text" size="20" placeholder="Province" 
                    value="<?php echo isset($data['birthplace_province']) ? htmlspecialchars($data['birthplace_province']) : ''; ?>"> 
                    <label>Province</label>
                    </div>
                    <div class="input-container">
                <input type="text" size="20" placeholder="Region" 
                    value="<?php echo isset($data['birthplace_region']) ? htmlspecialchars($data['birthplace_region']) : ''; ?>">
                    <label>Region</label>
                </td>
            </tr>
        </table>
        <table>
        <tr>
    <th colspan="4">3.6. Educational Attainment Before the Training (Trainee)</th>
</tr>
<tr>
    <td><label><input type="checkbox" name="educational_attainment[]" value="no_grade_completed" <?php echo $data['educational_attainment'] === 'no_grade_completed' ? 'checked' : ''; ?>> No Grade Completed</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="pre_school" <?php echo $data['educational_attainment'] === 'pre_school' ? 'checked' : ''; ?>> Pre-School (Nursery/Kinder/Prep)</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="high_school_undergraduate" <?php echo $data['educational_attainment'] === 'high_school_undergraduate' ? 'checked' : ''; ?>> High School Undergraduate</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="high_school_graduate" <?php echo $data['educational_attainment'] === 'high_school_graduate' ? 'checked' : ''; ?>> High School Graduate</label></td>
</tr>
<tr>
    <td><label><input type="checkbox" name="educational_attainment[]" value="elementary_undergraduate" <?php echo $data['educational_attainment'] === 'elementary_undergraduate' ? 'checked' : ''; ?>> Elementary Undergraduate</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="post_secondary_undergraduate" <?php echo $data['educational_attainment'] === 'post_secondary_undergraduate' ? 'checked' : ''; ?>> Post Secondary Undergraduate</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="college_undergraduate" <?php echo $data['educational_attainment'] === 'college_undergraduate' ? 'checked' : ''; ?>> College Undergraduate</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="college_graduate_or_higher" <?php echo $data['educational_attainment'] === 'college_graduate_or_higher' ? 'checked' : ''; ?>> College Graduate or Higher</label></td>
</tr>
<tr>
    <td><label><input type="checkbox" name="educational_attainment[]" value="elementary_graduate" <?php echo $data['educational_attainment'] === 'elementary_graduate' ? 'checked' : ''; ?>> Elementary Graduate</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="post_secondary_graduate" <?php echo $data['educational_attainment'] === 'post_secondary_graduate' ? 'checked' : ''; ?>> Post Secondary Graduate</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="junior_high_graduate" <?php echo $data['educational_attainment'] === 'junior_high_graduate' ? 'checked' : ''; ?>> Junior High Graduate</label></td>
    <td><label><input type="checkbox" name="educational_attainment[]" value="senior_high_graduate" <?php echo $data['educational_attainment'] === 'senior_high_graduate' ? 'checked' : ''; ?>> Senior High Graduate</label></td>
</tr>


        </table>

        
        <table>
            <tr>
                <td class="test1">3.7. Father or Mother's Full Name:</td>
                <td><input type="text" value="<?php echo htmlspecialchars($data['parent_guardian_name']); ?>" size="20"></td>
            </tr>
            <tr>
                <td class="test1">Complete Permanent Mailing Address:</td>
                <td><input type="text" value="<?php echo htmlspecialchars($data['parent_guardian_address']); ?>" size="20"></td>
            </tr>
        </table>

        <table>
    <tr>
      <th colspan="3">4. Learner/Trainee/Student (Clients) Classification:</th>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Students') !== false ? 'checked' : ''; ?>> Students</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Informal Workers') !== false ? 'checked' : ''; ?>> Informal Workers</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Indigenous People & Cultural Communities') !== false ? 'checked' : ''; ?>> Indigenous People & Cultural Communities</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Out-of-School-Youth') !== false ? 'checked' : ''; ?>> Out-of-School-Youth</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Industry Workers') !== false ? 'checked' : ''; ?>> Industry Workers</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Disadvantaged Women') !== false ? 'checked' : ''; ?>> Disadvantaged Women</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Solo Parent') !== false ? 'checked' : ''; ?>> Solo Parent</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Cooperatives') !== false ? 'checked' : ''; ?>> Cooperatives</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Victim of Natural Disasters and Calamities') !== false ? 'checked' : ''; ?>> Victim of Natural Disasters and Calamities</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Solo Parent\'s Children') !== false ? 'checked' : ''; ?>> Solo Parent's Children</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Family Enterprises') !== false ? 'checked' : ''; ?>> Family Enterprises</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Victim or Survivor of Human Trafficking') !== false ? 'checked' : ''; ?>> Victim or Survivor of Human Trafficking</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Senior Citizens') !== false ? 'checked' : ''; ?>> Senior Citizens</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Micro Entrepreneurs') !== false ? 'checked' : ''; ?>> Micro Entrepreneurs</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Drug Dependent Surrenderers') !== false ? 'checked' : ''; ?>> Drug Dependent Surrenderers</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Displaced HEls Teaching Personnel') !== false ? 'checked' : ''; ?>> Displaced HEls Teaching Personnel</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Family Members of Microentrepreneur') !== false ? 'checked' : ''; ?>> Family Members of Microentrepreneur</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Rebel Returnees or Decommissioned Combatants') !== false ? 'checked' : ''; ?>> Rebel Returnees or Decommissioned Combatants</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Displaced Workers') !== false ? 'checked' : ''; ?>> Displaced Workers</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Farmers and Fisherman') !== false ? 'checked' : ''; ?>> Farmers and Fisherman</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Inmates and Detainees') !== false ? 'checked' : ''; ?>> Inmates and Detainees</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'TVET Trainers') !== false ? 'checked' : ''; ?>> TVET Trainers</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Family Members of Farmers and Fisherman') !== false ? 'checked' : ''; ?>> Family Members of Farmers and Fisherman</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Wounded-in-Action AFP & PNP Personnel') !== false ? 'checked' : ''; ?>> Wounded-in-Action AFP & PNP Personnel</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Currently Employed Workers') !== false ? 'checked' : ''; ?>> Currently Employed Workers</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Community Tmg. & Employment Coordinator') !== false ? 'checked' : ''; ?>> Community Tmg. & Employment Coordinator</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Family Members of AFP and PNP Killed-and-Wounded in-Action') !== false ? 'checked' : ''; ?>> Family Members of AFP and PNP Killed-and-Wounded in-Action</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Employees with Contractual/Job-Order Status') !== false ? 'checked' : ''; ?>> Employees with Contractual/Job-Order Status</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Retuming/Repatriated Overseas Filipino Workers') !== false ? 'checked' : ''; ?>> Retuming/Repatriated Overseas Filipino Workers</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Family Members of Irimates and Detainees') !== false ? 'checked' : ''; ?>> Family Members of Irimates and Detainees</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'TESDA Alumni') !== false ? 'checked' : ''; ?>> TESDA Alumni</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Overseas Filipino Workers (OFW) Dependents') !== false ? 'checked' : ''; ?>> Overseas Filipino Workers (OFW) Dependents</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Uniformed Personnel') !== false ? 'checked' : ''; ?>> Uniformed Personnel</td>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Urban and Rural Poor') !== false ? 'checked' : ''; ?>> Urban and Rural Poor</td>
      <td><input type="checkbox" <?php echo strpos($data['classification'], 'Persons with Disabilities') !== false ? 'checked' : ''; ?>> Persons with Disabilities</td>
      <td></td>
    </tr>
   
    
    <tr>
      <th colspan="3">5. Type of Disability (for Persons with Disability Only): To be filled up by the TESDA personnel</th>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['disability'], 'Mental/Intellectual') !== false ? 'checked' : ''; ?>> Mental/Intellectual</td>
      <td><input type="checkbox" <?php echo strpos($data['disability'], 'Visual Disability') !== false ? 'checked' : ''; ?>> Visual Disability</td>
      <td><input type="checkbox" <?php echo strpos($data['disability'], 'Orthopedic (Musculoskeletal) Disability') !== false ? 'checked' : ''; ?>> Orthopedic (Musculoskeletal) Disability</td>
    </tr>
    <tr>
        <td><input type="checkbox" <?php echo strpos($data['disability'], 'Hearing Disability') !== false ? 'checked' : ''; ?>> Hearing Disability</td>
        <td><input type="checkbox" <?php echo strpos($data['disability'], 'Speech Impairment') !== false ? 'checked' : ''; ?>> Speech Impairment</td>
        <td><input type="checkbox" <?php echo strpos($data['disability'], 'Multiple Disabilities, specify') !== false ? 'checked' : ''; ?>> Multiple Disabilities, specify</td>
        </tr>
        <tr>
        <td><input type="checkbox" <?php echo strpos($data['disability'], 'Psychosocial Disability') !== false ? 'checked' : ''; ?>> Psychosocial Disability</td>
        <td><input type="checkbox" <?php echo strpos($data['disability'], 'Disability Due to Chronic Illness') !== false ? 'checked' : ''; ?>> Disability Due to Chronic Illness</td>
        <td><input type="checkbox" <?php echo strpos($data['disability'], 'Learning Disability') !== false ? 'checked' : ''; ?>> Learning Disability</td>
        </tr>



    <tr>
      <th colspan="3">6. Causes of Disability (for Persons with Disability Only): To be filled up by the TESDA personnel</th>
    </tr>
    <tr>
      <td><input type="checkbox" <?php echo strpos($data['cause_of_disability'], 'Congenital/Inborn') !== false ? 'checked' : ''; ?>> Congenital/Inborn</td>
      <td><input type="checkbox" <?php echo strpos($data['cause_of_disability'], 'Illness') !== false ? 'checked' : ''; ?>> Illness</td>
      <td><input type="checkbox" <?php echo strpos($data['cause_of_disability'], 'Injury') !== false ? 'checked' : ''; ?>> Injury</td>
    </tr>
    <tr>
      <th colspan="3">7. Taken NCAE/YP4SC Before?</th>
    </tr>
    <tr>
      <td colspan="3" >
        <input type="checkbox" <?php echo $data['taken_ncae'] == 'Yes' ? 'checked' : ''; ?>> Yes 
        <input type="checkbox" <?php echo $data['taken_ncae'] == 'No' ? 'checked' : ''; ?>> No 
        <input type="text" placeholder="Where:" id="where" name="where" value="<?php echo htmlspecialchars($data['where_ncae']); ?>"> 
        <input type="text" placeholder="When:" id="when" name="when" value="<?php echo htmlspecialchars($data['when_ncae']); ?>">
      </td>
    </tr>
    <tr>
      <td colspan="3" class="quali">8. Name of Course/Qualification: <input type="text" id="course-qualification" readonly value="<?php echo htmlspecialchars($data['qualification']); ?>"></td>
    </tr>
    <tr>
      <th colspan="3">9. If Scholar, What Type of Scholarship Package (TWSP, PESFA, STEP, others)?</th>
    </tr>
    <tr>
      <td colspan="3" class="quali">9. What Type of Scholarship Package (TWSP, PESFA, STEP, others)?<input type="text" id="scholarship-package" readonly value="<?php echo htmlspecialchars($data['scholarship']); ?>"></td>
    </tr>
    <tr>
      <th colspan="3">10. Privacy Disclaimer</th>
    </tr>
    <tr>
      <td colspan="3" style="text-align: center;">
        I hereby allow TESDA to use/post my contact details, name, email, cellphone/landline numbers, and other information I provided, which may be used for processing of my scholarship application, employment opportunities, and other purposes.
      </td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: center;"><input type="checkbox" <?php echo $data['privacy_disclaimer'] == 'Agree' ? 'checked' : ''; ?>> Agree</td>
      <td><input type="checkbox" <?php echo $data['privacy_disclaimer'] == 'Disagree' ? 'checked' : ''; ?>> Disagree</td>
    </tr>
    <tr>
      <th colspan="3">11. Applicant's Signature</th>
    </tr>
    <tr>
      <td colspan="3" style="text-align: center;">
        This is to certify that the information stated above is true and correct.
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <label for="applicant-signature">APPLICANT'S SIGNATURE OVER PRINTED NAME</label>
        <input type="text" id="applicant-signature" readonly value="<?php echo htmlspecialchars($data['applicant_signature']); ?>">
        <label for="date-accomplished">DATE ACCOMPLISHED</label>
        <input type="text" id="date-accomplished" readonly value="<?php echo htmlspecialchars($data['date_accomplished']); ?>">
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <label for="registrar_signature">REGISTRAR/SCHOOL ADMINISTRATOR:</label>
        <input type="text" id="registrar_signature" name="registrar_signature" value="<?php echo htmlspecialchars($data['registrar_signature']); ?>">
        <label for="date-received">DATE RECEIVED</label>
        <input type="text" id="date-received" readonly value="<?php echo htmlspecialchars($data['date_received']); ?>">
      </td>
    </tr>
  </table>
  <table> 
    <tr>
      <td colspan="2" class="picture-box1">
        <div class="thumbmark-box1">
          <label for="thumbmark" class="thumbmark-label">Right Thumbmark</label>
         
        </div>
        

        <div class="image-box1" id="imageBox">
    <label for="imageUpload" class="file-upload-label">Picture</label>
    <?php if (!empty($data['imageUpload'])): ?>
        <?php if (is_string($data['imageUpload'])): ?>
            <img src="<?php echo htmlspecialchars($data['imageUpload']); ?>" alt="Profile Picture">
        <?php else: ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($data['imageUpload']); ?>" alt="Profile Picture">
        <?php endif; ?>
    <?php endif; ?>
    </div>
</td>





      </td>
    </tr>
  </table>

        </table>
</body>
</html>



