<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Book Deposit</title>
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
	$bid = $_POST['bid'];
	$mid = $_POST['mid'];
	$aid = $_POST['aid'];
	$returndate = date("Y/m/d");
	$date = 0;
	$conn = new mysqli('localhost','root','','library');
	if($conn->connect_error)
	{
		die('Connection Failed : '+$conn->connection_error);
	}
	else
	{
		$query1 = $conn->prepare("SELECT * FROM issue WHERE bid = ? AND mid = ? AND aid = ?");
		$query1->bind_param("iii",$bid,$mid,$aid);
		if(!($query1->fetch()))
		{
			$results = $conn->query("SELECT returndate FROM issue WHERE bid = '".$bid."' AND mid = '".$mid."' AND aid = '".$aid."'");
			while($row = $results->fetch_array()) 
			{
	    		for($i =0; $i<1; $i++)
    			{
	        		$date = (int)$row[$i];
    			}
			}
			if($returndate < $date)
			{
				echo "Fine is to be paid !!! ";
				$fine = ($returndate-$date)*2;
				echo "Please Pay Rs.".($fine);
				$sql = "DELETE FROM issue WHERE bid = '".$bid."' AND mid = '".$mid."' AND aid = '".$aid."'";
				if(($conn->query($sql)) == TRUE)
				{
					$results = $conn->query("SELECT copies FROM book WHERE id = ".$bid);
					while($row = $results->fetch_array()) 
					{
	    				for($i =0; $i< 1; $i++)
    					{
        					$copies = (int)$row[$i];
    					}
					}
					$copies = $copies + 1;
    				$sql = "UPDATE book SET copies = ? WHERE id = ?";
    				$stmt = mysqli_prepare($conn, $sql);
    				mysqli_stmt_bind_param($stmt, "si", $param_copies, $param_id);
    				$param_copies = $copies;
    				$param_id = $bid;
    				if(mysqli_stmt_execute($stmt))
						echo "Book Deposited !!! ";
					else
						echo "Error While Updating Book Copies !!!!";
				}
				else
				{
					echo "Error while Deleting Record";
				}
			}
			else
			{
				$sql = "DELETE FROM issue WHERE bid = '".$bid."' AND mid = '".$mid."' AND aid = '".$aid."'";
				if(($conn->query($sql)) == TRUE)
				{
					$results = $conn->query("SELECT copies FROM book WHERE id = ".$bid);
					while($row = $results->fetch_array()) 
					{
	    				for($i =0; $i< 1; $i++)
    					{
        					$copies = (int)$row[$i];
    					}
					}
					$copies = $copies + 1;
    				$sql = "UPDATE book SET copies = ? WHERE id = ?";
    				$stmt = mysqli_prepare($conn, $sql);
    				mysqli_stmt_bind_param($stmt, "si", $param_copies, $param_id);
    				$param_copies = $copies;
    				$param_id = $bid;
    				if(mysqli_stmt_execute($stmt))
						echo "Book Deposited !!! ";
					else
						echo "Error While Updating Book Copies !!!!";
				}
				else
				{
					echo "Error while Deleting Record";
				}
			}
		}
		else
		{
			echo "No Book Issued with given details !!!! ";
		}
		$conn->close();
	}
?>
</center>
</body>
</html>