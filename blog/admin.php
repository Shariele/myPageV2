<html>
<title>Admin's page</title>
<head>
<?php

require "include/connect_db.php";
include "include/header.php";
include "include/log.php";

if(!isset($_SESSION['user'])) {
  header("location: startpage.php");
}

if($_SESSION['user']->Get_type() != "Admin"){
    header("location: startpage.php");
}

?>
</head>
<body>
  <div class="container">
    <div class="col-md-12">
      	<div class="row">
	        <div class="col-md-3 col-md-offset-5">
	        	<h1><strong>Admin's page</strong></h1>
	        </div>
      	</div>
        <div class="row">
    			<div class="btn-group col-md-4">
    				<form method="post" action="#">
    					<input type="hidden" name="action" value="filter">
    					<button type="submit" name="filter" value="users" class="btn btn-default btn-xs">Users</button>
    					<button type="submit" name="filter" value="blogs" class="btn btn-default btn-xs">Blogs</button>
    				</form>
    			</div>
        </div>
        <?php
        $action = 0;
        if(isset($_POST['filter'])){
          $action = $_POST['filter'];
        }?>
        
        <p><?php if(isset($_SESSION['wrong'])){
          echo '<font color="red">' . $_SESSION['wrong'] . '</font>';
          unset($_SESSION['wrong']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['deactivated'])){
          echo '<font color="green">' . $_SESSION['deactivated'] . '</font>';
          unset($_SESSION['deactivated']);
        }
        ?></p>
        <?php
        echo admin_tools($action)
        ?>
        
        </div>
    </div>
  </div>
</body>
</html>