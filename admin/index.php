<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- style for the main index.php can also be used -->
    <link rel="stylesheet" href="../style.css">
    <title>Admin Panel</title>
</head>
<body>
    <!-- Header -->
    <section class="header">
        <div class="enquire">
            <img src="../images/logo.png" alt="">
            <span>ENQUIRE QUIZ CLUB<span>
        </div>
        <div class="menu">
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['email'])) {
                echo "<span>Hello, {$_SESSION['name']}</span>";
            ?>
                <button class="button" onclick="window.location.href = 'logout.php'">LOGOUT</button>
            <?php
            }else{ ?>
                <button class="button" id="form-open">LOGIN</button>
            <?php
            }
            ?>
            <div>
                <button class="button apply-button">APPLY</button>
            </div>
        </div>
    </section>

    <!-- Home -->
    <section class="home">
        <div class="form_container">
            <!-- Login From -->
            <div class="form login_form">
                <form action="login.php" method="POST">
                    <div class="in_a_row">
                        <h2>LOGIN</h2>
                        <i class="uil uil-times form_close"></i>
                    </div>
                    <?php
                    if(isset($_SESSION['login-msg'])){
                        echo "<span class='session-msg'>{$_SESSION['login-msg']}</span>";
                        unset($_SESSION['login-msg']);
                    }
                    ?>
                    <div class="input_box">
                        <input type="email" placeholder="Enter your email" required name="email" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email'];?>"/>
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" placeholder="Enter your password" required name="password" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password'];?>"/>
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <button class="button">LOGIN NOW</button>
                </form>
            </div>
        </div>
    </section>
    
    <!-- Table and its contents html are to be done in script.js -->
    <section class="requests-tabel"></section>

    <script src="script.js" defer></script>

</body>
</html>