<?php include_once('inc/connection.php'); ?>
<?php include_once('inc/functions.php'); ?>
<?php session_start(); 
	


	$user_list = '';
	$query = "SELECT * FROM user WHERE is_deleted=0 ORDER BY first_name ";

	//database eke api gattu records okkoma tiyana variable eka
	$users = mysqli_query($connection,$query);

	//api check karagamu query eka succesfull da kiyala
		verify_query($users); //inc/functions eke hadla tiyanawaa
		while ($record=mysqli_fetch_assoc($users)) {
			$user_list .= "<tr>";
			$user_list .= "<td> {$record['first_name']} </td>";
			$user_list .= "<td> {$record['last_name']} </td>";
			$user_list .= "<td> {$record['last_login']} </td>";
			$user_list .= "<td> <a href=\"modify-user.php?user_id={$record['id']}\"> Edit </a> </td>";
			$user_list .= "<td> <a href=\"delete-user.php?user_id={$record['id']}\" 
						    onclick=\"return confirm('Are you sure ?')\";> Delete </a> </td>";
			$user_list .= "</tr>";
		}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Users</title>
	<link rel="stylesheet" href="css/abc.css">
</head>
<body>
	<header>
		<div class="appname"> User Management System </div>
		<div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a> </div>
	</header>

	<main>
		<h1> Users <span> <a href="add-user.php">+ Add New </a> </span> </h1>
		<table class="masterlist">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Last Login</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>

		<!--ituru records tika ganna variable ekk pass karanawa.-->	
		<?php echo $user_list; ?>

		</table>
	</main>
		
</body>
</html>
<?php mysqli_close($connection) ?>