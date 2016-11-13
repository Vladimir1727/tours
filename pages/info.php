<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Diamandi</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/info.css">
</head>

<body>
<?php
include_once ("functions.php");
if(isset($_GET['hotel'])){

	$hotel=$_GET['hotel'];
	//описание отеля
	connect();
	$sel='select * from hotels where id='.$hotel;
	$res=mysql_query($sel);
	$row=mysql_fetch_array($res,MYSQL_NUM);
	$hname=$row[1];
	$hstars=$row[4];
	$hcost=$row[5];
	$hinfo=$row[6];
	mysql_free_result($res);

	echo '<main><h2 class="text-uppercase text-center">'.$hname.'</h2>';
	echo '<div class="row"><div class="col-md-6 text-center">';
	//фото отеля
	connect();
	$sel='select imagepath from images where hotelid='.$hotel;
	$res=mysql_query($sel);
	echo'<ul id="gallery">';
    $i=0;
	while($row=mysql_fetch_array($res,MYSQL_NUM)){
		echo ' <li><img src="../'.$row[0].'"></li>';
	}
	mysql_free_result($res);
	echo ' </ul>';

	while ($hstars-- >0) {
	echo '<image src="../images/star.png" alt="X">';
	}
	echo '<h2 class="text-center">Цена <span class="label label-info">'.$hcost.' $</span></h2>';
	echo '<div class="btn-group btn-group-justified">';
	echo '<a href="#" class="btn btn-success">Заказать</a>';
	echo '<a href="#" class="btn btn-primary" id="rew">Отзывы</a>';
	echo '</div>';
	echo '</div><div class="col-md-6"><p class="well">'.$hinfo.'</p></div>';
	echo '</div>';
	connect();
	getcomments($hotel);
	echo '</main>';
	
}
 ?>
<footer>Diamandi production</footer>
<!-- <script src="../js/jquery.bxslider.js"></script> -->
<script src="../js/jquery-3.1.0.min.js"></script>
<script src="../js/gallery.js"></script>
<script src="../js/info2.js"></script>
</body>
</html>