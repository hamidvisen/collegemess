<?php 
//   include("db.php");
 
//    $sql = "SELECT * FROM orders WHERE id='".$_POST['id']."'";
//    $query = mysqli_query($conn,$sql);
//    while($row = mysqli_fetch_assoc($query))
//    {
//          $data = $row;
//    }
//     echo json_encode($data);

  include("db.php");
 
   $sql = "SELECT * FROM `master_table` WHERE `product_id` ='".$_POST['id']."'";
   $query = mysqli_query($conn,$sql);
   $arr = array();
   $row = mysqli_fetch_assoc($query);
  //  tax_table.tax_rate, tax_table.tax_name, //INNER JOIN tax_table ON tax_table.id= $row[tax_id]
      $q = "SELECT product_table.product_name, category_table.category_name, product_table.product_price,  master_table.quantity FROM master_table INNER JOIN product_table ON product_table.id = master_table.product_id INNER JOIN category_table ON category_table.id = master_table.category_id WHERE product_table.id = '$row[product_id]' AND category_table.id = (SELECT category_id FROM `master_table` WHERE `product_id` = '$row[product_id]')";
      $result_query = mysqli_query($conn,$q);
      $data = mysqli_fetch_assoc($result_query);
      
        

    echo json_encode($data);

    

 ?>
