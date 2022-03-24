<?php 
  require_once("dbconfig.php");
  session_start();
  if(!isset($_SESSION['username'])){
    $_SESSION['error'] = "You must log in first";
    header("location: login.php");
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
        <h1>Insert doc</h1>
    </div>
    
    <form action="phpinsertdoc.php" method="POST">

        <div class ="d1">
            <label for="doc_num">เลขที่คำสั่ง</label>
            <input type="text" class="f1" name="doc_num" id="doc_num" required>
        </div>
        <div class ="d1">
            <label for="doc_title">ชื่อเอกสาร</label>
            <input type="text" class="f1" name="doc_title" id="doc_title" required>
        </div>

        <div class ="d1">
            <label for="start_date">วันที่เริ่มต้น</label>               
            <input type="date" class="f2" name="start_date" id="start_date" required>

        </div>
        <div class ="d1">
            <label for="end_date">วันหมดอายุ</label>               
            <input type="date" class="f2" name="end_date" id="end_date">
        </div>
        <div class ="d1">
            <label for="status">สถานะ</label>
            <input type="radio" class="f3" name="status" id="status" value="Active" checked > Active 
            <input type="radio" name="status" id="status" value="Expire" > Expire
        </div>
        <div class ="d1">
            <label for="document">เอกสาร</label>
            <input type="file" class="f1" name="document" id="document">
        </div>
        <div class="d1">
            <input type="submit" id="submit" value="submit">
            <input type="reset" class="ss" value="ล้างข้อมูล">
        </div>
        <div class="d1">
            <a href="showdoc.php">Home</a>
        </div>

    </form>
</body>
</html>