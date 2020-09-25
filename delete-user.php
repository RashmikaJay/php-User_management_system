<?php include_once('inc/connection.php'); ?>
<?php include_once('inc/functions.php'); 
	session_start();

	//checking if user is logged in.
	if(!isset($_SESSION['first_name'])){
		header('Location: index.php');//session eka set karala natnm automatically aye index page ekata yanawa.
	}
?>

<?php 
	//$user_id ='';
	
	//user gawa tiyana edit eke parameter ekak ganna one eka ganne $_GET eken
	if (isset($_GET['user_id'])) {
		//getting the user information
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
		
		//before deleting user we have not to delete current user.
		if( $user_id ==$_SESSION['user_id']){
			//should not delete current user
			header('Location: users.php?cannot_delete_current_user');
		}else {
			$query_get = "UPDATE user SET is_deleted = 1 WHERE id ={$user_id} LIMIT 1";
			$result_get = mysqli_query($connection,$query_get);

			if($result_get){
				header('Location: users.php?msg=user_deleted');
			}else {
				header('Location: users.php?err=user_delete_failed');
			}
		}
	}
?>

	
