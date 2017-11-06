<?php

function changePagePhp(){
	$pageChoice = $_REQUEST['c'];

	switch ($pageChoice) {
		//Main pages
		case 'mainPage':
			include "main.php";
			// include "footer.php";
		break;

		case 'projects':
			include "projects.php";
			// include "footer.php";
		break;

		case 'myCv':
			include "myCv.php";
			// include "footer.php";
		break;

		case 'wordpressPlugin':
			include "wordpressPlugin.php";
			// include "footer.php";
		break;

		case 'webshop':
			include "webshop.php";
			// include "footer.php";
		break;

		case 'blog':
			include "blog.php";
			// include "footer.php";
		break;

		case 'pokemonKarlstad':
			include "pokemonKarlstad.php";
			// include "footer.php";
		break;

		case 'yatzy':
			include "yatzy.php";
			// include "footer.php";
		break;

		case 'memory':
			include "memory.php";
			// include "footer.php";
		break;

		case 'breakout':
			include "breakout.php";
			// include "footer.php";
		break;

		default:
			include "404.php";
			break;
	}
}
?>