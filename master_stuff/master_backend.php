<?php
include('conn.php');

// insert data
if (isset($_POST['submit']) && isset($_POST['first_input_value']) && isset($_POST['sec_input_value']) && isset($_POST['third_input_value']) && isset($_POST['fourth_input_value'])) {
    $submit = $_POST['submit'];

    $first_input_value = $_POST['first_input_value'];
    if ($_POST['len0'] != $_POST['num0']) {
        $date = date('d-m-y');
        $prod_insert_query =  "INSERT INTO `product_table`(`product_name`, `added_on`, `product_price`) VALUES('$first_input_value', '$date', $_POST[fifth_input_value])";
        mysqli_query($conn, $prod_insert_query);
       
    }
    $sec_input_value = $_POST['sec_input_value'];
    if ($_POST['len1'] != $_POST['num1']) {
        $date = date('d-m-y');
        $category_insert_query =  "INSERT INTO `category_table`(`category_name`, `added_on`) VALUES('$sec_input_value', '$date')";
        mysqli_query($conn, $category_insert_query);
    }
    $third_input_value = $_POST['third_input_value'];
    if ($_POST['len2'] != $_POST['num2']) {
        $date = date('d-m-y');
        $tax_insert_query =  "INSERT INTO `tax_table`(`tax_name`, `added_on`) VALUES('$third_input_value', '$date')";
        mysqli_query($conn, $tax_insert_query);
    }
    $fourth_input_value = $_POST['fourth_input_value'];
    // echo $fourth_input_value;
    if ($_POST['len3'] != $_POST['num3']) {
        $date = date('d-m-y');
        $unit_insert_query =  "INSERT INTO `unit_table`(`unit_name`, `added_on`) VALUES('$fourth_input_value', '$date')";
        mysqli_query($conn, $unit_insert_query);
    }

    $sql1 = "SELECT `id` FROM product_table WHERE `product_name` = '$first_input_value'";
    $sql2 = "SELECT `id` FROM category_table WHERE `category_name` = '$sec_input_value'";
    $sql3 = "SELECT `id` FROM tax_table WHERE `tax_name` = '$third_input_value'";
    $sql4 = "SELECT `id` FROM unit_table WHERE `unit_name` = '$fourth_input_value'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($result4);


    $query = "INSERT INTO `master_table`(`product_id`, `category_id`, `tax_id`, `unit_id`, `product_price`, `quantity`) VALUES ($row1[id], '$row2[id]', '$row3[id]', '$row4[id]', '$_POST[fifth_input_value]',  '$_POST[sixth_input_value]')";

    $date = date('Y-m-d H:i:s');
 $quantity_insert_query =  "INSERT INTO `stock_table`(`product_id`, `added_on`, `quantity`) VALUES('$row1[id]', '$date', '$_POST[sixth_input_value]')";
    mysqli_query($conn, $quantity_insert_query);

    $result = mysqli_query($conn, $query);
    echo $result;






    // echo $row1[0];
    // $result2 = mysqli_query($conn, $sql2);
    // $result3 = mysqli_query($conn, $sql3);
    // $result4 = mysqli_query($conn, $sql4);
    // $sql="insert into select2 (value) values('$select')";
    // $result=mysqli_query($conn,$sql);
    // if($result){
    //     echo 1;
    // }else{
    //     echo 0;
    // }
}


//READ RECORD
if (isset($_POST['readrecord'])) {

   $query =  "SELECT master_table.id, stock_table.quantity, product_table.product_price,
   product_table.product_name,
   category_table.category_name,
   tax_table.tax_name,
   unit_table.unit_name
   from master_table 
   INNER JOIN product_table ON product_table.id = master_table.product_id
   INNER JOIN category_table ON category_table.id = master_table.category_id
   INNER JOIN tax_table ON tax_table.id = master_table.tax_id
   INNER JOIN unit_table ON unit_table.id = master_table.unit_id INNER JOIN stock_table ON stock_table.product_id = master_table.product_id ORDER BY master_table.id DESC";
   
   $result = mysqli_query($conn, $query);
   $arr =array(); 
   while($res = mysqli_fetch_array($result)){
    
    array_push($arr, $res);
   }

   echo json_encode($arr);
}

    // $query = "SELECT * FROM `master_table`";
    
    // $result = mysqli_query($conn, $query);
    // $arr =array(); 
    // if (mysqli_num_rows($result) > 0) {
        // $num = 1;
        // while ($res = mysqli_fetch_array($result)) {
            // echo  $first_val;
            // echo $res['unit_id']; 

    //    echo  $query_repeat = "SELECT master_table.id, product_table.product_name, category_table.category_name, tax_table.tax_name, unit_table.unit_name FROM master_table INNER JOIN product_table ON product_table.id = $res[product_id] INNER JOIN category_table ON category_table.id = $res[category_id] INNER JOIN tax_table ON tax_table.id = $res[tax_id] INNER JOIN unit_table ON unit_table.id = $res[unit_id] ORDER BY master_table.id ";
        
//          print_r($result_repeat = mysqli_query($conn, $query_repeat));
         
