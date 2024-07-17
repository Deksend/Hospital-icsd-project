<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Guest Sign Up</title>
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
        <span>Guest</span>
    </div>
    <div class="top-right">
        <a href="index.php" class="btn">Αρχική</a>
    </div>
    <div class="container">
        <h1>Ιατρείο</h1>
        <div class="info">
            <p>Warrining!!! Ανα 10 εγγραφες ως "Επισκεπτης" θα διαγραφονται ολοι οι επισκτεπτες απο την σελιδα μας. Αν δεν ειστε Ασθενης, Γιατρος ή γραμματεας τοτε θα χρειαστει να ξανακανετε εγγραφη ως επισκεπτης</p>
        </div>
        <div id="signup-form">
            <h2>Εγγραφή</h2>
            <form action="index_3.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Name">
                <br>
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" placeholder="Surname">
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email">
                <br>
                <label for="confirm_email">Confirm Email:</label>
                <input type="email" id="confirm_email" name="confirm_email" placeholder="Confirm Email">
                <br>
                <label for="password">Κωδικός:</label>
                <input type="password" id="password" name="password" placeholder="Password">
                <br>
                <label for="confirm_password">Confirm Κωδικός:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                <br>
                <input type="submit" value="Εγγραφή">
                <span class="small-text">ή <a href="signupdoctor.htm">εγγραφή ως γιατρός</a></span>
                <span class="small-text">ή <a href="signuppatient.htm">εγγραφή ως ασθενής</a></span>
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


          if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["confirm_email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) 
          {
   
            if($_POST["email"] != $_POST["confirm_email"]) 
            {
               echo "Το email και το επιβεβαιωμένο email πρέπει να είναι ίδια.";
            }
            elseif ($_POST["password"] != $_POST["confirm_password"]) 
            {
                echo "Το password και το επιβεβαιωμένο password πρέπει να είναι ίδια.";
            }
            
        
            else 
            {
        
              $name = $_POST["name"];
              $surname = $_POST["surname"];
              $email = $_POST["email"];
              $password = $_POST["password"];
        
             $sql = "INSERT INTO guests (name, surname, email, password) VALUES ('$name', '$surname', '$email', '$password')";
        
             if ($conn->query($sql) === TRUE) 
             {
                echo "Επιτυχής εισαγωγή δεδομένων.";
                
             } 
             else
             {
                 
                echo "Σφάλμα κατά την εισαγωγή δεδομένων: " . $conn->error;
            }
        }
    
    
         
    

         if (!isset($_SESSION['counter'])) 
         {
             
          $_SESSION["counter"] = 1;
          
        }
        else 
        {
            
           $_SESSION["counter"]++;
        }

        if ($_SESSION['counter'] % 10 == 0) 
        {
           $sql_delete = "DELETE FROM guests";
           
             if($conn->query($sql_delete) === TRUE) 
             {
                 
                echo "Όλοι οι επισκέπτες έχουν διαγραφεί με επιτυχία.";
                
             } 
             else 
             {
                 
                echo "Σφάλμα κατά τη διαγραφή επισκεπτών: " . $conn->error;
           }
         }
       }


           $conn->close();


        
        ?>
    </body>
</html>
