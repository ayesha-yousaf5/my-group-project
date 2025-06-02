<?php
include 'Config.php';
// Get POSTed form data
$id       = intval($_POST['id']);
$fullName = $conn->real_escape_string($_POST['fullName']);
$email    = $conn->real_escape_string($_POST['email']);
$phone    = $conn->real_escape_string($_POST['phone']);
$address  = $conn->real_escape_string($_POST['address']);
$city     = $conn->real_escape_string($_POST['city']);

// Build UPDATE query
$sql = "
    UPDATE shippinginfo SET 
      fullName = '$fullName',
      email    = '$email',
      phone    = '$phone',
      address  = '$address',
      city     = '$city'
    WHERE id = $id
";

if ($conn->query($sql) === TRUE) {
    // Redirect back to view.php after successful update
    header("Location: view.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
