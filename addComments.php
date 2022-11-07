<?php
if(isset($_POST)){//добовляем коментарий если есть пост запрос и совпадает токен
  if($_POST['token'] == $_SESSION['token']){
    $_SESSION['token'] = null;
    if(!empty($_POST['comments'])){
      $comments = $_POST['comments'];
      $companyUserNotesId = $_POST['companyUserNotesId'];
      $user_name = $_SESSION['name'];
      $created_at = date('Y-m-d H:i:s');
      $query = "INSERT INTO company_users_comments SET company_users_notes_id = '$companyUserNotesId', user_name = '$user_name', company_users_comments = '$comments', created_at = '$created_at'";
      mysqli_query($link, $query);
    }
  }
}
