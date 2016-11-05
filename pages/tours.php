 <?php 
 //список стран
connect();
echo '<div class="form-inline">';
echo '<select name="countryid" id="countryid" onchange="showCities(this.value)">';
echo '<option value="0">выберите страну</option>';
$res=mysql_query('select * from countries');
while ($row=mysql_fetch_array($res,MYSQL_NUM)) {
	echo '<option value="'.$row[0].'">'.$row[1].'</option>';
}
echo '</select>';
//список городов
echo '<select name="cityid" id="citylist" onchange="showHotels(this.value)"></select>';
echo '</div>';
//список отелей
echo '<main>';
echo '</main>';
  ?>