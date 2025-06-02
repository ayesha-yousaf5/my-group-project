<?php
include 'Config.php';

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
