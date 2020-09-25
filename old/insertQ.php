<?php include_once('inc/connection.php'); ?>
<?php 
	
	$first_name ="Deepthika";
	$last_name ="Namali";
	$email ="namali@gmail.comp";
	$password ="Deepthika";
	$is_deleted =0;

	$hashed_password =sha1($password);

	$query ="INSERT INTO user(first_name,last_name,email,password,is_deleted)
			 VALUES('{$first_name}','{$last_name}','{$email}','{$hashed_password}',{$is_deleted})";

	$result =mysqli_query($connection,$query); 
	//mekata parameters dekak use wenawa ekk connection eka anika data inseet karapu query eka
	//table eke data okkoma delete karanna one wunama yanna ->operations ->truncate-> 

	if($result){
		echo "1 Record added succesfully";
	}else {
		echo "DB query added failed";
	}
	
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert Quuery</title>
</head>
<body>
	
</body>
</html>

<?php mysqli_close($connection); // $connection kiyanne var name eka connection ekata gattu. ?>
