<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Delete Member</title>
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
	$mid = $_POST['id'];
	$conn = new mysqli('localhost','root','','library');
	if($conn->connect_error)
	{
		die('Connection Failed : '+$conn->connection_error);
	}
	else
	{
		$sql = "DELETE FROM member WHERE id = '".$mid."'";
		if(($conn->query($sql)) == TRUE)
		{
			echo "Record Deleted  !!! ";
		}
		else
		{
			echo "Error while Deleting Record";
		}
		$conn->close();
	}
?>
</center>
</body>
</html>