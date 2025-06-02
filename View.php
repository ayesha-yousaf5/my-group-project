<?php
// view.php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "mydbb";

// 1. Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Query all rows from shippinginfo
$sql    = "SELECT * FROM shippinginfo";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Shipping Info</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .edit-btn {
            background-color: #ffc107;
            color: #212529;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <h2>📦 All Shipping Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>City</th>
            <th>Actions</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <!-- ID: assume it’s named exactly "id" -->
                    <td>
                        <?= isset($row['id']) ? intval($row['id']) : '—' ?>
                    </td>

                    <!-- Full Name: try camelCase then lowercase -->
                    <td>
                        <?= isset($row['fullName'])
                                ? htmlspecialchars($row['fullName'])
                                : (isset($row['fullname'])
                                    ? htmlspecialchars($row['fullname'])
                                    : '—') 
                        ?>
                    </td>

                    <!-- Email: try "email" or fallback to lowercase "email" (same) -->
                    <td>
                        <?= isset($row['email'])
                                ? htmlspecialchars($row['email'])
                                : '—' 
                        ?>
                    </td>

                    <!-- Phone: try "phone" or fallback "phone" (same) -->
                    <td>
                        <?= isset($row['phone'])
                                ? htmlspecialchars($row['phone'])
                                : '—' 
                        ?>
                    </td>

                    <!-- Address: try "address" -->
                    <td>
                        <?= isset($row['address'])
                                ? nl2br(htmlspecialchars($row['address']))
                                : '—' 
                        ?>
                    </td>

                    <!-- City: try "city" -->
                    <td>
                        <?= isset($row['city'])
                                ? htmlspecialchars($row['city'])
                                : '—' 
                        ?>
                    </td>

                    <td>
                        <?php if (isset($row['id'])): ?>
                            <a href="edit.php?id=<?= intval($row['id']) ?>" class="edit-btn">✏️ Edit</a>
                            <a href="delete.php?id=<?= intval($row['id']) ?>" class="delete-btn"
                               onclick="return confirm('Are you sure you want to delete this record?')">
                                ❌ Delete
                            </a>
                        <?php else: ?>
                            —
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;">No records found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
<?php
$conn->close();
?>
