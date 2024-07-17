<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add new Patients</title>
        <style>
            body
            {
                background: url('doctor-motivation-b5wjlwe5wjikoj7t.jpg');
                background-size: cover;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            
            .container
            {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                text-align: center;
            }
            
            .button 
            {
                background-color: green;
                color: white;
                padding: 10px 20px;
                border: none;
                margin: 10px;
                  
            }
            
            .button:hover
            {
                background-color: darkgreen;
            }
            .form-container
            {
                display: none;
                margin-top: 20px;
            }
            .form-container input
            {
                margin: 5px;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <button id="add-single">Add one new Patient</button>
            <button id="add-multiple">Add multiple new Patients</button>
            <div id="single-form" class="form-container">
                <form action="add_new_patiets.php" method="POST">
                    <input type="hidden" name="type" value="single">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="text" name="surname" placeholder="Surname" required>
                    <input type="text" name="amka" placeholder="AMKA" required> 
                    <input type="text" name="id" placeholder="Id" required>
                    <input type="text" name="age" placeholder="Age" required>
                    <button type="submit">Sumbit</button>
                </form>
            </div>
            
            <div id="multiple-form" class="form-container">
                <form action="add_new_patiets.php" method="POST">
                    <input type="hidden" name="type" value="multiple">
                    <div class="multiple-entry">
                    <input type="text" name="name1" placeholder="Name" required>
                    <input type="text" name="surname1" placeholder="Surname" required>
                    <input type="text" name="amka1" placeholder="AMKA" required> 
                    <input type="text" name="id1" placeholder="Id" required>
                    <input type="text" name="age1" placeholder="Age" required>
                    </div>
                    <div class="multiple-entry">
                    <input type="text" name="name2" placeholder="Name" required>
                    <input type="text" name="surname2" placeholder="Surname" required>
                    <input type="text" name="amka2" placeholder="AMKA" required> 
                    <input type="text" name="id2" placeholder="Id" required>
                    <input type="text" name="age2" placeholder="Age" required>
                    </div>
                    
                    <div class="multiple-entry"> 
                    <input type="text" name="name3" placeholder="Name" required>
                    <input type="text" name="surname3" placeholder="Surname" required>
                    <input type="text" name="amka3" placeholder="AMKA" required> 
                    <input type="text" name="id3" placeholder="Id" required>
                    <input type="text" name="age3" placeholder="Age" required>
                    </div>
                    <button type="submit">Submit</button>
                </form>
                
            </div>     
        </div>
        <script>
           document.getElementById("add-single").onclick = function()
           {
               document.getElementById("single-form").style.display = "block";
               document.getElementById("multiple-form").style.display = "none";
           };

          document.getElementById("add-multiple").onclick = function() 
          {
              document.getElementById("single-form").style.display = "none";
              document.getElementById("multiple-form").style.display = "block";
          };

        </script>
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
          
          if(isset($_POST["type"]))
          {
             $type = $_POST["type"];
                       if($type == "single")
          {
              $name = $_POST["name"];
              $surname = $_POST["surname"];
              $amka = $_POST["amka"];
              $id = $_POST["id"];
              $age = $_POST["age"];
              $sql = "INSERT INTO patients (name, surname, AMKA, patient_id, Age) VALUES ('$name', '$surname', '$amka', '$id', '$age')";
              if($conn->query($sql))
              {
                  echo "The new patient is succesfully in our servers";
              }
              
              else
              {
                  echo "Error404:" . $sql . "<br>". $conn->error;
              }
 
          }
          
          else if($type == "multiple")
          {
              for($i = 1; $i <= 3; $i++)
              {
                  $name = $_POST["name$i"];
                  $surname = $_POST["surname$i"];
                  $amka = $_POST["amka$i"];
                  $id = $_POST["id$i"];
                  $age = $_POST["age$i"];
                  
                  if (!empty($name) && !empty($surname) && !empty($amka) && !empty($id) && !empty($age))
                  {
                      $sql = "INSERT INTO patients (name, surname, AMKA, patient_id, Age) VALUES ('$name', '$surname', '$amka', '$id', '$age')";
                      if($conn->query($sql) !== TRUE)
                      {
                          echo "Error404:" . $sql . "<br>". $conn->error;
                          $conn->close();
                          exit();
                      }
                  }
              }
            echo "The new patient is succesfully in our servers";  
          }
          $conn->close();
          
      }
          

        ?>
    </body>
</html>
