<div id="projects-content" class="projects-content">
	<div class="container projectMenu">
		<div class="row">
			<div class=" col-md-12">
				<p><center><h1>Mina projekt</h1></center></p>
			</div>
		</div>
		<div class="row">
			<div style="color: grey;" class="col-md-12">
				<p><center><h3>Webb</h3></center></p>
			</div>
		</div>
		<div style="margin-top: 20px" class="row">
			<div class=" col-md-3">
				<div class="row">
					<div class="projectImg col-md-12">
						<center><img src="img/webshop1.png" id="webshop" class="img-circle" alt=""></center>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<center><p><center><h4>Webbshop</h4></center></p></center>
					</div>
				</div>
			</div>
			<div class=" col-md-3">
				<div class="row">
					<div class="projectImg col-md-12">
						<center><img src="img/blog1.png" id="blog" class="img-circle" alt=""></center>
					</div>
				</div>
				<div class="row">
					<div class="projectImg col-md-12">
						<center><p><center><h4>Blogg</h4></center></p></center>
					</div>
				</div>
			</div>
			<div class=" col-md-3">
				<div class="row">
					<div class="projectImg col-md-12">
						<center><img src="img/effectsLibrary3.png" class="projectImg img-circle" id="wordpressPlugin" alt=""></center>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<center><p><center><h4>Wordpress plugin</h4></center></p></center>
					</div>
				</div>
			</div>
			<div class=" col-md-3">
				<div class="row">
					<div class="projectImg col-md-12">
						<center><img src="img/pokemonkarlstad1.png" id="pokemonKarlstad" class="img-circle" alt=""></center>
					</div>
				</div>
				<div class="row">
					<div class="projectImg col-md-12">
						<center><p><center><h4>PokémonKarlstad</h4></center></p></center>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div style="color: grey;" class="col-md-12">
				<p><center><h3>Applikationer</h3></center></p>
			</div>
		</div>
		<div style="margin-top: 20px" class="row">
			<div class="col-md-4">
				<div class="row">
					<div class="projectImg col-md-12">
						<center><img src="img/breakout.png" id="breakout" class="img-circle" alt=""></center>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<center><p><center><h4>Breakoutspel</h4></center></p></center>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="projectImg col-md-12">
						<center><img src="img/yatzy.png" id="yatzy" class="img-circle" alt=""></center>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<center><p><center><h4>Yatzy</h4></center></p></center>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="projectImg col-md-12">
						<center><img src="img/memory.png" id="memory" class="img-circle" alt=""></center>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<center><p><center><h4>Memory</h4></center></p></center>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div class="projects-content-overlay">
	<div class="row">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-9" id="projects-content-overlay"></div>
	</div> 
</div>-->


<script type="text/javascript">

	function projectPressed(){
		
		$(".projectMenu").css('width', '0%');
		console.log("works");
		// $(".projects-content-overlay").css('width', '90%');        
    }
	$(document).ready(function(){

		$("#wordpressPlugin").one('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));
	      projectPressed();
	    });

	    $("#webshop").one('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));
	      projectPressed();
	    });

	    $("#blog").one('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));
	      projectPressed();
	    });

	    $("#pokemonKarlstad").one('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));
	      projectPressed();
	    });

	    $("#yatzy").one('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));
	      projectPressed();
	    });

	    $("#memory").one('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));
	      projectPressed();
	    });

	    $("#breakout").one('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));
	      projectPressed();
	    });
	}); 
</script>