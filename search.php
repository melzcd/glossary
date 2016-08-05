<?php
require $_SERVER['DOCUMENT_ROOT'] . "/conn.php";

$q = $_GET['q'];


$resultS = array();
	    // Подключим файл с api
	    include('C:\Sphinx\api\sphinxapi.php');

	    // Создадим объект - клиент сфинкса и подключимся к нашей службе
	    $cl = new SphinxClient();
	    $cl->SetServer( "localhost", 9312 );

	    // Собственно поиск
	    $cl->SetMatchMode( SPH_MATCH_ANY  ); // ищем хотя бы 1 слово из поисковой фразы
	    $result = $cl->Query($q); // поисковый запрос


	    // обработка результатов запроса
	    if ( $result === false ) {
	          echo "Query failed: " . $cl->GetLastError() . ".\n"; // выводим ошибку если произошла
	      }
	      else {
	          if ( $cl->GetLastWarning() ) {
	              echo "WARNING: " . $cl->GetLastWarning() . ".\n"; // выводим предупреждение если оно было;
	          }

	          if ( ! empty($result["matches"]) ) { // если есть результаты поиска - обрабатываем их
	              foreach ( $result["matches"] as $product => $info ) {
			foreach (ViewGlossary ($db,$product) as $value) {
				//var_dump(array_push($resultS,$value['glossary_name'],$value['glossary_full'] ));
				echo '
				<div class="container">
				    <div class="row">
				      <div class="col-lg-12"><h3><p>'.$value['glossary_name'].'</p></h3>
				        <div class="col-lg-12">'.$value['glossary_full'].'</div>
				</div>
			</div>
		</div>
	</div>';
			};
	                    //echo $product . "<br />"; // просто выводим id найденных товаров
	              }
	          }
	      }

	  //exit;

//Выводит список слов
function ViewGlossary ($db,$product) {
	try {
		if (empty($product)) {
			echo 'Вы не ввели ни одного поисвого слова';
		}
		else {
			$sql = "SELECT glossary_name,glossary_full,glossary_cat FROM glossary_gas WHERE glossary_id = :glossary_id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':glossary_id', $product);
		}
		$stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $row;
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		}
$db = null;
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
                        <a href="#">Контакты</a>
                    </li>
                    <li>
                        <a href="#">Сервисы</a>
                    </li>
                </ul>
		<form class="navbar-form navbar-left" role="search" action="/search.php" method="GET">
  			<div class="form-group input-group-sm" >
    				<input type="text" class="form-control" placeholder="Поиск" name="q">
  			</div>
  		<button type="submit" class="btn btn-default btn-sm" >Отправить</button>
		</form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->

    <!-- /.container -->


      <!-- /.container -->
    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; zcdteam</p>
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
