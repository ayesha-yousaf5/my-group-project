<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "mydbb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);

$sql = "DELETE FROM shippinginfo WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: view.php");
    exit();
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
