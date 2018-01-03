<!--Page for coordinating all the different Ajax file requests-->

<?php
include "../components/pages.php";
include "../components/modals.php";


// session_start();

//Variabel from java.js för att avgöra vad som ska göras.
$action = $_REQUEST['action'];

switch($action){
	//Changes the page from Ajax comamnds.
	case 'changePage':
		//pages.php
		changePagePhp();
	break;

	case 'changeModal':
		//modals.php
		changeModalPhp();
	break;
}
