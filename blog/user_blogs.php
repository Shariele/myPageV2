<!DOCTYPE html>
<!--
Sidan där användarens/alla/categorierade bloggar visas.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <?php 

        require "include/connect_db.php";
        include "include/header.php";
        $action = 0;
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }
        if($action == "my_account"){
            ?><title>My account</title><?php
        }elseif($action == "categories"){
            ?> <title>Blog Categories</title> <?php
        }elseif($action == "all_blogs"){
            ?> <title>All blogs</title><?php
        }
        ?>

    </head>
    <body>
        <?php
        if($action == "user"){
            ?>
        <div class="container">
            <div class="row">
                <div class="col-md-9">         
                    <?php
                    $returnvalue = get_user_blogs($action);
                    
                    ?>
                    <p><?php if(isset($_SESSION['blog_created'])){
                        echo '<font color="green">' . $_SESSION['blog_created'] . '</font>';
                        unset($_SESSION['blog_created']);
                    }
                    ?></p>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                            <td><Strong>Blogs</strong></td>
                            <td><Strong><p class="text-left">Views</p></strong></td>
                            <td><Strong><p class="text-center">Hide/Show blog</p></strong></td>
                            <?php
                            while($row = mysqli_fetch_array($returnvalue,MYSQL_BOTH)){
                                if($row['active'] == "false"){
                                    $string = nl2br(htmlspecialchars($row['blog_name']));
                                    echo "<tr>";
                                    echo "<td>$string <font color=\"red\">Removed by Admin</font></td>"; ?>
                                    <p class="text-left"> <?php echo "<td>$row[views]</td>"; ?>
                                    <form action="actions_index.php?action=hide_show" method="post">
                                        <?php if($row['hidden'] == "show"){
                                            echo "<td><p class=\"text-center\"><button name=\"hide\" value=\"hide\" class=\"btn btn-danger btn-xs\">Hide</button></p>";
                                            echo "<input type=\"hidden\" value=\"$row[blog_id]\" name=\"blog_id\">";
                                        }else{
                                            echo "<td><p class=\"text-center\"><button name=\"hide\" value=\"show\" class=\"btn btn-success btn-xs\">Show</button></p>";
                                            echo "<input type=\"hidden\" value=\"$row[blog_id]\" name=\"blog_id\">";
                                        }
                                        ?>
                                    </form>
                                    <?php
                                    echo "</tr>\n";
                                }else{
                                    $string = nl2br(htmlspecialchars($row['blog_name']));
                                    echo "<tr>";
                                    echo "<td><a href=\"blog_page.php?blog_id=$row[blog_id]&page=my_account\">$string</a></td>"; ?>
                                    <p class="text-left"> <?php echo "<td>$row[views]</td>"; ?>
                                    <form action="actions_index.php?action=hide_show" method="post">
                                        <?php if($row['hidden'] == "show"){
                                            echo "<td><p class=\"text-center\"><button name=\"hide\" value=\"hide\" class=\"btn btn-danger btn-xs\">Hide</button></p>";
                                            echo "<input type=\"hidden\" value=\"$row[blog_id]\" name=\"blog_id\">";
                                        }else{
                                            echo "<td><p class=\"text-center\"><button name=\"hide\" value=\"show\" class=\"btn btn-success btn-xs\">Show</button></p>";
                                            echo "<input type=\"hidden\" value=\"$row[blog_id]\" name=\"blog_id\">";
                                        }
                                        ?>
                                    </form>
                                    <?php
                                    echo "</tr>\n";
                                }
                            }   
                            ?>
                        </table>
                    </div>
                </div>
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="user_blogs.php?page=my_account">My blogs</a></li>
                        <li><a href="settings.php?page=my_account">Options</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        }elseif ($action == "categories"){
            $action = "categories";
            $page = "blogs";

            if(isset($_SESSION['page'])){
                $_SESSION['page'] = $page;
            }

            $returnvalue = get_user_blogs($action);
            ?>
            <?php
            


        }else{
            $returnvalue = get_user_blogs($action);
            $page = "about";
            if(isset($_SESSION['page'])){
                $_SESSION['page'] = $page;
            }
            ?>
            <div class="container">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                            <td><Strong>All blogs</strong></td>
                            <?php
                            while($row = mysqli_fetch_array($returnvalue)){
                                $string = nl2br(htmlspecialchars($row['blog_name']));
                                echo "<tr>";
                                echo "<td><a href=\"blog_page.php?blog_id=$row[blog_id]\">$string</a></td>"; ?>
                                    <?php

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
        

        
        
    </body>
</html>
