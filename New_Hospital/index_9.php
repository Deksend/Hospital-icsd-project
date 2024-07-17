<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Guest Profile</title>
        <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('doctor-motivation-b5wjlwe5wjikoj7t.jpg');
            background-size: cover;
            background-position: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
            position: relative;
        }

        h1 {
            text-align: center;
            font-size: 36px;
        }

        .info {
            font-size: 24px;
            text-align: center;
        }

        .top-left {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 18px;
        }

        .top-right {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            margin: 4px 2px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .header-box {
            background-color: #f0f0f0;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 24px;
            margin: 20px auto;
            width: fit-content;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        }

        .menu-buttons {
            text-align: center;
            margin-top: 30px;
        }

        .menu-buttons .button-container {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
            display: inline-block;
            width: fit-content;
        }

        .menu-buttons button {
            margin: 10px 0;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            background-color: #008CBA;
            color: white;
            display: block;
            width: 100%;
            box-sizing: border-box;
            text-transform: lowercase; /* Μετατροπή σε πεζά γράμματα */
        }

        .menu-buttons button:hover {
            background-color: #005f75;
        }

        .login-box {
            display: inline-block;
            background-color: #f0f0f0;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .small-text {
            font-size: 14px;
            text-align: right; /* Τοποθέτηση στη δεξιά πλευρά */
            margin-top: 10px;
            position: absolute; /* Απόλυτη θέση */
            bottom: 20px; /* Απόσταση από το κάτω μέρος */
            right: 20px; /* Απόσταση από τη δεξιά πλευρά */
        }

        .small-text a {
            color: #4CAF50;
            text-decoration: none;
            display: block; /* Τοποθέτηση σε νέα γραμμή */
            margin-top: 5px; /* Απόσταση μεταξύ των επιλογών */
        }

        .small-text a:hover {
            text-decoration: underline;
        }
    </style>
    </head>
    <body>
        <div class="top-left">
        <div class="login-box">
            <span>Login as Guest</span>
        </div>
    </div>
    <div class="container">
        <h1>Ιατρείο</h1>
        <div class="info">
            <p>Welcome to Hospitals Official Web Site</p>
        <p>Our hospital is dedicated to providing the highest quality healthcare to our patients. We offer state-of-the-art facilities and a team of experienced medical professionals who are committed to ensuring your well-being.</p>
        <p>Doctors working at our hospital enjoy numerous benefits, including access to advanced medical equipment, opportunities for continuous professional development, and a supportive work environment that fosters collaboration and innovation.</p>
        <p>We invite you to consider our hospital for your future healthcare needs, where you will receive compassionate care and exceptional service.</p>
    </div>
    
    </div>
    <div class="header-box">
        Guest
    </div>

    <div class="top-right">
        <a href="index.php" class="btn">Αποσύνδεση</a>
        
    </div>
    <div class="small-text">
        <a href="index_4.php">εγγραφή ως γιατρός</a>
        <a href="index_5.php">εγγραφή ως ασθενής</a>
    </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
