<?php
session_start();

?>
<?php


if ($_SESSION["user_name"] == '' && $_SESSION["login_type"] == '') {
    header('location:../login-Signup/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css_folders/navigation.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- <div class="select-menu">
        <div class="select-btn">
            <span class="sBtn-text">Select your option</span>
            <i class="bx bx-chevron-down"></i>
        </div>
        <ul class="options">
            <li class="option">
                <i class="bx bxl-github" style="color: #171515;"></i>
                <span class="option-text">Github</span>
            </li>
            <li class="option">
                <i class="bx bxl-instagram-alt" style="color: #E1306C;"></i>
                <span class="option-text">Instagram</span>
            </li>
            <li class="option">
                <i class="bx bxl-linkedin-square" style="color: #0E76A8;"></i>
                <span class="option-text">LinkedIn</span>
            </li>
            <li class="option">
                <i class="bx bxl-facebook-circle" style="color: #4267B2;"></i>
                <span class="option-text">Facebook</span>
            </li>
            <li class="option">
                <i class="bx bxl-twitter" style="color: #1DA1F2;"></i>
                <span class="option-text">Twitter</span>
            </li>
        </ul>
    </div> -->
    <nav>
        <ul id="ul_id">

            <li class="active">
                <a href="../pages/master.php" id="logo">

                    <img src="../../College_mess_files/rungta.png">
                    <div class="logo-span-div">
                        <span id="logo_span1" class="nav_item"><?php echo $_SESSION["user_name"]; ?></span>
                        <span id="logo_span2" class="nav_item"><?php echo $_SESSION["login_type"]; ?></span>
                    </div>
                </a>
            </li>
            <li>
                <a href="../pages/master.php"><i class="fas fa-home"></i>
                    <span class="nav-item">Master</span></a>
                    
            </li>

            <li>
                <a href="../login-Signup/login.php">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">Profile</span>

                </a>
            </li>
            <li>
                <a href="../pages/master_product.php">
                    <i class="fas fa-cookie-bite"></i>
                    <span class="nav-item">Products</span>

                </a>
            </li>
            <li>
                <a href="../pages/master_category.php">
                    <i class="fas fa-solid fa-box"></i>
                    <span class="nav-item">Category</span>

                </a>
            </li>
            <li>
                <a href="../pages/master_tax.php" id="add">
                    <i class="fas fa-regular fa-cart-plus"></i>

                    <span class="nav-item">Tax master</span>

                </a>
            </li>
            <li>
                <a href="../pages/master_unit.php">
                    <i class="fas fa-light fa-scale-unbalanced-flip"></i>
                    <span class="nav-item">Unit Master</span>

                </a>
            </li>
            <li>
                <a href="../billing/summury_table.php">
                    <i class="fas fa-solid fa-sack-dollar"></i>
                    <span class="nav-item">Sale</span>

                </a>
            </li>
            <li>
                <a href="../login-Signup/logout.php" id="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">Log Out</span>

                </a>
            </li>
        </ul>
    </nav>

</body>
<script>
    // Add active class to the current button (highlight it)
    var ul_id = document.getElementById("ul_id");
    var li = ul_id.getElementsByTagName("a");
    for (var i = 0; i < li.length; i++) {
        li[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace("active", "");
            this.className += "active";
        });

    }
    const add = document.getElementById('add');
    if (add.childNodes[3].style.fontSize = "x-large") {
        add.childNodes[3].style.fontSize = "medium";
    }

    // const optionMenu = document.querySelector(".select-menu"),
    //     selectBtn = optionMenu.querySelector(".select-btn"),
    //     options = optionMenu.children[1].children,
    //     sBtn_text = optionMenu.querySelector(".sBtn-text");
    // selectBtn.addEventListener('click', () => optionMenu.classList.toggle("active"));
    // Array.from(options).forEach((option) => {
    //     option.addEventListener('click', () => {
    //         let selectedOption = option.querySelector(".option-text").innerText;
    //         sBtn_text.innerText = selectedOption;
    //         optionMenu.classList.remove("active");
    //     });


    // });
</script>

</html>