<?php
session_start();
include('conn.php');


//INSERT CODE
if (isset($_POST['addString'])) {
    
    $unitname = $_POST['unitname'];
    // echo $unitname ;
    $date = date("d-m-y");
    $check = "SELECT * FROM `unit_table` WHERE `unit_name`= '$unitname'";
   mysqli_query($conn, $check);
    
    if(mysqli_affected_rows($conn) != 0){
        echo(1);
    }
    else{
    $query = "INSERT INTO `unit_table`(`unit_name`, `added_by`, `added_on`, `status`) VALUES ('$unitname', '$_SESSION[user_name]', '$date','0')";
    mysqli_query($conn, $query);
    }
}

//READ CODE
if (isset($_POST['readrecord'])){
   
    $data = '<table id="table" class="table-hover table border shadow table-bordered  bg-light">
    <tr>
    <th>S.NO.</th>
    <th>unit NAME</th>
    <th>ADDED BY</th>
    <th>ADDED ON</th>
    <th>UPDATED BY</th>
    <th>UPDATED ON</th>
    <th>Edit Action </th>
    <th>Delete Action</th>
    </tr>';

    $query = "SELECT * FROM `unit_table` order by 'id' desc";
    $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result)>0){
    $num =1;
    while($res = mysqli_fetch_array($result)){
        $data .= '<tr><td>'.$num. '</td>
        <td>'. $res['unit_name'].'</td>
        <td>'. $res['added_by'].' </td>
        <td>'. $res['added_on'].' </td>
        <td>'. $res['updated_by'].' </td>
        <td>'. $res['updated_on'].' </td>
        <td><button onclick="getUnitDetails('.$res['id'].')" class="btn btn-warning">Edit</button> </td>
        <td><button onclick="deleteUnit('.$res['id'].')" class="btn btn-danger">Delete</button>  </td></tr>';
        $num++;
    
    } 
  } 
  $data .= '</table>';
  echo $data;

}

//DELETE CODE
if(isset($_POST['deleteid'])){
    $id = $_POST['deleteid'];
    $query = "DELETE FROM `unit_table` WHERE id = '$id'";
    mysqli_query($conn, $query);
}

//GET RECORD CODE

if(isset($_POST['get_string'])){

    $user_id = $_POST['id'];
    $query = "SELECT * FROM `unit_table` WHERE `id` = '$user_id' ";
    // if(!$result = mysqli_query($conn,$query)){
    //     exit(mysqli_error());
    // }
$result = mysqli_query($conn, $query);
    $response = array(); 
    if(mysqli_num_rows($result)>0){
     
        while($res = mysqli_fetch_assoc($result)){
            $response = $res;
        }
    }
    else{
            $response['message'] = "Data not found";
    
    }
    echo json_encode($response);
   
}

// UPDATE CODE 
if(isset($_POST['update_string']) ){
   
    $id = $_POST['userid'];
  
    $date = date("d-m-y");
    $update_unit_name = $_POST['update_unit_name'];
//    echo $update_unit_name ;
   $check = "SELECT * FROM `unit_table` WHERE `unit_name`= '$update_unit_name'";
    mysqli_query($conn, $check);
    
    if(mysqli_affected_rows($conn) != 0){
        echo(1);
    }
    else{

    $query = "UPDATE `unit_table` SET `unit_name`='$update_unit_name', `updated_by` = '$_SESSION[user_name]', `updated_on` = '$date' WHERE `id` = '$id'";
    mysqli_query($conn, $query);
   
    }
    

}

?> 