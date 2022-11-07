<?php
  if($_SESSION['auth']){//если авторизованный пользователь попал на страницу, переадресовываем его на стартовую страницу
    header("Location: /index.php");
    exit;
  }

  $errLog;

  if(isset($_POST)){//если существует пост запрос и данные введены не пустые
    if(!empty($_POST['login']) && !empty($_POST['name']) && !empty($_POST['birthday']) && !empty($_POST['password']) && !empty($_POST['passworConfirm'])){
      $login = $_POST['login'];
      $name = $_POST['name'];
      $birthday = $_POST['birthday'];
      $password = $_POST['password'];
      $passworConfirm = $_POST['passworConfirm'];
      $created_at = date('Y-m-d H:i:s');

      if($password == $passworConfirm){ //если пароли совпадают
        $query = "SELECT * FROM users WHERE user_login='$login'";
    		$user = mysqli_fetch_assoc(mysqli_query($link, $query));

        $password = password_hash($password, PASSWORD_DEFAULT);

        if (empty($user)) { //если нет юзера по такому же логину создаем новую запись в таблицу
          $query = "INSERT INTO users SET user_login='$login', user_name = '$name', user_birthday = '$birthday',  user_password='$password', created_at = '$created_at'";
    			mysqli_query($link, $query);
          $_SESSION['auth'] = true;
          $_SESSION['id'] = mysqli_insert_id($link);
          $_SESSION['name'] = $name;

          if(isset($_POST['rememberMe'])){//сохраняем куки если данные о пользователе коректны и нажат чекбокс 'запомнить'
            setcookie("login", $login, time() + 3600);
            setcookie("password", $_POST['password'], time() + 3600);
          }
          header("Location: /index.php");
          exit;
        }
        else
        $errLog = "Данный логин уже используется";
      }
      else
        $errLog = "Пароли не совпадают";
    }
  }
?>
<div class="container bg-light p-1 mt-1 mb-1" style="border-radius: 8px;">
  <div class="contaner w-50 m-auto p-5 border border-secondary rounded mt-2 mb-2" >
    <form action="" method="post">
      <?php if(!empty($errLog)) echo "<p class = ' text-danger'>$errLog.</p>";?>
      <div class="form-group">
        <label for="login">Логин</label>
        <input name="login" type="email" class="form-control" id="login" aria-describedby="emailHelp" placeholder="введите логин" required>
      </div>
      <div class="form-group">
        <label for="name">Имя</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="введите ваше имя" required>
      </div>
      <div class="form-group">
        <label for="birthday">Дата рождения</label>
        <input name="birthday" type="date" class="form-control" id="birthday" placeholder="введите вашу дату рождения" max="<?=date('Y-m-d') ?>" required>
      </div>
      <div class="form-group">
        <label for="password">Пароль</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Пароль" minlength="8" required>
      </div>
      <div class="form-group">
        <label for="passworConfirm">Повторите пароль</label>
        <input name="passworConfirm" type="password" class="form-control" id="passworConfirm" placeholder="Пароль" minlength="8" required>
      </div>
      <div class="form-check">
        <input name="rememberMe" type="checkbox" class="form-check-input" id="rememberMe" value="true">
        <label class="form-check-label" for="rememberMe">Запомнить меня</label>
      </div>
      <button type="submit" class="btn btn-primary mt-2 mb-2">Зарегистрироватся</button>
      <br>
      <a href="login.php" class="link-dark">Есть аккаунт? Войдите в него сейчас!</a>
    </form>
  </div>
</div>
