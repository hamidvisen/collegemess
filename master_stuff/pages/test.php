<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>

<select class="js-example-tags" name="state" id="select" style="padding-right:550px ;">


</select><br><br><br><br>
<button type="submit" onclick="submit()">submit</button>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $(".js-example-tags").select2({
            tags: true
        });

    });
</script>
<script>
    $(document).ready(function() {
        load_values();
    });

    function load_values() {
        var display = 'display';
        $.ajax({
            url: '../select_backend.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                display: display
            },
            success: function(response) {
                if (response.length > 0) {
                    var optn_body = '';
                    for (var a = 0; a < response.length; a++) {
                        var value = response[a].value;
                        // alert(value);
                        optn_body = optn_body + '<option value="' + value + '">' + value + '</option>';
                    }
                    // $("#select").html(optn_body);
                    document.getElementById('select').innerHTML = optn_body;

                }
            }
        });
    }

    function submit() {
        var select = $("#select").val();
        alert(select);
        $.ajax({
            url: '../select_backend.php',
            type: 'POST',
            data: {
                select: select
            },
            success: function(response) {
                if (response == 1) {

                    alert('chala gaya');
                } else {
                    alert('nahi gaya');

                }
            }
        });
    }
</script>
</html>
// $(document).ready(function(){
    
    //   $("#myInput").on("focus", function() {
    //   var select_option =""; 
    //     $.ajax({
    //         url: 'master_backend.php',
    //         type: 'post',
    //         data:{
    //             master: master,
    //         },
    //         success: function(data){
    
    //             for(let i=0; i<data.length; i++){
                    
    //                select_option += '<option value="'+data[i]+'">'+data[i]+'</option>"';
    //             }
    //             $().html;
    //         }
    //     });
    //     var value = $(this).val().toLowerCase();
    //     $("#myTable tr").filter(function() {
    //       $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //     });
    //   });
    // });

    //my workd
    $first_input_value = $_POST['first_input_value'];
    $sec_input_value = $_POST['sec_input_value'];
    $third_input_value = $_POST['third_input_value'];
    $fourth_input_value = $_POST['fourth_input_value'];
    $sql1 = "SELECT `id` FROM product_table WHERE `product_name` = '$first_input_value'";
    $sql2 = "SELECT `id` FROM category_table WHERE `category_name` = '$sec_input_value'";
    $sql3 = "SELECT `id` FROM tax_table WHERE `tax_name` = '$third_input_value'";
    $sql4 = "SELECT `id` FROM unit_table WHERE `unit_name` = '$fourth_input_value'";
    $result1 =mysqli_query($conn, $sql1);
// echo $result1;
    $result2 = mysqli_query($conn, $sql2);
    $result3 = mysqli_query($conn, $sql3);
    $result4 = mysqli_query($conn, $sql4);