<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    // include('../pages/navigation.php');
    ?>
    <div>
        <label for="from_date">From:</label>
        <input type="date" id="from_date" name="from_date">
        <label for="to_date">From:</label>
        <input type="date" id="to_date" name="to_date">
        <button onclick="From_to_date()">submit</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Product</th>
                    <th scope="col">Sale Quantity</th>
                    <th scope="col">Total</th>

                </tr>
            </thead>
            <tbody id="table_append">
            </tbody>
            <tbody>
<tr><td></td>
<td></td><td></td>
<td>Gross</td>
<td id="totalPayment"></td></tr>
</tbody>
        </table>

    </div>

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
                        var num =parseInt(i)+1;
                        $('#table_append').append('<tr><td>' + num + '</td><td>' + obj[i].product_id + '</td><td>' + obj[i].category_id + '</td><td>' +  obj[i].quantity + '</td><td><input type="hidden" id="total" value="' + obj[i].total + '">' +  obj[i].total + '</td></tr>');
                    }
                    var total = 0;
                    console.log(total);
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
                        var num =parseInt(i)+1;
                        $('#table_append').append('<tr><td>' + num + '</td><td>' + obj[i].product_id + '</td><td>' + obj[i].category_id + '</td><td>' +  obj[i].quantity + '</td><td><input type="hidden" id="total" value="' + obj[i].total + '">' +  obj[i].total + '</td></tr>');
                    }

                    var total = 0;
                    
               $('#table_append tr td:last-child').each(function() {
                  var value = parseFloat($('#total', this).val());
                  alert(value);
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
                        var num =parseInt(i)+1;
                        $('#table_append').append('<tr><td>' + num+ '</td><td>' + obj[i].product_id + '</td><td>' + obj[i].category_id + '</td><td>' +  obj[i].quantity + '</td><td><input type="hidden" id="total" value="' + obj[i].total + '">' +  obj[i].total + '</td></tr>');
                    }

                    var total = 0;
               $('#table_append tr td:last-child').each(function() {
            
                  var value = parseFloat($('#total', this).val());
                  alert(value);
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
</body>

</html>