<!--Index/Home page. -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CV - Rasmus</title>
	<?php 
	include "include/necessities.php";
	include "components/header.php";
	 ?>
</head>
<body>
	<div id="indexPageContainer">
		<div id="about" class="about"><div class="parallax2"><?php include "components/about.php"; ?></div></div>
		<div id ="projects" class="projects"><div class="parallax1"><?php include "components/projects.php"; ?></div></div>
		<div id ="cv" class="cv"><div class="parallax3"><?php include "components/myCv.php"; ?></div></div>
	</div>
</body>

<footer><div class="footer"><?php include "components/footer.php"; ?></div></footer>
</html>

