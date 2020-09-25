<?php 
	
	//$connection = mysqli_connect(dbserver,dbuser,dbpassword,dbname);

	//database eka connect karaddi api refer karana variable name eka -> $connection kiyana variable name eka
	$servername = "localhost";
	$username ="root";
	$password = "";
	$dbname = "user";

	$connection = mysqli_connect($servername,$username,$password,$dbname);

	/*database eka connect wunada kiyala balanna use karanawa function ekk -> mysqli_connect_errono() saha e error eka balaganna use
	karanawa function ekk mysqli_connect_error()	*/

	//checking the connection
	if (mysqli_connect_error()) {
		die("Connection error ".mysqli_connect_error());
	}
	//else{
	//	echo "Connection Succesfull..";
	//}

	//api me dapu connection code eka database ekat ekka connect wena hama page ekakama udinma enna one, meka comman nisa include ekk widiyata api use karanna pluwan.
	//eta passe e page eke awasane connection eka close karannat one, mysqli_close($connection); atule denne var name eka.

 ?>