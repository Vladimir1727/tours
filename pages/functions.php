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

function register($name,$pass,$email,$a){
	$file=fopen($a,'rb');//открываем файл как бинарный
	$binary=fread($file,filesize($a));
	$binary=addslashes($binary);
	fclose($file);
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
	$ins='insert into users (login,pass,email,roleid,avatar) values("'.$name.'","'.md5($pass).'","'.$email.'",2,"'.$binary.'")';
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
		$_SESSION['ruser']=$name;
		$file=fopen("images/user.jpg", "w");
		fwrite($file,$row[6]);
		if (filesize('images/user.jpg')>0) $_SESSION['pic']=true; 
			else $_SESSION['pic']=false;
		fclose($file);
		return true;
	}
	else{
		logerr('нет такого пользователя');
		return false;
	}
	mysql_free_result($res);
	
}

function logerr($err){
	echo '<form action="index.php';
	if (isset($_GET['page'])) echo '?page='.$_GET['page'];
	echo '" method="post">';
	echo '<h5 class="text-danger">'.$err.'</h5>';
	echo '<input type="submit" value="войти заново" name="re" class="btn btn-default btn-sm">';
	echo '</form>';
}

function getcomments($hotelid){
	/*$res=mysql_query('select c.text,c.username,c.datein,u.avatar from comments c,users u
		where c.username=u.login and c.hotelid='.$hotelid);*/
	$res=mysql_query('select text,username,datein from comments 
		where hotelid='.$hotelid);
	$i=1;
	while($row=mysql_fetch_array($res,MYSQL_NUM)){
		echo '<div class="panel panel-info">';
		echo '<div class="panel-heading">';
		//загрузка картинки
		$resi=mysql_query('select avatar from users 
		where login="'.$row[1].'"');
		if ($rowi=mysql_fetch_array($resi,MYSQL_NUM)){
			$img="../images/comment_logo".$i.".jpg";
			$file=fopen($img, "w");
			fwrite($file,$rowi[0]);
			if (filesize($img)<1) $img="../images/noimage.png";
			fclose($file);
			mysql_free_result($resi);
		}
		echo '<img src="'.$img.'" style="width:20px;">';
		echo $row[1].'&nbsp;'.$row[2].'</div>';
		echo '<div class="panel-body">'.$row[0].'</div>';
		echo '</div>';
		$i++;
	}
	mysql_free_result($res);
}