<?php
	 $id = $_SESSION['id'];
	 $query = "SELECT * FROM company";
	 $result = mysqli_query($link, $query);
   for ($companies = []; $row = mysqli_fetch_assoc($result); $companies[] = $row); //преобразуем данные и бд в массив

	 if(!isset($_SESSION['token']))
		 $_SESSION['token'] = md5(rand());

	if(isset($_POST) && $_POST['token'] == $_SESSION['token']){//если существует пост запрос и токен совпадает добовляем компанию в таблицу бд
		$_SESSION['token'] = null;
	   if(!empty($_POST['companyName']) && !empty($_POST['innCompany']) && !empty($_POST['decriptionCompany']) && !empty($_POST['nameGenDirCompany']) && !empty($_POST['adresComapny']) && !empty($_POST['phoneCompany'])){

				 $company_name = $_POST['companyName'];
	       $company_inn = $_POST['innCompany'];
	       $company_information = $_POST['decriptionCompany'];
	       $company_gendir = $_POST['nameGenDirCompany'];
	       $company_address = $_POST['adresComapny'];
	       $company_phone = $_POST['phoneCompany'];

	       $query = "INSERT INTO company SET
	          company_name = '$company_name',
	          company_inn = '$company_inn',
	          company_information = '$company_information',
	          company_gendir ='$company_gendir',
	          company_address = '$company_address',
	          company_phone = '$company_phone'";

	        if(mysqli_query($link, $query)){
	          header("Location: /index.php");
	         exit;
				 }
     }
	}
?>


<div class="container bg-light p-1 mt-1 mb-1" style="border-radius: 8px;">
	 <h1>Список компаний</h1>
	<div class="d-flex flex-lg-row flex-xl-row flex-sm-column flex-md-column flex-column m-auto flex-wrap justify-content-start" style="width: 90%">

	  <?php
	  if(empty($companies)) echo "<p class = 'h3'>Список компаний пуст</p>";
	  foreach ($companies as $company) { ?>
	    <div class="d-inline-block bg-dark p-2 m-3 w-sm-100 w-md-100 w-xl-22 w-lg-22 w-100" style="height: 100px; border-radius: 3px;">
				<a class="text-light h3" href="company.php?id=<?=$company["id"];?>"><?=$company["company_name"];?></a>
	      <div class="mb-2 mt-3 text-light">
	      	<p class="text-truncate"><?=$company["company_information"];?></p>
	      </div>
	    </div>
		<?php } ?>
		</div>
  <div class="container p-0" style=" width: 90%;">
    <button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      Добавть компанию
    </button>
  </div>
  <div class="collapse container p-0 pb-3 pt-2" id="collapseExample" style="width: 90%;">
    <p class="h3">Добавьте компанию</p>
    <form action="" method="post">
			  <input type="hidden" name="token" value="<?=$_SESSION['token'] ?>">
    <div class="form-group">
      <label for="companyName">Название компании</label>
      <input name="companyName" type="text" class="form-control" id="companyName" placeholder="Яндекс" required>
    </div>
    <div class="form-group">
      <label for="innCompany">ИНН компании</label>
      <input name="innCompany" type="number" class="form-control" id="innCompany" placeholder="Введите ИНН компании" required>
    </div>
    <div class="form-group">
      <label for="decriptionCompany">Общая информация о компании</label>
      <textarea name="decriptionCompany" class="form-control" id="decriptionCompany" rows="3" placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero earum, voluptatem illum commodi ullam beatae error ipsum cupiditate tempore. Quas earum quos atque, provident, distinctio recusandae repellendus fugit. Quas voluptas modi error ullam natus, nesciunt asperiores molestias officia magnam corporis, atque temporibus maxime, aut perspiciatis ut accusantium rerum. Cum, voluptates!" required></textarea>
    </div>
    <div class="form-group">
      <label for="nameGenDirCompany">ФИО генерельного деректора компании</label>
      <input name="nameGenDirCompany" type="text" class="form-control" id="nameGenDirCompany" placeholder="Голуб Евгений Борисович" required>
    </div>
    <div class="form-group">
      <label for="adresComapny">Адрес компании</label>
      <input name="adresComapny" type="text" class="form-control" id="adresComapny" placeholder="г. Санкт-петербуг, Литейный пр., 20, Санкт-Петербург, 191028" required>
    </div>
    <div class="form-group">
      <label for="phoneCompany">Телефон компании</label>
      <input name="phoneCompany" type="tel" class="form-control" id="phoneCompany" placeholder="+7 (xxx) xxx-xx-xx" required>
    </div>
    <script src="js/jquery.maskedinput.min.js"></script>
      <script>
          $("#phoneCompany").mask("+7 (999) 999-99-99");
      </script>
      <div class="container text-center">
          <button type="submit" class="btn btn-dark mt-3" style="width:150px;">Добавить</button>
      </div>
  </form>
</div>
</div>
