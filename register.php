<?php 
session_start();
if(!session_start()){
    die('Session not started correctly.');
}
$query = $_SERVER['QUERY_STRING']; 
include('database-info.php'); 
if ($query=="action=submit" ){
    if($_POST('username') == ""){
        $_SESSION['invalidusername'] = true;
        echo('<script> window.open("register.php", self); </script>');
    }
    if (!preg_match("#^[a-zA-Z0-9]+$#", $_POST('username'))){
        $_SESSION['invalidusername'] = true;
        echo('<script> window.open("register.php", self); </script>');
    }
    if (!preg_match("#^[a-zA-Z0-9]+$#", $_POST('password'))){
        $_SESSION['invalidpassword'] = true;
        echo('<script> window.open("register.php", self); </script>');
        
    }
    $username = preg_replace( "/[^a-zA-Z0-9_]/", "", $_POST['username']);
    $password = preg_replace( "/[^a-zA-Z0-9_]/", "", $_POST['password']);
    $email = $_POST('email');
    if(strpos($email, '@') === FALSE){
        echo('<script> window.open("register.php", _self)');
        $_SESSION['invalidemail'] = true;
    }
    if(!$_SESSION['invalidusername'] && !$_SESSION['invalidpassword'] && !$_SESSION['invalidemail']){
        $_SESSION['successfulsignup'] = TRUE;
        echo('<script> window.open("login.php", _self); </script>');
    }
    $con = mysql_connect($SQL_Host, $SQL_UserName, $SQL_Password);
    if(!$con){ 
        die("Cannot connect to MySQL server." . mysql_error());
    }
    
     mysql_select_db($Database, $con);
    $checkuser = mysql_query("SELECT * FROM `users` WHERE `username` = \'$username\' LIMIT 0, 30");
    while($row = mysql_fetch_array($checkuser)){
        if($row['username'] == $username){
            $_SESSION['usertaken'] = true;
            echo('<script> window.open("register.php", _self); </script>');
        }
    }
            $hashedpass = password_hash($password, PASSWORD_DEFAULT);
            $entering = mysql_query("INSERT INTO `$SQL_Database`.`users` (`id`, `username`, `email`, `password`) VALUES (NULL, '$username', '$hashedpass', '$email');");
            echo("<script> window.open('login.php', '_self'); </script");
            if(! $entering){
                die("Could not enter data: " . mysql_error());
            }

    mysql_close($con);
}
    

?>
<!DOCTYPE HTML>
<!--
	Ion by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>

<head>
    <title>DJ For Us</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
    </noscript>
</head>

<body id="top">
    <!-- Header -->
    <header id="header" class="skel-layers-fixed">
        <h1><a href="#">*insert thing name here*</a></h1>
        <nav id="nav">
            <ul>
                <li><a href="no-sidebar.html">No Sidebar</a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- One -->
    <section id="one" class="wrapper style1">
        <header class="major">
            <h2>playit4.me</h2>
            <p>The easiest way to interact with your crowd</p>
        </header>
        <div class="container">
            <div class="row">
                <div class="4u">
                    <section class="special box">
                        <i class="icon fa-edit major"></i>
                        <script>
                                function validateForm() {
                                    var x = document.forms["myForm"]["fname"].value;
                                    if (x == null || x == "") {
                                        alert("Name must be filled out");
                                        return false;
                                    }
                                }
                            </script>
                        <form action="register.php?action=submit" method="post" name="register" id="register">
                            <h4><font size="10">Sign Up</font></h4>
                            <br>
                            <br>
                            <?php
                            if($_SESSION['invalidemail'] == TRUE){
                                echo('<p> Invalid email format. Please try again. </p>');
                                $_SESSION['invalidemail'] = FALSE;
                            }
                            if($_SESSION['invalidusername'] == TRUE){
                                echo('<br><p> Invalid username. Please keep them alphanumeric (a-z, 0-9)');
                                $_SESSION['invalidusername'] == FALSE;
                            }
                            if($_SESSION['usertaken']) {
                                echo('<p> That username is already taken </p>');
                                $_SESSION['usertaken'] = false;
                            }
                            ?>
                            <p>Username:</p>
                            <input type="text" name="username" id="username">
                            <br>
                            <p>Password:</p>
                            <input type="password" name="password" id="password">
                            <br>
                            <p>Email:</p>
                            <input type="text" name="email" id="email">
                            <br>
                            <br>
                            <input type="submit" value="Submit">
                        </form>
                        
                    </section>
                </div>
            </div>
        </div>
    </section>

</body>

</html>