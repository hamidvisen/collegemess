<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/dataTables.jqueryui.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="../css_folders/master.css" />
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    include('./navigation.php');

    ?>
    <?php


    if ($_SESSION["user_name"] == '' && $_SESSION["login_type"] == '') {
        header('location:../login-Signup/login.php');
    }
    ?>

    <!-- <div class="container">
        <h1 class="ml-5 border border-secondary text-warning text-center text-uppercase">Mess Admin panel</h1>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add Content to Master
            </button>
        </div>
        <h1 class="text-info text-center">Master table</h1>
        <div id="record-contant"> -->

    <!-- </div> -->
    <div class="container table-responsive" style="margin-left: 8%;">
        <h1 id="table-name" class="shadow rounded border text-center text-uppercase ">Sale Entry Table</h1>

        <div id="add_btn" class="shadow rounded mt-2 d-flex justify-content-end">

            <button type="button" class="border-0 shadow m-1 btn btn-primary" data-toggle="modal" data-target="#myModal"> Add Sale </button>
        </div>

        <!-- <div id="record-contant"> -->
        <table id="myTable" class="table-hover mt-5 table border shadow table-bordered  bg-light">
            <thead>
                <tr>
                    <th>S.NO.</th>
                    <th>PRODUCT NAME</th>
                    <th>Bill NO</th>
                    <th>CATEGORY NAME</th>
                    <!-- <th>TAX NAME</th> -->
                    <th>UNIT NAME</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>TOTAL PRODUCT PRICE</th>
                    <th>TAX RATE</th>
                    <th>TOTAL PRICE</th>
                    <th>ADDED BY</th>
                    <th>ADDED ON</th>
                    <!-- <th>UPDATED BY</th>
                    <th>UPDATED ON</th> -->
                    <th style="display: none;">EDIT ACTION</th>
                    <th style="display: none;">DELETE ACTION</th>
                </tr>
            </thead>
            <tbody id="table_body">
            </tbody>

        </table>

    </div>

    <!-- </div> -->
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-uppercase">Sale Content</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label>Product Name:</label>
                            <select onchange="getValue()" class="d form-control" name="product_name" id="first_input" multiple="multiple"></select>
                             <input type="hidden" id="first_hidden_input"></input>
                            <span id="product_select_alert" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Category Name:</label>
                            <select class="form-control" name="category_name" id="sec_input"></select>
                            <input type="hidden" id="sec_hidden_input"></input>
                            <span id="category_select_alert" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label>Tax:</label>
                            <select class="form-control" name="tax_name" id="third_input"></select>
                            <input type="hidden" id="third_hidden_input"></input>
                            <span id="tax_select_alert" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Unit:</label>
                            <select class="form-control" name="unit_name" id="fourth_input"></select>
                            <input type="hidden" id="fourth_hidden_input"></input>
                            <span id="unit_select_alert" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="d-flex " style="width: 100%;">
                        <div class="form-group col-md-3">
                            <label>Product per unit:</label><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">₹</div>
                                </div>
                                <input type="text" class="form-control" placeholder="INR" name="price_per_unit" id="price_id">
                                <!-- <span class="bg-info p-1"></span> -->
                                <input type="hidden" id="fifth_hidden_input"></input>
                                <span id="price_per_select_alert" class="text-danger"></span>

                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Quantity:</label><br>
                            <input onchange="getValue()" type="number" class="form-control" value="1" name="quant" id="quant" min=1>
                            <input type="hidden" id="sixth_hidden_input"></input>
                            <span id="quant_select_alert" class="text-danger"></span>
                        </div>

                        <!-- <div class="col-md-3">
      <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
      
        <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Username">
      </div> -->

                        <div class="form-group col-md-6">
                            <label>Product price:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">₹</div>
                                </div>
                                <input type="text" class="form-control" name="prod_price" id="prod_price" placeholder="total product price">
                                <input type="hidden" id="seventh_hidden_input"></input>
                                <span id="prod_price_select_alert" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex" style="width: 100%;">

                        <div class="form-group col-md-6">
                            <label>Tax:</label><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">%

                                    </div>
                                </div>
                                <input type="text" class="form-control" name="tax" id="tax_id" placeholder="tax">
                                <input type="hidden" id="eighth_hidden_input"></input>
                                <span id="tax_id__select_alert" class="text-danger"></span>
                            </div>
                        </div>
                        <!-- <div class="form-group col-md-3">
                                
                                </div>
                            -->
                        <div class="form-group col-md-6">
                            <label>Total price:</label><br>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">₹</div>
                                </div>
                                <input type="text" class="form-control" placeholder="INR" name="total_price" id="total_price">
                                <input type="hidden" id="nineth_hidden_input"></input>
                                <span id="total_price_select_alert" class="text-danger"></span>

                            </div>
                        </div>
                    </div>




                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="add_save" onclick="submit()">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- update model -->

    <div class="modal fade" id="update_master_modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-uppercase">Add Content</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label>Product Name:</label>
                            <input type="text" class="form-control" name="update_product_name" id="update_first_input">
                            <!-- <input type="hidden" id="update_first_hidden_input"></input> -->
                            <span id="update_product_select_alert" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Category Name:</label>
                            <input type="text" class="form-control" name="update_category_table" id="update_sec_input">
                            <!-- <input type="hidden" id="update_sec_hidden_input"></input> -->
                            <span id="update_category_select_alert" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label>Tax:</label>
                            <input type="text" class="form-control" name="update_tax_table" id="update_third_input">
                            <!-- <input type="hidden" id="update_third_hidden_input"></input> -->
                            <span id="update_tax_select_alert" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Unit:</label>
                            <input type="text" class="form-control" name="update_unit_table" id="update_fourth_input">
                            <!-- <input type="hidden" id="update_fourth_hidden_input"></input> -->
                            <span id="update_unit_select_alert" class="text-danger"></span>
                        </div>
                    </div>




                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="update_save" onclick="updateMasterDetails()">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    <input type="hidden" name="" id="hidden_master_id">
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    $(".d").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
    </script>

