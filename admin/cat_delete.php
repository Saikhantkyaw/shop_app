<?php  require("../connection/config.php");
$statment=$pdo->prepare("DELETE FROM categories WHERE id=".$_GET['id']);
$statment->execute();

header('Location:category.php');


 ?>