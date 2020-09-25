<?php 
	
	function verify_query($results){
		//
		global $connection;

		if(!$results){
			die('Database Failed :'. mysqli_error($connection));
		}
	}

	function display_error($errors){
		//format and display form errors
		echo "<div class='errmsg'>";
		echo " <b>There were errors in your form, </b> <br>";
		foreach ($errors as $error) {
			$error= ucfirst(str_replace("_", " ", $error));
			echo $error. "<br>";
		}
		echo "</div>";
	}

	
	

 ?>