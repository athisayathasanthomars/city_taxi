<?php
$connection=new mysqli('localhost','root','','city_taxi');


if(!$_GET['id']){
    echo "<script> alert('ID not recieved.Unable to delete!!'); </script>";
}
else{
    $user_name=$_GET['id'];
    $del_query=mysqli_query($connection,"DELETE FROM user WHERE username='$user_name'");
    $result=mysqli_query($connection,$del_query);
    if(!$result){
        echo "<script> alert('Login Details Deleted!!'); </script>";
    }
    else{
        echo "<script> alert('Unable to delete!!'); </script>";
    }    
}

?>
<script type="text/javascript">
    window.location="user.php";
</script>