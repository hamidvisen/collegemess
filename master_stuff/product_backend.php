<?php
session_start();
include('conn.php');


//INSERT CODE
if (isset($_POST['addString'])) {
    
    $productname = $_POST['productname'];
    // echo $productname ;
    $date = date("d-m-y");
    $check = "SELECT * FROM `product_table` WHERE `product_name`= '$productname'";
   mysqli_query($conn, $check);
    
    if(mysqli_affected_rows($conn) != 0){
        echo(1);
    }
    else{
    $query = "INSERT INTO `product_table`(`product_name`,`added_by`, `added_on`, `status`) VALUES ('$productname','$_SESSION[user_name]','$date','0')";
    mysqli_query($conn, $query);
    }
}

//READ CODE
if (isset($_POST['readrecord'])){
   
    $data = '<table id="table" class="table-hover table border shadow table-bordered  bg-light">
    <tr>
    <th>S.NO.</th>
    <th>PRODUCT NAME</th>
    <th>ADDED BY</th>
    <th>ADDED ON</th>
    <th>UPDATED BY</th>
    <th>UPDATED ON</th>
    <th>Edit Action </th>
    <th>Delete Action</th>
    </tr>';

    $query = "SELECT * FROM `product_table` ORDER BY `id` DESC";
    $result = mysqli_query($conn, $query);
  
  if(mysqli_num_rows($result)>0){
    $num =1;
    while($res = mysqli_fetch_array($result)){
        $data .= '<tr><td class="text-center">'.$num. '</td>
        <td class="text-center">'. $res['product_name'].'</td>
        <td class="text-center">'. $res['added_by'].' </td>
        <td class="text-center">'. $res['added_on'].' </td>
        <td class="text-center">'. $res['updated_by'].' </td>
        <td class="text-center">'. $res['updated_on'].' </td>
        <td class="text-center"><button onclick="getProductDetails('.$res['id'].')" class="btn text-warning"><i class="fas fa-solid fa-pen-to-square"></i></button> </td>
        <td class="text-center"><button onclick="deleteProduct('.$res['id'].')" class="btn text-danger"><i class="fas fa-solid fa-trash-can"></i></button>  </td></tr>';
        $num++;
    
    } 
  } 
  $data .= '</table>';
  echo $data;

}

//DELETE CODE
if(isset($_POST['deleteid'])){
    $id = $_POST['deleteid'];
    $query = "DELETE FROM `product_table` WHERE id = '$id'";
    mysqli_query($conn, $query);
}

//GET RECORD CODE

if(isset($_POST['get_string'])){

    $user_id = $_POST['id'];
    $query = "SELECT * FROM `product_table` WHERE `id` = '$user_id' ";
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
    $update_product_name = $_POST['update_product_name'];
//    echo $update_product_name ;
   $check = "SELECT * FROM `product_table` WHERE `product_name`= '$update_product_name'";
    mysqli_query($conn, $check);
    
    if(mysqli_affected_rows($conn) != 0){
        echo(1);
    }
    else{

   echo $query = "UPDATE `product_table` SET `product_name`='$update_product_name', `updated_by`= '$_SESSION[user_name]', `updated_on` = '$date' WHERE `id` = '$id'";
    mysqli_query($conn, $query);
   
    }
    

}
// class="table table-bordered table-striped bg-light ml-5 mr-5">
?> 