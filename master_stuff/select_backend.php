<?php
include('conn.php');

// insert data
if(isset($_POST['select'])){
    $select = $_POST['select'];
    $sql="insert into select2 (value) values('$select')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo 1;
    }else{
        echo 0;
    }
}

// select data
if(isset($_POST['display'])){
    $sql="select * from select2";
    $result=mysqli_query($conn,$sql);
    $result_arr=array();
    while($row=mysqli_fetch_array($result)){
        $result_arr[]=$row;
    }
    echo json_encode($result_arr);
}
?>