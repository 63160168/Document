<?php
/*
    //echo "Id = ".$_POST["id"]."<br>";
    echo "Doc_num = ".$_POST["doc_num"]."<br>";
    echo "Doc_title = ".$_POST["doc_title"]."<br>";
    echo "start_date = ".$_POST["start_date"]."<br>";
    echo "end_date = ".$_POST["end_date"]."<br>";
    echo "status = ".$_POST["status"]."<br>";
    echo "document = ".$_POST["document"]."<br>"; 
    //echo "judge = ".$_POST["judge"]."<br>";
*/
    //$Id = $_POST["id"];
    $Doc_num = $_POST["doc_num"];
    $Doc_title = $_POST["doc_title"];
    $start_date = $_POST["start_date"];
    $end_date = ($_POST["end_date"]== "") ? NULL : $_POST["end_date"];
    $status = $_POST["status"];
    $document = ($_POST["document"]== "") ? NULL : "'".$_POST["document"]."'";

    /*
    echo $Doc_num."<br>";
    echo $Doc_title."<br>"; 
    echo $start_date."<br>";
    echo $end_date."<br>";
    echo $status."<br>";
    echo $document."<br>";
    */



    require_once("dbconfig.php");
    session_start();
    if(!isset($_SESSION['username'])){
        $_SESSION['error'] = "You must log in first";
        header("location: login.php");
    }
    /*$sql ="INSERT 
            INTO documents(doc_num,doc_title,doc_start_date,doc_to_date,doc_status,doc_file_name)
            VALUES('$Doc_num','$Doc_title','$start_date','$end_date','$status','$document')";*/


    
    $sql = "INSERT 
    INTO documents(doc_num, doc_title, doc_start_date, doc_to_date, doc_status, doc_file_name) 
    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss", $Doc_num, $Doc_title, $start_date, $end_date , $status, $document);
    $stmt->execute();

    $sql ="SELECT *
            FROM documents
            WHERE doc_num = ?";
    
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $Doc_num);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_object();

    //print_r ($row);

    header("location: selectstaff.php?id=".$row->id);


    
    


?>