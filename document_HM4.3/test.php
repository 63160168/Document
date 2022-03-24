<?php

if ($_POST){
    $name = $_POST['file'];
    echo $name;


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css0.css">
    <title>insert</title>
</head>
<body>
  
    <div class ="d0">
        <h1>Insert</h1>
    </div>
    <form action="test.php" method="POST">   
        <div class ="d1">
            <label for="file">file</label>
            <input type="file" class="f1" name="file" id="file" >
        </div>

        <div class="d1">
            <input type="submit" id="submit" value="submit">
            <input type="reset" class="ss" value="ล้างข้อมูล">
        </div>
        <div class="d1">
            <a href="test.php">Home</a>
        </div>
     </form>

</body>
</html>