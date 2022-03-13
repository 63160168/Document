<?php
require_once("dbconfig.php");

// ตรวจสอบว่ามีการ post มาจากฟอร์ม ถึงจะเพิ่ม
if ($_POST){
    $code = $_POST['stf_code'];
    $name = $_POST['stf_name'];

    // insert a record by prepare and bind
    // The argument may be one of four types:
    //  i - integer
    //  d - double
    //  s - string
    //  b - BLOB

    // ในส่วนของ INTO ให้กำหนดให้ตรงกับชื่อคอลัมน์ในตาราง actor
    // ต้องแน่ใจว่าคำสั่ง INSERT ทำงานใด้ถูกต้อง - ให้ทดสอบก่อน
    $sql = "INSERT 
            INTO staff (stf_code, stf_name) 
            VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $code, $name);
    $stmt->execute();

    // redirect ไปยัง actor.php
    header("location: showdata.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css1.css">
    <title>insert</title>
</head>
<body>
    <div class ="d0">
        <h1>Insert</h1>
    </div>
    
     <form action="insertstaff.php" method="POST">
       <div class ="d1">
            <label for="stf_code">stf code</label>
            <input type="text" class="f1" name="stf_code" id="stf_code" >
        </div> 
       
        <div class ="d1">
            <label for="stf_name">stf name</label>
            <input type="text" class="f1" name="stf_name" id="stf_name" required>
        </div>

        <div class="d1">
            <input type="submit" id="submit" value="submit">
            <input type="reset" class="ss" value="ล้างข้อมูล">
        </div>
        <div class="d1">
            <a href="showdata.php">Home</a>
        </div>

     </form>
</body>
</html>