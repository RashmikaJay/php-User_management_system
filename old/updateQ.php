<?php include_once('inc/connection.php'); ?>
<?php 
	
	/*  UPDATE table_name
		SET column 1 = value 1, column 2 =value 2
		WHERE id =1
		LIMIT 
	*/
		$query = "UPDATE user 
				  SET first_name= 'Namali', last_name = 'Deepthika'
				  WHERE id =5 ";

		//mysqli_affected_rows() returns number of updated rows, **parameter eka atule denne db connection eka**

		$result_set =mysqli_query($connection,$query);
		if ($result_set) {
			echo mysqli_affected_rows($connection). "Rows updated <br>";
		}else {
			echo "DB updated failed.";
		}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Update Query</title>
</head>
<body>
	
</body>
</html>

<?php mysqli_close($connection); // $connection kiyanne var name eka connection ekata gattu. ?>