<script>
    $(document).ready(function() {
        readRecord();
        load_values0();
        load_values1();
        load_values2();
        load_values3();
    });



    function load_values0() {
        var display0 = 'display0';
        $.ajax({
            url: '../sale_backend.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                display0: display0
            },
            success: function(response) {
                // alert(response);
                $('#first_hidden_input').val(response.length);
                //    alert($('#first_hidden_input').val());
                if (response.length > 0) {
                    var optn_body = '';
                    for (var a = 0; a < response.length; a++) {
                        var value = response[a].product_name;
                        // alert(value);
                        optn_body = optn_body + '<option value="' + value + '">' + value + '</option>';
                    }
                    // $("#select").html(optn_body);
                    document.getElementById('first_input').innerHTML = optn_body;


                }
            }
        });
    }


    function load_values1() {
        var display1 = 'display1';
        $.ajax({
            url: '../master_backend.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                display1: display1
            },
            success: function(response) {
                // alert(response);
                $('#sec_hidden_input').val(response.length);
                if (response.length > 0) {
                    var optn_body = '<option disabled selected>Category_name</option>';

                    for (var a = 0; a < response.length; a++) {


                        var value = response[a].category_name;
                        // alert(value);
                        optn_body = optn_body + '<option value="' + value + '">' + value + '</option>';
                    }
                    // $("#select").html(optn_body);
                    document.getElementById('sec_input').innerHTML = optn_body;

                }
            }
        });
    }

    function load_values2() {
        var display2 = 'display2';
        $.ajax({
            url: '../master_backend.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                display2: display2
            },
            success: function(response) {
                // alert(response);
                $('#third_hidden_input').val(response.length);
                if (response.length > 0) {
                    var optn_body = '<option disabled selected>Tax_name</option>';
                    for (var a = 0; a < response.length; a++) {
                        var value = response[a].tax_name;
                        // alert(value);
                        optn_body = optn_body + '<option value="' + value + '">' + value + '</option>';
                    }
                    // $("#select").html(optn_body);
                    document.getElementById('third_input').innerHTML = optn_body;

                }
            }
        });
    }

    function load_values3() {
        var display3 = 'display3';
        $.ajax({
            url: '../master_backend.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                display3: display3
            },
            success: function(response) {
                // alert(response);
                $('#fourth_hidden_input').val(response.length);
                if (response.length > 0) {
                    var optn_body = '<option disabled selected>unit_name</option>';
                    for (var a = 0; a < response.length; a++) {
                        var value = response[a].unit_name;
                        // alert(value);
                        optn_body = optn_body + '<option value="' + value + '">' + value + '</option>';
                    }
                    // $("#select").html(optn_body);
                    document.getElementById('fourth_input').innerHTML = optn_body;

                }
            }
        });
    }

    function getValue() {
        var getvalue = "getvalue";

        var num0 = $('#first_input').val();
        
        $.ajax({
            method: "POST",
            url: "../sale_backend.php",

            data: {
                getvalue: getvalue,
                firstnum: num0,
            },
            success: function(data) {
                // var res = JSON.parse(data);
                // document.getElementById("first_input").value = res[0];
                // document.getElementById("sec_input").value = res[1];
                // document.getElementById("third_input").value = res[2];
                // document.getElementById("fourth_input").value = res[3];
                // document.getElementById("price_id").value = res[4];
                // document.getElementById("tax_id").value = res[5];
                // document.getElementById("prod_price").value = document.getElementById("quant").value * res[4];


                // document.getElementById("total_price").value = Math.round(parseFloat((res[5] / 100) * document.getElementById("prod_price").value) + parseFloat(document.getElementById("prod_price").value));






            }
        });
    }
