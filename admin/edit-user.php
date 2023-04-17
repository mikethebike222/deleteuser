<?php
include "../includes/db.php";

$userName = '';

if(  isset($_GET['id']))
{
	$uid = trim($_GET['id']);
	$sql = "SELECT * FROM `mvn_users` WHERE `id` = $uid    Limit 1";
	$stmt = $conn->query($sql);
	$row = $stmt->fetch();

}
	else
		header('Location: index.php');
		
if (isset($_GET['id'])) {
    $uid = trim($_GET['id']);
    $sql = "SELECT * FROM `mvn_users` WHERE `id` = $uid    Limit 1";
    $stmt = $conn->query($sql);
    $row = $stmt->fetch();

} else {
    header('Location: index.php');
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $age = $_POST['age'];

    $email = $_POST['email'];
    $id = $_GET['id'];

    $sql = "UPDATE mvn_users SET email=?, age=?, username=? WHERE id=? ";

    $stmt = $conn->prepare($sql);
    $rowsAffected = $stmt->execute([$email, $age, $username, $id]);
    echo 'rows affected : ' . $rowsAffected;
}
 
if( isset($_POST['changepword']))
{
	
	$password = trim($_POST['password']);
	$password = hash('sha256', $password . $salt);
	$id = $_GET['id'];
	$sql = "UPDATE mvn_users SET password=? WHERE id=? ";
	$stmt= $conn->prepare($sql);
	$result = $stmt->execute([$password, $id]);
	$done = $stmt !== false ? true : false;
	$rowsAffected = $stmt ->rowCount();
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>Untitled Document</title>
	<style> 
	 #feedback{
                opacity: 0;
				position: fixed;
				bottom: 0;
            }</style>
</head>

<body>
	<div class="container">
	<h1> Admin Panel-Edit User : <?php echo $row['username'] ; ?> </h1>
		<p>Admin Restricted Page</p>
		
			<?php 
			if( isset($_POST['username']))
			{
				echo '<div class="bg-primary text-white p-4 m-4">';
				if( $rowsAffected > 0)
				{
					echo 'Update successful';
				}
				else
				{
					echo 'update failed';
				}
				echo '</div>';
			}
			?>
		
		<form method="post">
                		<div class="input-group p-2">
                        <span class="input-group-text">username</span>
                        <input name="username" type="text" class="form-control" id="username" value="<?php echo $row['username'] ; ?>">
                    </div>
					 <div class="input-group p-2">
                        <span class="input-group-text">age</span>
                        <input type="number" class="form-control" id="age" value="<?php echo $row['age'] ; ?>" name="age">
                    </div>
                   
						
			
                    <div class="input-group p-2">
                        <span class="input-group-text">Email</span>
                        <input type="email" class="form-control" id="email" value="<?php echo $row['email'] ; ?>" name="email">
                    </div>
			<input type="submit" value="update" id="registerbttn" class="btn btn-lg btn-primary">
			 <div id="feedback" class="border ml-4 mt-2 mb-2 p-2 bg-danger">  <?php echo $row['id'] ; ?></div>
		</form>
		<form method="post">
			<div class="input-group m-3 ">
			<div class="input-group-prepend">
				<span class="input-group-text">Password</span>
				</div>
				<input name="password" class="form-control " type="text" id="pword" placeholder="password" value=" <?php echo $row['password']; ?> "/>
				<div class="input-group-append">
				<input type="submit" value="Change Password" name="changepword" class="btn btn-primary"></div>
			</div>
		
		</form>
		<form method="post">
			<?php 
			if( isset($_POST['deluser'])){
				$id = trim($_POST['deluser']);
				$sql = "DELETE FROM mvn_users WHERE id=?";
				
				$stmt= $conn->prepare($sql);
				$stmt->execute([$id]);
				$count = $stmt->rowCount();
				if ($count > 0 )
				{
					header('Location: index.php');
				}
			}
			
			?>
		<button type="submit"  name="deluser" class="btn btn-primary" value='<?php echo $row['id']; ?>'>Delete this user</button>
		</form>
	</div>
</body>
</html>
