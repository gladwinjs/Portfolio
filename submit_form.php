<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-color: #f0f8ff;
            background-image: url('good-background-iegpv34e167xjt5i.jpg'); /* Ensure the image is in the correct directory */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Dark overlay for better contrast */
        }
        .success-message {
            font-size: 30px;
            font-weight: bold;
            color: #ffffff;
            text-align: center;
            background: linear-gradient(45deg, #28a745, #218838);
            padding: 20px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeIn 2s ease-in-out;
            position: relative;
            z-index: 1;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .success-message::before {
            content: '✔';
            display: block;
            font-size: 50px;
            margin-bottom: 20px;
            color: #ffffff;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 500px;
            width: 100%;
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>

<div class="overlay"></div>

<?php
$n = $_POST['name'];
$t = $_POST['phone'];
$e = $_POST['email']; // Corrected the variable to match the form input name
$a = $_POST['address'];
$m = $_POST['message'];

// Establishing the connection
$con = mysqli_connect("localhost", "root", "", "portfolio");

// Checking connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepared statement to prevent SQL injection
$stmt = $con->prepare("INSERT INTO contact (name, phone, email, address, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $n, $t, $e, $a, $m);

if ($stmt->execute()) {
    echo '<div class="container">';
    echo '<div class="success-message">Message has been sent successfully</div>';
    echo '</div>';
} else {
    echo '<div class="container">';
    echo '<div class="success-message">Error: ' . $stmt->error . '</div>';
    echo '</div>';
}

// Closing the statement and connection
$stmt->close();
mysqli_close($con);
?>

</body>
</html>
