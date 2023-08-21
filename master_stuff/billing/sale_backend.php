<?php
include('db.php');
if(isset($_POST['dateWise'])){
    $date = date('Y-m-d');
$q = "SELECT `product_id`, `category_id`, SUM(`quantity`), SUM(`total`) FROM `receipt_table` where `added_on` = '$date' GROUP BY `product_id`";
if ($result=mysqli_query($conn,$q)) {
    $arr = array();
    while($row = mysqli_fetch_array($result)){
        
        $arr[] = $row;
    }
// print_r($arr);
//     for($i=0; $i<sizeof($arr); $i++){
//         for($j=1; $j<sizeof($arr); $j++){
//             if($arr[$i]['product_id']==$arr[$j]['product_id']){
//                 echo $j;
//                 $arr[$i]['quantity'] +=  $arr[$j]['quantity'];
//                 $arr[$i]['total'] += $arr[$j]['total'];
//                 // unset($arr[$j]);
//                 array_splice($arr, $j, 1);
//                 print_r($arr);
//              }
//         }
//     }

    for($i=0; $i<sizeof($arr); $i++){
        $prod_id = $arr[$i]['product_id'];
        $cat_id = $arr[$i]['category_id'];
       $sql = "SELECT product_table.product_name, category_table.category_name FROM `product_table`, `category_table` WHERE product_table.id ='$prod_id'  AND category_table.id = '$cat_id'";
       $res =  mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
        $arr[$i]['product_id'] = $row[0];
        $arr[$i]['category_id'] =$row[1];

    }
    print_r(json_encode($arr));


}
}

if(isset($_POST['from']) && isset($_POST['to'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
 
     $query = "SELECT product_id, category_id, SUM(quantity), SUM(total) FROM receipt_table WHERE added_on BETWEEN '$from' AND '$to' GROUP BY product_id";
     if ($result=mysqli_query($conn,$query)) {
        $arr = array();
        while($row = mysqli_fetch_array($result)){
            
            $arr[] = $row;
        }
        // print_r($arr);
       
        // for($i=0; $i<sizeof($arr); $i++){
        //     for($j=1; $j<sizeof($arr); $j++){
        //         if($arr[$i]['product_id']==$arr[$j]['product_id']){
                   
        //             $arr[$i]['quantity'] +=  $arr[$j]['quantity'];
        //             $arr[$i]['total'] += $arr[$j]['total'];
        //             // unset($arr[$j]);
        //             array_splice($arr, $j, 1);
        //          }
        //     }
        // }
     
        for($i=0; $i<sizeof($arr); $i++){
            $prod_id = $arr[$i]['product_id'];
            $cat_id = $arr[$i]['category_id'];
           $sql = "SELECT product_table.product_name, category_table.category_name FROM `product_table`, `category_table` WHERE product_table.id ='$prod_id'  AND category_table.id = '$cat_id'";
           $res =  mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($res);
            $arr[$i]['product_id'] = $row[0];
            $arr[$i]['category_id'] =$row[1];
    
        }
        print_r(json_encode($arr));
    }

}


if(isset($_POST['bill_no'])){
    $bill=$_POST['bill_no'];
$query = "SELECT `product_id`, `category_id`, SUM(`quantity`), SUM(`total`) FROM `receipt_table` WHERE `bill_no`='$bill' GROUP BY `product_id`";
$res =mysqli_query($conn, $query);
$arr = array();
while($row = mysqli_fetch_array($res)){
    // array_splice($row, 1, 1);
    $arr[] = $row;
}

for($i=0; $i<sizeof($arr); $i++){
    $prod_id = $arr[$i]['product_id'];
    $cat_id = $arr[$i]['category_id'];
   
   $sql = "SELECT product_table.product_name, category_table.category_name FROM `product_table`, `category_table` WHERE product_table.id ='$prod_id'  AND category_table.id = '$cat_id'";
   $result =  mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    $arr[$i]['product_id'] = $row[0];
    $arr[$i]['category_id'] =$row[1];

}
echo(json_encode($arr));
}
?>
