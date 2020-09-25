<?php include_once('inc/connection.php'); ?>
<?php 
	
	/*  DELETE FROM table_name 
		WHERE id =1
		LIMIT 1
	*/
		$query = "DELETE FROM  user 
				  WHERE id =3 
				  LIMIT 1";

		//mysqli_affected_rows() returns number of updated rows, **parameter eka atule denne db eke connection eka**

		$result_set =mysqli_query($connection,$query);
		if ($result_set) {
			echo mysqli_affected_rows($connection). "Rows Deleted <br>";
		}else {
			echo "DB Deleted failed.";
		}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Delete Query</title>
</head>
<body>
	
</body>
</html>

<?php mysqli_close($connection); // $connection kiyanne var name eka connection ekata gattu. ?>