//   localStorage.clear();
    function submit() {
        var submit = "submit";
        
        var now_date = new Date();

        

        if (localStorage.getItem('lastBillDate') == null) {

            var n = 1;

            var bill = String(now_date.getFullYear()) + String((now_date.getMonth() + 1)) + String(now_date.getDate()) + String(n);
            localStorage.setItem('lastBillDate', bill);
            localStorage.setItem('lastBillDate', bill);
            localStorage.setItem('lastBill', bill);
            localStorage.getItem('lastBillDate');
            
            localStorage.setItem('increment', n);
        } else {
            localStorage.setItem('increment', (parseInt(localStorage.getItem('increment')) + parseInt(1)));
            var bill = String(now_date.getFullYear()) + String((now_date.getMonth() + 1)) + String(now_date.getDate()) + String(localStorage.getItem('increment'));
            localStorage.setItem('lastBillDate', bill);

            if (String(parseInt(localStorage.getItem('lastBill')) + 1) == localStorage.getItem('lastBillDate')) {
                String(parseInt(localStorage.setItem('lastBill', bill) + 1))
           
            } else {
                localStorage.setItem('increment', 1); 
                var bill = String(now_date.getFullYear()) + String((now_date.getMonth() + 1)) + String(now_date.getDate()) + String(localStorage.getItem('increment'));
                localStorage.setItem('lastBillDate', bill);
           
                
            }
        }


        // if (localStorage.getItem('lastBillDate') == (parseInt(localStorage.getItem('lastBillDate')) + parseInt(1))) {} else {
        //     n = 1;
        //     var bill = String(now_date.getFullYear()) + String((now_date.getMonth() + 1)) + String(now_date.getDate()) + String(n);
        //     localStorage.setItem('lastBillDate', bill);
        //     alert(localStorage.getItem('lastBillDate', bill));
        //     alert("thakur");
        // }



        $.ajax({
            type: "post",
            url:"../sale_backend.php",
            data: {
                submit: submit,
                prod_value:document.getElementById("first_input").value, 
                cat_value:document.getElementById("sec_input").value,
                tax_value:document.getElementById("third_input").value,
                unit_value:document.getElementById("fourth_input").value,
                prod_price: document.getElementById("price_id").value,
                quant_value:document.getElementById("quant").value,
                prod_total_price:document.getElementById("prod_price").value,
                discounted_amount:document.getElementById("tax_id").value,
                total_price:document.getElementById("total_price").value,
                bill: localStorage.getItem('lastBillDate'),              

            },
            success: function(data){
                alert('Data submitted successfully');
                readRecord();
            }
        })
    }


    function readRecord() {
        var readrecord = "readrecord";
        // let table = new DataTable("#myTable");
        // table.destroy();


        $.ajax({
            url: "../sale_backend.php",
            type: 'post',
            dataType: 'JSON',
            data: {
                readrecord: readrecord,
            },

            success: function(data) {

                if (data != '') {

                    var res = '';
                    var num = 0;
                    for (let i = 0; i < (data.length / 2); i++) {
                        num += 1;

                        res += '<tr><td>' + num + '</td><td>' + data[i].product_name + '</td><td>' + data[i].bill+'</td><td>' + data[i].category_name + '</td> <td>' + data[i].unit_name + '</td><td>' + data[i].product_price + '</td><td>' + data[i].quantity + '</td><td>' + data[i].prod_total_price + '</td><td>' + data[i].quantity_value + '</td><td>' + data[i].total_price + '</td><td>' + data[data.length / 2 + i].u_name + '</td><td>' + data[i].added_on + '</td><td class="d-flex flex-column" style="display: none !important;"><button onclick="getMasterDetails(' + data[i].id + ')" class="btn d-inline-flex flex-column btn-warning text-center" style=" row-gap: 1px; width:70%; height: 25%;"><i class="fas fa-pen-to-square" style="height:20px; top:3px;"></i><span class="text-center align-self-center" style="font-size: 13px;">Edit</span></button><button onclick="deleteMaster(' + data[i].id + ')" class="btn d-inline-flex flex-column btn-danger text-center" style=" row-gap: 1px; width:70%; height: 25%;"><i class="fas fa-solid fa-trash-can" style="height:20px; top:3px;"></i><span class="text-center align-self-center" style="font-size: 13px;">Delete</span></button>  </td></tr>';
                        // console.log(data);
                    }
                    // <td></td><td></td>
                    // <td>' + data[i].tax_name + ' </td>


                    $('#table_body').html(res);
                    //   let table = new DataTable("#myTable");

                } else {
                    console.log("No Data Found");
                }
                // let table = new DataTable("#myTable");

            },

        });

    }




    // UPDATE AND DELETE JSON


    function deleteMaster(masterID) {
        alert(masterID);
        var con = confirm('Are you sure');
        if (con == true) {
            $.ajax({
                url: "../master_backend.php",
                type: 'post',
                data: {
                    deleteid: masterID,
                },
                success: function(data, status) {
                    readRecord();

                },

            });
        }
    }
    // var packet = "";

    function getMasterDetails(masterID) {
        $('#hidden_master_id').val(masterID);
        const get_string = 'get_string';
        // $.ajax({
        //   url: "backend1.php",
        //   type: 'post',
        //   data: {id : userID,
        //   },
        //   success: function(data, status) {
        //     var user = JSON.parse(data);
        //   $('#update_firstname').val(user.firstname);
        //   $('#update_lastname').val(user.lastname);
        //   $('#update_emailid').val(user.emailid);

        //   $('#update_mobile').val(user.mobile);
        //   $('#update_user_modal').modal('show');
        //   }
        //   });

        $.post("../master_backend.php", {
            id: masterID,
            get_string: get_string
        }, function(data, status) {
            var master = JSON.parse(data);
            // alert(product.product_name);
            // var a = product.product_name;
            $('#update_first_input').val(master.product_name);
            $('#update_sec_input').val(master.category_name);
            $('#update_third_input').val(master.tax_name);
            $('#update_fourth_input').val(master.unit_name);
            // $('#update_first_input option[value='+product.product_name+']').attr('selected','selected');
            // alert( $('#update_first_input').val());


        })

        $('#update_master_modal').modal('show');

    }

    // $('#update_product_name').focus(function() {
    //     $('#update_product_name_alert').html('');
    // });

    function updateMasterDetails() {
        const update_string = "update_string";

        var id = $('#hidden_master_id').val();

        var update_product_name = $('#update_first_input').val();
        var update_category_name = $('#update_sec_input').val();
        var update_tax_name = $('#update_third_input').val();
        var update_unit_name = $('#update_fourth_input').val();
        // var previous_product_name = $('#update_product_name').val();
        if (update_product_name.trim() == '') {

            $('#update_product_select_alert').html('Please enter product name');
            return false;
        } else if (update_category_name.trim() == '') {

            $('#update_category_select_alert').html('Please enter category name');
            return false;
        } else if (update_tax_name.trim() == '') {
            $('#update_tax_select_alert').html('Please enter tax name');
            return false;
        } else if (update_unit_name.trim() == '') {
            $('#update_unit_select_alert').html('Please enter unit name');
            return false
        } else {
            $('#update_save').attr('data-dismiss', 'modal');
        }
        $.ajax({
            url: "../master_backend.php",
            type: 'post',
            data: {
                update_string: update_string,
                userid: id,
                update_product_name: update_product_name,
                update_category_name: update_category_name,
                update_tax_name: update_tax_name,
                update_unit_name: update_unit_name,


            },
            success: function(data, status) {
                if (data == 1) {
                    alert("Data already exist");
                }

                $('#update_product_modal').modal('hide');
                readRecord();


            }
        });
    }
</script>

</html>