<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="../css_folders/master_product.css" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="../billing/saledata.css"> -->
    <!-- the data table cdn -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <link href="../css_folders/master.css" rel="stylesheet">
</head>


<body>
    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

        <?php
        include('../pages/navigation.php');
        include("db.php");
        ?>
        <?php


        if ($_SESSION["user_name"] == '' && $_SESSION["login_type"] == '') {
            header('location:../login-Signup/login.php');
        }
        ?>
        <div class="container">
            
                <h2 id="table-name" class="shadow rounded border text-center text-uppercase" style="white-space: nowrap; margin-left: auto;">Sale table for summury</h2>

                
                    <div class="d-flex justify-content-center">
                        <div class="card m-4 p-2 d-flex" style="width: 30rem;" style="box-shadow:0 0 5px #a8a8a8;">
                            
                                        <div class="col-3">Min Date:</div>
                                        <div class="col-3"><input class="form-control col-10" type="date" id="from_date" name="from_date"></div>

                                        <div class="col-3">Max Date:</div>
                                        <div class="col-3"><input class="form-control col-10" type="date" id="to_date" name="to_date">
                                    </div>
                        </div>
                        <div class="mt-4 p-2">
                            <button onclick="From_to_date()" class="btn btn-primary text-white btn-outline-success">Submit</button>
                        </div>
                        <div class="mt-4 p-2 float-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary text-white btn-outline-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Bill Report
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bill Number</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="text"  class="form-control"  placeholder="Enter bill number" id="bill_no">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="get_bill()">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tables border-1 border-warning table-responsive" style="margin-left: 5%; margin-right: 5%;">
                    <table id="mydata" class="table" style="box-shadow:0 0 5px #a8a8a8;" border=3>
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Product Name</th>
                                <th>Category Name</th>
                                <th>Quantity</th>
                                <th>Total</th>


                            </tr>
                        </thead>
                        <tbody id="table_append" class="Data">

                        </tbody>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Gross</strong></td>
                                <td id="totalPayment"><strong></strong></td>
                            </tr>
                        </tbody>


                    </table>
                   


                </div>
            </div>

           
</body>




        <script>
            //   $(document).ready(function(){
            //        showitem();
            //   });


            //  function showitem() {
            //     var min = $('#min').val();
            //     alert(min)
            //     var displaydata = "displaydata";

            //     $.ajax({
            //         url: "../summury_backend.php",
            //         type: "post",
            //         dataType: "json",
            //         data: {
            //             displaydata: displaydata
            //         },

            //         success: function(response) {
            //             if (response.length > 0) {
            //                 var data = '';
            //                 var S_No = 0;
            //                 for (var a = 0; a < response.length; a++) {
            //                     S_No++;
            //                     var product_name = response[a].product_name;
            //                     var quantity = response[a].quan;
            //                     var price = response[a].product_price;
            //                     var total_price = response[a].tot;


            //                     data = data + '<tr><td>' + S_No + '</td><td>' + product_name + '</td><td>' + quantity + '</td><td>' + price + '</td><td>' + total_price +  '</td></tr>';
            //                     // <td><a class="btn btn-primary m-1">Edit</a><a class="btn btn-danger m-1">Delete</a></td></tr>';
            //                 }
            //         $("#table_body").html(data);

            //      // the query for the dates 
            //         minDate = new DateTime('#min', {
            //           format: 'MMMM Do YYYY'
            //             });
            //             maxDate = new DateTime('#max', {
            //              format: 'MMMM Do YYYY'
            //              });


            //         // the query for the datatable for pdf print and search
            //         let table = new DataTable('#mydata',{
            //        responsive: true, "order": [], dom: 'lBfrtip', buttons: [ 'excel', 'pdf', 'print' ],
            //       });
            //     }
            // }
            //     });
            // }
        </script>
        <script>
            $(document).ready(function() {
                var dateWise = "datewise";
                $.ajax({
                    url: 'sale_backend.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        dateWise: dateWise,

                    },
                    success: function(response) {
                        var obj = response;

                        for (let i = 0; i < response.length; i++) {
                            var num = parseInt(i) + 1;
                            $('#table_append').append('<tr><td>' + num + '</td><td>' + obj[i].product_id + '</td><td>' + obj[i].category_id + '</td><td>' + obj[i][2] + '</td><td><input type="hidden" id="total" value="' + obj[i][3]+'">' + obj[i][3] + '</td></tr>');
                        }
                        var total = 0;

                        $('#table_append tr td:last-child').each(function() {
                            var value = parseFloat($('#total', this).val());

                            if (!isNaN(value)) {
                                total += value;
                            }
                        });

                        var totalPayment = parseFloat(total);
                        $('#totalPayment').text(totalPayment.toFixed(2));

                        let table = new DataTable('#mydata', {
                            responsive: true,
                            "order": [],
                            dom: 'lBfrtip',
                            buttons: ['excel', 'pdf', 'print'],
                            searching: false,
                        });
                    }

                })
            });


            function From_to_date() {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                $.ajax({
                    url: 'sale_backend.php',
                    type: 'post',
                    dataType: 'json',
                    data: {

                        from: from_date,
                        to: to_date,

                    },
                    success: function(response) {
                        var obj = response;
                        $('#table_append').html('');


                        for (let i = 0; i < response.length; i++) {
                            var num = parseInt(i) + 1;
                            $('#table_append').append('<tr><td>' + num + '</td><td>' + obj[i].product_id + '</td><td>' + obj[i].category_id + '</td><td>' + obj[i][2] + '</td><td><input type="hidden" id="total" value="' + obj[i][3]+'">' + obj[i][3] + '</td></tr>');
                        }

                        var total = 0;

                        $('#table_append tr td:last-child').each(function() {
                            var value = parseFloat($('#total', this).val());
                           
                        
                            if (!isNaN(value)) {
                                total += value;
                            }
                        });
                        var totalPayment = parseFloat(total);
                        $('#totalPayment').text(totalPayment.toFixed(2));
                        
                    }

                })
            }

            function get_bill() {
                var bill_no = $('#bill_no').val();


                $.ajax({
                    url: 'sale_backend.php',
                    type: 'post',
                    dataType: 'json',
                    data: {

                        bill_no: bill_no,

                    },
                    success: function(response) {
                        var obj = response;
                        $('#table_append').html('');


                        for (let i = 0; i < response.length; i++) {
                            var num = parseInt(i) + 1;
                            $('#table_append').append('<tr><td>' + num + '</td><td>' + obj[i].product_id + '</td><td>' + obj[i].category_id + '</td><td>' + obj[i][2] + '</td><td><input type="hidden" id="total" value="' + obj[i][3]+'">' + obj[i][3] + '</td></tr>');
                        }

                        var total = 0;
                        $('#table_append tr td:last-child').each(function() {

                            var value = parseFloat($('#total', this).val());
                            // alert(value);
                            if (!isNaN(value)) {
                                total += value;
                            }
                        });
                        var totalPayment = parseFloat(total);
                        $('#totalPayment').text(totalPayment.toFixed(2));
                     
                    }

                })
            }
        </script>
    





        <!--center-->
  


</html>