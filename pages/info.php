<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Diamandi</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- <link href="../css/jquery.bxslider.css" rel="stylesheet"> -->

	<style>
		footer{
		text-align: center;
		background-color: #ddf;
		}
	.jssorb01 {
            position: absolute;
        }
        .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
            position: absolute;
            /* size of bullet elment */
            width: 12px;
            height: 12px;
            filter: alpha(opacity=70);
            opacity: .7;
            overflow: hidden;
            cursor: pointer;
            border: #000 1px solid;
        }
        .jssorb01 div { background-color: gray; }
        .jssorb01 div:hover, .jssorb01 .av:hover { background-color: #d3d3d3; }
        .jssorb01 .av { background-color: #fff; }
        .jssorb01 .dn, .jssorb01 .dn:hover { background-color: #555555; }

		
        
	</style>
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
	echo '<h2 class="text-uppercase text-center">'.$hname.'</h2>';
	echo '<main class="row"><div class="col-md-4 text-center">';
	//фото отеля
	connect();
	$sel='select imagepath from images where hotelid='.$hotel;
	$res=mysql_query($sel);
	echo'<ul id="gallery">';
    $i=0;
	while($row=mysql_fetch_array($res,MYSQL_NUM)){
		echo ' <li>
                <img data-u="image" src="../'.$row[0].'" style="width:300px"></li>';
	}
	mysql_free_result($res);
	echo ' </ul>';

	while ($hstars-- >0) {
	echo '<image src="../images/star.png" alt="X">';
	}
	echo '<h2 class="text-center">Цена <span class="label label-info">'.$hcost.' $</span></h2>';
	echo '<div class="btn-group btn-group-justified">';
	echo '<a href="#" class="btn btn-success">Заказать</a>';
	echo '<a href="#" class="btn btn-primary">Отзывы</a>';
	echo '</div>';
	echo '</div><div class="col-md-8"><p class="well">'.$hinfo.'</p></div>';
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