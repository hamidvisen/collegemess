<?php 
  include("db.php");
 
   $sql = "SELECT * FROM sale_table WHERE id='".$_POST['id']."'";
   $query = mysqli_query($conn,$sql);
   while($row = mysqli_fetch_assoc($query))
   {
         $data = $row;
   }
    echo json_encode($data);
 ?>