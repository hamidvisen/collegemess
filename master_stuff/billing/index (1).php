<?php
include("db.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">

   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"> -->
   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script> -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <title>Document</title>
   <style>
      .result {
         color: red;
      }

      td {
         text-align: center;
      }

      @media (min-width: 1200px) {
         .container {
            max-width: 1000px !important;
         }
      }
   </style>
</head>

<body>

   <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> -->

   <?php
   include('../pages/navigation.php');

   ?>


   <section class="mt-3">
      <div class="container">
         <h4 class="text-center text-uppercase" style="color:green">Sale Entry</h4>
         <h6 class="text-center "> Sanjay Rungta Group of Institution</h6>

         <div class="col  mt-4 ">
            <table class="table" style="background-color:#f5f5f5;">
               <thead>
                  <tr>
                     <th>No.</th>
                     <th>Meal Items</th>
                     <th style="width: 31%">Qty</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td scope="row">1</td>
                     <td style="width:60%">
                        <select name="vegitable" id="vegitable" class="form-control">
                           <option disabled selected>product name</option>
                           <?php
                           $sql = "SELECT `id`, `product_name` from `product_table` where `id` IN (SELECT product_id FROM `master_table`) order by `id`";
                           $query = mysqli_query($conn, $sql);
                           while ($row = mysqli_fetch_assoc($query)) {
                           ?>
                              <option id="<?php echo $row['id']; ?>" value="<?php echo $row['product_name']; ?>" class="vegitable custom-select">
                                 <?php echo $row['product_name']; ?>
                              </option>
                           <?php  } ?>
                        </select>
                     </td>
                     <td style="width:1%">
                        <input type="number" id="qty" min="0" placeholder="0" class="form-control" onkeyup="check_quant()">
                        <span id="quant_show" class="text-warning"></span>
                     </td>
                     <td>
                        <p id="price"></p>
                        <input type="hidden" id="category_id">
                        <!-- <input type="hidden" id="tax_name"> -->
                        <input type="hidden" id="quantity">
                     </td>
                     <td><button id="add" class="btn btn-primary">Add</button></td>
                  </tr>
               </tbody>
            </table>
            <div role="alert" id="errorMsg" class="mt-5">
               <!-- Error msg  -->
            </div>
         </div>

         <!-- receipt table -->
         <div class="col  mt-4" style="background-color:#f5f5f5;">
            <div class="p-4">
               <div class="text-center">
                  <h4>Receipt</h4>
               </div>

               <div class="d-flex flex-row">
                  <div class="col-xs-6 col-sm-6 col-md-6 ">
                     <div class="d-flex">
                        <h5 class="mr-1" style="flex-shrink: 0;"><strong>Payment Mode: ₹</strong></h5>
                        <div><Select id="payment_mode" class="mr-1" name='select_mode'>
                              <option disabled selected>Mode</option>
                              <option value="cash">Cash</option>
                              <option value="online">Online</option>
                           </Select>
                           <br>
                           <label class="error" id="select_error" style="color:#FC2727">
                              <b> Warning : You have to Select One Item.</b>
                           </label>
                        </div>
                        <input class="text-center" id="payment_mode_input" type="hidden" placeholder="Enter Transaction ID" style="padding:0px; height:4vh;">
                     </div>
                     <span class="mt-4"> Time : </span><span class="mt-4" id="time"></span><br>
                     <span id="day"></span> : <span id="year"></span>
                  </div>
                  <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                     <button onclick="view()" name="sub" class="btn btn-primary text-uppercase">Receipt Generate</button>
                     <p id="order">Order No:</p>

                  </div>
               </div>
               <div class="row">
                  </span>
                  <table id="receipt_bill" class="table">
                     <thead>
                        <tr class="text-center">
                           <!-- <th> No.</th> -->
                           <th>Product Name</th>
                           <th>Category Name</th>
                           <th>Quantity</th>

                           <th>Price</th>
                           <!-- <th>Tax</th> -->


                           <th>Operation</th>
                           <th>Total</th>
                        </tr>
                     </thead>
                     <tbody id="new"></tbody>
                     <tr>
                        <!-- <td> </td> -->
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <!-- <td class="text-right text-dark">
                           <h5><strong>Sub Total: ₹ </strong></h5>
                           <p><strong>Tax (5%) : ₹ </strong></p>
                        </td> -->

                        <td class="text-center text-dark">
                           <h5> <strong><span id="subTotal"></strong></h5>
                           <h5> <strong><span id="taxAmount"></strong></h5>
                        </td>
                     </tr>
                     <tr>
                        <!-- <td></td> -->
                        <td></td>
                        <td> </td>
                        <td> </td>
                        <td></td>
                        <td class="text-right text-dark">
                           <h5><strong>Gross Total: ₹ </strong></h5>
                        </td>
                        <td class="text-center text-danger">
                           <h5 id="totalPayment"><strong> </strong></h5>

                        </td>
                     </tr>

                  </table>
               </div>
            </div>
         </div>

   </section>
   <div class="modal fade" id="update_master_modal">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
               <h4 class="modal-title text-uppercase">Change Quantity</h4>
               <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <div class="d-flex">
                  <div class="form-group col-md-12">
                     <label>Quantity:</label>
                     <input type="number" class="form-control" name="update_quantity_name" id="update_quantity_input">
                     <span id="update_quant_show" class="text-warning"></span>
                     <input type="hidden" id="hidden_input"></input>
                     <span id="update_quantity_select_alert" class="text-danger"></span>
                  </div>

               </div>




               <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-success" id="update_save" onclick="updateQuantityDetails()">Save</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
               <input type="hidden" name="" id="hidden_qunatity_id">
            </div>
         </div>
      </div>
   </div>





  
</body>

</html>
<script>
   var product_name_arr = [];
   // var tax_rate_arr = [];
   // var tax_name_arr = [];
   var category_arr = [];
   var qty_arr = [];
   var total_arr = [];
   // var gross_arr = [];
   var qty_id = 1;
   var check_arr = [];

   function check_quant() {

      var check_str = parseInt($('#qty').val());
      var checker = parseInt($('#quantity').val());

      if ($('#vegitable').val() == null) {
         Swal.fire({
            title: 'Select product',
            width: 500,
            background: '#caf0f8',
            showClass: {
               popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
               popup: 'animate__animated animate__fadeOutUp'
            }

         })



         $('#quant_show').html('');

      } else if (check_str > checker) {
         //       Swal.fire({
         //     title: `Availabale quantity is  ${$('#quantity').val()}`,
         //     width: 500,
         //     background: '#caf0f8',
         //     showClass: {
         //     popup: 'animate__animated animate__fadeInDown'
         //   },
         //   hideClass: {
         //     popup: 'animate__animated animate__fadeOutUp'
         //   }

         // })
         $('#quant_show').html('Availabale quantity is  ' + $('#quantity').val());
         document.getElementById('add').style.pointerEvents = 'none';
      } else {
         $('#quant_show').html('');
         document.getElementById('add').style.pointerEvents = 'auto';
      }


   }








   $(document).ready(function() {
      $('#vegitable').change(function() {
         var id = $(this).find(':selected')[0].id;
         $.ajax({
            method: 'POST',
            url: 'fetch_product.php',
            data: {
               id: id
            },
            dataType: 'json',
            success: function(data) {
               $('#price').text(data.product_price);
               $('#category_id').val(data.category_name);
               // $('#tax_name').val(data.tax_name);
               $('#quantity').val(data.quantity);
               //$('#qty').text(data.product_qty);
            }
         });
      });
      // var res_arr = new Array();


      //add to cart 
      var count = 1;

      $('#add').on('click', function() {

         var name = $('#vegitable').val();
         var qty = $('#qty').val();
         var price = $('#price').text();
         var category = $('#category_id').val();
         // var per_rate = $('#tax_rate').val();
         // var tax_name = $('#tax_name').val();

         if (jQuery("select[name=vegitable]").val() == null) {

            // jQuery("label#select_error").show(); // show Warning 
            // jQuery("select#payment_mode").focus();  // Focus the select box      
            return false;
         }

         if (qty == 0) {
            var erroMsg = '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
            $('#errorMsg').html(erroMsg).fadeOut(9000);
         } else {

            if (check_arr.length == 0) {
               billFunction();
               check_arr.unshift(name);
               return true;
            } else {
               // alert(check_arr.length);
               for (let i = 0; i < check_arr.length; i++) {
                  //  alert(i);
                  if (check_arr[i] == name) {
                     Swal.fire({
                        title: 'you have added the product',
                        width: 500,
                        background: '#caf0f8',
                        showClass: {
                           popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                           popup: 'animate__animated animate__fadeOutUp'
                        }

                     });
                     return true;
                  }

               }
               billFunction();
               check_arr.unshift(name);
               // Below Function passing here 
            }
         }

         function billFunction() {
            var total = 0;

            $("#receipt_bill").each(function() {
               // var total = Math.round(price * qty + parseFloat(price * qty * (per_rate / 100)));
               var total = Math.round(price * qty);

               var subTotal = 0;
               subTotal += total;
               // <td>' + count + '</td>
               // <td>' + per_rate + '%' + '(' + tax_name + ')' + '</td>
               var table = '<tr id=' + qty_id + '><td>' + name + '</td><td>' + category + '</td><td id="num' + qty_id + '" onclick="func(' + qty_id + ')">' + qty + '</td><td id="price' + qty_id + '">' + price + '</td><td><button onclick="deleteRow(' + qty_id + ')" class="btn text-danger"><i class="fas fa-solid fa-trash-can"></i></button></td><td id="total' + qty_id + '"><strong><input type="hidden" id="total" value="' + total + '">' + total + '</strong></td></tr>';

               $('#new').append(table);

               // localStorage.setItem(qty_id, table);

               //  arr.push(name,qty,per_rate,total);
               product_name_arr.push(name);
               // tax_rate_arr.push(per_rate);
               // tax_name_arr.push(tax_name);
               category_arr.push(category);
               qty_arr.push(qty);
               total_arr.push(total);
               qty_id += 1;
               // localStorage.setItem('size', qty_id);

               // Code for Sub Total of Vegitables 
               var total = 0;
               $('tbody tr td:last-child').each(function(i) {
                  var value = parseFloat($('#total'+(i+1)).text());
                  if (!isNaN(value)) {
                     total += value;
                  }
               });
               // $('#subTotal').text(total);

               // Code for calculate tax of Subtoal 5% Tax Applied
               // var Tax = (total * 5) / 100;
               // $('#taxAmount').text(Tax.toFixed(2));

               // Code for Total Payment Amount

               //  var Subtotal = $('#subTotal').text();
               //  var taxAmount = $('#taxAmount').text();

               //  var totalPayment = parseFloat(Subtotal) + parseFloat(taxAmount);
               var totalPayment = parseFloat(total);
               $('#totalPayment').text(totalPayment.toFixed(2)); // Showing using ID 
               //  arr.push(totalPayment);
               //  res_arr.push(arr);
               // localStorage.setItem("total"+qty_id, total);
               // localStorage.setItem('gross_total', totalPayment);
               // gross_arr.push(totalPayment);

            });
            count++;
         }

      });

      // Code for year 

      var currentdate = new Date();
      var datetime = currentdate.getDate() + "/" +
         (currentdate.getMonth() + 1) + "/" +
         currentdate.getFullYear();
      $('#year').text(datetime);

      // Code for extract Weekday     
      function myFunction() {
         var d = new Date();
         var weekday = new Array(7);
         weekday[0] = "Sunday";
         weekday[1] = "Monday";
         weekday[2] = "Tuesday";
         weekday[3] = "Wednesday";
         weekday[4] = "Thursday";
         weekday[5] = "Friday";
         weekday[6] = "Saturday";

         var day = weekday[d.getDay()];
         return day;
      }
      var day = myFunction();
      $('#day').text(day);
   });
</script>

<!-- // Code for TIME -->
<script>
   window.onload = displayClock();

   function displayClock() {
      var time = new Date().toLocaleTimeString();
      document.getElementById("time").innerHTML = time;
      setTimeout(displayClock, 1000);
   }

   // validation for payment mode
   jQuery(function() {
      jQuery('.error').hide(); // Hide Warning Label. 
      //  alert(document.cookie);
      // $('$new').html(document.cookie);

   });


   //Code for payment mode
   var e = document.getElementById("payment_mode");

   function onChange() {
      //   var value = e.value;
      //   var text = e.options[e.selectedIndex].text;

      if (e.value == "online") {

         $("#payment_mode_input").attr('type', 'text');
      } else {
         $("#payment_mode_input").attr('type', 'hidden');
      }
   }
   e.onchange = onChange;
   $("#payment_mode_input").click(function() {

      $("#payment_mode_input style").text(function(index, text) {
         return text.replace('#payment_mode_input::placeholder{color:red; text-transform: uppercase;}');
      });
   });

   //code for view
   var n = 1;
   var date = new Date();
   var d = date.getDate();
   var bill = '';

   // localStorage.clear();
   var order = "Order No: " + localStorage.getItem('lastBill');
   $('#order').html(order);

   //code for refresh storage
   // var size = localStorage.getItem('size');
   // for (let i = 1; i < size; i++) {
   //    $('#new').append(localStorage.getItem(i));

   // }
   // $('#totalPayment').text(localStorage.getItem('gross_total'));



   function view() {

      if ($('#new').text().trim() == '') {
         alert("Please select a product");
         return false;
      }

      
      var transaction_id = $("#payment_mode_input").val();
      var mode = "";
      var order = "Order No: " + bill;
      $('#order').html(order);
      if (e.value == 'online') {
         mode = "online";
         if (transaction_id.trim() == '') {
            $('#payment_mode_input').append('<style>#payment_mode_input::placeholder{color:red; text-transform: uppercase;}</style>');
            return;
         }

      } else {
         mode = "cash";
      }

      var gross_arr = $('#totalPayment').text();

      if (localStorage.getItem('lastDate') != date.getDate()) {

         if (localStorage.getItem('lastDate') == null) {
            n = 1;
            // alert("hamid");
            localStorage.setItem('lastDate', date.getDate());
            var bill = String(date.getFullYear()) + String((date.getMonth() + 1)) + String(date.getDate()) + String(n);
            localStorage.setItem('lastBill', bill);

         } else {
            n = 1;
            // alert("nhi k else chal rha h");
            localStorage.setItem('lastDate', date.getDate());
            var bill = String(date.getFullYear()) + String((date.getMonth() + 1)) + String(date.getDate()) + String(n);
         }
      } else {
         if (localStorage.getItem('lastBill') == null) {
            n = 1;
            // alert("else k if chal rha h");
            var bill = String(date.getFullYear()) + String((date.getMonth() + 1)) + String(date.getDate()) + String(n);
            localStorage.setItem('lastBill', bill);

         } else {
            n = parseInt(localStorage.getItem('lastBill').slice(7)) + 1;

            localStorage.setItem('lastDate', d);
            var bill = String(date.getFullYear()) + String((date.getMonth() + 1)) + String(date.getDate()) + String(n);
            n++;
            localStorage.setItem('lastBill', bill);

         }
      }

      if (jQuery("select[name=select_mode]").val() == null) {

         jQuery("label#select_error").show(); // show Warning 
         jQuery("select#payment_mode").focus(); // Focus the select box      
         return false;
      }






      $.ajax({
         url: 'receipt.php',
         type: 'POST',
         async: "false",
         data: {
            mode: mode,
            bill: bill,
            product_name_arr: product_name_arr,
            // tax_rate_arr: tax_rate_arr,
            // tax_name_arr: tax_name_arr,
            category_arr: category_arr,
            qty_arr: qty_arr,
            total_arr: total_arr,
            gross_arr: gross_arr,
            transaction_id: transaction_id,
            time: $('#time').text(),
            day: $('#day').text(),
         },

         success: function() {
         

            Swal.fire({
               //   position: 'top-end',
               icon: 'success',
               title: 'Your work has been saved',
               showConfirmButton: false,
               timer: 1500
            })
            setTimeout(function() {
               location.reload();
            }, 1500);


         }

         
      })

      //clear localStorage refresh
      // for (let i = 1; i < size; i++) {
      //          localStorage.removeItem(i);
      //       }
      //       localStorage.removeItem('gross_total');
      localStorage.setItem('lastBill', bill);

   }
   // code for update in quantity


   function func(id) {
      $('#update_master_modal').modal('show');
      $('#update_quantity_input').val($('#num' + id).html());
      $('#hidden_input').val(id);

   }

   function updateQuantityDetails() {
      var check_str = parseInt($('#update_quantity_input').val());
      var checker = parseInt($('#quantity').val());

      if (check_str > checker) {

         $('#update_quant_show').html('Availabale quantity is  ' + $('#quantity').val());
         return false;
      } else {
         $('#update_quant_show').html('');

      }

      var total = 0;
      var id = $('#hidden_input').val();

      var update_quantity_name = $('#update_quantity_input').val();

      // var previous_product_name = $('#update_product_name').val();
      if (update_quantity_name.trim() == '') {

         $('#update_quantity_select_alert').html('Please enter product name');
         return false;
      } else {

         $('#total' + id).text((update_quantity_name * parseInt($('#price' + id).text()))).wrapInner("<strong />");
         //new
       
        qty_arr.splice((id-1), 1, update_quantity_name);
       
        total_arr.splice((id-1), 1, update_quantity_name);

//


         $('#total').val(parseInt(update_quantity_name * parseInt($('#price' + id).text())));
         $('#num' + id).html(update_quantity_name);
         //new 
         total_arr.splice((id-1), 1, parseInt(update_quantity_name * parseInt($('#price' + id).text())));

         //



         $('#new tr td:last-child').each(function(i, value) {
            tdid = '#total' + (i + 1);
            var grossvalue = parseInt($(tdid).text());



            if (!isNaN(grossvalue)) {
               total += grossvalue;
            }
         });


         var totalPayment = parseFloat(total);
         $('#totalPayment').text(totalPayment.toFixed(2));
         gross_arr = totalPayment.toFixed(2);


         $('#update_master_modal').modal('hide');

      }




   }
   $('#payment_mode').change(function() {
      jQuery("label#select_error").hide(); // show Warning 
      // alert($('#payment_mode').find(":selected").val());
   });
   // alert();
   function deleteRow(id) {

      $('#totalPayment').text(parseInt($('#totalPayment').text()) - parseInt($('#' + id + ' td:last-child').text()));
      let value = String($('#' + id + ' td:first-child').text());

      var index = check_arr.indexOf(value);
      // new changes
     var productIndex =  product_name_arr.indexOf(value);

     product_name_arr.splice(productIndex, 1);
     category_arr.splice(productIndex, 1);
               qty_arr.splice(productIndex, 1);
               total_arr.splice(productIndex, 1);

     //upto it

      check_arr.splice(index, 1);
      $('#' + id).remove();


      // billFunction();
      //    var rowCount = $('#new tr:#'+id+'').index() + 1;
      //  alert(rowCount);
      //  $("#"+id).remove();

      //     const index = check_arr.indexOf(2);

      // const x = myArray.splice(index, 1);
      //       var table = document.getElementById("new");
      // var rowIndex = document.getElementById(id).rowIndex;
      // alert(rowIndex);
      // table.deleteRow(rowIndex);
      // var str = localStorage.getItem(id).slice((localStorage.getItem(id).lastIndexOf("</strong>") - 4), localStorage.getItem(id).lastIndexOf("</strong>"));
      // var regex = /\d+/g;
      // var clean = str.match(regex);
      // var res = parseInt(localStorage.getItem('gross_total')) - parseInt(clean);


      // localStorage.setItem('gross_total', res);

      // $('#totalPayment').text(localStorage.getItem('gross_total'));
      // localStorage.removeItem(id);
      // $('#add').click();
      // for (let i = 1; i < size; i++) {


      //    $('#new').html(localStorage.getItem(i));


      // }
   }
   // localStorage.clear();
</script>


