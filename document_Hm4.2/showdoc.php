<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <?php
            /* require_once("dbconfig.php");
                $sql = "SELECT *
                        FROM documents
                        WHERE id = 6
                ";
                $result= mysqli_query( $mysqli,$sql );
                $row=mysqli_fetch_assoc( $result);
                print_r ($row);*/

        ?>

        <h3><a href =insertdoc.html>Insert</a></h3>
        <h3><a href =showdata.php>Data staff</a></h3>
        <form action="#" method="post">
                <input type="text" name="kw" placeholder="Enter doc_num " value="">
                <input type="submit">
        </form>

        <?php
            require_once("dbconfig.php");
            @$kw = "%{$_POST['kw']}%";
            $sql = "SELECT *
                    FROM documents
                    WHERE concat(doc_num, doc_title) LIKE ? 
                    ORDER BY id";
 

            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("s", $kw);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                echo "Not found!";
            } else {
                echo "Found " . $result->num_rows . " record(s).";
            }
        ?>
        
        <br>

    
        <table class="table table-hover">
    
            <tr>
                <th>row</th>
                <th>doc_num</th>
                <th>doc_title</th>
                <th>start date</th>
                <th>end date</th>
                <th>status</th>
                <th>name_document</th>
                <th>ID</th>
                <th>ลบ</th>
                <th>เเก้ไข Doc</th>
                <th>เเก้ไข staff</th>
                
            </tr>
        
            <?php $i=1 ?>
            <?php while($row = $result->fetch_object()){  ?>
            <tr>
                <td><?php echo $i++ ;?></td>
                <td><?php echo $row->doc_num;?></td>
                <td><?php echo $row->doc_title;?> </td>
                <td><?php echo $row->doc_start_date;?></td>
                <td><?php echo $row->doc_to_date;?></td>
                <td><?php echo $row->doc_status;?></td>
                <td><?php echo $row->doc_file_name;?></td>
                <td><?php echo $row->id;?></td>
                <td><a href="deletedoc.php?id=<?php echo $row->id ;?>">delete</a></td>
                <td><a href="editdoc.php?id=<?php echo $row->id ;?>">edit doc</a></td>
                <td><a href="editselectstaff.php?id=<?php echo $row->id ;?>">edit staff</a></td>

            </tr>
            <?php } ?>
        </table>

   </div>


    
</body>
</html>