<body>
	<div class="container"> 
		<div class="row">
			<div class="col-md-2">
				<Strong><p class="text-left"><button id="projects" style="border-color: white;" class="btn btn btn-default btn-s"> Tillbaka </button></p></strong>
			</div>
			<div class="col-md-8">
				<p><h2><center>PokémonKarlstad</center></h2></p>
				<br>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">	
				<p>PokémonKarlstad är en sida jag skapade tillsammans med en kompis strax efter att Pokémon GO hade släpps vilket gör den till mitt senaste projekt. Tanken med sidan var att skapa en informationsplats där folk som spelade spelet i Karlstads kunde gå in och dela med sig av information, därav själva forumsdelen.</p>
				<p>Projektet kom dock aldrig till en liveversion och förblir ett gammalt projekt.</p>
				<p><strong>Programspråk vilka användes:</strong> HTML, CSS, PHP, Javasript & jQuery(är ju dock ett bibliotek till Javascript)</p>
			</div>
			<div class="col-md-4">
				<center><a href="pokemonKarlstad/index.php">Länk till sidan</a></center>
				<center><a href="pokemonKarlstad/index.php" target="_blank"><img src="img/pokemonkarlstad1.png" style="max-width: 350px; max-height: 400px; background-size: 100% 100%" class="img-rounded" alt=""></a></center>
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