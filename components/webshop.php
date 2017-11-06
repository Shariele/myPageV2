<div class="container"> 
	<div class="row">
		<div class="col-md-2">
			<i style="font-size: 200px;" class="fa fa-angle-double-left" aria-hidden="true"></i>
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="col-md-2">
					<Strong><p class="text-left"><button id="projects" style="border-color: white;" class="btn btn btn-default btn-s"> Tillbaka </button></p></strong>
				</div>
				<div class="col-md-8">
					<p><h2><center>Webshop</center></h2></p>
					<br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">	
					<p>Mitt andra och stora projekt under min tid på Gymnasieingenjörsutbildningen, en webbshop, här drog jag stor nytta av mina nya kunskaper med Javascript och jQuery till skillnad från Bloggen.
					Jag använde mig även för första gången av Ajax för vissa delar av sidan.</p>

					<p><strong>Programspråk vilka användes:</strong> HTML, CSS, PHP, Javasript & jQuery(är ju dock ett bibliotek till Javascript)</p>
					<p><strong>Ramverk:</strong> Bootstrap</p>
				</div>
				<div class="col-md-4">
					<center><a href="webshop/index.php" target="_blank">Länk till sidan</a></center>
					<center><a href="webshop/index.php" target="_blank"><img src="img/webshop1.png" style="max-width: 350px; max-height: 400px; background-size: 100% 100%" class="img-rounded" alt=""></a></center>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#projects").on('click', function(e) {
	      e.preventDefault();

	      changePageJs($(this).attr('id'));

	    });
	});
</script>