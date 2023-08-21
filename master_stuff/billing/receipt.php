<?php
include('db.php');
if(isset($_POST['bill'])){

    $bill = $_POST['bill'];
    $mode = $_POST['mode'];
    $trans_id = $_POST['transaction_id'];
    $gross = $_POST['gross_arr'];
   $date =  date("Y-m-d");
   $time = date("H:i:s");
    for($i=0; $i<sizeof($_POST['product_name_arr']);$i++){
       $product_name = $_POST['product_name_arr'][$i];
       $category_name = $_POST['category_arr'][$i];
       $quantity =  $_POST['qty_arr'][$i];
       $total = $_POST['total_arr'][$i];

        $q = "SELECT product_table.id, category_table.id  FROM product_table, category_table WHERE product_table.product_name = '$product_name' AND category_table.category_name='$category_name'";
         
      $result= mysqli_query($conn, $q);
       $res = mysqli_fetch_array($result);
      
       echo $sql = "INSERT INTO `receipt_table`(`bill_no`, `payment_mode`, `transaction_id`, `product_id`, `category_id`, `quantity`, `total`, `gross`, `added_on`, `added_time`) VALUES ('$bill','$mode','$trans_id','$res[0]','$res[1]','$quantity','$total',' $gross', '$date', '$time')";
       mysqli_query($conn, $sql);

        }

    }
   

//     $product_name_arr = implode("','", $_POST['product_name_arr']);

//     // $tax_rate_arr = implode(",",$_POST['tax_rate_arr']);
//     // $tax_name_arr = implode(",",$_POST['tax_name_arr']);
//     $qty_arr = implode(",", $_POST['qty_arr']);
//     $total_arr = implode(",",$_POST['total_arr']);
//     $gross = $_POST['gross_arr'];
//     echo $qty_arr;
//     echo$total_arr;
//     echo $gross;
//     if($_POST['mode']=='cash'){
//         $transaction = $_POST['mode'];
//     }else{
//     $transaction = $_POST['mode']."(".$_POST['transaction_id'].")";
//     }
//     $time = $_POST['day'].$_POST['time'];

//      $q = "SELECT `id` from product_table where product_name IN ('$product_name_arr')";

//     $res = mysqli_query($conn, $q);
    
//     $arr = array();
//     while($row = mysqli_fetch_array($res)){
//        print_r($row);
//         $arr[] = $row;
//     }
//     $prod_name_stor = array();
   
// for($i=0; $i<count($arr); $i++){
//     $prod_name_stor[] = intval($arr[$i][0]);
// }
//  $prod = implode(",",$prod_name_stor);
//     $date = date('Y-m-d H:i:s');
//     $query = "INSERT INTO `receipt_table`(`bill`, `date`, `transaction`, `products`, `tax_rate`, `tax_name`, `quantity`, `total`, `gross_amount`) VALUES('$bill', '$date','$transaction', '$prod', '$tax_rate_arr', '$tax_name_arr', '$qty_arr', '$total_arr', '$gross')";

//     mysqli_query($conn, $query);
   
//    $sql = "SELECT `quantity` from `master_table` where `product_id` IN (select id from product_table where `product_name` IN ('$product_name_arr'))";
//    $result=mysqli_query($conn, $sql);
//    $master_quant_arr = array();
//    while($res = mysqli_fetch_array($result)){
// $master_quant_arr[] = $res;
//    }
//    print_r($master_quant_arr);
//    for($i=0; $i<count($arr); $i++){
//    echo $prod_id = $prod_name_stor[$i]; 
//     echo $master_quant_arr[$i][0]; echo '<br>';
//     echo "hamid";
//     echo (int)$_POST['qty_arr'][$i];echo '<br>';

//     $new=(int)$master_quant_arr[$i][0]- (int)$_POST['qty_arr'][$i];
// echo $new;
//    echo $update_sql ="UPDATE `master_table` SET `quantity`= '$new' WHERE `product_id` = $prod_id";
//     mysqli_query($conn, $update_sql);
// }
   

// }
?>
