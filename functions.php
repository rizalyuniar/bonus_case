<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'instansi';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	</head>
	<body class="bg-warning">
    
	<div class="container">
	<div>
	<div class="col-md-4">
	<form class="mt-5">
	<div class="form-group">
	  <label for="exampleInputEmail1">Username</label>
	  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	</div>
	<div class="form-group">
	  <label for="exampleInputPassword1">Password</label>
	  <input type="password" class="form-control" id="exampleInputPassword1">
	</div>
	<div class="form-group">
	  <a href="#">Lupas password?</a>
	</div>
	<a href="instansi.php" class="btn btn-primary">Submit</a>
 	</form>
	</div>
	</div>
	</div>
EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>