<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css_folders/master_product.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mess Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css_folders/master_product.css">
</head>


<body >


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php
include('./navigation.php');

?>
<?php


if($_SESSION["user_name"]=='' && $_SESSION["login_type"]==''){
    header('location:../login-Signup/login.php');
}
?>
    <!-- <div class="container">
        <h1 class="text-warning text-center text-uppercase">Mess Admin panel</h1>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Add Unit
            </button>
        </div>
        <h1 class="text-info text-center">Unit table</h1>
        <div id="record-contant">

        </div> -->
        <div class="container d-flex flex-column border-1 border-warning" style="margin-left: 10%; width: 90%; ">
            <h1 id="table-name" class="shadow rounded border text-center text-uppercase " style="white-space: nowrap; margin-left: auto;">Unit table</h1>

            <div id="add_btn" class="shadow rounded d-flex justify-content-end" style="width: min-content ; margin-left:auto;">

<button type="button" class="border-0 shadow m-1 btn  btn-primary" data-toggle="modal" data-target="#myModal" style="white-space: nowrap; "> Add Unit</button>
</div>

            <div class="table-responsive">

            </div>
        </div>
        
        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-uppercase">Add Unit</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Unit Name:</label>
                            <input type="text" placeholder="Enter unit name" class="form-control" id="unit_name" name="">
                            <span id="unit_name_alert" class="text-danger"></span>
                        </div>
                    </div>



                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="add_save" onclick="addrecord()">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- update user model end here-->

        <!-- //update modal -->
        <div class="modal fade" id="update_unit_modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-uppercase">Update Unit</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Unit name:</label>
                            <input type="text" placeholder="Enter unit name" class="form-control" id="update_unit_name" name="">

                            <span id="update_unit_name_alert" class="text-danger"></span>

                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" id="update_save" class="btn btn-primary" onclick="updateUnitDetails()">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                    <input type="hidden" name="" id="hidden_unit_id">

                </div>
            </div>

        </div>

    

</body>
<script type="text/javascript">
    $(document).ready(function() {
        readRecord();

    });

    function readRecord() {
        var readrecord = "readrecord";
        $.ajax({
            url: "../unit_backend.php",
            type: 'post',
            data: {
                readrecord: readrecord,
            },
            success: function(data, status) {
                $('.table-responsive').html(data);

            },

        });
    }


    //   ADD unit NAME AJAX
    $('#unit_name').focus(function() {
        $('#unit_name_alert').html('');
    });

    function addrecord() {
        var unitname = $('#unit_name').val();
        const add_string = "addString";
        if (unitname.trim() == '') {
            $('#unit_name_alert').html('Please enter unit name');
            throw new Error("unit not filled");
        } else {
            $('#add_save').attr('data-dismiss', 'modal');
        }
        $.ajax({
            url: "../unit_backend.php",
            type: 'post',
            data: {
                unitname: unitname,
                addString: add_string

            },
            success: function(data, status) {
               
                if(data==1){
                    alert("Data already exist");
                }
                readRecord();

            },

        });

    }

    function deleteUnit(unitID) {
        var con = confirm('Are you sure');
        if (con == true) {
            $.ajax({
                url: "../unit_backend.php",
                type: 'post',
                data: {
                    deleteid: unitID,
                },
                success: function(data, status) {
                    readRecord();

                },

            });
        }
    }
    var packet = "";

    function getUnitDetails(unitID) {
        $('#hidden_unit_id').val(unitID);
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

        $.post("../unit_backend.php", {
            id: unitID,
            get_string: get_string
        }, function(data, status) {
            var unit = JSON.parse(data);
            $('#update_unit_name').val(unit.unit_name);

        })
       
        $('#update_unit_modal').modal('show');

    }

    $('#update_unit_name').focus(function() {
        $('#update_unit_name_alert').html('');
    });

    function updateUnitDetails() {
        const update_string = "update_string";

        var id = $('#hidden_unit_id').val();

        var update_unit_name = $('#update_unit_name').val();
        // var previous_unit_name = $('#update_unit_name').val();
        if (update_unit_name.trim() == '') {
            $('#update_unit_name_alert').html('Please enter unit name');
            return false;
        }
       else {
            $('#update_save').attr('data-dismiss', 'modal');
        }
        $.ajax({
            url: "../unit_backend.php",
            type: 'post',
            data: {
                update_string: update_string,
                userid: id,
                update_unit_name: update_unit_name,
            },
            success: function(data, status) {
                if(data==1){
                    alert("Data already exist");
                }
               
                $('#update_unit_modal').modal('hide');
                readRecord();

              
            }
        });
    }
</script>

</html>