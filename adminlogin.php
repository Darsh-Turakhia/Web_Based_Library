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
	$id = $_POST['aid'];
	$pass = $_POST['apass'];
	$conn = new mysqli('localhost','root','','library');
	if($conn->connect_error)
	{
		die('Connection Failed : '+$conn->connection_error);
	}
	else
	{
		$query = $conn->prepare("SELECT username FROM admin WHERE id = ?");
		$query->bind_param("i",$id);
		if(!($query->fetch())) 
		{
			$query = $conn->prepare("SELECT password FROM admin WHERE id = ?");
			$query->bind_param("i",$id);
			if(!($query->fetch())) 
			{
				if($pass == $query->fetch())
				{
					header("Location: /Library/Administrator.html");
				}
				else
				{
					header("Location: /Library/index.html");
				}
				$conn->close();
			}
		}
		else
		{
			echo "Invalid Admin Code !!! ";
		}
	}
?>
</center>
</body>
</html>