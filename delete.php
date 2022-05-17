<?php 
include('config.php');
if (isset($_POST['submit'])){
$id=$_POST['id'];
$sql="DELETE FROM users where id='$id' ";
$result = $conn->query($sql);
if ($result==true) {
    header("Location:admin.php");
 
  }


}
?>