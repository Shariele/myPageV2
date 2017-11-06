<!DOCTYPE html>
<!--
Startpage, home, hemsida eller index. Kalla det vad du vill. 
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Blogger</title>
        <?php 
        require "include/connect_db.php";
        include "include/header.php";
        ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="user_blogs.php?action=all_blogs">Blog list</a></li>
                        <li><a href="user_blogs.php?action=categories">Blog categories</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <?php
                    if(isset($_SESSION['wrong'])){
                        echo '<font color="red">' . $_SESSION['wrong_pass_name'] . '</font>';
                        unset($_SESSION['wrong']);
                    }
                    ?>
                    <h2><?php if(isset($_SESSION['user'])){ echo "Welcome ".$_SESSION['user']->Get_name()."!"; }
                    else{?> Welcome! <?php } ?></h2>
                    <h3>Most popular blogs</h3>
                    
                    <?php
                    $sql = "SELECT * FROM blogs WHERE hidden='show'  AND active='true' ORDER BY views DESC";
                    $result = mysqli_query($opendb, $sql)
                    or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');
                    ?>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                            <td><Strong>Blogs</strong></td>
                            <td><Strong><p class="text-center">Views</p></strong></td>
                            <td><Strong><p class="text-center">Category</p></strong></td>
                            <?php
                            $i = 0;
                            while($row = mysqli_fetch_array($result,MYSQL_BOTH)){
                                $string = nl2br(htmlspecialchars($row['blog_name']));
                                echo "<tr>";
                                echo "<td><a href=\"blog_page.php?blog_id=$row[blog_id]\">$string</a></td>";
                                echo "<td><p class=\"text-center\">$row[views]</p></td>";
                                echo "<td><p class=\"text-center\">$row[category]</p></td>";
                                echo "</tr>\n";
                                $i++;
                                if($i == 10){
                                    break;
                                }
                            }
                            ?>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>

