<?php
require $_SERVER['DOCUMENT_ROOT'] . "/conn.php";

$glossary_abc = $_GET['glossary'];


//Выводит список слов
function ViewGlossary ($db,$glossary_abc,$sql) {
	try {
		if (empty($glossary_abc)) {
			$sql = "SELECT glossary_name, glossary_full FROM glossary_gas WHERE glossary_abc is not null ORDER BY glossary_name ASC";
			$stmt = $db->prepare($sql);
		}
		else {
			$sql = "SELECT glossary_name,glossary_full,glossary_cat FROM glossary_gas WHERE glossary_abc = :glossary_abc ORDER BY glossary_name ASC";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':glossary_abc', $glossary_abc);
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

//Выводит алфавит
	function ViewABC ($db) {
		try {
			$stmt = $db->prepare("SELECT DISTINCT glossary_abc FROM glossary_gas ORDER BY glossary_abc ASC");
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
<div class="container">
  <div class="row">
    <div class="col-lg-12">
  </div>
	<br>
	<div class="row">
		<div class="col-lg-12">
			<ul class="pagination">
				<?php foreach (ViewABC($db) as $value): ?>
			<li><a href=?glossary=<?php echo $value['glossary_abc']; ?>><?php echo $value['glossary_abc']; ?></a></li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
<?php foreach (ViewGlossary($db,$glossary_abc,$sql) as $value): ?>
    <div class="row">
      <div class="col-lg-12">
        <h3><p><?php echo $value['glossary_name']; ?></p></h3>
        <div class="col-lg-12">
          <?php echo $value['glossary_full']; ?>
          </div>
					<div class="col-xs-6 col-md-4"><h5><small>Вторичный текст</small></h5></div>
					<div class="col-xs-6 col-md-4"><h5><small>Вторичный текст</small></h5></div>
					<div class="col-xs-6 col-md-4"><h5><small>Вторичный текст</small></h5></div>
      </div>
      </div>
<?php endforeach; ?>
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
