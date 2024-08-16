<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Webpage Title</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light background color for contrast */
            height: 100vh; /* Ensures the body covers the full height of the viewport */
            display: flex;
            flex-direction: column;
        }

        /* Header Styles */
        #header {
            background-color: #2575fc;
            padding: 1em;
            width: 100%; /* Fixes the header width to cover the full width */
            text-align: center; /* Centers the text horizontally */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
            position: relative;
            top: -20px; /* Adjusts the position */
            left: -20px; /* Adjusts the position */
            z-index: 1; /* Ensures the header stays above other elements */
        }

        h1 {
            font-size: 2em; /* Adjust font size as needed */
            margin: 0;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Adds a text shadow for readability */
        }

        /* Home Section Styles */
        #home-section {
            background-image: url('dash.png');
            background-size: cover; 
            background-repeat: no-repeat; /* Prevents the image from repeating */
            flex: 1; /* Makes the section take up the remaining space */
            display: flex;
            height: 885px;
            justify-content: center; /* Centers the content horizontally */
            align-items: center; /* Centers the content vertically */
            color: white;
            text-align: center;
            padding: 2em; /* Adjust padding as needed */
            position: relative;
            top: -20px; /* Adjusts the position */
            left: -20px; /* Adjusts the position */
        }

        /* Box Container Styles */
        .box-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center; /* Centers the boxes horizontally */
            align-items: center; /* Centers the boxes vertically within the container */
        }

        .box {
            flex: 1;
            min-width: 200px;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .box h3 {
            margin: 0;
            color: #333;
        }

        .box p {
            margin: 10px 0 0;
            font-size: 16px;
        }
    </style>
</head>
<body>

<!-- Header -->
<div id="header">
    <h1>Welcome Admin</h1>
</div>

<!-- Home Section -->
<section id="home-section">
    <div class="box-container">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = ""; // Update this with your database password
        $dbname = "tesda"; // Update this with your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // List of courses
        $courses = [
            "Cookery NC II",
            "Food and Beverage Service NC II",
            "Housekeeping NC II",
            "Front Office Service NC II",
            "SMAW NC I and SMAW NC II"
        ];

        // Prepare SQL to count students for each course
        $course_counts = [];
        foreach ($courses as $course) {
            $sql = "SELECT COUNT(*) AS student_count FROM users WHERE qualification = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("Failed to prepare SQL statement: " . $conn->error);
            }

            $stmt->bind_param("s", $course);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result === false) {
                die("Failed to get result: " . $stmt->error);
            }

            $row = $result->fetch_assoc();
            $course_counts[$course] = $row['student_count'];
            $stmt->close();
        }

        $conn->close();
        ?>

        <?php foreach ($courses as $course): ?>
            <div class="box">
                <h3><?php echo htmlspecialchars($course); ?></h3>
                <p>Total Students: <?php echo htmlspecialchars($course_counts[$course] ?? 0); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

</body>
</html>
