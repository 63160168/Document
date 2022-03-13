<?php
require_once("dbconfig.php");


if ($_POST){
    $code = $_POST['stf_code'];
    $name = $_POST['stf_name'];
    $id = $_POST['id'];

    $sql = "UPDATE staff
            SET stf_code = ?, 
                stf_name = ?
            WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssi", $code, $name, $id);
    $stmt->execute();

    header("location: showdata.php");


} else {
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


        <div class="d1">
        <input type="hidden" name="id" value="<?php echo $row->id;?>">
        <input type="submit" id="submit" value="update">
        </div>
        <div class="d1">
            <a href="showdata.php">Home</a>
        </div>

     </form>
    
</body>
</html>