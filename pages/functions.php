<?php 
$user='root';
$pass='123456';
$host='localhost';//путь к базе данных
$dbname='tours';//имя базы данных
function connect(){
	global $user,$pass,$host,$dbname;
	$link=mysql_connect($host,$user,$pass) or die('connection error');//подключение к серверу
	mysql_select_db($dbname) or die('DB open error');//подключение к БД
	mysql_query("set names 'utf8'");
}