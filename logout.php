<?php 
	
	//first we have to start session
	session_start();

	//second we have to set the session to an empty array,in here delete all the past session data
	$_SESSION = array();

	//delete the cookie which is related to session
	//so we have to check if the cookie have
	if(isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-86400, '/');
		//setcookie("session_name()", "value", "time()-86400","root folder eka")
	}

	//destroy the session
	session_destroy();

	//after delete the session --> redirect file
	header('Location: index.php?logout=yes');

	//**we can use this for any logout page**
	//browser history eke parana css file eka tiyenne eka alut ekata load wenna gahanna one ctr+shift+r
 ?>