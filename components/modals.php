<?php
function changeModalPhp(){
	$modalChoice = $_REQUEST['c'];
	?>

	<!-- Modal -->
	<div class="modal fade" id="projectsModal" tabindex="-1" role="dialog" aria-labelledby="projectsModalLabel">
	  <div class="modal-dialog modal-lg projectsModalContent" role="document">
	    <div class="modal-content welcomeModalContent">
	      <div class="modal-body">
	        <?php
	        	switch ($modalChoice) {
	        		case 'blog':
	        			include "blog.php";
        			break;

        			case 'breakout':
	        			include "breakout.php";
        			break;

        			case 'memory':
	        			include "memory.php";
        			break;

        			case 'pokemonKarlstad':
	        			include "pokemonKarlstad.php";
        			break;

        			case 'webshop':
	        			include "webshop.php";
        			break;

        			case 'wordpressPlugin':
	        			include "wordpressPlugin.php";
        			break;

        			case 'yatzy':
	        			include "yatzy.php";
        			break;

	        		default:
	        			# code...
        			break;
	        	}
	        ?>
	      </div>
	    </div>
	  </div>
	</div>

	<script type="text/javascript">
		// $(window).on('load',function(){
        	$('#projectsModal').modal('show');
					console.log("Works");
    	// });
	</script>
	<?php
}
?>
