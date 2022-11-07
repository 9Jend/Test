<script type="text/javascript">
	$(document).ready(function(){
		var count = 5;
		document.getElementById("countsForFieldNotes").innerHTML = count;
		$('#fildNote1').hide();
		$('#fildNote2').hide();
		$('#fildNote3').hide();
		$('#fildNote4').hide();
		$('#fildNote5').hide();

		$("#show").click(function () {
			if(count <= 5 && count >= 1 )
				$('#fildNote' + count).show();
			if(count >= 1)
				count --;
			document.getElementById("countsForFieldNotes").innerHTML = count;
		});

		$("#hide").click(function () {
			if(count < 5)
				count ++;
			if(count <= 5 && count >= 1 )
				$('#fildNote' + count).hide();
			document.getElementById("countsForFieldNotes").innerHTML = count;
		});
	});
</script>

<?php
	$companyUserNotesId;
	if(!isset($_SESSION['token']))
    $_SESSION['token'] = md5(rand());

	if(isset($_GET)){
		if(!empty($_GET['id'])){
			$company_id = $_GET['id'];//get запросом получаем id компании
			$user_id = $_SESSION['id'];

			$query = "SELECT * FROM company WHERE id = '$company_id'";
			$company = mysqli_fetch_assoc(mysqli_query($link, $query));
			if(empty($company)){//если по данному id нет компании переадресовыаем пользоваетля на 404 страницу
				header("Location: /404.php");
				exit();
			}
			$query = "SELECT * FROM company_users_notes WHERE company_id = '$company_id' AND user_id='$user_id'";
			$companyUserNotes = mysqli_fetch_assoc(mysqli_query($link, $query)); //получаем заметки пользователя о компании
			if(empty($companyUserNotes)){
				$query = "INSERT INTO company_users_notes SET company_id = '$company_id', user_id='$user_id'";
				mysqli_query($link, $query); //создаем запись-связь между пользователем и компанией если ее не было
				$query = "SELECT * FROM company_users_notes WHERE company_id = '$company_id' AND user_id='$user_id'";
				$companyUserNotes = mysqli_fetch_assoc(mysqli_query($link, $query));//получаем заметки пользователя о компании
			}

			$companyUserNotesId = $companyUserNotes['id'];
			$query = "SELECT * FROM company_users_comments WHERE company_users_notes_id = '$companyUserNotesId' ORDER BY created_at DESC";
			$result = mysqli_query($link, $query);
			for ($companyUserComents = []; $row = mysqli_fetch_assoc($result); $companyUserComents[] = $row);//получаем все комментарии о данной компании оставленные данным пользователем и преобразовываем в массив
		}
		else { //если попали на страницу без гет запроса то 404
			header("Location: /404.php");
			exit();
		}
	}
?>


