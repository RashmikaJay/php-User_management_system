<?php include_once('inc/connection.php'); ?>
<?php include_once('inc/functions.php'); ?>
<?php session_start(); ?>

<?php 
	
	//check for form submission
	if (isset($_POST['submit'])) {
			
			$errors =array();

		//check if the username and password has been entered.
		if(!isset($_POST['email']) || strlen(trim($_POST['email'])) <1){
			//display error, for that we have to pass an array
			$errors[]= 'Invalid Username or Missing Username';
		}
		else if(!isset($_POST['password']) || strlen(trim($_POST['password'])) <1){
			//display error
			$errors[] ='Invalid Password or Missing Password';
		}

		//check if there are any errors in the form
		else if(empty($errors)){
			//save username and password into variables
			//db ekata damage ekk karanna script ekk liyanna pluwan eka nawatanna tama real_escape_string func eka use ganne
			$email = mysqli_real_escape_string($connection, $_POST['email']);
			$password =mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password =sha1($password);

			//prepare database query
			$query = "SELECT *FROM user
					  WHERE email ='{$email}'
					  AND password = '{$hashed_password}' ";
			$result_set =mysqli_query($connection, $query);

				//check query work succesfully
				if($result_set){
						if(mysqli_num_rows($result_set)==1){
							//valid username and password
							//redirect wenna one file eka,location eka deddi Location: space redirect wenna one file eka
							$new = mysqli_fetch_assoc($result_set); //associative array ekak
							$_SESSION['user_id'] = $new['id']; //methana id kiyanne table eke id eka
							$_SESSION['first_name'] = $new['first_name']; 

							//updating last login, NOW() karanne current date and time return karana eka
							$query2 = "UPDATE user SET  last_login =NOW() WHERE id= {$_SESSION['user_id']} ";
							$result2 =mysqli_query($connection,$query2);

							if(!$result2){
								die("Database Failed");
							}
							header('Location: users.php'); 
					}else {
						//invalid username and password
						$errors[] = 'Invalid Username and Password';
					}
				}else {
					$errors[] = 'Database Query failed.';
				}
		}
	}
	
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LogIn User Management System </title>
	<link rel="stylesheet" href="css/abc.css">
</head>
<body>
	<div class="login">
		<form action="index.php" method="post">
			<fieldset>
				<legend> <h1>  Log In	</h1></legend>

				<?php 
					if(isset($errors) && !empty($errors)){
						echo '<p class="error">Invalid Username or Password </p>';
					}
				?>
				<?php 
					if(isset($_GET['logout'])){
						echo '<p class="info"> You have Succesfullu Logout ! </p>';
					}

				 ?>

				<p>
					<label for="">Username</label>
					<input type="text" name="email" id="" placeholder="Email Address">
				</p>

				<p>
					<label for="">Password</label>
					<input type="password" name="password" id="" placeholder="Password">
				</p>

				<p>
					<button type="submit" name="submit">Login</button>
				</p>
			</fieldset>
		</form>
	</div>
</body>
</html>

<?php mysqli_close($connection); // $connection kiyanne var name eka connection ekata gattu. ?>
