<?php
//Används i heaader.php
//Kollar vem som är inloggad.
function check_user_id(){
	require "include/connect_db.php";

	$sql = mysqli_query($opendb,"SELECT * FROM users WHERE username='".$_SESSION['user']->Get_name()."' AND super_id='".$_SESSION['user']->Get_id()."'")
	or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');
	$row = mysqli_affected_rows($opendb);
	
	if($row == '0' || $row == 0){
		header("location: actions_index.php?action=log_me_out&log_out=1");
	}
}
//Används i user_blogs.php och får ett input som bestämmer vad som ska göras.
//Hämtar alla bloggar som finns registrerade hos användaren.
function get_user_blogs($input){
	require "include/connect_db.php";

	switch ($input) {
		case 'user':

			$sql = mysqli_query($opendb,"SELECT * FROM blogs WHERE super_id ='".$_SESSION['user']->Get_id()."'")
			or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');

			return $sql;

		break;

		case 'categories':
			function categories($input){
				require "include/connect_db.php";

				$sql = "SELECT * FROM blogs WHERE category='$input' AND hidden='show' AND active='true' ORDER BY blog_name ASC";
				$result = mysqli_query($opendb, $sql);
				if(!$result){
					echo mysqli_error($opendb);
					return false;
					
				}else{
					return $result;
				}
				
			}
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12">
	                            <?php
	                            $categories_array = array("About me","Animals","Culture","Fashion","Series & movies", "Sports", "Travels","Other");
	                            for ($i=0; $i < count($categories_array); $i++) { 
	                            	$category = $categories_array[$i];
									$returnvalue = categories($category);
	                            	?>
	                            	<div class="row">
	                            		<div class="col-md-12">
 			                            	<div class="table-responsive">
			                        			<table class="table">
						                            <tr>
						                            <td><Strong><?php echo "$categories_array[$i]" ?></strong></td>
						                            <?php
						                            while($row = mysqli_fetch_array($returnvalue)){
						                            	$string = nl2br(htmlspecialchars($row['blog_name']));
						                                echo "<tr>";
						                                echo "<td><a href=\"blog_page.php?blog_id=$row[blog_id]\">$string</a></td>";

						                                echo "</tr>\n";
						                            }
			                            			?>
			                            		</table>
			                            	</div>
		                            	</div>
	                            	</div>
	                            <?php
	                            }
	                            ?>
							</div>
						</div>
					</div>
				</div>

			</div>
				<?php
		break;

		case 'all_blogs':
			$sql = mysqli_query($opendb,"SELECT * FROM blogs WHERE hidden='show' AND active='true' ORDER BY blog_name ASC")
			or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');

			return $sql;
		break;

		case 'all_blogs_admin':
			$sql = mysqli_query($opendb,"SELECT * FROM blogs ORDER BY blog_name ASC")
			or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');

			return $sql;
		break;
}
}
//Används i blog_page.php 
//Hämtar de specifika blogginläggen för den valda bloggen.
function get_blog_posts($input_id){
	require "include/connect_db.php";

	$blog_id = 0;
	if (isset($input_id)) {
		$blog_id = $input_id;
	}

	$array = get_blog_preferences($blog_id);

    $post_background = $array[1];


	$sql = mysqli_query($opendb, "SELECT * FROM blog_post WHERE blog_id=$blog_id ORDER BY time desc")
	or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));

	while($row = mysqli_fetch_array($sql, MYSQL_BOTH)){
		$string = 0;

		$blog_user_id = 0;
		$blog_user_id = $row['super_id'];

		?>
		<?php echo "<div class=\"post-border post-shadowborder post\" style=\"background-color: ".$post_background." \">";?>
			<h1><p class="text-center"><?php echo nl2br(htmlspecialchars($row['title'])) ?></p></h1>
			<h5 class="text-muted"><small><p class="text-center"><?php echo $row['time'] ?></p></small></h5>
			<!--nl2br andvänds för att skriva ut texten så som den skrevs in, alltså med enter, tabs och allting
			substr kan användas för att visa ett visst antal tecken.-->
			<?php 
			$string = substr(nl2br(htmlspecialchars($row['post'])),0,1000);

			echo $string; ?>

			<p><?php echo "<a href=\"detailed_post.php?blog_id=$blog_id&post_id=$row[post_id]&action=detailed\">Click here to read more</a>";
			if(isset($_SESSION['user'])){
				if($_SESSION['user']->Get_id() == $blog_user_id){
					echo "<p class=\"text-right\"><a href=\"detailed_post.php?blog_id=$blog_id&post_id=$row[post_id]&action=edit\">	Edit post</a>";
					echo "	";
					echo "<a href=\"detailed_post.php?blog_id=$blog_id&post_id=$row[post_id]&action=delete\">Delete post</a></p>"; 
					?></p>
					<?php
				}
			} 
			?>
			
		</br>
		</div>

		<?php
	}
		
	}
	?>
