<!DOCTYPE html>
<!--
Sidan där man skriver ett nytt blogginlägg.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>My blog</title>
        <?php 

        require "include/connect_db.php";
        include "include/header.php";

        if(isset($_GET['blog_id'])){
            $blog_id = $_GET['blog_id'];
        }
        
        ?>
    </head>
    <body>
        <div class="container">
            <div class="row row-blog_post">
                <div class="col-md-9">
                    <div class="row">
                        <p><?php if(isset($_SESSION['post_created'])){
                            echo '<font color="green">' . $_SESSION['post_created'] . '</font>';
                            unset($_SESSION['post_created']);
                        }?></p>
                        <h1>Create new post</h1>
                        
                    </div>
                    <div class="row">         
                        <form role="form" action="actions_index.php" method="post">
                            <h4>Title</h4>
                            <textarea class="form-control" rows="1" name="text_title" required></textarea>
                            <h4>Content</h4>
                            <textarea class="form-control" rows="10" name="text_content" required></textarea>
                            <input type="hidden" value="<?php if(isset($blog_id)){echo $blog_id;} ?>" name="blog_id">
                            <button type="submit" class="btn btn-default" value="create_post" name="action">Create post</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="user_blogs.php?page=my_account">My blogs</a></li>
                        <li><a href="settings.php?page=my_account">Options</a></li>
                        <li><a href="blog_post.php?page=my_account">New post</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>
