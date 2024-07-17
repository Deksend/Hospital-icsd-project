

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "Metkaros4@";
$dbname = "hospitalsystem";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $id = $_POST["id"];
        $sql = "DELETE FROM patients WHERE patient_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Success";
        } else {
            echo "Error: " . $conn->error;
        }
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        $id = $_POST["id"];
        $field = $_POST["field"];
        $value = $_POST["value"];
        $sql = "UPDATE patients SET $field='$value' WHERE patient_id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Success";
        } else {
            echo "Error: " . $conn->error;
        }
        exit;
    }
}

$sql = "SELECT patients.patient_id, patients.AMKA, patients.name, patients.surname, patients.Age, appointments.appointment_date
        FROM patients
        LEFT JOIN appointments ON patients.patient_id = appointments.patient_id";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Patient Managment</title>
        <style>
            body
            {
                background-image: url('doctor-motivation-b5wjlwe5wjikoj7t.jpg');
                background-size: cover;
                font-family: Arial, sans-serif;
            }
            .container
            {
                width: 50%;
                margin: 0 auto;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0,0,0,0.5);
                overflow-y: auto;
                max-height: 80vh;
            }
            
            table
            {
                width: 100%;
                border-collapse: collapse;
            }
            
            th, td
            {
                padding: 10px;
                border: 1px solid #ddd;
            }
            
            th
            {
                background-color: #f2f2f2;
            }
            
            .search-box
            {
                margin-bottom: 20px;
            }
            
            .editable
            {
                cursor: pointer;
            }
            
            .top-right 
            {
             position: absolute;
             top: 20px;
             right: 20px;
            }
        
          .top-left 
          {
            position:absolute
            top: 20px;
            left: 20px;
            
          }
        
        .green-button 
        {
          background-color: green;
          color: white;
          border: none;
          padding: 10px 20px;
          text-decoration: none;
          display: inline-block;
          cursor: pointer;
          border-radius: 5px;
         margin-top: 100px;
        }

     .green-button:hover 
     {
       background-color: darkgreen;
     }

     .add-green 
     {
        background-color: green;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
       border-radius: 5px;
    
      }

     .add-green:hover 
      {
       background-color: darkgreen;
      }


        </style>
        <script>
           document.addEventListener('DOMContentLoaded', function() {
    function searchPatient() {
        const search = document.getElementById('search').value.toUpperCase();
        const rows = document.getElementById('patient-list').getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const amka = rows[i].getElementsByTagName('td')[0];
            if (amka) {
                const values = amka.textContent || amka.innerText;
                rows[i].style.display = values.toUpperCase().indexOf(search) > -1 ? '' : 'none';
            }
        }
    }

    document.getElementById('search').addEventListener('keyup', searchPatient);

    document.querySelectorAll('.editable').forEach(cell => {
        cell.addEventListener('click', function() {
            const content = this.innerText;
            const field = this.dataset.field;
            const id = this.parentElement.dataset.id;

            const input = document.createElement('input');
            input.type = 'text';
            input.value = content;
            input.style.width = '100%';

            input.addEventListener('blur', function() {
                const newValues = this.value;
                if (newValues !== content) {
                    const formsData = new FormData();
                    formsData.append('action', 'update');
                    formsData.append('id', id);
                    formsData.append('field', field);
                    formsData.append('value', newValues);

                    fetch('patient_Managment.php', {
                        method: "POST",
                        body: formsData
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === "Success") {
                            cell.innerText = newValues;
                        } else {
                            cell.innerText = content;
                            alert("Update Failed");
                        }
                    });
                } else {
                    cell.innerText = content;
                }
            });

            this.innerText = '';
            this.appendChild(input);
            input.focus();
        });

        cell.addEventListener("contextmenu", function(e) {
            e.preventDefault();
            const id = this.parentElement.dataset.id;
            if (confirm("Are you sure you want to delete this patient?")) {
                const formsData = new FormData();
                formsData.append("action", "delete");
                formsData.append("id", id);

                fetch("patient_Managment.php", {
                    method: "POST",
                    body: formsData
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "Success") {
                        this.parentElement.remove();
                    } else {
                        alert("Removal Failed");
                    }
                });
            }
        });
    });
});
    
            
        </script>
    </head>
    <body>
        <div class="top-left">
                    <a href="add_new_patiets.php" class="btn add-green">Add new Patients</a>
                      
                </div>
        <div class="container">
            <h2>Patients List</h2>
            <div class="search-box">
                <input type="text" id="search" placeholder="Search Patient" onkeyup="searchPatient()">
                <div class="top-right">
                   
                        <?php
                           if ($_SESSION["user_role"] == "doctors")
                           {
                                  echo "<a href='index_7.php' class='btn green-button'>Back</a>";
                           }
                           else if ($_SESSION["user_role"] == "secretary") 
                           {
                               echo "<a href='index_8.php' class='btn green-button'>Back</a>";
                           }
                        ?>
        
               </div>
                
        </div>
            
            <table>
                <thead>
                    <tr>
                        <th>AMKA</th>
                        <th>Ονομα</th>
                        <th>Επωνυμο</th>
                        <th>Ηλικια</th>
                        <th>Ημερομηνια Ραντεβου</th>
                    </tr>
                </thead>
                <tbody id="patient-list">
                 <?php
                   if ($result->num_rows > 0)
                   {
                       while($row = $result->fetch_assoc()) 
                       {
                          echo "<tr data-id='{$row['patient_id']}'>
                         <td class='editable' data-field='AMKA'>" . htmlspecialchars($row['AMKA']) . "</td>
                         <td class='editable' data-field='name'>" . htmlspecialchars($row['name']) . "</td>
                         <td class='editable' data-field='surname'>" . htmlspecialchars($row['surname']) . "</td>
                         <td class='editable' data-field='Age'>" . htmlspecialchars($row['Age']) . "</td>
                         <td>" . htmlspecialchars($row['appointment_date']) . "</td>
                         </tr>";
                       }
                   } 
                   else 
                   {
                       echo "<tr><td colspan='5'>Δεν βρέθηκαν αποτελέσματα</td></tr>";
                   }
                 ?>


            </table>
        </div>
        
        
    </body>
</html>
