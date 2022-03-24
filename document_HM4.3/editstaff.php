<?php
require_once("dbconfig.php");


if ($_POST){
    $code = $_POST['stf_code'];
    $name = $_POST['stf_name'];
    $id = $_POST['id'];
    $username = $_POST['username'];
    $passwd = $_POST['password_1'];
    $passwd = md5($passwd);

    $sql = "UPDATE staff
            SET stf_code = ?, 
                stf_name = ?,
                username = ?,
                passwd = ?
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssi", $code, $name, $username, $passwd, $id);
    $stmt->execute();

    header("location: showdata.php");


} else {
    session_start();
    if(!isset($_SESSION['username'])){
        $_SESSION['error'] = "You must log in first";
        header("location: login.php");
    }
    
    $id = $_GET['id'];
    $sql = "SELECT *
            FROM staff
            WHERE id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
}
    /*
    $id = $_GET['id'];
    //echo $id;
    $sql = "SELECT *
            FROM documents
            WHERE id = $id";

    $result= mysqli_query( $mysqli,$sql );
    $row = $result->fetch_object();
    //print_r ($row);
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css1.css">
    <title>Document</title>
</head>
<body>
<div class ="d0">
        <h1>Edit</h1>
    </div>
    
     <form action="editstaff.php" method="POST">


        <div class ="d1">
            <label for="stf_code">stf code</label>
            <input type="text" class="f1" name="stf_code" id="stf_code" value="<?php echo $row->stf_code;?>" required>
        </div>
        <div class ="d1">
            <label for="stf_name">stf name</label>
            <input type="text" class="f1" name="stf_name" id="stf_name" value="<?php echo $row->stf_name;?>" required>
        </div>
        <div class ="d1">
            <label for="username">username</label>
            <input type="text" class="f1" name="username" id="username" value="<?php echo $row->username;?>" required>
        </div>
        <div class ="d1">
            <label for="password_1">Password</label>
            <input type="password"  name="password_1" id="password_1" onchange="checkPasswd()" required>
        </div>
        <div class ="d1">
            <label for="password_2">Confirm Password</label>
            <input type="password"  name="password_2" id="password_2" onchange="checkPasswd()"required>
        </div>
        <div class ="d1">
            <p  id="message"></p>
        </div>
 



        <div class="d1">
        <input type="hidden" name="id" value="<?php echo $row->id;?>">
        <input type="submit" id="submit" value="update">
        </div>
        <div class="d1">
            <a href="showdata.php">Home</a>
        </div>

     </form>
     <script>
         function checkPasswd() {
            password1 = document.getElementById("password_1").value;
            password2 = document.getElementById("password_2").value;
            //console.log(password1,password2);
                if(password1 == password2){
                    document.getElementById("message").innerHTML="<span style='color: green;'>Passwords match</span>";
                   // console.log("Passwords match");
                   
                }else{
                    document.getElementById("message").innerHTML="<span style='color: red;'>Password don't match</span>";
                   // console.log("Password don't match");
                    
                }
         }

     </script>
    
</body>
</html>