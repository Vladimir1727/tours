<?php
if (isset($_SESSION['ruser'])){//сессия запущена
	echo '<form action="index.php';
	if (isset($_GET['page'])) echo '?page='.$_GET['page'];
	echo '" class="form-inline" method="post">';
	echo '<h4>Вы вошли как <span>'.$_SESSION['ruser'].'</span></h4>';
	echo '<input type="submit" value="выйти" id="ex" name="ex" class="btn btn-default btn-sm">';
	echo '</form>';
	if (isset($_POST['ex'])) {
		unset($_SESSION['ruser']);
	}


}
else//сессия не запущена
{
	if (isset($_POST['press'])) {//нажата кнопка входа
		if(!login($_POST['login'],$_POST['pass'])){
			//if (isset($_POST['re'])) {
			//	unset($_POST['press']);
			//}
		}
	}
	else{
		echo '<form action="index.php';
		if (isset($_GET['page'])) echo '?page='.$_GET['page'];
		echo '" class="input-group input-group-sm" method="post">';
		echo '<input type="text" name="login" class="form-control" placeholder="логин">
		<input type="password" name="pass"  class="form-control"  placeholder="пароль">
		<input type="submit" id="press" value="войти" class="btn btn-default btn-sm" name="press">
		</form>';
	}
}