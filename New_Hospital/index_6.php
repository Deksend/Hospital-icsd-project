<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forgot Password</title>
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
            <div class="top-right">
        <a href="index.php" class="btn">Αρχική</a>
    </div>
        <h1>Ιατρείο</h1>
        <div class="info">
            <p>Πληροφορίες Ιατρείου</p>
            <!-- Εδώ μπορείτε να προσθέσετε τις πληροφορίες του ιατρείου -->
        </div>
        <form id="login-form" action="index_6.php" method="POST">
            <input type="text" name="email" placeholder="Confirm with your Email">
            <br>
            <input type="password" name="password" placeholder="New Password">
            <br>
           
            <input type="submit" value="Submit">
            <br>
        </form>
        </div>.
        
        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST")
          {
              $servername = "localhost";
              $username = "root";
              $password = "Metkaros4@";
              $dbname = "hospitalsystem";
              $conn = new mysqli($servername, $username, $password, $dbname);

              if ($conn->connect_error) 
              {
                  
                die("Connection Failed: " . $conn->connect_error);
                
              }

            $email = $_POST["email"];
            $new_password = $_POST["password"];
            
            
            $tables = ["doctors", "guests", "secretary"];
            $epitixia = false;
            
            foreach($tables as $table)
            {
                $sql = "UPDATE $table SET password = ? WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $new_password, $email);
                
                if($stmt->execute() && $stmt->affected_rows > 0)
                {
                    $epitixia = true;
                    break;
                }
                $stmt->close();
            }
            
            if($epitixia)
            {
                echo "Password updated successfully.";
            }
            
            else
            {
                echo "No matching email found in any table.";
            }
            
            $conn->close();
            
          }
        ?>
    </body>
</html>
