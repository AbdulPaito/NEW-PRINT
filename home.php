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

        /* Background Styles */
        #home-section {
            background-image: url('dash.png');
            background-size:cover ; 
           
            background-repeat: no-repeat; /* Prevents the image from repeating */
            flex: 1; /* Makes the section take up the remaining space */
            display: flex;
           height: 885px;
          
            justify-content: flex-start; /* Aligns items to the top */
            align-items: center; /* Centers children horizontally */
            color: white;
            text-align: center;
            padding: 2em; /* Adjust padding as needed */
            position: relative;
            top: -20px; /* Aligns the header to the top */
            left: -20px; /* Aligns the header to the left */
            
        }

        /* Header Styles */
        #header {
            background-color: #2575fc;
            padding: 1em;
            width: 100pcx; /* Makes the header cover the full width */
            text-align: center; /* Centers the text horizontally */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
            position: relative;
            top: -20px; /* Aligns the header to the top */
            left: -20px; /* Aligns the header to the left */
            z-index: 1; /* Ensures the header stays above other elements */
        }

        h1 {
            font-size: 2em; /* Adjust font size as needed */
            margin: 0;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Adds a text shadow for readability */
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
    <!-- Your content here -->
</section>

</body>
</html>
