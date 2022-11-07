<?php

  $id = $_SESSION['id'];
  $query = "SELECT * FROM users WHERE id='$id'";
  $user = mysqli_fetch_assoc(mysqli_query($link, $query));
  $sqlQuery = null;

  if(!isset($_SESSION['token']))
    $_SESSION['token'] = md5(rand());

  $err = null;

  if(isset($_POST)){ //если есть пост запрос
    if($_POST['token'] == $_SESSION['token']){ //если токен валидности совпадает
      $_SESSION['token'] = null;
      if(!empty($_POST['name']) && $_POST['name'] != $user['user_name']) //если новое имя не пустое и не совпадает со старым
        $sqlQuery .= "user_name = '" .$_POST['name']."'" ;//формируем sqc запрос с новым именем
      if(!empty($_POST['birthday']) && $_POST['birthday'] != $user['user_birthday']){//если дата рождения не пустое и не совпадает со старым
        if($sqlQuery== null)
          $sqlQuery .= "user_birthday = '" .$_POST['birthday']."'" ;//формируем sqc запрос с новым именем
        else
          $sqlQuery .= ", user_birthday = '" .$_POST['birthday']."'" ;//формируем sqc запрос с новым именем
      }
      if(!empty($_POST['passwordOld']) || !empty($_POST['passwordNew']) || !empty($_POST['passworConfirm'])){//если одно из полей пароля не пустое
        if(!empty($_POST['passwordOld']) && !empty($_POST['passwordNew']) && !empty($_POST['passworConfirm'])){//если все поля пароля не пустое
          if(password_verify($_POST['passwordOld'], $user['user_password'])){//если пароль совпадает с паролем пользователя
            if($_POST['passwordNew'] == $_POST['passworConfirm']){//если новый пароль совпадает с подтверждением нового пароля
              $newPass = password_hash($_POST['passwordNew'], PASSWORD_DEFAULT);
              if($sqlQuery== null)
                $sqlQuery .= "user_password = '" .$newPass."'" ;//формируем sqc запро
              else
                $sqlQuery .= ", user_password = '" .$newPass."'" ;//формируем sqc запро
            }
            else
              $err = "Пароли новые не совпадают";
          }
          else
            $err =  "Старый пароль не верный";
        }
        else
            $err =  "Не все поля паролей заполнены";
      }
      if($sqlQuery != null){
        $queryUpdate = "UPDATE users SET $sqlQuery WHERE id = '$id'";

        if(mysqli_query($link, $queryUpdate)){//выполняем изминение в бд и если оно происхожит успешно берем из бд обновленные данные о пользователе
          $user = mysqli_fetch_assoc(mysqli_query($link, $query));
          $_SESSION['name'] = $user['user_name'];
          header("Location: /personalArea.php");
          exit;
         }
       }
    }
  }
?>

<div class="container bg-light p-1 mt-1 mb-1" style="border-radius: 8px;">
  <div class="contaner w-50 m-auto p-5 border border-secondary rounded mt-2 mb-2" >
    <p class="h3">Добрый день <?=$user['user_name'] ?></p>
    <form action="" method="post" id="changeUserDateForm">
      <?php
        if($err != null)
          echo "<p class = ' text-danger'>$err.</p>";
      ?>
      <input type="hidden" name="token" value="<?=$_SESSION['token'] ?>">
      <div class="form-group">
        <label for="name">Изменить имя</label>
        <input name="name" type="text" class="form-control" id="name" value="<?=$user['user_name'] ?>" required>
      </div>
      <div class="form-group">
        <label for="birthday">Изменить дату рождения</label>
        <input name="birthday" type="date" class="form-control" id="birthday" max="2021-12-31" value="<?=$user['user_birthday'] ?>" required>
      </div>
      <div class="form-group">
        <label for="password">Введите старый пароль</label>
        <input name="passwordOld" type="password" class="form-control" id="password" placeholder="Пароль" minlength="8">
      </div>
      <div class="form-group">
        <label for="passwordNew">Введите новый пароль</label>
        <input name="passwordNew" type="password" class="form-control" id="passwordNew" placeholder="Пароль" minlength="8">
      </div>
      <div class="form-group">
        <label for="passworConfirm">Повторите пароль</label>
        <input name="passworConfirm" type="password" class="form-control" id="passworConfirm" placeholder="Пароль" minlength="8">
      </div>
      <button type="submit" class="btn btn-success mt-2 mb-2">Изменить данные</button>
      <br>
      <a href="logout.php" class="btn btn-danger mt-2 mb-0">Выйти!</a>
    </form>
  </div>
</div>
