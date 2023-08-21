<?php
session_start();
include('conn.php');

if(isset($_POST['getvalue'])){
$prod_name = $_POST['firstnum'];

$in =  implode(',', $prod_name);
$result_string = "'" . str_replace(',', "','", $in) . "'";


$query = "SELECT * from `master_table` where `product_id` IN (SELECT `id` from `product_table` where `product_name` IN ($result_string)) ORDER BY`product_id`";
// echo ($query);
$result = mysqli_query($conn, $query);

// $product_id_array = array();
// $category_id_array = array(); 
// $tax_id_array = array(); 
// $unit_id_array = array(); 
$result_array = array();

while($res = mysqli_fetch_array($result)){
    
    $result_query = "SELECT product_table.product_name, category_table.category_name, tax_table.tax_name, unit_table.unit_name, product_table.product_price, tax_table.tax_rate FROM master_table INNER JOIN product_table ON product_table.id = master_table.product_id INNER JOIN category_table ON category_table.id = master_table.category_id INNER JOIN tax_table ON tax_table.id = master_table.tax_id INNER JOIN unit_table ON unit_table.id WHERE product_table.id =  $res[product_id] AND category_table.id  = $res[category_id]  AND tax_table.id = $res[tax_id] AND unit_table.id = $res[unit_id]";
    // $product_id_array[] = $res['product_id'];
    // $category_id_array[] =  $res['category_id'];
    // $tax_id_array[] = $res['tax_id'];
    // $unit_id_array[] = $res['unit_id'];
    // $res1[] = mysqli_query($conn, $result_query);
    $res1 = mysqli_query($conn, $result_query);
     $row = mysqli_fetch_array($res1);
     $result_array[] = $row;
     echo json_encode($result_array);
        
    
}
// $in0 = implode(',',$product_id_array);
// $product_result_string = "'" . str_replace(',', "','", $in0) . "'";
// echo $product_result_string;
// $in1 = implode(',',$category_id_array);
// $category_result_string = "'" . str_replace(',', "','", $in1) . "'";
// $in2 = implode(',',$tax_id_array);
// $tax_result_string = "'" . str_replace(',', "','", $in2) . "'";
// $in3 = implode(',',$unit_id_array);
// $unit_result_string = "'" . str_replace(',', "','", $in3) . "'";

// echo  $result_query = "SELECT product_table.product_name, category_table.category_name, tax_table.tax_name, unit_table.unit_name, product_table.product_price, tax_table.tax_rate FROM master_table INNER JOIN product_table ON product_table.id IN ($product_result_string)  INNER JOIN category_table ON category_table.id IN ($category_result_string) INNER JOIN tax_table ON tax_table.id  IN ($tax_result_string) INNER JOIN unit_table ON unit_table.id IN ($unit_result_string)";

// $result =  array();
// for($i=0; $i<count($res1); $i++){
//     $result[] = mysqli_query($conn, $result_query);
// }
// $row = array();
// for($i=0; $i<count($result); $i++){
//     $row[]=mysqli_fetch_array($result[$i]);
    
// }


// echo json_encode($row);
}

if(isset($_POST['submit'])){
    $prod_value = $_POST['prod_value'];
    $cat_value = $_POST['cat_value'];
    $tax_value = $_POST['tax_value'];
    $unit_value = $_POST['unit_value'];
    $prod_price= $_POST['prod_price'];
    $quant_value = $_POST['quant_value'];
    $prod_total_price = $_POST['prod_total_price'];
    $discounted_amount = $_POST['discounted_amount'];
    $total_price = $_POST['total_price'];
    $bill = $_POST['bill'];
    $date= date('d-m-y');


    $query = "INSERT INTO `sale_table`(`product_name`,`bill`, `category_name`, `tax_name`, `unit_name`, `product_price`, `quantity`, `prod_total_price`, `quantity_value`, `total_price`, `added_by`, `added_on`, `status`) VALUES ('$prod_value', '$bill', '$cat_value','$tax_value','$unit_value','$prod_price','$quant_value','$prod_total_price','$discounted_amount','$total_price','$_SESSION[user_id]', '$date', '0')";
    $result = mysqli_query($conn, $query);
    
    }


if (isset($_POST['display0'])) {
        
    $query= "SELECT product_table.product_name FROM master_table INNER JOIN product_table ON master_table.product_id = product_table.id";
    $result = mysqli_query($conn, $query);
    $result_arr = array();
    while ($row = mysqli_fetch_array($result)) {
        $result_arr[] = $row;
    }
    echo json_encode($result_arr);
}

if (isset($_POST['display1'])) {
        
    $query= "SELECT category_table.category_name FROM master_table INNER JOIN category_table ON master_table.category_id = category_table.id";
    $result = mysqli_query($conn, $query);
    $result_arr = array();
    while ($row = mysqli_fetch_array($result)) {
        $result_arr[] = $row;
    }
    echo json_encode($result_arr);
}

if (isset($_POST['display2'])) {
        
    $query= "SELECT tax_table.taxname FROM master_table INNER JOIN tax_table ON master_table.tax_id = tax_table.id";
    $result = mysqli_query($conn, $query);
    $result_arr = array();
    while ($row = mysqli_fetch_array($result)) {
        $result_arr[] = $row;
    }
    echo json_encode($result_arr);
}

if (isset($_POST['display3'])) {
        
    $query= "SELECT unit_table.unit_name FROM master_table INNER JOIN unit_table ON master_table.unit_id = unit_table.id";
    $result = mysqli_query($conn, $query);
    $result_arr = array();
    while ($row = mysqli_fetch_array($result)) {
        $result_arr[] = $row;
    }
    echo json_encode($result_arr);
}

if(isset($_POST['readrecord'])){
    
    $query= "SELECT `id`, `product_name`, `bill`, `category_name`, `unit_name`, `product_price`, `quantity`, `prod_total_price`, `quantity_value`, `total_price`, `added_on` FROM `sale_table`";
    
    $result = mysqli_query($conn, $query);
     $arr = array(); 
     
    while($res = mysqli_fetch_array($result)){ 
       
        $arr[]=$res;
        
                 
        } 
      
    
      $query2 = "SELECT login_data.u_name from sale_table INNER JOIN login_data ON login_data.user_id =sale_table.added_by"; 
      $result2 = mysqli_query($conn, $query2); 
      while($row =  mysqli_fetch_array($result2))
      { array_push($arr, $row);
         
         } 
         print_r(json_encode($arr));
}
?>