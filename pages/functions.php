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

function register($name,$pass,$email){
	$name=trim(htmlspecialchars($name));
	$pass=trim(htmlspecialchars($pass));
	$email=trim(htmlspecialchars($email));
	if ($name=="" || $pass=="" || $email=="") {
		echo '<h3 style="color:red;">Не все поля заполнены</h3>';
		return false;		
	}
	if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 || strlen($pass)>30) {
		echo '<h3 style="color:red;">Слишком короткие логин/пароль</h3>';
		return false;		
	}
	$ins='insert into users (login,pass,email,roleid) values("'.$name.'","'.md5($pass).'","'.$email.'",2)';
	connect();
	mysql_query($ins);
	return true;
}

function login($name,$pass){
	$name=trim(htmlspecialchars($name));
	$pass=trim(htmlspecialchars($pass));
	if ($name=="" || $pass=="") {
		logerr('Не все поля заполнены');
		return false;		
	}
	if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 || strlen($pass)>30) {
		logerr('Слишком короткие логин/пароль');
		return false;
	}
	connect();
	$sel='select * from users where login="'.$name.'"
	and pass="'.md5($pass).'"';
	$res=mysql_query($sel);
	if($row=mysql_fetch_array($res,MYSQL_NUM)){
		if($row[1]==$name){
			$_SESSION['ruser']=$name;
			return true;
		}
		else{
			logerr('нет такого пользователя');
			return false;
		}
	}
}

function logerr($err){
	echo '<form action="index.php';
	if (isset($_GET['page'])) echo '?page='.$_GET['page'];
	echo '" class="form-inline" method="post">';
	echo '<h5 class="text-danger">'.$err.'</h5>';
	echo '<input type="submit" value="войти заново" name="re" class="btn btn-default btn-sm">';
	echo '</form>';
}