<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Developer</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Darsh Turakhia</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
	      	<li class="nav-item">
	        	<a class="nav-link" href="IssueBook.html">Issue</a>
	      	</li>
	      	<li class="nav-item">
		        <a class="nav-link" href="ReturnBook.html">Deposit</a>
	      	</li>
	      	<li class="nav-item">
		        <a class="nav-link" href="Administrator.html">Admin</a>
	      	</li>
		</ul>
	</div>
	</nav>
	<br>
	<center>
<?php
	$id = $_POST['did'];
	$pass = $_POST['pass'];
	if($id == "root")
	{
		if($pass == "root")
		{
			header("Location: /Library/Admin.html");
		}
		else
		{
			header("Location: /Library/index.html");
		}
	}
	else
	{
		header("Location: /Library/index.html");
	}
?>
</center>
</body>
</html>