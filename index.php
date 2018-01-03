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
	<div id="modalHandler"></div>
	<div id="indexPageContainer">
		<div id="about" class="about"><div class="parallax2"><?php include "components/about.php"; ?></div></div>
		<div id ="projects" class="projects"><div class="parallax1"><?php include "components/projects.php"; ?></div></div>
		<div id ="cv" class="cv"><div class="parallax3"><?php include "components/myCv.php"; ?></div></div>
	</div>
</body>
<footer><div class="footer"><?php include "components/footer.php"; ?></div></footer>
</html>



<!-- Modal -->
<div class="modal fade" id="welcomeModal" tabindex="-1" role="dialog" aria-labelledby="welcomeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content welcomeModalContent">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Hej och välkommen!</h4>
      </div>
      <div class="modal-body">
        <p>Ser du hellre en Github-profil än en webbsida?</p>
        <p><a href="https://github.com/Shariele" target="_blank"><i class="fa fa-github" aria-hidden="true"></i> Mot Github!</a></p>
		<p>Vill du inte besöka sidan nu finns länken längst ned på sidan.</p>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(window).on('load',function(){
        $('#welcomeModal').modal('show');
    });
</script>
