<?php
if(isset($_POST['submit']))
{
  $search=$_POST['search'];
  header("Location: SearchProduct.php?keyword=" . $_POST['search'] . "&sort=");
}
?>
