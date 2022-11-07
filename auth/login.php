<?php
  if($_SESSION['auth']){//если авторизованный пользователь попал на страницу переадресовываем его на стартовую страницу
    header("Location: /index.php");
    exit;
  }
    $errLog;

    if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {//если есть куки о пользователе
      $login = $_COOKIE['login'];
      $password = $_COOKIE['password'];
      $query = "SELECT * FROM users WHERE user_login='$login'";
      $user = mysqli_fetch_assoc(mysqli_query($link, $query));

      if (!empty($user)) {
        if(password_verify($password, $user['user_password'])){//куки о пользователе коректны то производим авторизацию
          $_SESSION['auth'] = true;
          $_SESSION['id'] = $user['id'];
          $_SESSION['name'] = $user['user_name'];
          header("Location: /index.php");
          exit;
        }
      }
    }

  if(isset($_POST)){
    if(!empty($_POST['login']) && !empty($_POST['password'])) {//если существует пост запрос и данные введены не пустые
      $login = $_POST['login'];
      $password = $_POST['password'];

      $query = "SELECT * FROM users WHERE user_login='$login'";
      $user = mysqli_fetch_assoc(mysqli_query($link, $query));

      if (!empty($user)) {
        $hash = $user['user_password'];
        if(password_verify($password, $hash)){//если данные о пользователе коректны то производим авторизацию
          $_SESSION['auth'] = true;
          $_SESSION['id'] = $user['id'];
          $_SESSION['name'] = $user['user_name'];
          if(isset($_POST['rememberMe'])){//сохраняем куки если данные о пользователе коректны и нажат чекбокс 'запомнить'
            setcookie("login", $login, time() + 3600);
            setcookie("password", $password, time() + 3600);
          }
          header("Location: /index.php");
          exit;
        }
        else {
            $errLog = "Введен не правильный пароль";
        }
      }
      else {
        $errLog = "Введен логин не существующего пользователя";
      }
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
        <label for="password">Пароль</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Пароль" required>
      </div>
      <div class="form-check">
        <input name="rememberMe" type="checkbox" class="form-check-input" id="rememberMe" value="true">
        <label class="form-check-label" for="rememberMe">Запомнить меня</label>
      </div>
      <button type="submit" class="btn btn-primary mt-2 mb-2">Войти</button>
      <br>
      <a href="register.php" class="link-dark">Нет аккаунта? Создайте его сейчас!</a>
    </form>
  </div>
</div>
