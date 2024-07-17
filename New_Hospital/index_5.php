<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign up as Patient</title>
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
            max-width: 600px; /* Μείωση πλάτους του κουτιού */
            height: auto; /* Αυτόματο ύψος ανάλογα με το περιεχόμενο */
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.75);
        }

        h1 {
            text-align: center;
            font-size: 48px;
        }

        .info {
            font-size: 24px;
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

        #signup-form {
            margin-top: 30px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 18px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            margin: 20px 0;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .small-text {
            font-size: 14px;
            display: inline-block;
            margin-left: 10px;
        }

        .small-text a {
            color: #4CAF50;
            text-decoration: none;
        }

        .small-text a:hover {
            text-decoration: underline;
        }
    </style>
    </head>
    <body>
         <div class="top-left">
        <span>Patient</span>
    </div>
    <div class="top-right">
        <a href="index.php" class="btn">Αρχική</a>
    </div>
    <div class="container">
        <h1>Ιατρείο</h1>
        <div class="info">
            <p>Πληροφορίες Ιατρείου</p>
        </div>
        <div id="signup-form">
            <h2>Εγγραφή ως Ασθενής</h2>
            <form action="index_5.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Name" required>
                <br>
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" placeholder="Surname" required>
                <br>
                <label for="AMKA">AMKA:</label>
                <input type="text" id="AMKA" name="AMKA" placeholder="AMKA" required>
                <br>
                
                <label for="Age">Age:</label>
                <input type="text" id="Age" name="Age" placeholder="Age" required>
                <br>
                <label for="id">Patient ID:</label>
                <input type="text" id="id" name="id" placeholder="Patient ID" required>
                <br>
                <input type="submit" value="Εγγραφή">
            </form>
        </div>
    </div>
        <?php
           $servername = "localhost";
           $username = "root";
           $password = "Metkaros4@";
           $dbname = "hospitalsystem";
           $conn = new mysqli($servername, $username, $password, $dbname);

           if($conn->connect_error)
           {
            
             die("Connection Failed: " . $conn->connect_error);
           }
           
           if ($_SERVER["REQUEST_METHOD"] == "POST")
           {   
           
             $name = $_POST["name"] ?? null;
             $surname = $_POST["surname"] ?? null;
             $amkas = $_POST["AMKA"] ?? null;
             $id = $_POST["id"] ?? null;
             $age = $_POST["Age"] ?? null;
               if($name && $surname && $amkas && $id)
               {
                   $sql = "INSERT INTO patients (name, surname, AMKA, Age, patient_id) VALUES (?, ?, ?, ?, ?)";
                   $stmt = $conn->prepare($sql);
                   $stmt->bind_param("sssss", $name, $surname, $amkas, $id, $age);
                   
                   if($stmt->execute())
                   {
                       echo "Sign up completed Successfully.";
                   }
                   
                   else
                   {
                       echo "Error: " . $sql . "<br>" . $conn->error;
                   }
                   $stmt->close();
               }
               else
               {
                    echo "All fields are required.";
               }
            
          } 
          $conn->close();
        ?>
    </body>
</html>
