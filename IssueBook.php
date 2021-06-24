<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Book Issue</title>
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
	$issuedate = date("Y/m/d");
	$date = date_create("$issuedate");
	date_add($date,date_interval_create_from_date_string("15 days"));
	$returndate = date_format($date, "Y/m/d");
	$copies = 0;
	$conn = new mysqli('localhost','root','','library');
	if($conn->connect_error)
	{
		die('Connection Failed : '+$conn->connection_error);
	}
	else
	{
		$query = $conn->prepare("SELECT * FROM book WHERE id = ?");
		$query->bind_param("i",$bid);
		if(!($query->fetch()))
		{
			$query = $conn->prepare("SELECT * FROM member WHERE id = ?");
			$query->bind_param("i",$mid);
			if(!($query->fetch()))
			{
				$query = $conn->prepare("SELECT * FROM admin WHERE id = ?");
				$query->bind_param("i",$aid);
				if(!($query->fetch())) 
				{
					$results = $conn->query("SELECT copies FROM book WHERE id = ".$bid);
					while($row = $results->fetch_array()) 
					{
	    				for($i =0; $i< 1; $i++)
    					{
        					$copies = (int)$row[$i];
    					}
					}
					$copies = $copies - 1;
    				$sql = "UPDATE book SET copies = ? WHERE id = ?";
    				$stmt = mysqli_prepare($conn, $sql);
    				mysqli_stmt_bind_param($stmt, "si", $param_copies, $param_id);
    				$param_copies = $copies;
	    			$param_id = $bid;
    				if(mysqli_stmt_execute($stmt))
    				{
    					if ($copies > 0) 
    					{
	    					$stmt = $conn->prepare("INSERT INTO issue(bid,mid,aid,issuedate,returndate) values(?,?,?,?,?) ");
							$stmt->bind_param("iiiss",$bid,$mid,$aid,$issuedate,$returndate);
							$stmt->execute();
							echo "Record Created !!!! "."<br>";
							echo "Return Date is : ".$returndate."<br>";
							$stmt->close();
    						echo "Copies Updated Successfully !!!!";
    					}
    					else
	    				{
    						echo "Cannot Issue Book !!!!"."<br>"."All books already issued !!!! ";
    					}
    				}
    				else
	    			{
    					echo "Error While Updating Copies";
    				}
					$conn->close();
				}
				else
				{
					echo "Invalid Admin Code !!! ";
				}
			}
			else
			{
				echo "Invalid Member Code !!! ";
			}
		}
		else
		{
			echo "Invalid Book Code !!! ";
		}
	}
?>
</center>
</body>
</html>