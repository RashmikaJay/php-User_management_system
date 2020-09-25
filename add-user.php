<?php include_once('inc/connection.php'); ?>
<?php include_once('inc/functions.php'); 
	session_start();
	
	//checking if user is logged in.
	if(!isset($_SESSION['first_name'])){
		header('Location: index.php');//session eka set karala natnm automatically aye index page ekata yanawa.
	}
?>

<?php 

	$errors = array();
	$first_name = '';
	$last_name= '';
	$email= '';
	$password= '';

	if(isset($_POST['submit'])){

		$first_name =$_POST['first_name'];
		$last_name= $_POST['last_name'];
		$email=$_POST['email'];
		$password=$_POST['password'];

		//check wheher fields are entered
		$req_fields = array('first_name','last_name','email','password');

		foreach ($req_fields as $fields) {
			if((empty(trim($_POST[$fields])))){
			$errors[] = $fields.' is required';
			}
		}

		//checking maximum length,api mekata associative array ekk use karanawa.
		$maximum_length = array('first_name'=>50,'last_name'=>100, 'email'=>20, 'password'=>40);
		foreach ($maximum_length as $fields => $length) {
			if (strlen(trim($_POST[$fields])) > $length) {
				$errors[] = $fields."  reach maximum length ".$length;
			}
		}

		//check email address is already exists.
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$query_email = "SELECT * FROM user WHERE email='{$email}'";

		$result_set =mysqli_query($connection,$query_email);

		if ($result_set) {
			if (mysqli_num_rows($result_set)) {
				$errors[] ="You have enetered email address is already exists";
			}
		}

		if(empty($errors)){
		//add new user
			$first_name = mysqli_real_escape_string($connection,$_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection,$_POST['last_name']);
			$password = mysqli_real_escape_string($connection,$_POST['password']);
			//email address is already exists.

			$hashed_password = sha1($password);

			$query_new = "INSERT INTO user (first_name,last_name,email,password,is_deleted) 
						 VALUES('{$first_name}', '{$last_name}', '{$email}','{$hashed_password}', 0) ";

			$result_new = mysqli_query($connection,$query_new);

			if($result_new){
				//redirect to the new users list
				header('Location: users.php?added_new_user');
			}else{
				$errors[] ='Insert query added failed';
			}
		}

	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add-User</title>
	<link rel="stylesheet" href="css/abc.css">
</head>
<body>
	<header>
		<div class="appname"> User Management System </div>
		<div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a> </div>
	</header>

	<main>
		<h1> Users <span> <a href="users.php"> < Back to User List </a> </span> </h1>

		<?php 
			if(!empty($errors)){
				display_error($errors);
			}
		 ?>

		<form action="add-user.php" method="post" class="userform">
			<p>
				<label for="">First Name:</label>
				<input type="text" name="first_name" <?php echo "value = {$first_name}"; ?>>
			</p>
			<p>
				<label for="">Last Name:</label>
				<input type="text" name="last_name" <?php echo "value = {$last_name}"; ?>>
			</p>
			<p>
				<label for="">Email Address:</label>
				<input type="email" name="email" <?php echo "value = {$email}"; ?>>
			</p>
			<p>
				<label for="">Password:</label>
				<input type="password" name="password">
			</p>
			<p>
				<label for="">&nbsp</label> <!--&nbsp => space bar ekk wage tama non breaking space--> 
				<button type="submit" name="submit">Save</button>
			</p>
		</form>
		
	</main>
		
</body>
</html>
<?php mysqli_close($connection) ?>