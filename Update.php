<?php 
include "config.php";

if (isset($_POST['update'])) {
    $user_id = $_POST['user_id'];
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    $sql = "UPDATE shippinginfo SET 
                fullname = '$fullName',
                email = '$email',
                phone = '$phone',
                address = '$address',
                city = '$city'
            WHERE id = '$user_id'";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Information record updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 

if (isset($_GET['id'])) {
    $user_id = $_GET['id']; 

    $sql = "SELECT * FROM shippinginfo WHERE id = '$user_id'";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {        
        while ($row = $result->fetch_assoc()) {
            $fullName = $row['fullName'];
            $email = $row['email'];
            $phone = $row['phone'];
            $address = $row['address'];
            $city = $row['city'];
            $id = $row['id'];
        } 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Shipping Info</title>
</head>
<body>

<h2>Shipping Information Update Form</h2>

<form action="" method="post">
  <fieldset>
    <legend>Update Details:</legend>

    Full Name:<br>
    <input type="text" name="fullName" value="<?php echo $fullName; ?>"><br>

    <input type="hidden" name="user_id" value="<?php echo $id; ?>">

    Email:<br>
    <input type="email" name="email" value="<?php echo $email; ?>"><br>

    Phone:<br>
    <input type="text" name="phone" value="<?php echo $phone; ?>"><br>

    Address:<br>
    <input type="text" name="address" value="<?php echo $address; ?>"><br>

    City:<br>
    <input type="text" name="city" value="<?php echo $city; ?>"><br><br>

    <input type="submit" value="Update" name="update">

  </fieldset>
</form>

</body>
</html>

<?php
    } else { 
        header('Location: view.php');
    } 
}
?>
