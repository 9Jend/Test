<?php

if(isset($_POST)){//обновляем таблицу заметок если существует пост запрос и поля не пустые
  if(!empty($_POST['companyUserNotesId']) && !empty($dbCellName = $_POST['name'])){
    $companyUserNotesId = $_POST['companyUserNotesId'];
    $dbCellName = $_POST['name'];
    $note = $_POST['note'];
    $query = "UPDATE company_users_notes SET $dbCellName = '$note' WHERE id = '$companyUserNotesId'";
    mysqli_query($link, $query);
  }
}
