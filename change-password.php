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
	$user_id ='';
	$first_name = '';
	$last_name= '';
	$email= '';
	$password= '';

	//user gawa tiyana edit eke parameter ekak ganna one eka ganne $_GET eken
	if (isset($_GET['user_id'])) {
		//getting the user information
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
		$query_get = "SELECT * FROM user WHERE id= {$user_id} LIMIT 1";

		$result_get = mysqli_query($connection,$query_get);
		if ($result_get) {
			if(mysqli_num_rows($result_get) ==1 ){
				//user found
				$final_result =mysqli_fetch_assoc($result_get);
				$first_name = $final_result['first_name'];
				$last_name= $final_result['last_name'];
				$email= $final_result['email'];

			}else {
				//user not found
				header('Location: users.php?query_failed?user_not_found');
			}
		}else {
			//redirect to the users page
			header('Location: users.php?query_failed');
		}
	}

	if(isset($_POST['submit'])){

		$user_id =$_POST['user_id'];
		$password =$_POST['password'];
		
		
		//checking whether fields are entered
		$req_fields = array('user_id','password');

		foreach ($req_fields as $fields) {
			if((empty(trim($_POST[$fields])))){
			$errors[] = $fields.' is required';
			}
		}

		//checking maximum length,api mekata associative array ekk use karanawa.
		$maximum_length = array('password'=>40);
		foreach ($maximum_length as $fields => $length) {
			if (strlen(trim($_POST[$fields])) > $length) {
				$errors[] = $fields."  reach maximum length ".$length;
			}
		}

		if(empty($errors)){
			//add new user
			$password = mysqli_real_escape_string($connection,$_POST['password']);
			$hashed_password = sha1($password);
			//email address is already exists.

			$query_new = " UPDATE user SET password ='{$hashed_password}' WHERE id ={$user_id}";

			$result_new = mysqli_query($connection,$query_new);

			if($result_new){
				//redirect to the new users list
				header('Location: users.php?modify_user=true');
			}else{
				$errors[] ='Update Password query added failed';
			}
		}

	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>modify-User</title>
	<link rel="stylesheet" href="css/abc.css">
</head>
<body>
	<header>
		<div class="appname"> User Management System </div>
		<div class="loggedin"> Welcome <?php echo $_SESSION['first_name']; ?>! <a href="logout.php">Log Out</a> </div>
	</header>

	<main>
		<h1> Change Password <span> <a href="users.php"> < Back to User List </a> </span> </h1>

		<?php 
			if(!empty($errors)){
				display_error($errors);
			}
		 ?>

		<form action="change-password.php" method="post" class="userform">
			<p>
				<input type="hidden" name="user_id" value=" <?php echo $user_id; ?> " >
				<label for="">First Name:</label>
				<input type="text" name="first_name" <?php echo "value = {$first_name}"; ?> disabled>
			</p>
			<p>
				<label for="">Last Name:</label>
				<input type="text" name="last_name" <?php echo "value = {$last_name}"; ?> disabled>
			</p>
			<p>
				<label for="">Email Address:</label>
				<input type="email" name="email"  <?php echo "value = {$email}"; ?> disabled>
			</p>
			<p>
				<label for="">New Password:</label>
				<input type="password" name="password" id="password">
			</p>
			<p>
				<label for="">Show Password:</label>
				<input type="checkbox" name="showpassword" id="showpassword" style="width: 20px; height: 20px;">
			</p>
			<p>
				<label for="">&nbsp</label> <!--&nbsp => space bar ekk wage tama non breaking space--> 
				<button type="submit" name="submit">Update Password</button>
			</p>
		</form>
		
	</main>
		
		<script src="js/jquery.js"></script>
		<script>
			$(document).ready(function(){
				$('#showpassword').click(function(){
					if ($("#showpassword").is(':checked')) {
						$("#password").attr('type',"text");
					}else {
						$("#password").attr("type","password");
					}
				})
			});
		</script>
</body>
</html>
<?php mysqli_close($connection) ?>