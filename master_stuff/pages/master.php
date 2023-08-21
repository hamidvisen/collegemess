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
    <div class="container d-flex flex-column" style="margin-left: 10%; width: 90%; ">
        <h1 id="table-name" class="shadow rounded border text-center text-uppercase " style="white-space: nowrap; margin-left: auto;">Master table</h1>

        <div id="add_btn" class="shadow rounded mt-2 d-flex justify-content-end" style="width: min-content ; margin-left:auto;">

            <button type="button" class="border-0 shadow m-1 btn  btn-primary" data-toggle="modal" data-target="#myModal" style="white-space: nowrap; "> Add Content to Master </button>
        </div>

        <!-- <div id="record-contant"> -->
            <div class="table-responsive">
        <table id="myTable" class="table-hover mt-5 table border shadow table-bordered  bg-light ">
            <thead>
                <tr>
                    <th>S.NO.</th>
                    <th>PRODUCT NAME</th>
                    <th>PRODUCT PRICE </th>
                    <th>CATEGORY NAME</th>
                    <th>TAX NAME</th>
                    <th>UNIT NAME</th>
                    <th>Quantity</th>
                    <th>Edit Action </th>
                    <th>Delete Action</th>
                </tr>
            </thead>
            <tbody id="table_body">
            </tbody>

        </table>
