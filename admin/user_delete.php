<?php 
 require("../connection/config.php");
 $statment=$pdo->prepare("DELETE FROM users WHERE id=".$_GET['id']);
 $statment->execute();
 header("Location:user_list.php");

 ?>