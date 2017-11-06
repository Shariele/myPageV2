<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Create blog</title>
        <?php 
        require "include/connect_db.php";
        include "include/header.php";
        ?>
    </head>
    <body>
        <div class="container">
            <form style="margin-bottom: 20px" role="form" action="actions_index.php" method="post">
            <div class="row">
            	<div class="col-md-10 create-blog">
                    <p><?php if(isset($_SESSION['wrong_category'])){
                        echo '<font color="red">' . $_SESSION['wrong_category'] . '</font>';
                        unset($_SESSION['wrong_category']);
                    }
                    ?></p>
            		
            		<label for="input_blog_name" class="col-sm-1 control-label">Blogname: </label>
	                <div class="col-md-3">
				        <input type="firstname" class="form-control" id="input_blog_name" placeholder="Blogname" name="blog_name" required autofocus>
	                </div> 

                    <div class="row">
                        <div class="col-md-3">
                        <select name="category" class="form-control" required>
                            <option value="">Choose a category</option>
                            <option value="About me">About me</option>
                            <option value="Animals">Animals</option>
                            <option value="Culture">Culture</option>
                            <option value="Fashion">Fashion</option>
                            <option value="Series & movies">Series & movies</option>
                            <option value="Sports">Sports</option>
                            <option value="Travels">Travels</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <button style="margin-left: 10px" type="submit" class="btn btn-default" value="create_blog" name="action">Create blog</button>
                    </div>

	            </div>    
            </div>
            </form>
        </div>
    </body>
</html>
