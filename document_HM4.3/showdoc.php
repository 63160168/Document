<?php 
  require_once("dbconfig.php");
  session_start();
  if(!isset($_SESSION['username'])){
    $_SESSION['error'] = "You must log in first";
    header("location: login.php");
  }
  if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
   
    header("location: login.php");
  }


?>
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
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="color: rgb(51, 130, 219);"><?php  echo $_SESSION['username']; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
       
        <li><a href="showdata.php" style="color: rgb(51, 130, 219);" >Show Staff Data</a></li>
        <li><a href="#">link</a></li>
       
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="showdata.php?logout='1'" style="color: red;">logout</a></li>
        
    </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <div class="container">
      <?php if(isset($_SESSION['success'])) { ?>
              <div class="text-success">
                  <h5>
                      <?php
                      echo $_SESSION['success'];
                      unset($_SESSION['success']); 
                      ?>
                  </h5>
              </div>
      <?php }?>

      <p>Welcome <b class="text-success" ><?php  echo $_SESSION['username']; ?></b></p>
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
        <h4><a href =insertdoc.php><span class='glyphicon glyphicon-user'></span> | Insert Doc</a></h4>

        

        <form action="#" method="post">
                <input type="text" name="kw" placeholder="ค้นหา รห้สเอกสาร ชื่อเอกสาร " value="">
                <input type="submit">
        </form><br>

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
                <th>เเถว</th>
                <th>รห้สเอกสาร</th>
                <th>ชื่อเรื่องเอกสาร</th>
                <th>วันที่เริ่มเเต่งตั้ง</th>
                <th>วันหมดอายุ</th>
                <th>สถานะ</th>
                <th>ชื่อไฟล์</th>
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