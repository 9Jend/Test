<?php
    ob_start(); //Включение буферизации вывода, нужен для того чтобы переадресация с помощью хедера коректно работала
    $host = 'localhost';
		$user = 'root';
		$password = 'root';
		$db_name = 'adadurum_dbase';


		$link = mysqli_connect($host, $user, $password, $db_name); //подключеник к бд
    session_start();

    $url = substr(strtok($_SERVER["REQUEST_URI"], '?'), 1); //получаем url чтоб открыть необходимый файл
    if($url == "index.php" || $url == "")
      $url = "content.php";

    if(file_exists($url)){
      if($_SESSION['auth']){
          $path = $url;
      }
      else {
        header('Location: /login.php');
        exit;
      }
    }
    else if(!$_SESSION['auth'] && file_exists("auth/$url")) {
        $path = "auth/$url";
    }
    else {
      $path = "404.php";
      header("HTTP/1.0 404 Not Found");
    }
    //если файл существует и авторизация выполнена записываем путь файла
    //если авторизация не выполнена переадресуем пользователя на страницу входа
    //если файла по url не существует то страница 404

    include("layout.php"); //подключаем файл с html и тд

    $link->close();
    ob_end_flush();
 ?>
