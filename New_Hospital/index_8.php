<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secretary Profile</title>
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
            font-size: 36px; /* Μικραίνουμε το μέγεθος του τίτλου */
        }

        .info {
            font-size: 24px;
            text-align: center;
        }
        
        .info p
        {
            text-align: left;
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
    </style>
    </head>
    <body>
        <div class="top-left">
        <div class="login-box">
            <span>Login as Γραμματέας</span>
        </div>
    </div>
    <div class="container">
        <h1>Ιατρείο</h1> <!-- Μικραίνουμε το μέγεθος του τίτλου -->
        <div class="info">
            <p>Πληροφορίες Γραμματειας</p>
            <?php
               session_start();

                if (!isset($_SESSION["email"])) 
                {
                    echo "Session email is not set.";
                    header("Location: index.php");
                    exit;
                }
                
                $email = $_SESSION["email"];
                
                $servername = "localhost";
                $username = "root";
                $password = "Metkaros4@";
                $dbname = "hospitalsystem";
                $conn = new mysqli($servername, $username, $password, $dbname);

                if($conn->connect_error)
                {
            
                  die("Connection Failed: " . $conn->connect_error);
                  
                }
                
               $sql = "SELECT name, surname, email FROM secretary WHERE email = ?";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("s",$email );
               $stmt->execute();
               $result = $stmt->get_result();
                if($result->num_rows > 0)
                {
                         $doc = $result->fetch_assoc();
                         echo "<p>Name : " . htmlspecialchars($doc["name"]) . "</p>";
                         echo "<p>Surname : " . htmlspecialchars($doc["surname"]) . "</p>";
                         echo "<p>Email : " . htmlspecialchars($doc["email"]) . "</p>";
                        
                     
                      
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
        Secretary
    </div>
    <div class="menu-buttons">
        <div class="button-container">
            <button onclick="window.location.href='appointment_maager.php'">Διαχείριση Ραντεβού</button> <!-- Ελληνική ονομασία -->
            <button onclick="window.location.href='patient_Managment.php'">Διαχείριση Ασθενών</button> <!-- Ελληνική ονομασία -->
            </div>
        </div>
    
    <div class="top-right">
        <a href="index.php" class="btn">Αποσύνδεση</a>
        
    </div>
       
    </body>
</html>
