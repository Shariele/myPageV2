<!--Navigation Menu-->

<?php
include "classes/User.php";
session_start();
session_name("my_blogger");


include "include/functions.php";

$logged_in_user = 0;
if(isset($_SESSION['user'])){
    $logged_in_user = $_SESSION['user'];
    echo check_user_id();
}
$page = 0;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
$blog_id = 0;
if(isset($_GET['blog_id'])){
    $blog_id = $_GET['blog_id'];
}

?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="img/favicon.png">


<!-- Bootstrap core CSS -->
<link href="lib/css/bootstrap.min.css" rel="stylesheet">
<!--Behövs för att använda glyphicons -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
<link href="include/style.css" rel="stylesheet">

<?php
if(isset($_SESSION['user'])){
  switch ($page) {
      case 'home':
          ?>
          <div class="header-nav">
              <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="startpage.php?page=home">Home</a></li>
                      <li><a href="about.php?page=about">About</a></li>
                      <li><a href="create_blog.php?page=create_blog">Create blog</a></li>
                      <li><a href="user_blogs.php?page=my_account">My account</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <?php
                      echo "<li><a href=\"actions_index.php?action=log_me_out&log_out=1\">
                      <span class=\"glyphicon glyphicon-log-out\"></span>Log Out</a></li>";
                      ?> 
                      </li>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
          </div>
          <?php
      break;

      case 'about':
          ?>
          <div class="header-nav">
              <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href="startpage.php?page=home">Home</a></li>
                      <li class="active"><a href="about.php?page=about">About</a></li>
                      <li><a href="create_blog.php?page=create_blog">Create blog</a></li>
                      <li><a href="user_blogs.php?page=my_account">My account</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <?php
                      echo "<li><a href=\"actions_index.php?action=log_me_out&log_out=1\">
                      <span class=\"glyphicon glyphicon-log-out\"></span>Log Out</a></li>";
                      ?> 
                      </li>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
          </div>
          <?php
      break;
      case 'create_blog':
          ?>
          <div class="header-nav">
              <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href="startpage.php?page=home">Home</a></li>
                      <li><a href="about.php?page=about">About</a></li>
                      <li class="active"><a href="create_blog.php?page=create_blog">Create blog</a></li>
                      <li><a href="user_blogs.php?page=my_account">My account</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <?php
                      echo "<li><a href=\"actions_index.php?action=log_me_out&log_out=1\">
                      <span class=\"glyphicon glyphicon-log-out\"></span>Log Out</a></li>";
                      ?> 
                      </li>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
          </div>
          <?php
      break;

      case 'my_account':
          ?>
          <div class="header-nav">
              <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href="startpage.php?page=home">Home</a></li>
                      <li><a href="about.php?page=about">About</a></li>
                      <li><a href="create_blog.php?page=create_blog">Create blog</a></li>
                      <li class="active"><a href="user_blogs.php?page=my_account">My account</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <?php
                      echo "<li><a href=\"actions_index.php?action=log_me_out&log_out=1\">
                      <span class=\"glyphicon glyphicon-log-out\"></span>Log Out</a></li>";
                      ?> 
                      </li>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
          </div>
          <?php
      break;

      default:
      ?>
      <ul class="nav nav-pills navbar-inverse navbar-fixed-top min-width-header">
          <li><a href="startpage.php?page=home">Home</a></li>
          <li><a href="about.php?page=about">About</a></li>
          <li><a href="create_blog.php?page=create_blog">Create blog</a></li>
          <li class="active"><a href="user_blogs.php?page=my_account">My account</a></li>
          <form class="navbar-form navbar-right log-out" role="form" method="post" action="actions_index.php?action=log_me_out" name="sign_in">
              <?php
              $string = nl2br(htmlspecialchars($logged_in_user));
              echo "<li>Welcome  $string <a href=\"actions_index.php?action=log_me_out&log_out=1\">
              <span class=\"glyphicon glyphicon-log-out\"></span>Log Out</a></li>";
              ?>  
          </form>
      </ul>
      <?php
      break;
      
  } ?>
<?php
//Om inte inloggad:
}else{
?>
<?php switch ($page) {
case 'home':
  ?>
  <div class="header-nav">
      <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="startpage.php?page=home">Home</a></li>
              <li><a href="about.php?page=about">About</a></li>
              <li><a href="register.php?page=register">Register</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login<span class="caret"></span></a>
                <ul class="dropdown-menu login" role="menu">
                  <form action="actions_index.php?action=check_login" class="form-inline" method="post" name="sign_in">
                          <fieldset>
                              <legend></legend>
                              <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Username" name="username" required>
                              </div>
                              <br />
                              <div class="form-group">
                                  <input type="password" class="form-control" placeholder="Password" name="password" required>
                              </div>
                              <div class="form-group">
                                  <button type="submit" class="btn btn-default">Log in</button>
                              </div>
                          </fieldset>
                      </form>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
  </div>
          <?php
      break;

      case 'about':
          ?>
          <div class="header-nav">
              <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href="startpage.php?page=home">Home</a></li>
                      <li class="active"><a href="about.php?page=about">About</a></li>
                      <li><a href="register.php?page=register">Register</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login<span class="caret"></span></a>
                        <ul class="dropdown-menu login" role="menu">
                          <form action="actions_index.php?action=check_login" class="form-inline" method="post" name="sign_in">
                                  <fieldset>
                                      <legend></legend>
                                      <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Username" name="username" required>
                                      </div>
                                      <br />
                                      <div class="form-group">
                                          <input type="password" class="form-control" placeholder="Password" name="password" required>
                                      </div>
                                      <div class="form-group">
                                          <button type="submit" class="btn btn-default">Log in</button>
                                      </div>
                                  </fieldset>
                              </form>
                        </ul>
                      </li>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
          </div>
          <?php
      break;
      case 'register':
          ?>
          <div class="header-nav">
              <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li><a href="startpage.php?page=home">Home</a></li>
                      <li><a href="about.php?page=about">About</a></li>
                      <li class="active"><a href="register.php?page=register">Register</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Login<span class="caret"></span></a>
                        <ul class="dropdown-menu login" role="menu">
                          <form action="actions_index.php?action=check_login" class="form-inline" method="post" name="sign_in">
                                  <fieldset>
                                      <legend></legend>
                                      <div class="form-group">
                                          <input type="text" class="form-control" placeholder="Username" name="username" required>
                                      </div>
                                      <br />
                                      <div class="form-group">
                                          <input type="password" class="form-control" placeholder="Password" name="password" required>
                                      </div>
                                      <div class="form-group">
                                          <button type="submit" class="btn btn-default">Log in</button>
                                      </div>
                                  </fieldset>
                              </form>
                        </ul>
                      </li>
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
              </nav>
          </div>
          <?php
      break;
      
  }
}
?>
<?php
if($blog_id != 0 || '0'){

  $array = get_blog_preferences($blog_id);

  $logo = $array[2];

  if(!empty($logo)){
    ?>
    <div class="container" style="max-width: 1170px;">
      <div class="row">
        <?php echo "<a href=\"startpage.php?page=home\"><img src=\"$logo\" width=\"100%\" ></a>"; ?>
      </div>
    </div>
    <?php
  }
}else{
  ?>
  <div class="container" style="max-height: 100px;" style="max-width: 1170px;">
    <div class="row">
        <a href="startpage.php?page=home"><img src="img/logga_simon.png" width="100%"></a>
    </div>
</div>
  <?php
}
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="lib/js/bootstrap.min.js"></script>