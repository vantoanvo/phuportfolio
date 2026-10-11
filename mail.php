
<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method not allowed.");
}

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$message = trim($_POST["message"] ?? "");

// Replace this with your receiving email address.
$to = "ducphongphuvu@gmail.com";

if ($name === "" || $email === "" || $message === "") {
    http_response_code(400);
    exit("Please fill in all fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    exit("Please enter a valid email address.");
}

if (preg_match('/[\r\n]/', $email)) {
    http_response_code(400);
    exit("Invalid email address.");
}

$subject = "New message from your portfolio website";

$body = "Name: " . $name . "\n"
      . "Email: " . $email . "\n\n"
      . "Message:\n" . $message;

$headers = "From: Portfolio Contact <no-reply@yourdomain.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";

if (mail($to, $subject, $body, $headers)) {
    echo "Thank you! Your message has been sent.";
} else {
    http_response_code(500);
    echo "Sorry, the message could not be sent.";
}
?>
