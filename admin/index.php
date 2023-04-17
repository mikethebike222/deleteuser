<?php
include "../includes/db.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>Untitled Document</title>
</head>

<body>
	<div class="container">
	<h1> Admin Panel </h1>
	<p> Admin restricted page</p>
	
	<table class="table table-striped table-bordered table-responsive">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Username </th>
			<th scope="col">Email </th>
			<th scope="col">password </th>
			<th scope="col">age </th>
		</tr>
	</thead>	
	
		<tbody>
	<?php
	
	function printUsersTable():void{
		global $conn;
		
		$sql = 'SELECT * FROM `mvn_users` ';
		$stmt = $conn->query($sql);
		while ($row = $stmt->fetch()) {
			echo '<tr>';
				echo '<td>';
					echo $row['username'];
				echo '</td>';
			
				echo '<td>';
					echo "<a href='edit-user.php?id=" .$row["id"] . "'>". $row["email"] . "</a>";
				echo '</td>';
				
				echo '<td>';
					echo substr($row['password'], 0,15) . '___';
				echo '</td>';
			
				echo '<td>';
					echo $row['age'];
				echo '</td>';
			
			echo '</tr>';
		}
	}
		
	printUsersTable();
	?>
		</tbody>
		</table>
	</div>
</body>
</html>