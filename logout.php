<?php

  $_SESSION['auth'] = null;
  $_SESSION['id'] = null;
  $_SESSION['name'] = null;
  setcookie('login', '', time());
  setcookie('password', '', time());
  header("Location: /login.php");
  exit();
  //обнуляем данные об авторизации и куки о пользователе
 ?>
