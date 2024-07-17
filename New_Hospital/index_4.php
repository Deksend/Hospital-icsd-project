<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign up As Doctor</title>
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
        div class="top-left">
        <span>Doctor</span>
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
            <h2>Εγγραφή ως Γιατρος</h2>
            <form action="index_4.php" method="POST">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Name" required>
                <br>
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" placeholder="Surname" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <br>
                <label for="confirm_email">Confirm Email:</label>
                <input type="email" id="confirm_email" name="confirm_email" placeholder="Confirm Email " required>
                <br>
                <label for="password">Κωδικός:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <br>
                <label for="confirm_password">Confirm Κωδικός:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <br>
                <label for="speciality">Speciality:</label>
                <input type="text" id="speciality" name="speciality" placeholder="Speciality" required>
                <br>
                <label for="about">About:</label>
                <textarea id="about" name="about" rows="4" cols="50" placeholder="Tell us about yourself " required></textarea>
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
               $name = $_POST["name"];
               $surname = $_POST["surname"];
               $email = $_POST["email"];
               $confirm_email = $_POST["confirm_email"];
               $password = $_POST["password"];
               $confirm_password = $_POST["confirm_password"];
               $speciality = $_POST["speciality"];
               $about = $_POST["about"];
               
               if($email !== $confirm_email)
               {
                   echo"The email inputs must be the same to proceed";
                   exit();
               }
               
               if($password !== $confirm_password)
               {
                   echo "The password inputs must be the same to procceed";
               }
               
               $hash_password = password_hash($password, PASSWORD_DEFAULT);
               $sql = "INSERT INTO doctors (name, surname, speciality, email, password, about) VALUES (?, ?, ?, ?, ?, ?)";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("ssssss", $name, $surname, $speciality, $email, $password, $about);
               
               if($stmt->execute())
               {
                   echo "Sign up completed Successfully.";
               }
               else 
               {
                   echo"Error :" . $sql. "<br>". $conn->error;
               }
               
               $stmt->close();
           }
          
          $conn->close();
        ?>
    </body>
</html>
