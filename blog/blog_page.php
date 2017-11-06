<!DOCTYPE html>
<!--
Sidan för den specifika bloggen som valdes.
-->
<html>
    <?php
    
    require "include/connect_db.php";
    include "include/header.php";

    $blog_id = 0;
    if(isset($_GET['blog_id'])){
        $blog_id = mysqli_real_escape_string($opendb, $_GET['blog_id']);
    }

    $sql = "SELECT * FROM blogs WHERE blog_id=$blog_id";
    $result = mysqli_query($opendb,$sql)
    or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');
    $row = mysqli_fetch_assoc($result);
    $blog_name = $row['blog_name'];
    $active = $row['active'];


    if(isset($_SESSION['user'])){
        if($_SESSION['user']->Get_type() == "Admin" && $active == "false"){
            ?>
            <head>
            <meta charset="UTF-8">
            <?php echo "<title>".$blog_name."</title>";?>
            <?php 
            

            $returnvalue = count_views($blog_id);

            $array = get_blog_preferences($blog_id);

            $blog_background = $array[0];
            $post_background = $array[1];

            ?>

            </head>
            <?php echo "<body style=\"background-color: ".$blog_background." \">;"?>
                <div class="container">
                    <?php echo "<div class=\"row min-width\" style=\"background-color: ".$post_background." \">";?>
                        <?php if(!isset($_SESSION['user'])){
                            ?>
                            <?php echo "<div class=\"col-xs-12 min-width\" style=\"background-color: ".$post_background." \">";?>
                            <?php
                        }else{
                            ?>
                            <?php echo "<div class=\"col-xs-12 min-width\" style=\"background-color: ".$post_background." \">";?>
                            <?php
                        }
                        ?>
                        <div class="row blog_name">
                            <?php echo "<form class=?\"form-signin\" role=\"form\" action=\"user_blogs.php?action=all_blogs\" method=\"post\" name=\"create_account\">" ?>
                                <div class="col-md-1" style="margin-top:10px">
                                    <button class="btn btn-lg" type="submit" name="button">Back</button>
                                </div>
                            </form>
                            <div class="col-md-5 col-md-offset-4">
                                <h2><p><strong><?php echo nl2br(htmlspecialchars($row['blog_name'])) ?></strong></p></h2>
                            </div>
                        </div>
                        <?php
                        $action = "blog_page";
                        echo get_user_image($blog_id,$action); ?>
                        <div class="col-md-9">
                        <?php
                        echo get_blog_posts($blog_id);
                        ?>
                        </div>
                    </div>
                </div>
            </body>
            <?php
        }elseif($_SESSION['user']->Get_type() != "Admin" && $active == "false"){
            header("location: 404_not_found.php");
        }
        else{
            ?>
            <head>
                <meta charset="UTF-8">
                <?php echo "<title>".$blog_name."</title>";?>
                <?php 

                $returnvalue = count_views($blog_id);

                $array = get_blog_preferences($blog_id);

                $blog_background = $array[0];
                $post_background = $array[1];

                ?>

            </head>
            <?php echo "<body style=\"background-color: ".$blog_background." \">;"?>
                <div class="container">
                    <?php echo "<div class=\"row min-width\" style=\"background-color: ".$post_background." \">";?>
                        <?php if(!isset($_SESSION['user'])){
                            ?>
                            <?php echo "<div class=\"col-xs-12 min-width\" style=\"background-color: ".$post_background." \">";?>
                            <?php
                        }else{
                            ?>
                            <?php echo "<div class=\"col-xs-12 min-width\" style=\"background-color: ".$post_background." \">";?>
                            <?php
                        }
                        ?>
                        <div class="row blog_name">
                            <?php echo "<form class=?\"form-signin\" role=\"form\" action=\"user_blogs.php?action=all_blogs\" method=\"post\" name=\"create_account\">" ?>
                                <div class="col-md-1" style="margin-top:10px">
                                    <button class="btn btn-lg" type="submit" name="button">Back</button>
                                </div>
                            </form>
                            <div class="col-md-5 col-md-offset-4">
                                <h2><p><strong><?php echo nl2br(htmlspecialchars($row['blog_name'])) ?></strong></p></h2>
                            </div>
                        </div>
                        <?php
                        $action = "blog_page";
                        echo get_user_image($blog_id,$action); ?>
                        <div class="col-md-9">
                        <?php
                        echo get_blog_posts($blog_id);
                        ?>
                        </div>
                    </div>
                </div>
            </body>
            <?php
        }
    }elseif($active == "false"){
        header("location: 404_not_found.php");
    }else{
        ?>
        <head>
            <meta charset="UTF-8">
            <?php echo "<title>".$blog_name."</title>";?>
            <?php 

            $returnvalue = count_views($blog_id);

            $array = get_blog_preferences($blog_id);

            $blog_background = $array[0];
            $post_background = $array[1];

            ?>

        </head>
        <?php echo "<body style=\"background-color: ".$blog_background." \">;"?>
            <div class="container">
                <?php echo "<div class=\"row min-width\" style=\"background-color: ".$post_background." \">";?>
                    <?php if(!isset($_SESSION['user'])){
                        ?>
                        <?php echo "<div class=\"col-xs-12 min-width\" style=\"background-color: ".$post_background." \">";?>
                        <?php
                    }else{
                        ?>
                        <?php echo "<div class=\"col-xs-12 min-width\" style=\"background-color: ".$post_background." \">";?>
                        <?php
                    }
                    ?>
                    <div class="row blog_name">
                        <?php echo "<form class=?\"form-signin\" role=\"form\" action=\"user_blogs.php?action=all_blogs\" method=\"post\" name=\"create_account\">" ?>
                            <div class="col-md-1" style="margin-top:10px">
                                <button class="btn btn-lg" type="submit" name="button">Back</button>
                            </div>
                        </form>
                        <div class="col-md-5 col-md-offset-4">
                            <h2><p><strong><?php echo nl2br(htmlspecialchars($row['blog_name'])) ?></strong></p></h2>
                        </div>
                    </div>
                    <?php
                    $action = "blog_page";
                    echo get_user_image($blog_id,$action); ?>
                    <div class="col-md-9">
                    <?php
                    echo get_blog_posts($blog_id);
                    ?>
                    </div>
                </div>
            </div>
        </body>
        <?php
    } ?>
</div>
</html>
