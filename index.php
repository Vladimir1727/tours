<?php
session_start();
include_once ("pages/functions.php"); 
if(isset($_GET['page'])){
	$page=$_GET['page'];
	}
 ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Diamandi</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	 <!-- <link rel="stylesheet" href="css/style.css">  -->
	<link rel="stylesheet/less" href="css/style.less">
</head>
<body>
<div class="head">
<?php include_once("pages/enter.php");?>
</div>
<section class="content">
<nav><?php include_once("pages/menu.php") ?></nav>
	<main>
	<?php
	
	if(isset($_GET['page'])){
		if($page==1) include_once("pages/tours.php");
		if($page==2) include_once("pages/admin.php");
		if($page==3) include_once("pages/review.php");
		if($page==4) include_once("pages/register.php");
	}

	?>
	</main>
</section>

<footer>Diamandi production</footer>
<script src="js/jquery-3.1.0.min.js"></script>
<script src="js/less.min.js"></script>
<script src="js/ajax.js"></script>
<script src="js/script.js"></script>

</body>
</html>