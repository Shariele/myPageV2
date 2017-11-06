<!DOCTYPE html>
<!--
Sidan där blog posten kan läsas mer i detalj.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>My blog</title>
        <?php 

        require "include/connect_db.php";
        include "include/header.php";

        $action = 0;

        if(isset($_GET['blog_id'])){
            $blog_id = mysqli_real_escape_string($opendb, $_GET['blog_id']);
        }
        if(isset($_GET['post_id'])){
            $post_id = mysqli_real_escape_string($opendb, $_GET['post_id']);
        }
        if(isset($_GET['action'])){
            $action = mysqli_real_escape_string($opendb, $_GET['action']);
        }
        $array = get_blog_preferences($blog_id);

        $blog_background = $array[0];
        $post_background = $array[1];
        
        ?>
    </head>
    <?php echo "<body style=\"background-color: ".$blog_background." \">;"?>
        <div class="container">
            <?php echo "<div class=\"row\" style=\"background-color: ".$post_background." \">";?>
                <?php echo "<form class=?\"form-signin\" role=\"form\" action=\"blog_page.php?blog_id=$blog_id\" method=\"post\" name=\"create_account\">" ?>
                <div class="col-md-1" style="margin-top:10px">
                    <button class="btn btn-lg" type="submit" name="button">Back</button>
                </div>
                </form>
            </div>
            
            <?php
            if($action == "detailed"){
                ?>
                <div class="col-md-12">
                    <?php echo "<div class=\"row\" style=\"background-color: ".$post_background." \">";?>
                        <?php echo get_separate_post($blog_id,$post_id,$action); ?>
                    </div>
                </div>
                <?php
            }elseif($action == "edit"){
                ?>
                <div class="col-md-12">
                    <?php echo "<div class=\"row\" style=\"background-color: ".$post_background." \">";?>
                        <?php echo get_separate_post($blog_id,$post_id,$action); ?>
                    </div>
                </div>
                <?php
            }else{
                echo "Something went wrong, please try again.";
            }
            ?>
        </div>
    </body>
</html>
