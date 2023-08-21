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
                Add Category
            </button>
        </div>
        <h1 class="text-info text-center">Category table</h1>
        <div id="record-contant">

        </div> -->
        <div class="container d-flex flex-column border-1 border-warning" style="margin-left: 10%; width: 90%; ">
            <h1 id="table-name" class="shadow rounded border text-center text-uppercase " style="white-space: nowrap; margin-left: auto;">Category table</h1>

            <div id="add_btn" class="shadow rounded d-flex justify-content-end" style="width: min-content ; margin-left:auto;">

<button type="button" class="border-0 shadow m-1 btn  btn-primary" data-toggle="modal" data-target="#myModal" style="white-space: nowrap; "> Add Category</button>
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
                        <h4 class="modal-title text-uppercase">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category Name:</label>
                            <input type="text" placeholder="Enter category name" class="form-control" id="category_name" name="">
                            <span id="category_name_alert" class="text-danger"></span>
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
        <div class="modal fade" id="update_category_modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title text-uppercase">Update Category</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Category name:</label>
                            <input type="text" placeholder="Enter category name" class="form-control" id="update_category_name" name="">

                            <span id="update_category_name_alert" class="text-danger"></span>

                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" id="update_save" class="btn btn-primary" onclick="updateCategoryDetails()">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                    <input type="hidden" name="" id="hidden_category_id">

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
            url: "../category_backend.php",
            type: 'post',
            data: {
                readrecord: readrecord,
            },
            success: function(data, status) {
                $('.table-responsive').html(data);

            },

        });
    }


    //   ADD category NAME AJAX
    $('#category_name').focus(function() {
        $('#category_name_alert').html('');
    });

    function addrecord() {
        var categoryname = $('#category_name').val();
        const add_string = "addString";
        if (categoryname.trim() == '') {
            $('#category_name_alert').html('Please enter category name');
            throw new Error("category not filled");
        } else {
            $('#add_save').attr('data-dismiss', 'modal');
        }
        $.ajax({
            url: "../category_backend.php",
            type: 'post',
            data: {
                categoryname: categoryname,
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

    function deleteCategory(categoryID) {
        var con = confirm('Are you sure');
        if (con == true) {
            $.ajax({
                url: "../category_backend.php",
                type: 'post',
                data: {
                    deleteid: categoryID,
                },
                success: function(data, status) {
                    readRecord();

                },

            });
        }
    }
    var packet = "";

    function getCategoryDetails(categoryID) {
        $('#hidden_category_id').val(categoryID);
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

        $.post("../category_backend.php", {
            id: categoryID,
            get_string: get_string
        }, function(data, status) {
            var category = JSON.parse(data);
            $('#update_category_name').val(category.category_name);

        })
       
        $('#update_category_modal').modal('show');

    }

    $('#update_category_name').focus(function() {
        $('#update_category_name_alert').html('');
    });

    function updateCategoryDetails() {
        const update_string = "update_string";

        var id = $('#hidden_category_id').val();

        var update_category_name = $('#update_category_name').val();
        // var previous_category_name = $('#update_category_name').val();
        if (update_category_name.trim() == '') {
            $('#update_category_name_alert').html('Please enter category name');
            return false;
        }
       else {
            $('#update_save').attr('data-dismiss', 'modal');
        }
        $.ajax({
            url: "../category_backend.php",
            type: 'post',
            data: {
                update_string: update_string,
                userid: id,
                update_category_name: update_category_name,
            },
            success: function(data, status) {
                if(data==1){
                    alert("Data already exist");
                }
               
                $('#update_category_modal').modal('hide');
                readRecord();

              
            }
        });
    }
</script>

</html>