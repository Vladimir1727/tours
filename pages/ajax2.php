<?php
include_once('functions.php');
connect();
$cid=$_POST['cid'];
$sel='select id,hotel,stars,cost from hotels where cityid='.$cid;
$res=mysql_query($sel);
echo '<table class="table table-stripped" id="table1"><thead><tr><th>Отель</th><th>Цена</th><th>Звёзды</th><th>подробнее</th></thead><tbody>';
while ($row=mysql_fetch_array($res,MYSQL_NUM)) {
	echo '<tr><td>'.$row[1].'</td><td>'.$row[3].'$</td><td>'.$row[2];
	echo '<td><a href="pages/info.php?hotel='.$row[0].'" target="_blank" class="btn btn-default btn-xs">подробнее</a></td></tr>';
}
echo '</tbody></table>';
mysql_free_result($res);