<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- the following stylesheet has the icons in the login signup form form_container -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="style.css">
    <title>Forgot Password</title>
</head>
<style>
    body{
        background-color: var(--grey);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }
    .container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        background-color: var(--textColor);
        padding: 2rem 2rem;
        border-radius: 1rem;
        width: fit-content;
    }
    .heading{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .container header{
        font-size: 1.5rem;
        margin-bottom: 10px;
        font-weight: 600;
    }
    .container form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 1rem;       
        background-color: var(--textColor);
    }
    .form-field{
        width: 18rem;
        height: 2.5rem;
        border-radius: 0.5rem;
        padding: 0rem 0.5rem;
        outline: none;
        border: 2px solid var(--darkGrey);
    }
    .form-field:focus{
        border-color: var(--mainColor);
        color: var(--mainColor);
    }
    .form-field input{
        width: 100%;
        height: 100%;
        font-size: 1rem;
        border: none;
    }
    .go-button{
        font-size: 1rem;
    }
    .row{
        display: flex;
        gap: 0.5rem;
    }
    @media screen and (max-width: 450px) {
        *{
            font-size: 0.9rem;
        }
        .container{
            padding: 1rem;
        }
        .container header{
            font-size: 1.2rem;
        }
        .form-field{
            width: 16rem;
        }
        
    }
</style>
<body>
    <div class="container">
        <div class="heading">
            <header>Recover Your Account</header>
            <span>Please fill your email id properly</span>
        </div>
        <?php
        if(isset($_SESSION['forgot-msg'])){
            echo "<span class='session-msg'>{$_SESSION['forgot-msg']}</span>";
            unset($_SESSION['forgot-msg']);
        }
        ?>
        <form action="send_mail.php" method="POST">
            <div class="form-field">
                <i class="uil uil-envelope-alt email"></i>
                <input type="email" placeholder="Email address" required name="email">
            </div>            
            <button class="button go-button" name="submit">Send Mail</button>
        </form>
        <div class="row">
            <span>Don't have an account?</span>
            <a href="index.php?signup=open">SignUp Here</a>
        </div>
    </div>
</body>
</html>