<?php
//Används i blog_page.php
//Räknar antalet views en blogg har.
function count_views($input_id){
	require "include/connect_db.php";

	$sql = mysqli_query($opendb,"SELECT views FROM blogs WHERE blog_id='$input_id'")
	or die("Kunde inte ansluta till MySQL:<br />" . mysql_error($opendb) . $wrong='1');
	$row = mysqli_fetch_assoc($sql);
	$result = $row['views'];
	$result = ($result + 1);

	$sql_2 = "UPDATE blogs SET views='$result' WHERE blog_id='$input_id'";
	mysqli_query($opendb,$sql_2);

	return $result;
}
//Används i detailed_post.php
//Kommentarer samt edit-funktionen hittas här med.
function get_separate_post($input_id,$input_post_id,$input_action){
	require "include/connect_db.php";

	$blog_id = 0;
	$post_id = 0;
	$action = 0;
	if (isset($input_id)) {
		$blog_id = $input_id;
	}
	if (isset($input_post_id)) {
		$post_id = $input_post_id;
	}
	if (isset($input_action)) {
		$action = $input_action;
	}

	$array = get_blog_preferences($blog_id);

    $blog_background = $array[0];
    $post_background = $array[1];

    if($action == "edit"){
    	$sql = mysqli_query($opendb, "SELECT * FROM blog_post WHERE post_id=$post_id")
		or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));

		while($row = mysqli_fetch_array($sql, MYSQL_BOTH)){
			$string = 0;
			?>
			<?php echo "<div class=\"row\" style=\"background-color: ".$post_background." \">";?>
				<div class="post-border">
					<form role="form" action="actions_index.php" method="post">
						<h1><p class="text-center"><?php echo nl2br(htmlspecialchars($row['title'])); ?></p></h1>
						<h5 class="text-muted"><small><p class="text-center"><?php echo $row['time'] ?></p></small></h5>
						<!--nl2br andvänds för att skriva ut texten så som den skrevs in, alltså med enter, tabs och allting-->
						<?php 
						$string = htmlspecialchars($row['post']);
						echo "<textarea class=\"form-control\" rows=\"10\" name=\"text_content\">$string</textarea>";
						?>
						<input type="hidden" value="<?php if(isset($blog_id)){echo $blog_id;} ?>" name="blog_id">
						<input type="hidden" value="<?php if(isset($post_id)){echo $post_id;} ?>" name="post_id">
		                <button type="submit" class="btn btn-default" value="edit_post" name="action">Edit post</button>
	                </form>
					<br />
				</div>
			</div>

			<?php
		}
	}else{

	$sql = mysqli_query($opendb, "SELECT * FROM blog_post WHERE post_id=$post_id")
	or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));

	while($row = mysqli_fetch_array($sql, MYSQL_BOTH)){
		$string = 0;
		?>
		<?php echo "<div class=\"row\" style=\"background-color: ".$post_background." \">";?>
			<div class="col-md-12">
				<h1><p class="text-center"><?php echo nl2br(htmlspecialchars($row['title'])); ?></p></h1>
				<h5 class="text-muted"><small><p class="text-center"><?php echo $row['time'] ?></p></small></h5>
				<!--nl2br andvänds för att skriva ut texten så som den skrevs in, alltså med enter, tabs och allting-->
				<?php 
				$string = nl2br(htmlspecialchars($row['post']));
				echo $string;
				?>
				<br />
			</div>
		</div>

		<?php
	}
	?>
	<!--Write comment-->
	<?php echo "<div class=\"row\" style=\"background-color: ".$post_background." \">";?>
		<div class="row-blog_post">         
	        <?php echo "<form role=\"form\" action=\"actions_index.php?post_id=$post_id\" method=\"post\">" ?>
	        	<br />
	        	<div class="col-md-12">
	            <h4>Comment</h4>
	            	<textarea class="form-control" rows="5" placeholder="Comment" name="text_content"></textarea>
	            	<input type="hidden" value="<?php if(isset($blog_id)){echo $blog_id;} ?>" name="blog_id">
	            	<button type="submit" class="btn btn-default" value="create_comment" name="action">Post comment</button>
	            </div>
	        </form>
	    </div>
	    <!--Comments-->
	    <div class="row">
	    	<div class="col-md-4 col-md-offset-4">
		    <div class="post-shadowborder">
		    	<?php
				$sql_2 = mysqli_query($opendb, "SELECT * FROM user_comment WHERE post_id=$post_id ORDER BY time desc")
				or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));


				while($row = mysqli_fetch_array($sql_2, MYSQL_BOTH)){
				$string = 0;
				$sql_3 = "SELECT username FROM users WHERE super_id='".$row['super_id']."'";
				$result = mysqli_query($opendb, $sql_3);
				$row_2 = mysqli_fetch_assoc($result);
				?>
				<div class="post-shadowborder">
					<h4><p class="text-center"><?php if(!empty($row_2['username']) && $row_2['username'] == 'Admin') { echo "<font color=\"Blue\">".nl2br(htmlspecialchars($row_2['username']))."</font>";}
					elseif (!empty($row_2['username'])) {
						echo nl2br(htmlspecialchars($row_2['username']));
					}
					else{
						echo "<font color=\"Grey\">Anonymous</font>";
					}?></p></h4>
					<h5 class="text-muted"><p class="text-center"><small><?php echo $row['time'] ?></small></p></h5>
					<!--nl2br andvänds för att skriva ut texten så som den skrevs in, alltså med enter, tabs och allting-->
					<?php 
					$string = nl2br(htmlspecialchars($row['comment']));
					echo $string; 
					?>
					<br />
					<br />
				</div>

				<?php
			}
		    	?>
		    </div>
		</div>
		</div>
	</div>
    <?php
}
}
//Används i blog_page.php
//Hämtar information om bloggens ägare samt om ägaren är inloggade på bloggen
//så hämtas också menyn för konfiguration.
function get_user_image($input_id,$input_action){
	require "include/connect_db.php";

	$blog_id = 0;
	
	if (isset($input_id)) {
		$blog_id = $input_id;
	}

	$array = get_blog_preferences($blog_id);

    $post_background = $array[1];

	$sql = mysqli_query($opendb, "SELECT super_id FROM blogs WHERE blog_id=$blog_id")
	or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
	$row = mysqli_fetch_assoc($sql);

	$super_id = $row['super_id'];

	print "<table>";

	$sql_2 = "SELECT * FROM users WHERE super_id=$super_id";
	$result = mysqli_query($opendb, $sql_2)
	or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
	while($row_2 = mysqli_fetch_assoc($result)){
		$string = 0;
		?>

		<?php echo "<div class=\"col-md-3\" style=\"background-color: ".$post_background." \">";?>
            <div class="row">
            	<div class="col-md-10 col-md-offset-2">
                	<h4>This is me!</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-2">
                <?php print "<img class=\"img-rounded\" border=\"0\" name=\"myimage\" src=\"$row_2[user_img]\" alt=\"I have no picture yet!\" width=\"150\" height=\"150\"/>";			
                ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                	<?php
                	$string = nl2br(htmlspecialchars($row_2['description']));
					echo $string;
                	?>                
                </div>
            </div>
            <?php if(isset($_SESSION['user'])){

            	$sql = "SELECT super_id FROM blogs WHERE blog_id='$blog_id'";
            	$result = mysqli_query($opendb,$sql);
            	$row = mysqli_fetch_assoc($result);
            	$id = $row['super_id'];

            	if($_SESSION['user']->Get_id() == $id){
            	?>
		            <div class="row">
		            	<div class="col-md-10 col-md-offset-1">
		            		<ul class="nav nav-pills nav-stacked">
		                        <li><a href="user_blogs.php?page=my_account">My blogs</a></li>
		                        <li><a href="settings.php?page=my_account">Options</a></li>
		                        <?php echo "<li><a href=\"blog_post.php?blog_id=$blog_id&page=my_account\">New post</a></li>"; ?>
		                    </ul>
		                </div>
		        	</div>
		        	<?php
	        	}
	        }
	        ?>
	<?php	
	break;
	}
	print "</table>";
}
//Används i blog_page.php och detailed_pot.php
//Hämtar bloggens specifika egenskaper så so bakgrund.
function get_blog_preferences($input_id){
	require "include/connect_db.php";

	$blog_id = 0;
	
	if (isset($input_id)) {
		$blog_id = mysqli_real_escape_string($opendb, $input_id);
	}

	$sql = "SELECT * FROM blogs WHERE blog_id='$blog_id' AND active='true'";
	$result = mysqli_query($opendb,$sql)
	or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
	$row = mysqli_fetch_assoc($result);

	$sql_2 = "SELECT background FROM blog_post WHERE blog_id='$blog_id' AND active='true'";
	$result_2 = mysqli_query($opendb,$sql_2)
	or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
	$row_2 = mysqli_fetch_assoc($result_2);

	$array = array();
	//blog background
	$array[0] = "$row[background]";
	//Post background
	$array[1] = "$row_2[background]";
	//Logo
	$logo = htmlspecialchars($row['logo']);
	$array[2] = $logo;

	return $array;
}
//Används i settings.php
//Utför ändringar för användaren så som beskrivning, namn, lösenord och annat som har med bloggen och användaren att göra.
function check_settings_change($input){
	require "connect_db.php";

	$sql = "SELECT * FROM blogs WHERE super_id=".$_SESSION['user']->Get_id()." AND active='true'";
    $result = mysqli_query($opendb,$sql)
    or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));

    $n = 0;
    $categories_array = array();
    while($row = mysqli_fetch_assoc($result)){
    	$categories_array[$n] = $row['blog_id'];
    	$n++;
    }
	
	switch ($input){
		case 'delete_blog':
			$blog_id = 0;
			$clear = 0;

			if(isset($_POST['blog_id'])){
				$blog_id = mysqli_real_escape_string($opendb, $_POST['blog_id']);
			}

			for ($i=0; $i < count($categories_array); $i++) { 
			    if($categories_array[$i] == $blog_id){
			        $clear = 1;
			        break;
			    }else{
			    	$clear = 0;
			    }
			}
			    if($clear == 1){
					//Delete blog
					$sql_blog = "DELETE FROM blogs WHERE blog_id='$blog_id'";
					$sql_post = "DELETE FROM blog_post WHERE blog_id='$blog_id'";
					$sql_comment = "DELETE FROM user_comment WHERE blog_id='$blog_id'";
					$result = mysqli_query($opendb, $sql_blog);
					$result_2 = mysqli_query($opendb, $sql_post);
					$result_3 = mysqli_query($opendb,$sql_comment);
					$_SESSION['deleted'] = "The blog has been deleted!";
					header('Location: settings.php');
					break;
				}else{

					$_SESSION['wrong'] = "Something went wrong, please try again delete function!";
					header('Location: settings.php');
					break;

				}
			

			break;
		case 'change_description':
			$description = 0;

			if(isset($_POST['text_content'])){
				$description = mysqli_real_escape_string($opendb, $_POST['text_content']);
			}

			//Change profile picture
			$sql = "UPDATE users SET description ='$description' WHERE super_id=".$_SESSION['user']->Get_id()."";
			$result = mysqli_query($opendb,$sql);
			$_SESSION['changed_description'] = "Your profile description has been updated!";
			header('Location: settings.php');

			break;

		case 'change_logo':
			$logo_url = 0;
			$blog_id = 0;
			$clear = 0;
			
			if(isset($_POST['logo'])){
				$logo_url = mysqli_real_escape_string($opendb, $_POST['logo']);
			}
			if(isset($_POST['blog_id'])){
				$blog_id = mysqli_real_escape_string($opendb, $_POST['blog_id']);
			}

			for ($i=0; $i < count($categories_array); $i++) { 
			    if($categories_array[$i] == $blog_id){
			        $clear = 1;
			        break;
			    }else{
			    	$clear = 0;
			    }
			}
			    if($clear == 1){
					//Change logo
					$sql = "UPDATE blogs SET logo ='$logo_url' WHERE blog_id='$blog_id'";
					$result = mysqli_query($opendb,$sql);
					$_SESSION['changed_logo'] = "The blog's logo has been changed!";
					header('Location: settings.php');
				}else{
					$_SESSION['wrong'] = "Something went wrong, please try again logo function!";
					header('Location: settings.php');
				}
			
		break;

		case 'change_post_background':
			$picture_url = 0;
			$blog_id = 0;
			$clear = 0;
			
			if(isset($_POST['post_background'])){
				$color_url = mysqli_real_escape_string($opendb, $_POST['post_background']);
			}
			if(isset($_POST['blog_id'])){
				$blog_id = mysqli_real_escape_string($opendb, $_POST['blog_id']);
			}
			for ($i=0; $i < count($categories_array); $i++) { 
			    if($categories_array[$i] == $blog_id){
			        $clear = 1;
			        break;
			    }else{
			    	$clear = 0;
			    }
			}
			    if($clear == 1){
					//Change post color
					$sql = "UPDATE blog_post SET background ='$color_url' WHERE blog_id='$blog_id'";
					$result = mysqli_query($opendb,$sql);
					$_SESSION['changed_post_background'] = "The blog's post background has been changed!";
					header('Location: settings.php');
				}else{
					$_SESSION['wrong'] = "Something went wrong, please try again post background function!";
					header('Location: settings.php');
				}
		break;

		case 'change_blog_background':
			$picture_url = 0;
			$blog_id = 0;
			$clear = 0;
			
			if(isset($_POST['blog_background'])){
				$color_url = mysqli_real_escape_string($opendb, $_POST['blog_background']);
			}
			if(isset($_POST['blog_id'])){
				$blog_id = mysqli_real_escape_string($opendb, $_POST['blog_id']);
			}
			
			for ($i=0; $i < count($categories_array); $i++) { 
			    if($categories_array[$i] == $blog_id){
			        $clear = 1;
			        break;
			    }else{
			    	$clear = 0;
			    }
			}
			    if($clear == 1){
					//Change background color
					$sql = "UPDATE blogs SET background ='$color_url' WHERE blog_id='$blog_id'";
					$result = mysqli_query($opendb,$sql);
					$_SESSION['changed_blog_background'] = "The blog's background has been changed!";
					header('Location: settings.php');
				}else{
					$_SESSION['wrong'] = "Something went wrong, please try again blog background function!";
					header('Location: settings.php');
				}
		break;

		case 'change_picture':
			$picture_url = 0;
			$blog_id = 0;
			

			if(isset($_POST['change_picture'])){
				$picture_url = mysqli_real_escape_string($opendb, $_POST['change_picture']);
			}

			//Change profile picture
			$sql = "UPDATE users SET user_img ='$picture_url' WHERE super_id=".$_SESSION['user']->Get_id()."";
			$result = mysqli_query($opendb,$sql);
			$_SESSION['changed_user_picture'] = "Your profile picture has been changed";
			header('Location: settings.php');
				
			break;

		case 'change_email':
			$current_email = 0;
			$new_email = 0;

			//Email
			if(isset($_POST['current_email'])){
				$current_email = mysqli_real_escape_string($opendb, $_POST['current_email']);
				$sql_resource = mysqli_query($opendb,"SELECT email FROM users WHERE username=".$_SESSION['user']->Get_name()."");
				$sql_array = mysqli_fetch_assoc($sql_resource);
				$sql_email = $sql_array['email'];
			}
			if(isset($_POST['new_email'])){
				$new_email = mysqli_real_escape_string($opendb, $_POST['new_email']);
			}
			//Change email
			if($sql_email == $current_email){
				mysqli_query($opendb,"UPDATE users SET email ='$new_email' WHERE username=".$_SESSION['user']->Get_name()."");
				echo"mailen är ändrad";
				$_SESSION['changed_email'] = "Your email has been updated";
				header('Location: my_account.php');
			}
			break;

		case 'change_password':
			$current_password = 0;
			$new_password = 0;

			if(isset($_POST['current_password'])){
				$str = mysqli_real_escape_string($opendb, $_POST['current_password']);
				$current_password = md5($str);

				$sql = "SELECT password FROM users WHERE username='".$_SESSION['user']->Get_name()."' AND super_id='".$_SESSION['user']->Get_id()."'";
				$result = mysqli_query($opendb, $sql);
				$row = mysqli_fetch_assoc($result);
			}

			if($row['password'] == $current_password){
				if(isset($_POST['new_password'])){
					$str = mysqli_real_escape_string($opendb, $_POST['new_password']);
					$new_password = md5($str);

					$sql = "UPDATE users SET password ='$new_password' WHERE username='".$_SESSION['user']->Get_name()."' AND super_id='".$_SESSION['user']->Get_id()."'";
					$result = mysqli_query($opendb, $sql);
					$_SESSION['changed_password'] = "Your password has been changed";
					header('Location: settings.php');
				}

			}else{
				$_SESSION['changed_password'] = "Your passwoord did not change, please enter the right password";
				header('Location: settings.php');
			}
		break;

		case 'change_username':
			$current_username = 0;
			$new_username = 0;
			

			//username
			if(isset($_POST['current_username'])){
				$current_username = mysqli_real_escape_string($opendb, $_POST['current_username']);
			}
			if(isset($_POST['new_username'])){
				$new_username = mysqli_real_escape_string($opendb, $_POST['new_username']);
			}

			//Change username
			if($_SESSION['user']->Get_name() == $current_username){
				mysqli_query($opendb, "SELECT BINARY username FROM users WHERE username = '$new_username'")
				or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');
				$row = mysqli_affected_rows();

				if($row >= '1'){
					$_SESSION['existing_username'] = "There is already an user with that username, please try another";
					$_SESSION['wrong'] = '1';
					header('Location: settings.php?');
				}else{
					mysqli_query($opendb,"UPDATE users SET username ='$new_username' WHERE username='".$_SESSION['user']->Get_name()."' AND super_id='".$_SESSION['user']->Get_id()."'");
					$_SESSION['user']->Set_name($new_username);
					$_SESSION['changed_username'] = "Your username has been changed to  ".$new_username;
					header('Location: settings.php');
				}
			}

			break;
		
		default:
			echo "Something went wrong, please go back and try again.";
			break;
	}
}
//Används i settings.php
//Ändrar användarbeskrivningen.
function edit_description($input_id,$input_post_id,$input_action){
	require "connect_db.php";

	$super_id = 0;

	if (isset($_SESSION['user_id'])) {
		$super_id = $_SESSION['user_id'];
	}

	$sql = "SELECT description FROM users WHERE super_id=$super_id";
	$result = mysqli_query($opendb, $sql)
	or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));

	while($row = mysqli_fetch_array($sql, MYSQL_BOTH)){
		$string = 0;
		?>
		<?php echo "<div class=\"row\" style=\"background-color: ".$post_background." \">";?>
			<div class="post-border">
				<form role="form" action="actions_index.php" method="post">
					<h1><p class="text-center"><?php echo nl2br(htmlspecialchars($row['title'])); ?></p></h1>
					<h5 class="text-muted"><small><p class="text-center"><?php echo $row['time'] ?></p></small></h5>
					<!--nl2br andvänds för att skriva ut texten så som den skrevs in, alltså med enter, tabs och allting-->
					<?php 
					$string = htmlspecialchars($row['post']);
					echo "<textarea class=\"form-control\" rows=\"10\" name=\"text_content\">$string</textarea>";
					?>
					<input type="hidden" value="<?php if(isset($blog_id)){echo $blog_id;} ?>" name="blog_id">
					<input type="hidden" value="<?php if(isset($post_id)){echo $post_id;} ?>" name="post_id">
	                <button type="submit" class="btn btn-default" value="edit_post" name="action">Edit post</button>
                </form>
				<br />
			</div>
		</div>

		<?php
	}
}
//Används i admin.php
//En funktion specifik för admin sidan. 
function admin_tools($action){
	require "connect_db.php";

	if($action == "blogs"){
		?>
		<form method="post" action="actions_index.php?action=admin_tools">
			<div class="row" style="margin-bottom: 15px">
				<div class="col-md-3">
		            <strong>Choose an option:</strong>
		            <br />
		            <select name="admin_action" class="form-control" required>
						<option value="">Options</option>;
						<option value="configure_blog">Configure specific blog(Under construction)</option>
						<option value="deactivate_activate">Deactivate/activate</option>
						<option value="hide_show">Hide/Show</option>
		            </select>
		  		</div>
		  		<div class="col-md-2">
		  			<button name="admin_page" class="btn btn-primary btn-xs" style="margin-top: 25px">Submit</button>
		  		</div>
	  		</div>
			<div class="row">
		    	<div class="col-md-12">
		            <?php
		            $action = "all_blogs_admin";

		            $returnvalue = get_user_blogs($action);
		            ?>

		            <div class="table-responsive  col-md-12">
		              	<table class="table table-condensed admin-table">
							<tr>
								<td><Strong>Super id</strong></td>
								<td><Strong>Username</strong></td>
								<td><Strong>Blog id</strong></td>
								<td><Strong>Blog name</strong></td>
								<td><Strong>Views</strong></td>
								<td><Strong>Background</strong></td>
								<td><Strong>Logo</strong></td>
								<td><Strong>Hide/Show blog</strong></td>
								<td><Strong>Active</strong></td>
								<td><Strong>Select</strong></td>
							</tr>
							<?php
							while($row = mysqli_fetch_array($returnvalue,MYSQL_BOTH)){
								$string = nl2br(htmlspecialchars($row['blog_name']));
								$sql = "SELECT username FROM users WHERE super_id='".$row['super_id']."'";
								$result = mysqli_query($opendb, $sql);
								$row_2 = mysqli_fetch_assoc($result);

								echo "<tr>";
								echo "<td>$row[super_id]</td>";
								echo "<td>$row_2[username]</td>";
								echo "<td>$row[blog_id]</td>";
								echo "<td><a href=\"blog_page.php?blog_id=$row[blog_id]&page=my_account\">$string</a></td>";
								echo "<td>$row[views]</td>";
								echo "<td>$row[background]</td>";
								echo "<td>$row[logo]</td>";
								echo "<td>$row[hidden]</td>";
								echo "<td>$row[active]</td>";
								?>
								<!--<form action="actions_index.php?action=hide_show" method="post">
								<?php /*if($row['hidden'] == "show"){
								echo "<td><p class=\"text-center\"><button name=\"hide\" value=\"hide\" class=\"btn btn-danger btn-xs\">Hide</button></p>";
								echo "<input type=\"hidden\" value=\"$row[blog_id]\" name=\"blog_id\">";
								}else{
								echo "<td><p class=\"text-center\"><button name=\"hide\" value=\"show\" class=\"btn btn-success btn-xs\">Show</button></p>";
								echo "<input type=\"hidden\" value=\"$row[blog_id]\" name=\"blog_id\">";
								}*/
								?>
								</form>-->
								<?php
								echo "<td><input type=\"checkbox\" name=\"selected\" value=\"$row[blog_id]\"></td>";
								echo "</tr>\n";
			                }
				            ?>
		  				</table>
		  			</div>
		        </div>
			</div>
		</form>
		<?php
	}elseif($action == "users"){
		?>
		<form method="post" action="actions_index.php?action=admin_tools">
			<div class="row" style="margin-bottom: 15px">
				<div class="col-md-3">
		            <strong>Choose an option:</strong>
		            <select name="admin_action" class="form-control" required>
						<option value="">Options</option>;
						<option value="ban">Ban user(Under construction)</option>
						<option value="block_ip">Block ip(Under construction)</option>
						<option value="configure_user">Configure user(Under construction)</option>
		            </select>
		  		</div>
		  		<div class="col-md-2">
		  			<button name="admin_page" class="btn btn-primary btn-xs" style="margin-top: 25px">Submit</button>
		  		</div>
	  		</div>
			<div class="row">
		    	<div class="col-md-12">
		    		<h3><font color="blue">Under construction!</font></h3>
		            <?php
		            $action = "all_blogs_admin";

		            $sql = "SELECT * FROM users";
					$result = mysqli_query($opendb, $sql);

		            $returnvalue = get_user_blogs($action);
		            ?>

		            <div class="table-responsive  col-md-12">
		              	<table class="table table-condensed admin-table">
							<tr>
								<td><Strong>Super id</strong></td>
								<td><Strong>Username</strong></td>
								<td><Strong>Email</strong></td>
								<td><Strong>Verified</strong></td>
								<td><Strong>User type</strong></td>
								<td><Strong>Active</strong></td>
								<td><Strong>Description</strong></td>
								<td><Strong>User image</strong></td>
								<td><Strong>Ip</strong></td>
								<td><Strong>Reg time</strong></td>
							</tr>
							<?php
							while($row = mysqli_fetch_array($result,MYSQL_BOTH)){
								$string = nl2br(htmlspecialchars($row['username']));

								echo "<tr>";
								echo "<td>$row[super_id]</td>";
								echo "<td>".$string."</td>";
								echo "<td>$row[email]</td>";
								echo "<td>$row[verified]</td>";
								echo "<td>$row[user_type]</td>";
								echo "<td>$row[active]</td>";
								echo "<td>$row[description]</td>";
								echo "<td>$row[user_img]</td>";
								echo "<td>$row[ip]</td>";
								echo "<td>$row[reg_time]</td>";
								echo "<td><input type=\"checkbox\" name=\"selected\" value=\"$row[super_id]\"></td>";
								echo "</tr>\n";
			                }
				            ?>
		  				</table>
		  			</div>
		        </div>
			</div>
		</form>
		<?php
	}elseif($action == "configure"){

	}else{
		echo "Something went wrong, please try again";
	}
}