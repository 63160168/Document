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
<h3><a href =insertstaff.php>Insert</a></h3>
<h3><a href =showdoc.php>Data doc</a></h3>

<form action="#" method="post">
            <input type="text" name="kw" placeholder="Enter stf_code" value="">
            <input type="submit">
</form>

    <?php
        require_once("dbconfig.php");
        @$kw = "%{$_POST['kw']}%";
        
        $sql = "SELECT *
        FROM staff
        WHERE concat(id ,stf_code, stf_name) LIKE ? 
        ORDER BY id";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $kw);
        $stmt->execute();
        $result = $stmt->get_result();
        

        /*
        $sql = "SELECT *
        FROM staff";
        $result= mysqli_query( $mysqli,$sql );
        */

        if ($result->num_rows == 0) {
            echo "Not found!";
        } else {
            echo "Found " . $result->num_rows . " record(s).";
        }

    ?>
        <table class="table table-hover" >
       
        <tr>
            <th>row</th>
            <th>stf_code</th>
            <th>stf_name</th>
            <th>id</th>
            <th>ลบ</th>
            <th>เเก้ไข</th>
            
        </tr>
        
        <?php $i=1 ?>
        <?php while($row = $result->fetch_object()){  ?>
        <tr>
            <td><?php echo $i++ ;?></td>
            <td><?php echo $row->stf_code;?></td>
            <td><?php echo $row->stf_name;?> </td>
            <td><?php echo $row->id;?></td>
 
            <td><a href="deletestaff.php?id=<?php echo $row->id ;?>">delete</a></td>
            <td><a href="editstaff.php?id=<?php echo $row->id ;?>">edit</a></td>

        </tr>
        <?php } ?>



        </div>
</body>
</html>