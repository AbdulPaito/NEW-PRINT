<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check for required fields
    if (empty($_POST['applicant_signature']) || empty($_POST['date_accomplished']) || empty($_POST['registrar_signature']) || empty($_POST['date_received'])) {
        echo 'Please fill in all required fields.';
        exit();
    }
    // Save form data into session variables from Page 5
    $_SESSION['applicant_signature'] = $_POST['applicant_signature'] ?? '';
    $_SESSION['date_accomplished'] = $_POST['date_accomplished'] ?? '';
    $_SESSION['registrar_signature'] = $_POST['registrar_signature'] ?? '';
    $_SESSION['date_received'] = $_POST['date_received'] ?? '';


    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] == 0) {
        $uploadedFile = $_FILES['imageUpload'];
        $uploadDir = 'picture/'; // Ensure this directory exists and is writable
        $uploadFile = $uploadDir . basename($uploadedFile['name']);

        // Validate file type
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png'];
        if (!in_array($imageFileType, $allowedTypes)) {
            echo 'Sorry, only JPG, JPEG & PNG files are allowed.';
            exit();
        }

        // Validate file size (limit to 500KB)
        if ($uploadedFile['size'] > 500000) {
            echo 'Sorry, your file is too large.';
            exit();
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($uploadedFile['tmp_name'], $uploadFile)) {
            $_SESSION['imageUpload'] = $uploadFile; // Save file path to session
        } else {
            echo 'File upload failed!';
            exit();
        }
    }

    header('Location: final_submit.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - Page 5</title>
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
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            
        }
        .table-image{
            width: auto;
            

        }

        th, td {
            padding: 5px;
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

        td input[type="text"] {
            width: calc(100% - 16px);
            padding: 6px;
            border: 1px solid black;
            border-radius: 4px;
            margin-top: 5px;
        }

        .center {
            text-align: center;
            margin-top: 20px;
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


        .image-upload-container {
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 1px;
            position: relative;
            top: 15px;
        }

        .image-preview {
            width: 150px;
            height: 140px;
            border: 1px solid #007bff;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
            margin-bottom: 1px;
            overflow: hidden;

        }

        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            
        }

        .image-upload-label {
            cursor: pointer;
            color: #007bff;
            text-decoration: underline;
            position: relative;
            top: -30px;
            font-size: 15px;
            
        }

       
        @media (max-width: 768px) {
            .page {
                padding: 20px;
            }

            th, td {
                font-size: 14px;
            }

            button[type="submit"], button[type="button"] {
                width: 100%;
                padding: 12px;
            }

            .picture-box {
                flex-direction: column;
                align-items: center;
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
    <h1>Registration Form - Page 4/4</h1></div>
    <img src="images.jpg" alt="Right Logo">
    </div>
    <form action="final_submit.php" method="post" enctype="multipart/form-data">
    <table>
    <tr>
        <th colspan="3">Applicant's Signature</th>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center;">This is to certify that the information stated above is true and correct.</td>
    </tr>
    <tr>
        <td><label for="applicant_signature">APPLICANT'S SIGNATURE OVER PRINTED NAME:</label></td>
        <td><input type="text" id="applicant_signature" placeholder="APPLICANT'S SIGNATURE OVER PRINTED NAME" name="applicant_signature"></td>
        <td rowspan="4" style="text-align: center;">
            <div class="image-upload-container">
                <div class="image-preview" id="imagePreview">
                    <?php if (isset($_SESSION['imageUpload'])): ?>
                        <img src="<?= $_SESSION['imageUpload'] ?>" alt="Profile Image" style="max-width: 100%; height: auto;">
                    <?php else: ?>
                        <span>I.D Picture</span>
                    <?php endif; ?>
                </div>
                <label class="image-upload-label" for="imageUpload" style="display: block; margin-top: 10px;">Choose Image</label>
                <input type="file" name="imageUpload" id="imageUpload" accept="image/*" style="display: none;" onchange="previewImage(event)">
            </div>
        </td>
    </tr>
    <tr>
        <td><label for="date_accomplished">DATE ACCOMPLISHED:</label></td>
        <td><input type="text" id="date_accomplished" placeholder="DATE ACCOMPLISHED" name="date_accomplished"></td>
    </tr>
    <tr>
        <td><label for="registrar_signature">REGISTRAR/SCHOOL ADMINISTRATOR:</label></td>
        <td><input type="text" id="registrar_signature" placeholder="REGISTRAR/SCHOOL ADMINISTRATOR" name="registrar_signature"></td>
    </tr>
    <tr>
        <td><label for="date_received">DATE RECEIVED:</label></td>
        <td><input type="text" id="date_received" placeholder="DATE RECEIVED" name="date_received"></td>
    </tr>
</table>
        
        <div class="center">
            <button type="button" onclick="window.location.href='page3.php'">Back</button>
            <button type="submit">Submit</button>
        </div>
        
    </form>
</div>
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.innerHTML = `<img src="${reader.result}" alt="Profile Image">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const applicantSignature = document.getElementById('applicant_signature').value.trim();
        const dateAccomplished = document.getElementById('date_accomplished').value.trim();
        const registrarSignature = document.getElementById('registrar_signature').value.trim();
        const dateReceived = document.getElementById('date_received').value.trim();

        if (!applicantSignature || !dateAccomplished || !registrarSignature || !dateReceived) {
            alert('Please fill in all required fields.');
            event.preventDefault(); // Prevent form submission
        }
    });

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.innerHTML = `<img src="${reader.result}" alt="Profile Image">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
