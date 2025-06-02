<?php 

include "config.php"; 

if (isset($_GET['id'])) {

    $user_id = $_GET['id'];

    $sql = "DELETE FROM shippinginfo WHERE id='$user_id'";

     $result = $conn->query($sql);

     if ($result == TRUE) {

        echo " deleted successfully.";

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 

?>
