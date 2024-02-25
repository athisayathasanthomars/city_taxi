<?php
$connection=new mysqli('localhost','root','','city_taxi');


if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
}
else{
    $reservation_no=$_GET['id'];
    $del_query=mysqli_query($connection,"DELETE FROM reservation WHERE reservationno='$reservation_no'");
    $result=mysqli_query($connection,$del_query);
    if(!$result){
        echo "<script> alert('Reservation Deleted!!'); </script>";
    }
    else{
        echo "<script> alert('Unable to delete!!'); </script>";
    }    
}

?>
<script type="text/javascript">
    window.location="reservation.php";
</script>