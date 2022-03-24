<?php
    session_start();
    require_once("dbconfig.php");

    $errors =array();
    if(isset($_POST['login_user'])){
        $username =  $_POST['username'];
        $password = $_POST["password"];

        if(empty($username)){
            array_push($errors,"Username is required");
        }
        if(empty($password)){
            array_push($errors,"password is required");
        }
        if(count($errors) == 0){
            $password = md5($password);
            $sql ="SELECT * 
            FROM staff 
            WHERE username = ? AND passwd = ?";

            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ss",$username,$password );
            $stmt->execute();
            $result = $stmt->get_result();
            
            if(mysqli_num_rows($result)==1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Your are now logged in";
                header("location: showdoc.php");
            } else{
                array_push($errors, "Wrong username/password combination");
                $_SESSION['error'] = "Wrong username or password try again!";
                header("location: login.php");
            }
        }else{
            $_SESSION['error'] = "Username and password are required";
            header("location: login.php");
        }
    }



?>