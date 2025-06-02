<?php
// edit.php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "mydbb";

// 1. Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Get the record ID from the URL (ensure it’s an integer)
if (!isset($_GET['id'])) {
    die("No ID provided.");
}
$id = intval($_GET['id']);

// 3. Fetch that row from shippinginfo
$sql    = "SELECT * FROM shippinginfo WHERE id = $id";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    die("Record not found.");
}

$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Shipping Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0069d9;
        }
    </style>
</head>
<body>
    <h2>✏️ Edit Shipping Info (ID #<?= intval($row['id']) ?>)</h2>
    <form method="post" action="update.php">
        <input type="hidden" name="id" value="<?= intval($row['id']) ?>">

        <label for="fullName">Full Name</label>
        <input
            type="text"
            id="fullName"
            name="fullName"
            value="<?php
                if (isset($row['fullName'])) {
                    echo htmlspecialchars($row['fullName']);
                } elseif (isset($row['fullname'])) {
                    echo htmlspecialchars($row['fullname']);
                } else {
                    echo '';
                }
            ?>"
            required
        >

        <label for="email">Email Address</label>
        <input
            type="email"
            id="email"
            name="email"
            value="<?=
                isset($row['email'])
                    ? htmlspecialchars($row['email'])
                    : ''
            ?>"
            required
        >

        <label for="phone">Phone Number</label>
        <input
            type="text"
            id="phone"
            name="phone"
            value="<?=
                isset($row['phone'])
                    ? htmlspecialchars($row['phone'])
                    : ''
            ?>"
            required
        >

        <label for="address">Delivery Address</label>
        <textarea
            id="address"
            name="address"
            rows="3"
            required
        ><?=
            isset($row['address'])
                ? htmlspecialchars($row['address'])
                : ''
        ?></textarea>

        <label for="city">City</label>
        <input
            type="text"
            id="city"
            name="city"
            value="<?=
                isset($row['city'])
                    ? htmlspecialchars($row['city'])
                    : ''
            ?>"
            required
        >

        <button type="submit">Update Record</button>
    </form>
</body>
</html>
<?php
$conn->close();
?>