<div class="container bg-light p-1 mt-1 mb-1" style="border-radius: 8px;">
  <div class="container p-0 mb-3 mt-3" style="width: 90%;">
    <p class="h2">Страница компании</p>
  </div>
  <div class="container bg-dark p-3 mb-2 mt-2 text-light align-middle" style="width: 90%; border-radius: 3px;">
    <div class="container row">
      <div class="col-3">
        <span class="h6">Название: <?=$company["company_name"];?></span>
      </div>
      <div class="col-5">
        <input name="company_name_notes" type="text" class="form-control h-100" value="<?=$companyUserNotes["company_name_notes"];?>">
      </div>
      <div class="col-4 text-center">
        <button type="button" id="show" class="btn btn-secondary" style="height:40px; width:40px;">+</button>
        <button type="button" id="hide" class="btn btn-secondary" style="height:40px; width:40px;">-</button>
        <span class="d-none d-sm-none d-md-none d-lg-inline m-2">коментарии</span>
        <span id="countsForFieldNotes"></span>
      </div>
    </div>
    <div class="container row mt-2 h-auto" id="fildNote5">
      <div class="col-3">
        <span class="h6">ИНН: <?=$company["company_inn"];?></span>
      </div>
      <div class="col-5">
        <input name="company_inn_notes" type="text" class="form-control h-100" value="<?=$companyUserNotes["company_inn_notes"];?>">
      </div>
    </div>
    <div class="container row mt-2 h-auto" id="fildNote4">
      <div class="col-3">
        <span class="h6">Общая информация: <?=$company["company_information"];?></span>
      </div>
      <div class="col-5">
        <input name="company_inf_notes" type="text" class="form-control h-100" value="<?=$companyUserNotes["company_inf_notes"];?>">
      </div>
    </div>
    <div class="container row mt-2 h-auto" id="fildNote3">
      <div class="col-3">
        <span class="h6">ФИО генерельного директора: <?=$company["company_gendir"];?></span>
      </div>
      <div class="col-5">
        <input name="company_gendir_notes" type="text" class="form-control h-100" value="<?=$companyUserNotes["company_gendir_notes"];?>">
      </div>
    </div>
    <div class="container row mt-2 h-auto"  id="fildNote2">
      <div class="col-3">
        <span class="h6">Адрес: <?=$company["company_address"];?></span>
      </div>
      <div class="col-5">
        <input name="company_address_notes" type="text" class="form-control h-100" value="<?=$companyUserNotes["company_address_notes"];?>">
      </div>
    </div>
    <div class="container row mt-2 h-auto" id="fildNote1">
      <div class="col-3">
        <span class="h6">Телефон: <?=$company["company_phone"];?></span>
      </div>
      <div class="col-5">
        <input name="company_phone_notes" type="text" class="form-control h-100" value="<?=$companyUserNotes["company_phone_notes"];?>">
      </div>
    </div>
  </div>
    <div class="container bg-dark p-3 mb-2 text-light" style="width: 90%; border-radius: 3px;">
		  <form method="post">
				<input type="hidden" name="token" value="<?=$_SESSION['token'] ?>">
				<input id = "companyUserNotesId" type="hidden" name="companyUserNotesId" value="<?=$companyUserNotesId ?>">
        <label class="m-2 h4" for="comments">Комментарий</label>
        <textarea name = "comments" class="form-control" id="comments" rows="3" required></textarea>
          <button type="submit" class="btn btn-light mt-3" style="width:150px;">Добавить</button>
      </form>
    </div>
    <div class="container bg-dark p-3 mb-2 text-light" style="width: 90%; border-radius: 3px;">
      <p class="m-2 h4" for="decriptionCompany">Комментарии</p>
			<?php
				if(empty($companyUserComents))
					echo '<p class="m-2 h4" for="decriptionCompany">Список комментариев пуст</p>';
				else {
					foreach ($companyUserComents as $coments) { ?>
						<div class="container border mt-2">
							<p  class="m-2" ><?=$coments['user_name']." ".$coments['created_at'] ?></p>
							<hr>
							<p  class="m-2"> <?=$coments['company_users_comments'] ?></p>
						</div>
				<?php
					}
				}
			?>
    </div>
</div>
<script>
	$('form').submit(function (e) {
    e.preventDefault();
    var data = $('form').serializeArray();
    $.ajax(
			{
        type: "POST",
        url: "addComments.php",
        data: data,
				dataType: "html",
				success: function() { //Данные отправлены успешно
					location.reload();
          alert("Коментарий был успешно добавлен.");
        },
				error: function() { // Данные не отправлены
					location.reload();
          alert("Ошибка! Коментарий не был добавлен.");
        }
    	});
		});

		$('input').on('change',function()
		{
			name = $(this).attr("name");
  		var $this = $(this);
      note = $this.val();
			var companyUserNotesId = <?=$companyUserNotesId  ?>;
			  $.ajax(
				{
					type: "POST",
					url: "editNotes.php",
					data: {note : note, name: name, companyUserNotesId:companyUserNotesId },
					dataType: "html",
					success: function(){
						alert("Заметка была изменена.");
					},
					error: function(){
						alert("Ошибка. Что-то пошло не так(.");
					}
				});
			});
</script>
