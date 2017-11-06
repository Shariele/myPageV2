<body>
	<div class="container"> 
		<div class="row">
			<div class="col-md-2">
				<Strong><p class="text-left"><button id="projects" style="border-color: white;" class="btn btn btn-default btn-s"> Tillbaka </button></p></strong>
			</div>
			<div class="col-md-8">
				<p><h2><center>Blogg</center></h2></p>
				<p><center style="color: grey">My Blogger</center></p>
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">	
				
				<p><strong>Programspråk vilka användes:</strong> HTML, CSS, PHP</p>
				<p><strong>Ramverk:</strong> Bootstrap</p>
			</div>
			<div class="col-md-4">
				<center><a href="blog/index.php" target="_blank">Länk till sidan</a></center>
				<center><a href="blog/index.php" target="_blank"><img src="img/blog1.png" style="max-width: 350px; max-height: 400px; background-size: 100% 100%" class="img-rounded" alt=""></a></center>
			</div>
		</div>
	</div>
</body>

<script type="text/javascript">
	$(document).ready(function(){
		$("#projects").one('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));

	    });
	});
</script>