//             $res1 = mysqli_fetch_array($result_repeat);
// print_r($res1);
// }
            //   print_r($result);
            // //   echo(mysqli_num_rows($result));
            // if(mysqli_num_rows($result)>0){
                    // $num =1;
                //   $res1 = mysqli_fetch_array($result_repeat);
                //         array_push($arr, $res1);
                //     }
    //         $data .= '<tbody><tr><td>' . $num . '</td>
    //             <td>' . $res1['product_name'] . '</td>
    //             <td>' . $res1['category_name'] . ' </td>
    //             <td>' . $res1['tax_name'] . ' </td>
    //             <td>' . $res1['unit_name'] . ' </td>
                
    //             <td><button onclick="getMasterDetails(' . $res['id'] . ')" class="btn btn-warning">Edit</button> </td>
    //             <td><button onclick="deleteMaster(' . $res['id'] . ')" class="btn btn-danger">Delete</button>  </td></tr>
                
    //            ';
    //         $num++;
    //     }
    // }
    // $data .= '</tbody></table>';
    // echo $data;
    
//     }
//     echo json_encode($arr);
// }




// }


// PRODUCT SHOW 
if (isset($_POST['display0'])) {
    $sql = "select `product_name` from product_table";
    $result = mysqli_query($conn, $sql);
    $result_arr = array();
    while ($row = mysqli_fetch_array($result)) {
        $result_arr[] = $row;
    }
    echo json_encode($result_arr);
}

// CATEGORY SHOW

if (isset($_POST['display1'])) {
    $sql = "select `category_name` from category_table";
    $result = mysqli_query($conn, $sql);
    $result_arr = array();
    while ($row = mysqli_fetch_array($result)) {
        $result_arr[] = $row;
    }
    echo json_encode($result_arr);
}

//TAX SHOW 
if (isset($_POST['display2'])) {
    $sql = "select `tax_name` from tax_table";
    $result = mysqli_query($conn, $sql);
    $result_arr = array();
    while ($row = mysqli_fetch_array($result)) {
        $result_arr[] = $row;
    }
    echo json_encode($result_arr);
}

// UNIT SHOW
if (isset($_POST['display3'])) {
    $sql = "select unit_name from unit_table";
    $result = mysqli_query($conn, $sql);
    $result_arr = array();
    while ($row = mysqli_fetch_array($result)) {
        $result_arr[] = $row;
    }
    echo json_encode($result_arr);
}


//DELETE CODE
if (isset($_POST['deleteid'])) {
    $id = $_POST['deleteid'];
    $query = "DELETE FROM `master_table` WHERE id = '$id'";
    mysqli_query($conn, $query);
}

//GET RECORD CODE

if (isset($_POST['get_string'])) {

    $user_id = $_POST['id'];
    // echo $user_id;
    $query = "SELECT * FROM `master_table` WHERE `id` = '$user_id' ";
    // if(!$result = mysqli_query($conn,$query)){
    //     exit(mysqli_error());
    // }
    $result = mysqli_query($conn, $query);
    $response = array();
    if (mysqli_num_rows($result) > 0) {

        while ($res = mysqli_fetch_assoc($result)) {
            $response = $res;
        }
    } else {
        $response['message'] = "Data not found";
    }
    //    print_r($response);

    $get_insert_query = "SELECT product_table.product_name, product_table.product_price, category_table.category_name, tax_table.tax_name, unit_table.unit_name, master_table.quantity FROM master_table INNER JOIN product_table ON product_table.id = master_table.product_id INNER JOIN category_table ON category_table.id = master_table.category_id INNER JOIN tax_table ON tax_table.id = master_table.tax_id INNER JOIN unit_table ON unit_table.id = master_table.unit_id WHERE product_table.id = '$response[product_id]' AND category_table.id = '$response[category_id]' AND tax_table.id = '$response[tax_id]' AND unit_table.id = '$response[unit_id]'";

    $get_result = mysqli_query($conn, $get_insert_query);
    $get_result_response = array();
    while ($res = mysqli_fetch_assoc($get_result)) {
        $get_result_response = $res;
    }
    echo json_encode($get_result_response);
}

// UPDATE CODE 
if (isset($_POST['update_string'])) {

    $id = $_POST['userid'];

    $date = date("d-m-y");
    $update_product_name = $_POST['update_product_name'];
    $update_category_name = $_POST['update_category_name'];
    $update_tax_name = $_POST['update_tax_name'];
    $update_unit_name = $_POST['update_unit_name'];
    $update_price_name = $_POST['update_price_name'];
    $update_quantity_name = $_POST['update_quantity_name'];
    

    //    echo $update_product_name ;
    $check = "SELECT * FROM `master_table` WHERE `id`= '$id'";
    $result = mysqli_query($conn, $check);
    // print_r($result);
    if ($res = mysqli_fetch_assoc($result)) {
        // echo $res['product_id'];
    echo $update_query = "UPDATE master_table, product_table, category_table, tax_table, unit_table, stock_table SET 
    master_table.quantity = '$update_quantity_name',
    product_table.product_name = '$update_product_name',
product_table.product_price = '$update_price_name',
	category_table.category_name = '$update_category_name',
    tax_table.tax_name = '$update_tax_name',
    unit_table.unit_name = '$update_unit_name',
    stock_table.quantity = '$update_quantity_name'
    
WHERE
master_table.product_id = $res[product_id]
 AND  product_table.id = $res[product_id]
   AND product_table.id = $res[product_id]
    AND category_table.id = $res[category_id]
    AND tax_table.id = $res[tax_id]
    AND unit_table.id = $res[unit_id]
    AND stock_table.product_id = $res[product_id]";
    }


    
    // else{

    // $query = "UPDATE `product_table` SET `product_name`='$update_product_name', `updated_on` = '$date' WHERE `id` = '$id'";
    $result =mysqli_query($conn, $update_query);
    if (mysqli_affected_rows($conn) != 0) {
        echo (1);
    }
    // }


}
