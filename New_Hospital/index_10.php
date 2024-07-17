<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Patient Profile</title>
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
        
        .info p
        {
            text-align: left;
        }
    </style>
    </head>
    <body>
        <body>
    <div class="top-left">
        <div class="login-box">
            <span>Login as Ασθενής</span>
        </div>
    </div>
    <div class="container">
        <h1>Ιατρείο</h1>
        <div class="info">
            <p>Πληροφορίες Ασθενη</p>
            <?php
            session_start();
             if (!isset($_SESSION["patient_id"]) || empty($_SESSION["patient_id"])) 
             {
                header("Location: index.php");
                exit;
             }

               $id = $_SESSION["patient_id"];

                
                $servername = "localhost";
                $username = "root";
                $password = "Metkaros4@";
                $dbname = "hospitalsystem";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if($conn->connect_error)
                {
            
                  die("Connection Failed: " . $conn->connect_error);
                  
                }
                
               $sql = "SELECT name, surname, age, patient_id, registration_date, AMKA FROM patients WHERE patient_id = ?";


               $stmt = $conn->prepare($sql);
               $stmt->bind_param("s",$id );
               $stmt->execute();
               $result = $stmt->get_result();
                if($result->num_rows > 0)
                {
                         $doc = $result->fetch_assoc();
                         echo "<p>Name : " . htmlspecialchars($doc["name"]) . "</p>";
                         echo "<p>Surname : " . htmlspecialchars($doc["surname"]) . "</p>";
                         echo "<p>Age : " . htmlspecialchars($doc["age"]) . "</p>";
                         echo "<p>Id : " . htmlspecialchars($doc["patient_id"]) . "</p>";
                         echo "<p>Amka : " . htmlspecialchars($doc["AMKA"]) . "</p>";
                         echo "<p>Registration Date : " . htmlspecialchars($doc["registration_date"]) . "</p>";
                        
                     
                      
                }
                 else
               {
                   echo"<p>Error404 no user found...</p>";
               }
              $conn->close();
               
          ?>    
        </div>
    </div>
    <div class="header-box">
        patient
    </div>
    <div class="menu-buttons">
        <div class="button-container">
            <div class="btn-group">
                <button onclick="window.location.href='appointment_booking.php'">Διαχείριση Ραντεβού</button>
            </div>
            <div class="btn-group">
                <button onclick="window.location.href='manageinformationpatient.htm'">Διαχείριση Πληροφοριών</button>
            </div>
            <div class="btn-group">
                <button onclick="window.location.href='patient_historyy.php'">Εμφάνιση Ιστορικού</button> 
            </div>
        </div>
    </div>
    <div class="top-right">
        <a href="index.php" class="btn">Αποσύνδεση</a>
        
    </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
