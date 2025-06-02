<?php
$servername="localhost";
$username="root";
$password="";
$dbname="mydbb";
$conn=new mysqli($servername, $username ,$password,$dbname);
if ($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
}

if (isset($_POST['submit'])) {
  echo 'boomer';
  // Get data
  $fullName = $_POST['fullName'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $city = $_POST['city'];
 

  // SQL to insert into database
  $sql = "INSERT INTO `shippinginfo` (`fullName`, `email`, `phone`, `address`, `city` )
          VALUES ('$fullName', '$email', '$phone', '$address', '$city')";

  $result = $conn->query($sql);

  if ($result === TRUE) {
    echo "✅ Order confirmed!";
  } else {
    echo "❌ Error: " . $conn->error;
  }

  $conn->close();
}
$sql=" SELECT * FROM shipping_info";
?>
