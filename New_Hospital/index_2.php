<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login ως Ασθενης</title>
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
            background-color: #fff; /* Ασπρο χρωμα */
            border-radius: 20px; /* Μεγαλυτερος κυκλος */
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75); /* Σκια στο κουτι */
        }

        h1 {
            text-align: center;
            font-size: 48px;
        }

        .info {
            font-size: 24px; /* Μεγαλυτερο μεγεθος γραμματων */
        }

        #login-form {
            text-align: center;
            margin-top: 50px;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 24px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .guest-btn {
            background-color: #008CBA;
        }

        .guest-btn:hover {
            background-color: #005f75;
        }

        /* Εφαρμόζεται η background-blend-mode */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('doctor-motivation-b5wjlwe5wjikoj7t.jpg');
            background-size: cover;
            background-position: center;
            mix-blend-mode: normal;
            z-index: -1;
        }
        </style>
        
    </head>
    <body>
           <div class="container">
        <h1>Ιατρείο</h1>
        <div class="info">
            <p>Πληροφορίες Ιατρείου</p>
            <!-- Εδώ μπορείτε να προσθέσετε τις πληροφορίες του ιατρείου -->
        
        
        <form id="login-form" action="index_2.php" method="POST">
            <input type="text" name="id" placeholder="id">
            <br>
            <input type="text" name="amka" placeholder="amka">
            <br>
            <input type="checkbox" name="remember_me" id="remember_me">
            <label for="remember_me">Remember me</label>
            <br>
            <input type="submit" value="Login">
            <div class="Button">
                <a href="index.php">Αρχικη</a>
            </div>
            <br>
        </form>
            </div>
        
        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (isset($_POST["id"]) && isset($_POST["amka"]))
            {
                  $servername = "localhost";
                  $username = "root";
                  $password = "Metkaros4@";
                  $dbname = "hospitalsystem";
               
                   $conn = new mysqli($servername, $username, $password, $dbname);
                
                  if($conn->connect_error)
                  {
                     die("Connection Failed : " .$conn->connect_error);
                  }
               
                  
                    $ids = $_POST["id"];
                    $Amka = $_POST["amka"];
                    
                    $sql = "SELECT * FROM patients WHERE patient_id = ? AND AMKA = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $ids, $Amka);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $_SESSION["patient_id"] = $ids;
                    
                    if($result->fetch_assoc())
                    {
                        echo "Login Successfully!!!";
                        header("Location: index_10.php");
                        exit;
                        
                    }
                    
                    else
                    {
                        echo "Something went wrong, please try again...";
                    }
                    
                    $stmt->close();
                    $conn->close();
                            
                    
            }
            else
            {
                echo "Please fill in all field";
            }
        }
        
       
        
        
        
        ?>
    </body>
</html>
