<form action="index.php?page=3" method="post">
<select name="hotelid">
<?php
connect();
$res=mysql_query('select ho.id,co.country,ci.city, ho.hotel
	from Countries co,cities ci, hotels ho
	where co.id=ho.countryid and ci.id=ho.cityid
	');
while($row=mysql_fetch_array($res,MYSQL_NUM)){
	echo '<option value="'.$row[0].'">'.$row[1]." ".$row[2]." ".$row[3].'</options>';
}
mysql_free_result($res);
?>
</select>
<textarea name="text"></textarea>
<button name="addcom" type="submit">Добавить отзыв</button>
</form>
<?php
if(isset($_REQUEST['addcom'])){
	$hotelid=$_REQUEST['hotelid'];
	$text=trim(htmlspecialchars($_REQUEST['text']));
	$name='';
	if(isset($_SESSION['ruser'])){
		$name=$_SESSION['ruser'];
	}	else{
			$name="гость";
		}

	$dt=@date("Y-m-d H:i:s");
	$ins='insert into Comments (hotelid,text,username,datein)
	values(
	'.$hotelid.',"'.$text.'","'.$name.'","'.$dt.'")';
	mysql_query($ins);
}
?>