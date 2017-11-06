<body>
	<div class="container"> 
		<div class="row">
			<div class="col-md-2">
				<Strong><p class="text-left"><button id="projects" style="border-color: white;" class="btn btn btn-default btn-s"> Tillbaka </button></p></strong>
			</div>
			<div class="col-md-8">
				<p><h2><center>Breakout spel</center></h2></p>
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">	
				<p>Mer kommer inom kort!</p>
				<p><strong>Programspråk vilka användes:</strong> Java</p>
				<a href="programs/breakout.zip">Nedladdningslänk:</a>
			</div>
			<div class="col-md-4">
				<center><a href="img/breakout.png" target="_blank"><img src="img/breakout.png" style="max-width: 350px; max-height: 400px; background-size: 100% 100%" class="img-rounded" alt=""></a></center>
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