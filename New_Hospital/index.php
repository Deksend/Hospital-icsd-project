<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
        </div>
        <form id="login-form" action="index.php" method="POST">
            <input type="text" name="email" placeholder="Email">
            <br>
            <input type="password" name="password" placeholder="Password">
            <br>
            <input type="checkbox" name="remember_me" id="remember_me">
            <label for="remember_me">Remember me</label>
            <br>
            <input type="submit" value="Login">
            <br>
            <p>Ή <a href="index_2.php">Log in ως Ασθενης</a></p>
            <p>Ή <a href="index_3.php">Εγγραφη ως επισκέπτης</a></p>
            <p>ή <a href="index_4.php">εγγραφή ως γιατρός</a></p>
            <p>ή <a href="index_5.php">εγγραφή ως ασθενής</a></p>
            <a href="index_6.php">Forgot password?</a>
        </form>
    </div>.
        <?php
           session_start();
           if ($_SERVER["REQUEST_METHOD"] == "POST")
           {
               if(isset($_POST["email"]) && isset($_POST["password"]))
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
               
                  
                   $email = $_POST["email"];
                   $pass = $_POST["password"];
                    
                  $tables = ["doctors", "secretary","guests"];
                  $log = false;
                  $type =  "";
                  
                  foreach($tables as $table)
                  {
                      $sql = "SELECT * FROM $table WHERE email = ? AND password = ?";
                      $stmt = $conn->prepare($sql);
                      $stmt->bind_param("ss", $email, $pass);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      
                      if($result->num_rows > 0)
                      {
                          $log = true;
                          $type = "$table";
                          $_SESSION["email"] = $email;
                          $_SESSION["user_role"] = $type;
;
                          
                          break;
                      }
                      
                  }
                  $stmt->close();
                  $conn->close();
                  
                  if($log)
                  {
                      
                      switch ($type)
                      {
                          case "doctors":
                              header("Location: index_7.php");
                              exit;
                              
                          case "secretary":
                               header("Location: index_8.php");
                              exit;
                              
                          case "guests":
                              header("Location: index_9.php");
                              exit;
                      }
                  }
                  else
                  {
                      echo"Wrong Please Try Again..";
                  }
                      
               
               }
               else
               {
                   echo "Please fill in all fields";
               }
           }
        ?>
    </body>
</html>
