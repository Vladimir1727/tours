<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Diamandi</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- <link href="../css/jquery.bxslider.css" rel="stylesheet"> -->
	<script src="../js/jquery-3.1.0.min.js"></script>
	<script src="../js/jssor.slider-21.1.6.mini.js" type="text/javascript"></script>
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
	echo '<main class="row"><div class="col-md-3 text-center">';
	//фото отеля
	connect();
	$sel='select imagepath from images where hotelid='.$hotel;
	$res=mysql_query($sel);
	echo'<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 300px; height: 200px; overflow: hidden; visibility: hidden">';
	echo '<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url("..images/loading.gif") no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>';

    echo '<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 300px; height: 200px; overflow: hidden;">';
    $i=0;
	while($row=mysql_fetch_array($res,MYSQL_NUM)){
		echo ' <div data-p="112.50">
                <img data-u="image" src="../'.$row[0].'" style="width:300px"></div>';
	}
	mysql_free_result($res);
	echo ' </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb01" style="bottom:16px;right:16px;">
            <div data-u="prototype" style="width:12px;height:12px;"></div>
        </div>
        </div>';

	while ($hstars-- >0) {
	echo '<image src="../images/star.png" alt="X">';
	}
	echo '<h2 class="text-center">Цена <span class="label label-info">'.$hcost.' $</span></h2>';
	echo '<div class="btn-group btn-group-justified">';
	echo '<a href="#" class="btn btn-success">Заказать</a>';
	echo '<a href="#" class="btn btn-primary">Отзывы</a>';
	echo '</div>';
	echo '</div><div class="col-md-9"><p class="well">'.$hinfo.'</p></div>';
	echo '</main>';
	
}
 ?>
<footer>Diamandi production</footer>
<!-- <script src="../js/jquery.bxslider.js"></script> -->
<script src="../js/script.js"></script>	
</body>
</html>