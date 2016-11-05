<?php 
if (isset($_POST['adduser'])) {
	if(register($_POST['login'],$_POST['pass1'],$_POST['email'])){
		echo '<h3 style="color:green;">Добавлен</h3>';
	}
}
else{
?>

<form action="index.php?page=4" method="post">
	<div class="form-group">
		<label for="login">Логин</label>
		<input type="text" id="login" class="form-control" name="login">
	</div>
	<div class="form-group">
		<label for="pass1">Пароль</label>
		<input type="password" id="pass1" class="form-control" name="pass1">
	</div>
	<div class="form-group">
		<label for="pass2">Подтверждение пароля</label>
		<input type="password" id="pass2" class="form-control"  name="pass2">
	</div>
	<div class="form-group">
		<label for="email">E-mail</label>
		<input type="email" id="email" class="form-control" name="email">
	</div>
	<input type="submit" class="btn btn-primary" name="adduser">
</form>

<?php
}
?>