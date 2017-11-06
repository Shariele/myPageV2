<html>
<title>Options</title>
<head>
<?php

require "include/connect_db.php";
include "include/header.php";
include "include/log.php";

?>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-md-3 col-md-offset-4">
        <h2><p class="text-center"><strong>Settings</strong></p></h2>
      </div>
      <?php if($_SESSION['user']->Get_id() == '1' && $_SESSION['user']->Get_type() == "Admin"){
        ?>
        <form class="form-settings" role="form" action="admin.php?page=my_account" method="post">
          <div class="col-md-2 col-md-offset-3" style="margin-left:200px">
            <button name="admin_page" class="btn btn-primary btn-xs">Admin's page</button>
          </div>
        </form>
        <?php
      } ?>
    </div>
    <form class="form-settings" role="form" action="actions_index.php?action=settings&page=my_account" method="post" name="settings">
    <div class="row">
      <div class="col-md-3 col-md-offset-2">
        <h4><p class="text-center"><strong>User settings</strong></p></h4>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-10">
        <p><?php if(isset($_SESSION['existing_username'])){
          echo '<font color="red">' . $_SESSION['existing_username'] . '</font>';
          unset($_SESSION['wrong']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['changed_username'])){
          echo '<font color="green">' . $_SESSION['changed_username'] . '</font>';
          unset($_SESSION['changed_username']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['changed_password'])){
          echo '<font color="green">' . $_SESSION['changed_password'] . '</font>';
          unset($_SESSION['changed_password']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['changed_description'])){
          echo '<font color="green">' . $_SESSION['changed_description'] . '</font>';
          unset($_SESSION['changed_description']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['changed_user_picture'])){
          echo '<font color="green">' . $_SESSION['changed_user_picture'] . '</font>';
          unset($_SESSION['changed_user_picture']);
        }
        ?></p>

        <!--Username-->
        <label for="input_current_username" class="col-sm-1 control-label">Current username</label>
        <div class="col-sm-3">
          <input type="username" class="form-control" id="input_current_username" placeholder="Current username" name="current_username">
        </div>

        <label for="input_username" class="col-sm-1 control-label">New username</label>
        <div class="col-sm-3">
          <input type="username" class="form-control" id="input_username" placeholder="New username" name="new_username">
        </div>
      </div>
    </div>
    <!--Password -->
    <div class="row">
      <div class="col-sm-10">
        <label for="input_current_password" class="col-sm-1 control-label">Current Password</label>
        <div class="col-sm-3">
          <input type="password" class="form-control" id="input_current_password" placeholder="Current password" name="current_password">
        </div>

        <label for="input_password" class="col-sm-1 control-label">New password</label>
        <div class="col-sm-3">
          <input type="password" class="form-control" id="input_password" placeholder="New password" name="new_password">
        </div>
      </div>
    </div>
    <!--Email -->
    <div class="row">
      <div class="col-sm-10">
        <label for="input_current_email" class="col-sm-1 control-label">Current email</label>
        <div class="col-sm-3">
          <input type="email" class="form-control" id="input_current_email" placeholder="Current email" name="current_email">
        </div>
        <label for="input_email" class="col-sm-1 control-label">New email</label>
        <div class="col-sm-3">
          <input type="email" class="form-control" id="input_email" placeholder="New email" name="new_email">
        </div>
      </div>
    </div>
    <!--Profile picture-->
    <div class="row">
      <div class="col-sm-10">
        <label for="input_current_email" class="col-sm-3 control-label">Change profile picture:</label>
        <div class="col-sm-3 col-md-offset-2">
          <input type="url" class="form-control" id="input_picture" placeholder="Paste image url here" name="change_picture">
        </div>
      </div>
    </div>
    <!--Description-->
    <?php
    $super_id = 0;

    if (isset($_SESSION['user_id'])) {
      $super_id = $_SESSION['user_id'];
    }

    $sql = "SELECT description FROM users WHERE super_id='".$_SESSION['user']->Get_id()."'";
    $result = mysqli_query($opendb, $sql)
    or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));

    while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
      $string = 0;
      ?>
      <div class="row">    
        <div class="col-md-5">
          <strong>Describe yourself!</strong>    
          <?php 
          $string = htmlspecialchars($row['description']);
          echo "<textarea class=\"form-control\" rows=\"5\" name=\"text_content\">$string</textarea>";
          ?>
        </div>
      </div>
      <?php
    }
    ?>
    <div class="row">
      <div class="col-sm-10">
        <button class="btn btn-lg btn-primary" type="submit" name="button" value="change_settings" style="margin-top: 10px">Change settings</button>
      </div>
    </div>
  </form>
    <hr>
    <!--Blog configuration-->
    <form class="form-settings" role="form" action="actions_index.php?action=settings&page=my_account" method="post" name="settings">
      <div class="row">
        <div class="col-md-3 col-md-offset-2">
          <h4><p class="text-center"><strong>Blog settings</strong></p></h4>
        </div>
      </div>

      <p><?php if(isset($_SESSION['changed_logo'])){
          echo '<font color="green">' . $_SESSION['changed_logo'] . '</font>';
          unset($_SESSION['changed_logo']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['changed_post_background'])){
          echo '<font color="green">' . $_SESSION['changed_post_background'] . '</font>';
          unset($_SESSION['changed_post_background']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['changed_blog_background'])){
          echo '<font color="green">' . $_SESSION['changed_blog_background'] . '</font>';
          unset($_SESSION['changed_blog_background']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['wrong'])){
          echo '<font color="red">' . $_SESSION['wrong'] . '</font>';
          unset($_SESSION['wrong']);
        }
        ?></p>
        <p><?php if(isset($_SESSION['deleted'])){
          echo '<font color="green">' . $_SESSION['deleted'] . '</font>';
          unset($_SESSION['deleted']);
        }
        ?></p>

    <div class="row">
      <div class="col-md-3">
          <?php
          $sql = "SELECT * FROM blogs WHERE super_id=".$_SESSION['user']->Get_id()." AND active='true' ORDER BY blog_name";
          $result = mysqli_query($opendb,$sql)
          or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
          ?>

          <strong>Choose blog to configure:</strong>
          <br />
          <select name="blog_id" class="form-control" required>
            <option value="">Choose blog</option>;
              <?php
                while($row = mysqli_fetch_assoc($result)){
                    echo  "<option value=\"{$row['blog_id']}\">{$row['blog_name']}</option>";
                }
              ?>
          </select>
        </div>
        <!--Background color-->
          <div class="col-md-2 col-md-offset-1">
            <strong>Background color:</strong>
            <input type="text" class="form-control" placeholder="Paste html color code here" name="blog_background">
          </div>
          <!--Post background color-->
          <div class="col-md-3">
          <strong>Change post background:</strong>
          <input type="text" class="form-control" placeholder="Paste html color code here" name="post_background">
          </div>
        </div>
        <!--Change logo-->
        <div class="row">
        <div class="col-md-2 col-md-offset-4">
          <strong>Change logo picture:</strong>
          <input type="url" class="form-control" id="input_logo" placeholder="Paste logo url here" name="logo" aria-describedby="helpBlock">
          <span id="helpBlock" class="help-block">Recommended proportion: 1170px width.</span>
        </div>
      <!--Delete blog-->
        <div class="col-md-2">
          <strong><u><p class="text-center">Delete blog:</p></u></strong>
          <input type="checkbox" class="form-control" name="delete_blog">
        </div>
      </div>

    <hr>
    <!--Change settings button-->
    <div class="row">
      <div class="col-sm-10">
        <button class="btn btn-lg btn-primary" type="submit" name="button" value="change_settings">Change settings</button>
      </div>
    </div>
  </form>

</body>
</html>