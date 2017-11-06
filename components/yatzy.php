<body>
	<div class="container"> 
		<div class="row">
			<div class="col-md-2">
				<Strong><p class="text-left"><button id="projects" style="border-color: white;" class="btn btn btn-default btn-s"> Tillbaka </button></p></strong>
			</div>
			<div class="col-md-8">
				<p><h2><center>Yatzy</center></h2></p>
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">	
				<p>Ett spel jag skapade på gymnasiet när jag började programmera, ett projekt som har några år på nacken men tar med det ändå.</p>
				<p>Finns någon enstaka bugg men annars ett stabilt program.</p>

				<p><strong>Programspråk vilka användes:</strong> C++</p>
				<a href="programs/Yatzy.zip">Nedladdningslänk:</a>
			</div>
			<div class="col-md-4">
				<center><a href="img/yatzy.png" target="_blank"><img src="img/yatzy.png" style="max-width: 350px; max-height: 400px; background-size: 100% 100%" class="img-rounded" alt=""></a></center>
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

