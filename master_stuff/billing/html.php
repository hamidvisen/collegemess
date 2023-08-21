<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <td onclick='func(this.innerHTML)'>Hamid</td>
            <td onclick='func(this.innerHTML)'>anas</td>
            <td onclick='func(this.innerHTML)'>ahir</td>
            <td onclick='func(this.innerHTML)'>mahek</td>
        </tr>
    </table>
</body>
<script>
    //     var selctor = document.getElementsByTagName("tr")[0];

    //     selctor.addEventListener('click', function(e){
    // alert(e.target.innerHTML);

    // });
    function func(e) {
        alert(e);
    }

</script>
<?php

?>
</html>