<?php
$connection=new mysqli('localhost','root','','city_taxi');


if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
}
else{
    $driver_id=$_GET['id'];
    $del_query=mysqli_query($connection,"DELETE FROM driver WHERE driverid='$driver_id'");
    $result=mysqli_query($connection,$del_query);
    if(!$result){
        echo "<script> alert('Driver Deleted!!'); </script>";
    }
    else{
        echo "<script> alert('Unable to delete!!'); </script>";
    }    
}

?>
<script type="text/javascript">
    window.location="driver.php";
</script>