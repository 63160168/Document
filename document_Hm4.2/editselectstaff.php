<?php
require_once("dbconfig.php");

if($_POST){
    $id = $_POST['id'];
    $sql ="DELETE
           FROM doc_staff
           WHERE doc_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();



    @$staff_id = $_POST['staff_id'];
    //@$kw = "%{$_POST['kw']}%";

    if(!empty($staff_id)){
        for($i=0 ; $i<count($staff_id); $i++){
            $sql = "INSERT
                    INTO doc_staff (doc_id, stf_id)
                    VALUES(?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ss", $id, $staff_id[$i]);
            $stmt->execute();
            
            
        }
    }
    header("location: showdoc.php");

}else{
    $doc_id = $_GET['id'];
    $sql ="SELECT *
            FROM documents
            WHERE id = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $doc_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();
    //echo "<h4>".$row->doc_num." ".$row->doc_title."</h4>";
    $name = $row->doc_num." ".$row->doc_title;


    $sql = "SELECT *
            FROM staff LEFT JOIN (SELECT * FROM doc_staff WHERE doc_id = ?) ds ON staff.id = ds.stf_id
            ORDER BY staff.id";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $doc_id);
    $stmt->execute();
    $result = $stmt->get_result();
  
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
<h4><?php echo $name;?></h4>
<hr>
<form action="editselectstaff.php" method ="POST">
    <input type="hidden" name="id" value="<?php echo $doc_id;?>">
    <?php while($row = $result->fetch_object()){ ?>
    <div class ="">
        <label>
            <input type ="checkbox" name="staff_id[]" <?php if ($row->doc_id <> null) echo "checked";?>
            value ="<?php echo $row->id;?>">
            <?php echo $row->stf_name; ?>
        </label>
        </div>

    <?php } ?>
    <input type="submit" class="btn btn-primary">
    <br><br><a href="showdoc.php">Home</a>
    
</form>
<div>
<hr>

    
</body>
</html>