</div>
    </div>

    <!-- </div> -->
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
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
                            <select class="form-control" name="product_name" id="first_input"></select>
                            <input type="hidden" id="first_hidden_input"></input>
                            <span id="product_select_alert" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Category Name:</label>
                            <select class="form-control" name="category_table" id="sec_input"></select>
                            <input type="hidden" id="sec_hidden_input"></input>
                            <span id="category_select_alert" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label>Tax:</label>
                            <select class="form-control" name="tax_table" id="third_input"></select>
                            <input type="hidden" id="third_hidden_input"></input>
                            <span id="tax_select_alert" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Unit:</label>
                            <select class="form-control" name="unit_table" id="fourth_input"></select>
                            <input type="hidden" id="fourth_hidden_input"></input>
                            <span id="unit_select_alert" class="text-danger"></span>
                        </div>
                    </div>
                    <!-- input price changes-->
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label>Price:</label>
                            <input type="number" min=0 placeholder="Enter price in rupees" class="form-control" name="price_table" id="fifth_input">
                            <input type="hidden" id="fifth_hidden_input"></input>
                            <span id="price_select_alert" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Quantity:</label>
                            <input type="number" min=0 placeholder="Enter quantity" class="form-control" name="quantity_table" id="sixth_input">
                            <input type="hidden" id="sixth_hidden_input"></input>
                            <span id="quantity_select_alert" class="text-danger"></span>
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
                    <!-- input price changes-->
                    <div class="d-flex">
                        <div class="form-group col-md-6">
                            <label>Price:</label>
                            <input type="number" min=0 placeholder="Enter price in rupees" class="form-control" name="price_table" id="update_fifth_input">
                            <input type="hidden" id="fifth_hidden_input"></input>
                            <span id="update_price_select_alert" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Quantity:</label>
                            <input type="number" min=0 placeholder="Enter quantity" class="form-control" name="quantity_table" id="update_sixth_input">
                            <input type="hidden" id="sixth_hidden_input"></input>
                            <span id="update_quantity_select_alert" class="text-danger"></span>
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
    $(document).ready(function() {
        $("#first_input").select2({
            tags: true,

        });


    });




    $(document).ready(function() {
        $("#sec_input").select2({
            tags: true
        });

    });
    $(document).ready(function() {
        $("#third_input").select2({
            tags: true
        });

    });
    $(document).ready(function() {
        $("#fourth_input").select2({
            tags: true
        });

    });
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
            url: '../master_backend.php',
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
                    var optn_body = '<option disabled selected>Product_name</option>';
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
    $('#fifth_input').on('focus', function() {
        $('#price_select_alert').html('');
    });
    $('#fifth_input').on('focus', function() {
        $('#quantity_select_alert').html('');
    });

    function submit() {
        var submit = "submit";

        var num0 = $('#first_hidden_input').val();

        var len0 = $('#first_input option').length;

        var num1 = $('#sec_hidden_input').val();
        var len1 = $('#sec_input option').length;
        var num2 = $('#third_hidden_input').val();
        var len2 = $('#third_input option').length;
        var num3 = $('#fourth_hidden_input').val();
        var len3 = $('#fourth_input option').length;

        var first_input_value = $('#first_input').val();



        // alert(first_input_value);
        var sec_input_value = $('#sec_input').val();
        // alert(sec_input_value);
        var third_input_value = $('#third_input').val();
        // alert(third_input_value);
        var fourth_input_value = $('#fourth_input').val();
        // alert(third_input_value);
        //input price changes
        var fifth_input_value = $('#fifth_input').val();
        var sixth_input_value = $('#sixth_input').val();

        if (first_input_value.trim() == '') {

            $('#product_select_alert').html('Please enter product name');
            return false;
        } else if (sec_input_value.trim() == '') {

            $('#category_select_alert').html('Please enter category name');
            return false;
        } else if (third_input_value.trim() == '') {
            $('#tax_select_alert').html('Please enter tax name');
            return false;
        } else if (fourth_input_value.trim() == '') {
            $('#unit_select_alert').html('Please enter unit name');
            return false
        } else if (fifth_input_value.trim() == '') {
            $('#price_select_alert').html('Please enter price');
            return false
        } else if (sixth_input_value.trim() == '') {
            $('#quantity_select_alert').html('Please enter quantity');
            return false
        } else {
            $('#add_save').attr('data-dismiss', 'modal');
        }
        $.ajax({
            url: '../master_backend.php',
            type: 'POST',
            data: {
                submit: submit,
                num0: num0,
                len0: (len0 - 1),
                num1: num1,
                len1: (len1 - 1),
                num2: num2,
                len2: (len2 - 1),
                num3: num3,
                len3: (len3 - 1),
                first_input_value: first_input_value,
                sec_input_value: sec_input_value,
                third_input_value: third_input_value,
                fourth_input_value: fourth_input_value,
                fifth_input_value: fifth_input_value,
                sixth_input_value: sixth_input_value,
            },
            success: function(response) {






                if (response == '') {

                    // alert("hamid");
                    alert("Entry already exist");
                    readRecord();
                    return false;
                }
                // else {
                //     alert('nahi gaya');

                // }
                // submit();
                // alert("hamid");
                readRecord();
                window.location.reload(true);

            }
        });
    }

    function readRecord() {
        var readrecord = "readrecord";
        // let table = new DataTable("#myTable");
        // table.destroy();

        $.ajax({
            url: "../master_backend.php",
            type: 'post',
            dataType: 'JSON',
            data: {
                readrecord: readrecord,
            },

            success: function(data) {
                if (data != '') {

                    var res = '';
                    var num = 0;
                    for (let i = 0; i < data.length; i++) {
                        num += 1;
                        res += '<tr><td>' + num + '</td><td>' + data[i].product_name + '</td><td>' + data[i].product_price + '</td><td>' + data[i].category_name + '</td><td>' + data[i].tax_name + ' </td>    <td>' + data[i].unit_name + '</td><td>' + data[i].quantity + '</td><td><button onclick="getMasterDetails(' + data[i].id + ')" class="btn d-inline-flex flex-column btn-warning text-center" style=" row-gap: 1px; width:70%; height: 25%;"><i class="fas fa-pen-to-square" style="height:20px; top:3px;"></i><span class="text-center align-self-center" style="font-size: 13px;">Edit</span></button>  </td><td><button onclick="deleteMaster(' + data[i].id + ')" class="btn d-inline-flex flex-column btn-danger text-center" style=" row-gap: 1px; width:70%; height: 25%;"><i class="fas fa-solid fa-trash-can" style="height:20px; top:3px;"></i><span class="text-center align-self-center" style="font-size: 13px;">Delete</span></button>  </td></tr>';
                        //  console.log(data);
                    }


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
        // alert(product.product_name);
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
            $('#update_fifth_input').val(master.product_price);
            $('#update_sixth_input').val(master.quantity);
            // $('#update_first_input option[value='+product.product_name+']').attr('selected','selected');
            // alert( $('#update_first_input').val());


        })

        $('#update_master_modal').modal('show');

    }

    // $('#update_product_name').focus(function() {
    //     $('#update_product_name_alert').html('');
    // });
    $('#update_fifth_input').on('focus', function() {
        $('#update_price_select_alert').html('');
    });
    $('#update_sixth_input').on('focus', function() {
        $('#update_quantity_select_alert').html('');
    });

    function updateMasterDetails() {
        const update_string = "update_string";

        var id = $('#hidden_master_id').val();

        var update_product_name = $('#update_first_input').val();
        var update_category_name = $('#update_sec_input').val();
        var update_tax_name = $('#update_third_input').val();
        var update_unit_name = $('#update_fourth_input').val();
        var update_price_name = $('#update_fifth_input').val();
        var update_quantity_name = $('#update_sixth_input').val();
        // alert(update_quantity_name);

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
        } else if (update_price_name.trim() == '') {
            $('#update_price_select_alert').html('Please enter price');
            return false
        } else if (update_quantity_name.trim() == '') {
            $('#update_quantity_select_alert').html('Please enter quantity');
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
                update_price_name: update_price_name,
                update_quantity_name: update_quantity_name,

            },
            success: function(data, status) {
                // if (data == 1) {
                //     alert("Data already exist");
                // }

                $('#update_product_modal').modal('hide');
                readRecord();


            }
        });
    }
</script>

</html>