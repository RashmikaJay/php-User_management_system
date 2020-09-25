<?php include_once('inc/connection.php'); ?>
<?php 
	
	$query = "SELECT id,first_name,last_name,email FROM user";
	$result_set = mysqli_query($connection,$query);

	if($result_set){
		//cheking how many records returns from the query
		echo mysqli_num_rows($result_set). " records Found <hr>";
		//echo "query Succesful";

		//mysqli_fetch_assoc() -> associative array ekak meke data ganna nm variable eke nama associative array eke key eka widiyata denna one.

		$table = "<table>";
		$table .= "<tr> <th> ID </th> <th> First Name </th> <th> Last Name </th> <th> Email </th> </tr>";

		while($records =mysqli_fetch_assoc($result_set)){
			$table .="<tr>";
			$table .="<td>" .$records['id']. "</td>";
			$table .="<td>" .$records['first_name']. "</td>";
			$table .="<td>" .$records['last_name']. "</td>";
			$table .="<td>" .$records['email']. "</td>";
			$table .= "</tr>";

		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Select Quuery</title>
	<style>
		table {border-collapse: collapse;}
		td,th {border: 1px solid; padding: 5px; }
	</style>
</head>
<body>
	<?php  echo $table; ?> <!--uda hadapu table variable eka body eke echo karanna one.-->
</body>
</html>

<?php mysqli_close($connection); // $connection kiyanne var name eka connection ekata gattu. ?>
