<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign up</title>

    <!-- Bootstrap core CSS -->
    <link href="lib/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sign_in.css" rel="stylesheet">

    <?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	include "include/connect_db.php";
  include "include/header.php";
	?>

  </head>

  <body>
    <div class="container">
        <div class="row">
            <form class="form-signin" role="form" action="actions_index.php?action=create_account" method="post" name="create_account">
              <?php
                      if(isset($_SESSION['wrong'])){
                              echo '<font color="red">' . $_SESSION['existing_username'] . '</font>';
                      unset($_SESSION['wrong']);
                      }
                      ?>
                <div class="col-md-4">
                    <h2 class="form-signin-heading">Create account</h2>
                    <input  type="username" class="form-control" placeholder="Username" name="username" required autofocus>
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                    <button class="btn btn-lg btn-primary" type="submit" name="button" value="Registrera" Style="margin-top:10px">Sign up</button>
                </div>
            </form>
        </div>
    </div>

  </body>
</html>