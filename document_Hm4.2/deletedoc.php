<?php
        require_once("dbconfig.php");

        if($_POST){
            $id = $_POST['id'];
            //echo $id;
            $sql = "DELETE
                    FROM documents
                    WHERE id=$id";


            $result= mysqli_query( $mysqli,$sql );
            header("location: showdoc.php");
        }else{
            
            $id = $_GET['id'];
            $sql = "SELECT *
                    FROM documents
                    WHERE id = ?";
        
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_object();
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
    <div class ="container">
    
    <h3>Delete</h3>
    <table class="table table-hover">
        <tr>
            <th>id</th>
            <td><?php echo $row->id;?></td>
        </tr>
        <tr>
            <th>doc_num</th>
            <td><?php echo $row->doc_num;?></td>
        </tr>
        <tr>
            <th>doc_title</th>
            <td><?php echo $row->doc_title;?></td>
        </tr>
        <tr>
            <th>start date</th>
            <td><?php echo $row->doc_start_date;?></td>
        </tr>
        <tr>
            <th>end date</th>
            <td><?php echo $row->doc_to_date;?></td>
        </tr>
        <tr>
            <th>status</th>
            <td><?php echo $row->doc_status;?></td>
        </tr>
        <tr>
            <th>name_document</th>
            <td><?php echo $row->doc_file_name;?></td>
        </tr>


    </table>
    <hr>
        
    <form action="deletedoc.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row->id;?>">
        <input type="submit" class="btn btn-danger" value="Confirm delete">

        <button type="button" class="btn btn-primary"  onClick="window.history.back()">Cancel Delete</button>

    </form>
    </div>
</body>
</html>