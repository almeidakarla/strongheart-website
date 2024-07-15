<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstName = htmlspecialchars(trim($_POST['first_name'] ?? ''));
    $lastName = htmlspecialchars(trim($_POST['last_name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $answer1 = htmlspecialchars(trim($_POST['answer1'] ?? ''));
    $answer2 = htmlspecialchars(trim($_POST['answer2'] ?? ''));

    // Check if all required fields are filled
    if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($answer1) || empty($answer2)) {
        echo "Error: All fields are required.";
        exit;
    }

    // Email recipient
    $to = "invest@energyinvestusa.com";
    
    // Subject
    $subject = "Form Submission from Website";

    // Message
    $message = "
    <html>
    <head>
    <title>Form Submission</title>
    </head>
    <body>
    <h2>Form Submission Details</h2>
    <p><strong>First Name:</strong> $firstName</p>
    <p><strong>Last Name:</strong> $lastName</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Question 1:</strong> $answer1</p>
    <p><strong>Question 2:</strong> $answer2</p>
    </body>
    </html>
    ";

    // Headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <$email>" . "\r\n";

    // Send email and check for errors
    if (mail($to, $subject, $message, $headers)) {
        echo "Your information has been sent. Thank you!";
    } else {
        echo "There was a problem sending your information. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>
