<?php 
session_start();
$query = $_SERVER['QUERY_STRING']; 
include('database-info.php'); 
if ($query=="action=submit" ){ 
    
    if($_POST('username') == ""){
        $_SESSION('invalidusername') = true;
        echo('<script> window.open("register.php", self); </script>');
    }
    if (!preg_match("#^[a-zA-Z0-9]+$#", $_POST('username'))){
        $_SESSION('invalidusername') = true;
        echo('<script> window.open("register.php", self); </script>');
    }
    if (!preg_match("#^[a-zA-Z0-9]+$#", $_POST('password'))){
        $_SESSION('invalidpassword') = true;
        echo('<script> window.open("register.php", self); </script>');
        
    }
    $username = preg_replace( "/[^a-zA-Z0-9_]/", "", $_POST['username']);
    $password = preg_replace( "/[^a-zA-Z0-9_]/", "", $_POST['password']);
    $email = preg_replace( "/[^a-zA-Z0-9_@]/", "", $_POST['password']);
    if(strpos($email, '@') === FALSE){
        echo('<script> window.open("register.php", _self)');
        $_SESSION('invalidemail') = true;
    }
    if(!$_SESSION('invalidusername') && !$_SESSION('invalidpassword') && !$_SESSION('invalidemail')){
        $_SESSION('successfulsignup') = TRUE;
        echo('<script> window.open("login.php", _self); </script>');
    }
    $con = mysql_connect($SQL_Host, $SQL_UserName, $SQL_Password);
    if(!$con){ 
        die("Cannot connect to MySQL server." . mysql_error());
    }
    
     mysql_select_db($Database, $con);
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);
    $user_sql = mysql_query("SELECT * FROM `$SQL_Table` WHERE `username` = \'$username\' LIMIT 0, 30");
    while($row = mysql_fetch_array($user_sql)){
        if($row['username'] == $username){
            if($row['password'] == $hashedpass){
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $username;
                echo('<script> window.open("index.php", _self)');
            }
        }
    }
    mysql_close($con);
}
    
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
                         <?php
                            //state checks lol
                            if($_SESSION['loggedin'] == true){
                                echo("You're already logged in.");
                                echo('<input type="button" value="Sign Out" action="')
                            }
                            else{
                                echo('<form action="register.php?action=submit" method="post" name="register" id="register">
                            <h4><font size="10">Sign Up</font></h4>
                            <br>
                            <br>
                            <p>Username:</p>
                            <input type="text" name="username" id="username">
                            <br>
                            <p>Password:</p>
                            <input type="password" name="password" id="password">
                            <br>
                            <br>
                            <input type="submit" value="Submit" autofocus>
                        </form>')
                            }
                            if($_SESSION('invalidemail') == TRUE){
                                echo('<p> Invalid email format. Please try again. </p>');
                                $_SESSION('invalidemail') = FALSE;
                            }
                            if($_SESSION('invalidusername') == TRUE){
                                echo('<br><p> Invalid username. Please keep them alphanumeric (a-z, 0-9)');
                                $_SESSION('invalidusername') == FALSE;
                            }
                            if($_SESSION('usertaken')) {
                                echo('<p> That username is already taken </p>');
                                $_SESSION('usertaken') = false;
                            }
                            if($_SESSION('cred_invalid') == TRUE){
                                echo('<p>Your username/password combo is invalid </p>');
                                $_SESSION('cred_invalid') = FALSE;
                            }
                            ?>
                        <script>
                                function validateForm() {
                                    var x = document.forms["myForm"]["fname"].value;
                                    if (x == null || x == "") {
                                        alert("Name must be filled out");
                                        return false;
                                    }
                                }
                            </script>
                        
                        
                    </section>
                </div>
            </div>
        </div>
    </section>

</body>

</html>