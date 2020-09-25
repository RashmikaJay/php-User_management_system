<?php include_once('inc/connection.php') ?>
	
<?php 
	
	$first_name ="Chandima";
	$last_name = "Sampath";
	$email 	= "chandii@gmail.com";
	$password = "chandii";
	$is_deleted =1;

	$hashed_password = sha1($password);

	$query = "INSERT INTO user(first_name,last_name,email,password,is_deleted)
			  VALUES ('{$first_name}','{$last_name}','{$email}','{$hashed_password}', {$is_deleted}) ";

	$result_set = mysqli_query($connection,$query);
	if($result_set){
		echo "1 record added succesfully";
	}else{
		echo "Query added failed";
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert Query</title>
</head>
<body>
	
</body>
</html>
<?php mysqli_close($connection) ?>