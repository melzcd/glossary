<?php


require $_SERVER['DOCUMENT_ROOT'] . "/conn.php";

//Добовляет новое слово
function AddGlossary ($db,$glossary_name,$glossary_full, $glossary_cat,$glossary_abc) {
	try {
		$stmt = $db->prepare("INSERT INTO glossary_gas(glossary_name, glossary_full, glossary_cat, glossary_abc) VALUES (:glossary_name, :glossary_full, :glossary_cat, :glossary_abc)");
		$stmt->bindParam(':glossary_name', $glossary_name);
		$stmt->bindParam(':glossary_full', $glossary_full);
		$stmt->bindParam(':glossary_cat', $glossary_cat);
		$stmt->bindParam(':glossary_abc', $glossary_abc);
		$stmt->execute();
		return $msg = 'В глоссарий добовлено новое слово';
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		}
$db = null;
	};

	//Алфавит
	function ABC (){
		$abc = array();
		foreach (range(chr(0xC0), chr(0xDF)) as $b)
				$abc[] = iconv('CP1251', 'UTF-8', $b);
		return $abc;
	}

$glossary_name = $_REQUEST['glossary_name'];
$glossary_full = $_REQUEST['glossary_full'];
$glossary_cat = $_REQUEST['glossary_cat'];
$glossary_abc = $_REQUEST['glossary_abc'];

if (isset($_POST['saveGlossary']))
{
  //тут надо написать проверку для полей.
  echo $msg = AddGlossary($db,$glossary_name,$glossary_full, $glossary_cat,$glossary_abc);

};

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Глоссарий</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Глоссарий</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Добавить категорию</a>
                    </li>
                    <li>
                        <a href="#">Сервисы</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
<div class="container">
	<div class="row">
	  <div class="col-lg-8">
	    <table class="table table-hover">
	      <form class="form-reg" action="/add.php" method="POST">
	        <div class="form-group">
	          <label for="exampleInputEmail1">Слово</label>
	          <input type="text" name="glossary_name" class="form-control" placeholder="Слово">
	        </div>
	        <div class="form-group">
	          <label for="exampleInputEmail1">Категория</label>
						<p><select class="form-control" name="glossary_cat" size="1">
						 <option disabled>Выберите категорию</option>
						 <option value="1">Судебная система</option>
						 <option value="2">Информационные технологии</option>
						 <option value="3">Иное</option>
						</select></p>
	        </div>
					<div class="form-group">
						<label for="exampleInputEmail1">Алфавитный указатель</label>
						<p><select class="form-control" name="glossary_abc" size="1">
						 <option disabled>Выберите первую букву слова</option>
						 <?php foreach (ABC() as $value): ?>
						 <option value=<?php echo $value; ?>><?php echo $value; ?></option>
						 <?php endforeach; ?>
						</select></p>
					</div>
	        <div class="form-group">
	          <label for="exampleInputEmail1">Определение</label>
	          <textarea name="glossary_full"  WRAP="virtual" COLS="40" ROWS="3" class="form-control" placeholder="Определение"></textarea>
	        </div>
	        <button type="submit" class="btn btn-default" name = "saveGlossary">Сохранить</button>
	    </form>
	  </div>
	<!-- /.row -->
	</div>
    <!-- /.container -->



      <!-- /.container -->
    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Судебный департамент 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
