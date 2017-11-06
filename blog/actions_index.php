<!--Dena sida fungerar som en funktionssida fast är en web sida. Här kallas funktioner vid behov, olika beräkningar
och dirigeringar händer också här. 
Det kan sägas att denna sida är till för de stora funktionerna som finns på bloggen, därefter tas hjälp från funktioner 
vid behov.-->

<?php
//Klasser skall inkluderas innan sessionen startar.
include "classes/User.php";
session_start();
session_name("my_blogger");

$action = 0;

if(isset($_GET['action'])){
    $action = $_GET['action'];
}
if(isset($_POST['action'])){
    $action = $_POST['action'];
}

include "include/connect_db.php";
include "include/log.php";
include "include/functions.php";

switch($action){
    case 'admin_tools':

        $admin_action = 0;
        if(isset($_POST['admin_action'])){
            $admin_action = $_POST['admin_action'];
        }

        switch ($admin_action) {
            case 'block_ip':
                # code...
                break;

            case 'ban':
                $blog_id = 0;

                if(isset($_POST['selected'])){
                    $blog_id = mysqli_real_escape_string($opendb, $_POST['selected']);

                    $sql = "SELECT active FROM users WHERE super_id='$super_id'";
                    $result = mysqli_query($opendb, $sql);
                    $row = mysqli_fetch_assoc($result);

                    if($row['active'] == "true"){
                        $sql_blog = "UPDATE blogs SET active='false' WHERE blog_id='$blog_id'";
                        $sql_post = "UPDATE blog_post SET active='false' WHERE blog_id='$blog_id'";
                        $sql_comment = "UPDATE user_comment SET active='false' WHERE blog_id='$blog_id'";
                        $result = mysqli_query($opendb, $sql_blog);
                        $result_2 = mysqli_query($opendb, $sql_post);
                        $result_3 = mysqli_query($opendb,$sql_comment);

                        $_SESSION['deactivated'] = "The blog has been deactivated!";
                        header('Location: admin.php');

                    }elseif($row['active'] == "false"){
                        if(isset($_POST['selected'])){

                            $sql_blog = "UPDATE blogs SET active='true' WHERE blog_id='$blog_id'";
                            $sql_post = "UPDATE blog_post SET active='true' WHERE blog_id='$blog_id'";
                            $sql_comment = "UPDATE user_comment SET active='true' WHERE blog_id='$blog_id'";
                            $result = mysqli_query($opendb, $sql_blog);
                            $result_2 = mysqli_query($opendb, $sql_post);
                            $result_3 = mysqli_query($opendb,$sql_comment);

                            $_SESSION['deactivated'] = "The blog has been activated!";
                            header('Location: admin.php');
                        }else{

                            $_SESSION['wrong'] = "Something went wrong, please try again function!";
                            header('Location: admin.php');
                        }
                    }
                }
                break;

            case 'hide_show':
                $blog_id = 0;
                if(isset($_POST['selected'])){
                    $blog_id = mysqli_real_escape_string($opendb, $_POST['selected']);
                }

                $sql = "SELECT hidden FROM blogs WHERE blog_id='$blog_id'";
                $result = mysqli_query($opendb, $sql)
                or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
                $row = mysqli_fetch_assoc($result);

                if($row['hidden'] == "show"){
                    $sql_2 = "UPDATE blogs SET hidden='hide' WHERE blog_id='$blog_id'";
                    $result_ = mysqli_query($opendb, $sql_2)
                    or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
                    header("location: admin.php?page=my_account");
                }else{
                    $sql_2 = "UPDATE blogs SET hidden='show' WHERE blog_id='$blog_id'";
                    $result_2 = mysqli_query($opendb, $sql_2)
                    or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
                    header("location: admin.php?page=my_account");
                }   
                break;

            case 'deactivate_activate':

                $blog_id = 0;

                if(isset($_POST['selected'])){
                    $blog_id = mysqli_real_escape_string($opendb, $_POST['selected']);

                $sql = "SELECT active FROM blogs WHERE blog_id='$blog_id'";
                $result = mysqli_query($opendb, $sql);
                $row = mysqli_fetch_assoc($result);

                    if($row['active'] == "true"){
                        $sql_blog = "UPDATE blogs SET active='false' WHERE blog_id='$blog_id'";
                        $sql_post = "UPDATE blog_post SET active='false' WHERE blog_id='$blog_id'";
                        $sql_comment = "UPDATE user_comment SET active='false' WHERE blog_id='$blog_id'";
                        $result = mysqli_query($opendb, $sql_blog);
                        $result_2 = mysqli_query($opendb, $sql_post);
                        $result_3 = mysqli_query($opendb,$sql_comment);

                        $_SESSION['deactivated'] = "The blog has been deactivated!";
                        header('Location: admin.php');

                    }elseif($row['active'] == "false"){
                        if(isset($_POST['selected'])){

                            $sql_blog = "UPDATE blogs SET active='true' WHERE blog_id='$blog_id'";
                            $sql_post = "UPDATE blog_post SET active='true' WHERE blog_id='$blog_id'";
                            $sql_comment = "UPDATE user_comment SET active='true' WHERE blog_id='$blog_id'";
                            $result = mysqli_query($opendb, $sql_blog);
                            $result_2 = mysqli_query($opendb, $sql_post);
                            $result_3 = mysqli_query($opendb,$sql_comment);

                            $_SESSION['deactivated'] = "The blog has been activated!";
                            header('Location: admin.php');
                        }else{

                            $_SESSION['wrong'] = "Something went wrong, please try again function!";
                            header('Location: admin.php');
                        }
                    }
                }
                break;

            case 'configure_blog':
                # code...
                break;
            
            default:
                # code...
                break;
        }
        break;

    case 'hide_show':
        $blog_id = 0;
        $hide = 0;
        if(isset($_POST['blog_id'])){
            $blog_id = $_POST['blog_id'];
        }
        if(isset($_POST['hide'])){
            $hide = mysqli_real_escape_string($opendb,$_POST['hide']);
        }
        if(isset($_POST['show'])){
            $hide = mysqli_real_escape_string($opendb,$_POST['show']);
        }

        $sql = "UPDATE blogs SET hidden='$hide' WHERE blog_id='$blog_id'";
        $result = mysqli_query($opendb, $sql)
        or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
        header("location: user_blogs.php?page=my_account");
        break;

    case 'edit_post':
        $blog_id = 0;
        $title = 0;
        $post = 0;
        if(isset($_POST['text_content'])){
            $content = mysqli_real_escape_string($opendb,$_POST['text_content']);
            }
        if(isset($_POST['text_title'])){
            $title = mysqli_real_escape_string($opendb,$_POST['text_title']);
        }
        if(isset($_POST['blog_id'])){
            $blog_id = $_POST['blog_id'];
        }
        if(isset($_POST['post_id'])){
            $post_id = $_POST['post_id'];
        }

        $sql = "UPDATE blog_post SET post = '$content' WHERE post_id='$post_id'";
        mysqli_query($opendb,$sql)
        or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
        $_SESSION['post_edited'] = "Your post has been edited!";

        header("location: detailed_post.php?action=detailed&blog_id=$blog_id&post_id=$post_id");
        break;

    case 'settings':
        /*if(empty($_POST['blog_background'] && $_POST['post_background'] && $_POST['logo'] && !empty($_POST['blog_id']))){
            $_SESSION['wrong'] = "Please choose background or logo and try again!";
            header('Location: settings.php');
        }else{*/
            if(isset($_POST['current_username']) && !empty($_POST['current_username'] && $_POST['new_username'])){
            echo check_settings_change("change_username");
            }else{
                header('Location: settings.php');
            }

            if(isset($_POST['current_password']) && !empty($_POST['current_password'] && $_POST['new_password'])){
                echo check_settings_change("change_password");
            }else{
                header('Location: settings.php');
            }

            if(isset($_POST['current_email']) && !empty($_POST['current_email'] && $_POST['new_email'])){
                echo check_settings_change("change_email");
            }else{
                header('Location: settings.php');
            }

            if(isset($_POST['change_picture']) && !empty($_POST['change_picture'])){
                echo check_settings_change("change_picture");
            }else{
                header('Location: settings.php');
            }
            
            if(isset($_POST['text_content']) && !empty($_POST['text_content'])){
                echo check_settings_change("change_description");
            }else{
                header('Location: settings.php');
            }
            

            if(!empty($_POST['blog_background'] && $_POST['blog_id'])){
                echo check_settings_change("change_blog_background");
            }else{
                header('Location: settings.php');
            }

            if(!empty($_POST['logo'] && $_POST['blog_id'])){
                echo check_settings_change("change_logo");
            }else{
                header('Location: settings.php');
            }

            if(!empty($_POST['post_background'] && $_POST['blog_id'])){
                echo check_settings_change("change_post_background");
            }else{
                header('Location: settings.php');
            }

            if(!empty($_POST['delete_blog'] && $_POST['blog_id'])){
                echo check_settings_change("delete_blog");
            }else{
                header('Location: settings.php');
            }
            //}
        

        break;

    case 'create_comment':
        $blog_id = 0;
        $title = 0;
        $post_id = 0;
        if(isset($_POST['text_content'])){
            $content = mysqli_real_escape_string($opendb,$_POST['text_content']);
            }
        if(isset($_POST['blog_id'])){
            $blog_id = $_POST['blog_id'];
        }
        if(isset($_POST['post_id'])){
            $post_id = $_POST['post_id'];
        }
        if(isset($_GET['post_id'])){
            $post_id = $_GET['post_id'];
        }

        if(isset($_SESSION['user'])){
            $sql = "INSERT INTO user_comment(comment,super_id,blog_id,post_id)VALUES('$content','".$_SESSION['user']->Get_id()."','$blog_id','$post_id')";
            mysqli_query($opendb,$sql)
            or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
        }else{
            $sql = "INSERT INTO user_comment(comment,blog_id,post_id)VALUES('$content','$blog_id','$post_id')";
            mysqli_query($opendb,$sql)
            or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
        }
        $_SESSION['comment_created'] = "Your comment has been posted on the blog!";

        header("location: detailed_post.php?blog_id=$blog_id&post_id=$post_id&action=detailed");

        break;

    case 'create_post':
        $blog_id = 0;
        $title = 0;
        if(isset($_POST['text_content'])){
            $content = mysqli_real_escape_string($opendb,$_POST['text_content']);
            }
        if(isset($_POST['text_title'])){
            $title = mysqli_real_escape_string($opendb,$_POST['text_title']);
        }
        if(isset($_POST['blog_id'])){
            $blog_id = $_POST['blog_id'];
        }

        $sql = "INSERT INTO blog_post(post,title,super_id,blog_id)VALUES('$content','$title','".$_SESSION['user']->Get_id()."','$blog_id')";
        mysqli_query($opendb,$sql)
        or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));
        $_SESSION['post_created'] = "Your post has been published on you blog!";
        header("location: blog_post.php");
    
        break;

    case 'create_blog':
        if(isset($_POST['blog_name'])){
            if(isset($_POST['category'])){
                $category = $_POST['category'];
            }
            $clear = 0;
            $categories_array = array("About me","Animals","Culture","Fashion","Series & movies", "Sports", "Travels","Other");

            for ($i=0; $i < count($categories_array); $i++) { 
                if($categories_array[$i] == $category){
                    $clear = 1;
                    break;
                }else{
                    $clear = 0;
                }
            }
            if($clear == 1){
                $_SESSION['blog_created'] = "Your blog has been created, go to My account to find it!";

                $blog_name = mysqli_real_escape_string($opendb,$_POST['blog_name']);
                $sql_2 = mysqli_query($opendb,"SELECT MAX(blog_id) FROM blogs");
                $row = mysqli_fetch_assoc($sql_2);
                
                $result_id = $row['MAX(blog_id)'];
                $result_id = ($result_id + 1);
                

                $sql = "INSERT INTO blogs(blog_name,super_id,blog_id,category) VALUES('$blog_name','".$_SESSION['user']->Get_id()."','$result_id','$category')";
                mysqli_query($opendb,$sql)
                or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb));

                header("location: user_blogs.php");
            }else{
                header("location: create_blog.php");
                $_SESSION['wrong_category'] = "Wrong category given, please try again!";
            }
        }
        break;

    case 'log_me_out':
        $log_out = 0;
        $user_log_out = 0;

        if(isset($_GET['log_out'])){
            $log_out = $_GET['log_out'];
        }
        
        if($log_out == 1){
            log_to_file("log.log", "User " . $_SESSION['user']->Get_name() . " logged out");
            session_unset("my_blogger");
            session_destroy("my_blogger");

            header('Location: startpage.php');
        }
        break;

    case'check_login':
        $myusername = $_POST['username'];
        $str = $_POST['password'];

        $mypassword = md5($str);

        //För att skydda mot mysql injection
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        $myusername = mysqli_real_escape_string($opendb,$myusername);
        $mypassword = mysqli_real_escape_string($opendb,$mypassword);

        //Genom att använda BINARY så ser jag till att lösenordet och användarnamnet är case sensitive.
        $sql = "SELECT * FROM users WHERE username = '$myusername' AND BINARY password = BINARY '$mypassword'";
        
        $result = mysqli_query($opendb,$sql)
        or die("Kunde inte ansluta till MySQL:<br />" . mysql_error());

        //mysql_affected_rows kollar hur många rader som stämmer överens med de angiva uppgifterna.
        $row = mysqli_affected_rows($opendb);


        if($row == '0'){
            echo "Login failed, please try again";
            log_to_file("log.log", "Login failed by user $myusername");

            $_SESSION['wrong_pass_name'] = "Wrong username or password!";
            $_SESSION['wrong'] = '1';
            header('Location: startpage.php');
        }else{
            header('Location: startpage.php');
            log_to_file("log.log", "User $myusername logged in"); 
            $result_2 = mysqli_fetch_assoc($result);

            $_SESSION['user'] = new User($result_2['username'], $result_2['user_type'], $result_2['super_id']);
            }
            
            unset($action);
            mysqli_close($opendb);
        
        break;

    case'create_account':
        $username = mysqli_real_escape_string($opendb, $_POST['username']);
        $str = mysqli_real_escape_string($opendb, $_POST['password']);
        $email = mysqli_real_escape_string($opendb, $_POST['email']);

        $verified = 0;
        $wrong;
        //Krypterar lösenordet med md5
        $password = md5($str);
        
        $adr = $_SERVER['REMOTE_ADDR'];
        $sql_2 = mysqli_query($opendb,"SELECT MAX(super_id) FROM users");
        $row = mysqli_fetch_assoc($sql_2);
        
        var_dump($row['MAX(super_id)']);
        $result_id = $row['MAX(super_id)'];
        $result_id = ($result_id + 1);


        mysqli_query($opendb,"SELECT * FROM users WHERE username = '$username'")
        or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');
        $row = mysqli_affected_rows($opendb);

        if($row == '1'){
                $_SESSION['existing_username'] = "There is already an user with that username, please try another";
                $_SESSION['wrong'] = '1';
                header('Location: register.php?' . SID);
        }else{
                $sql = "INSERT INTO users(super_id,username,password,email,ip) VALUES('$result_id','$username','$password','$email','$adr')";
                mysqli_query($opendb,$sql)
                or die("Kunde inte ansluta till MySQL:<br />" . mysqli_error($opendb) . $wrong='1');

                if($wrong == '1'){
                        echo "Register failed, please try again after checking mysql database availability.";
                        log_to_file("log.log", "Account creation with username $username failed.");
                }else{
                        header('Location: startpage.php');
                        log_to_file("log.log", "Account $username has been created");
                }
            }
            session_destroy();
            unset($action);
            mysqli_close($opendb);
        break;

        default:
        echo "<h1>Error 404 page not found. Please try again!</h1>";
        break;
}