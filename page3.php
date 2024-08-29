<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Save form data into session variables from Page 3
    $_SESSION['disability'] = $_POST['disability'] ?? [];
    $_SESSION['cause_of_disability'] = $_POST['cause_of_disability'] ?? [];
    $_SESSION['taken_ncae'] = $_POST['taken_ncae'] ?? '';
    $_SESSION['where'] = $_POST['where'] ?? '';
    $_SESSION['when'] = $_POST['when'] ?? '';
    $_SESSION['qualification'] = $_POST['qualification'] ?? '';
    $_SESSION['scholarship'] = $_POST['scholarship'] ?? '';
    $_SESSION['privacy_disclaimer'] = $_POST['privacy_disclaimer'] ?? '';

     // Get form data
     $disability = $_POST['disability'] ?? [];
     $cause_of_disability = $_POST['cause_of_disability'] ?? '';
     $taken_ncae = $_POST['taken_ncae'] ?? '';
     $where = $_POST['where'] ?? '';
     $when = $_POST['when'] ?? '';
     $qualification = $_POST['qualification'] ?? '';
     $scholarship = $_POST['scholarship'] ?? '';
     $privacy_disclaimer = $_POST['privacy_disclaimer'] ?? '';
 
     // Validate required fields
     if (empty($qualification) || empty($scholarship) || empty($privacy_disclaimer)) {
         echo '<script>alert("Please fill out all required fields.");</script>';
     } else {
         // Save form data into session variables from Page 3
         $_SESSION['disability'] = $disability;
         $_SESSION['cause_of_disability'] = $cause_of_disability;
         $_SESSION['taken_ncae'] = $taken_ncae;
         $_SESSION['where'] = $where;
         $_SESSION['when'] = $when;
         $_SESSION['qualification'] = $qualification;
         $_SESSION['scholarship'] = $scholarship;
         $_SESSION['privacy_disclaimer'] = $privacy_disclaimer;
 
         // Redirect to Page 5
         header('Location: page4.php');
         exit();
     }
 }
 ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - Page 4</title>
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
            max-width: 1300px; /* Adjust as needed */
            height: 640px;
            margin: 0px auto;
            padding: 5px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 5px; /* Adjust padding for tighter spacing */
            text-align: left;         
            border: 2px solid #007bff;
            font-size: 22px;
        }

        th {
            background-color: #007bff;
            padding: 5px;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        td input[type="text"], td input[type="checkbox"], td input[type="radio"] {
            margin-top: 5px;
        }

        td input[type="text"] {
            width: calc(100% - 16px); /* Adjust width to fit table without overflow */
            padding: 6px;
            border: 1px solid black;
            border-radius: 4px;
        }

        .center {
            text-align: center;
            margin-top: 20px; /* Provides space for button */
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
     
        @media (max-width: 768px) {
            .page {
                padding: 20px; /* Adjust padding for smaller screens */
            }

            th, td {
                font-size: 14px;
            }

            button[type="submit"], button[type="button"] {
                width: 100%;
                padding: 12px;
            }
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
           
        }

        .header-container img {
            width: 130px; /* Adjust the width as needed */
            height: auto;
        }

        .page {
            max-width: 100%;
            height: auto;
            padding: 1px;
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
        <h1>Registration Form - Page 3/4</h1></div>
        <img src="images.jpg" alt="Right Logo">
        </div>
        <form action="" method="POST">
            <table>
            <tr>
    <th colspan="2">Type of Disability And Causes of Disabilities</th>
</tr>

<tr>
    <td>Type of Disability:
        <select name="disability[]">
            <option value="Mental/Intellectual" <?= isset($_SESSION['disability']) && in_array('Mental/Intellectual', $_SESSION['disability']) ? 'selected' : '' ?>>Mental/Intellectual</option>
            <option value="Visual Disability" <?= isset($_SESSION['disability']) && in_array('Visual Disability', $_SESSION['disability']) ? 'selected' : '' ?>>Visual Disability</option>
            <option value="Orthopedic (Musculoskeletal) Disability" <?= isset($_SESSION['disability']) && in_array('Orthopedic (Musculoskeletal) Disability', $_SESSION['disability']) ? 'selected' : '' ?>>Orthopedic (Musculoskeletal) Disability</option>
            <option value="Hearing Disability" <?= isset($_SESSION['disability']) && in_array('Hearing Disability', $_SESSION['disability']) ? 'selected' : '' ?>>Hearing Disability</option>
            <option value="Speech Impairment" <?= isset($_SESSION['disability']) && in_array('Speech Impairment', $_SESSION['disability']) ? 'selected' : '' ?>>Speech Impairment</option>
            <option value="Multiple Disabilities" <?= isset($_SESSION['disability']) && in_array('Multiple Disabilities', $_SESSION['disability']) ? 'selected' : '' ?>>Multiple Disabilities, specify</option>
            <option value="Psychosocial Disability" <?= isset($_SESSION['disability']) && in_array('Psychosocial Disability', $_SESSION['disability']) ? 'selected' : '' ?>>Psychosocial Disability</option>
            <option value="Disability Due to Chronic Illness" <?= isset($_SESSION['disability']) && in_array('Disability Due to Chronic Illness', $_SESSION['disability']) ? 'selected' : '' ?>>Disability Due to Chronic Illness</option>
            <option value="Learning Disability" <?= isset($_SESSION['disability']) && in_array('Learning Disability', $_SESSION['disability']) ? 'selected' : '' ?>>Learning Disability</option>
            <option value="N/A" <?= isset($_SESSION['N/A']) && in_array('N/A', $_SESSION['N/A']) ? 'selected' : '' ?>>N/A</option>
        </select>
    

         <td>Cause of Disability:
        <select name="cause_of_disability">
            <option value="Congenital/Inborn" <?= isset($_SESSION['cause_of_disability']) && $_SESSION['cause_of_disability'] === 'Congenital/Inborn' ? 'selected' : '' ?>>Congenital/Inborn</option>
            <option value="Illness" <?= isset($_SESSION['cause_of_disability']) && $_SESSION['cause_of_disability'] === 'Illness' ? 'selected' : '' ?>>Illness</option>
            <option value="Injury" <?= isset($_SESSION['cause_of_disability']) && $_SESSION['cause_of_disability'] === 'Injury' ? 'selected' : '' ?>>Injury</option>
            <option value="N/A" <?= isset($_SESSION['N/A']) && in_array('N/A', $_SESSION['N/A']) ? 'selected' : '' ?>>N/A</option>
        </select>
    </td>
</tr>
            
            <tr>
                <th colspan="2">Taken NCAE/YP4SC Before?</th>
            </tr>
            <tr>
                <td>
                    <input type="checkbox" id="ncae_yes" name="taken_ncae" value="Yes" 
                    <?php if (isset($_SESSION['taken_ncae']) && $_SESSION['taken_ncae'] == 'Yes') echo 'checked'; ?>> 
                    Yes
                </td>
                <td>
                    <input type="checkbox" id="ncae_no" name="taken_ncae" value="No" 
                    <?php if (isset($_SESSION['taken_ncae']) && $_SESSION['taken_ncae'] == 'No') echo 'checked'; ?>> 
                    No
                </td>
            </tr>
            <tr>
                <td><input type="text" placeholder="Where:" id="where" name="where" value="<?php echo isset($_SESSION['where']) ? htmlspecialchars($_SESSION['where']) : ''; ?>"></td>
                <td><input type="text" placeholder="When:" id="when" name="when" value="<?php echo isset($_SESSION['when']) ? htmlspecialchars($_SESSION['when']) : ''; ?>"></td>
            </tr>

            <script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxYes = document.getElementById('ncae_yes');
        const checkboxNo = document.getElementById('ncae_no');

        checkboxYes.addEventListener('change', function() {
            if (checkboxYes.checked) {
                checkboxNo.checked = false;
            }
        });

        checkboxNo.addEventListener('change', function() {
            if (checkboxNo.checked) {
                checkboxYes.checked = false;
            }
        });
    });
</script>

                <tr>
                <th colspan="2">Name of Course/Qualification and Type of Scholarship</th>
            </tr>
            <tr>
                <td>Name of Course/Qualification:
                
                    <select id="qualification" name="qualification">
                        <option value="">Select Course/Qualification</option>
                        <?php
                        // Array of TESDA courses in Pampanga (Replace this with your actual course list)
                        $courses = [
                            "Cookery NC II",
                            "Food and Beverage Service NC II",
                            "Housekeeping NC II",
                            "Front Office Service NC II",
                            "SMAW NC I and SMAW NC II",
                            // Add more courses as needed

                        ];

                        // Populate the dropdown with courses
                        foreach ($courses as $course) {
                            // Set the selected attribute if this course was previously chosen
                            $selected = (isset($_SESSION['qualification']) && $_SESSION['qualification'] === $course) ? 'selected' : '';
                            echo "<option value=\"{$course}\" {$selected}>{$course}</option>";
                        }
                        ?>
                    </select>
            

                <td >What Type of Scholarship:
                
                    <select id="scholarship" name="scholarship">
                        <option value="">Select Scholarship Package</option>
                        <?php
                        // Array of scholarship types (Replace this with your actual list of scholarships)
                        $scholarships = [
                            "TWSP" => "TWSP",
                            "PESFA" => "PESFA",
                            "STEP" => "STEP",
                            "Others" => "Others"
                            // Add more scholarship types as needed
                        ];

                        // Populate the dropdown with scholarship types
                        foreach ($scholarships as $value => $label) {
                            // Set the selected attribute if this scholarship was previously chosen
                            $selected = (isset($_SESSION['scholarship']) && $_SESSION['scholarship'] === $value) ? 'selected' : '';
                            echo "<option value=\"{$value}\" {$selected}>{$label}</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>





                        <tr>
                <th colspan="3">Privacy Disclaimer</th>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;">
                    I hereby allow TESDA to use/post my contact details, name, email, cellphone/landline numbers, and other information I provided, which may be used for processing of my scholarship application, employment opportunities, and other purposes.
                </td>
            </tr>
            <tr>
                <?php 
                $privacyDisclaimer = isset($_SESSION['privacy_disclaimer']) ? $_SESSION['privacy_disclaimer'] : ''; 
                ?>
                <td><input type="checkbox" name="privacy_disclaimer" value="Agree" id="agree" <?php if ($privacyDisclaimer == 'Agree') echo 'checked'; ?>> Agree</td>
                <td><input type="checkbox" name="privacy_disclaimer" value="Disagree" id="disagree" <?php if ($privacyDisclaimer == 'Disagree') echo 'checked'; ?>> Disagree</td>
            </tr>
            <script>
                document.querySelectorAll('input[name="privacy_disclaimer"]').forEach(function(checkbox) {
                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            document.querySelectorAll('input[name="privacy_disclaimer"]').forEach(function(cb) {
                                if (cb !== checkbox) {
                                    cb.checked = false;
                                }
                            });
                        }
                    });
                });
            </script>


            </table>
            <div class="center">
                <button type="button" onclick="window.location.href='page2.php'">Back</button>
                <button type="submit">Next</button>
            </div>
        </form>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxYes = document.getElementById('ncae_yes');
    const checkboxNo = document.getElementById('ncae_no');

    checkboxYes.addEventListener('change', function() {
        if (checkboxYes.checked) {
            checkboxNo.checked = false;
        }
    });

    checkboxNo.addEventListener('change', function() {
        if (checkboxNo.checked) {
            checkboxYes.checked = false;
        }
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(event) {
        const qualification = document.getElementById('qualification').value;
        const scholarship = document.getElementById('scholarship').value;
        const privacyDisclaimer = document.querySelector('input[name="privacy_disclaimer"]:checked');
        let valid = true;

        // Check if 'Qualification' is selected
        if (qualification === '') {
            alert('Please select a course/qualification.');
            valid = false;
        }

        // Check if 'Scholarship' is selected
        if (scholarship === '') {
            alert('Please select a scholarship package.');
            valid = false;
        }

        // Check if 'Privacy Disclaimer' is agreed
        if (!privacyDisclaimer) {
            alert('You must agree to the privacy disclaimer.');
            valid = false;
        }

        // Prevent form submission if validation fails
        if (!valid) {
            event.preventDefault();
        }
    });
});
</script>

</body>
</html>