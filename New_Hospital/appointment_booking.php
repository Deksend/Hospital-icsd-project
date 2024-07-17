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

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['cancel_appointment'])) {
    $appointmentId = $_POST['appointment_id'];
    $sql = "DELETE FROM appointments WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointmentId);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Το ραντεβού ακυρώθηκε με επιτυχία');</script>";
    } else {
        echo "<script>alert('Σφάλμα κατά την ακύρωση του ραντεβού');</script>";
    }
    $stmt->close();
}

if (isset($_POST['book_appointment'])) {
    if (isset($_POST["doctor_id"]) && isset($_POST["appointment_date"]) && isset($_POST["about"])) {
        $doctorId = $_POST["doctor_id"];
        $patientId = $_SESSION['patient_id'];
        $appointmentDate = $_POST["appointment_date"];
        $about = $_POST["about"];

        $sql = "SELECT COUNT(*) as count FROM appointments WHERE doctor_id = ? AND appointment_date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $doctorId, $appointmentDate);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo "<script>alert('Υπάρχει ήδη ραντεβού για αυτήν την ημερομηνία.');</script>";
        } else {
            $sql = "INSERT INTO appointments (doctor_id, patient_id, appointment_date, about) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiss", $doctorId, $patientId, $appointmentDate, $about);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Το ραντεβού κλείστηκε με επιτυχία');</script>";
            } else {
                echo "<script>alert('Σφάλμα κατά την κλείσιμο του ραντεβού');</script>";
            }
            $stmt->close();
        }
    } else {
        echo "<script>alert('Σφάλμα: Λείπουν απαιτούμενα πεδία.');</script>";
    }
}

if (isset($_POST['update_appointment'])) {
    if (isset($_POST["appointment_id"]) && isset($_POST["appointment_date"]) && isset($_POST["about"])) {
        $appointmentId = $_POST["appointment_id"];
        $appointmentDate = $_POST["appointment_date"];
        $about = $_POST["about"];

        $sql = "SELECT COUNT(*) as count FROM appointments WHERE appointment_id != ? AND appointment_date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $appointmentId, $appointmentDate);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            echo "<script>alert('Υπάρχει ήδη ραντεβού για αυτήν την ημερομηνία.');</script>";
        } else {
            $sql = "UPDATE appointments SET appointment_date = ?, about = ? WHERE appointment_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $appointmentDate, $about, $appointmentId);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Η ημερομηνία του ραντεβού ενημερώθηκε με επιτυχία');</script>";
            } else {
                echo "<script>alert('Σφάλμα κατά την ενημέρωση της ημερομηνίας του ραντεβού');</script>";
            }
            $stmt->close();
        }
    } else {
        echo "<script>alert('Σφάλμα: Λείπουν απαιτούμενα πεδία.');</script>";
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Appointments</title>
        <style>
            body
            {
                background: url('doctor-motivation-b5wjlwe5wjikoj7t.jpg');
                background-size: cover;
                font-family: Arial, sans-serif;
            }
            
            .container
            {
                background-color: white;
                margin: 50px auto;
                padding: 20px;
                border-radius: 10px;
                max-width: 800px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                
            }
            
            .table
            {
                width: 100%;
                border-collapse: collapse;
            }
            
            th, td
            {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            
            button
            {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                border: none;
                cursor: pointer;
            }
            
            button:hover
            {
                background-color: #45a049;
            }
            
            .modal
            {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.1);
                
            }
            
            .modal-content
            {
                background-color: white;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }
            
            .close
            {
                color: #aaa;
                float: right;
                font-size: 28px;
            }
            
            .close:hover
            .close:focus
            {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
            
            .back
            {
                background-color: #4CAF50;
                color: white;
                padding: 10px;
                border: none;
                cursor: pointer;
                margin-bottom: 20px;
            }
            .back:hover
            {
                background-color: #45a049;
            }
            
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Appointments</h1>
           <button class="back" onclick="window.location.href='index_10.php';">Back to Profile</button>
            <table id="doctors-table">
                <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Speciality</th>
                <th></th>  
            </tr>
                </thead>
                <tbody>
                <?php
                   $servername = "localhost";
                   $username = "root";
                   $password = "Metkaros4@";
                   $dbname = "hospitalsystem";
                   $conn = new mysqli($servername, $username, $password, $dbname);

                   if ($conn->connect_error) 
                   {
                      die("Connection Failed: " . $conn->connect_error);
                   }

                   $sql = "SELECT * FROM doctors";
                   $result = $conn->query($sql);
                   if($result->num_rows > 0)
                   {
                       while($row = $result->fetch_assoc())
                       {
                           echo "<tr>
                                   <td>{$row['doctor_id']}</td>
                                   <td>{$row['name']}</td>
                                   <td>{$row['surname']}</td>
                                   <td>{$row['speciality']}</td>
                                  <td>
                                  <form method='POST' action=''>
                                  <input type='hidden' name='doctor_id' value='{$row['doctor_id']}'>
                                  <label for='appointment_date'>Appointment Date:</label>
                                 <input type='date' name='appointment_date' required><br><br>
                                <label for='about'>About:</label>
                                <input type='text' name='about' required><br><br>
                        <button type='submit' name='book_appointment'>Book Appointment</button>
                             </form>

                                 <td>
    


                                 </td>
                            </tr>";
                       }
                   }
                   else
                   {
                       echo "<tr><td colspan='5'>Δεν βρέθηκαν γιατροί</td></tr>"; 
                   }
                   $conn->close();
                   ?>
                </tbody>
            </table>
            <h2>Your Appointments</h2>
            <table>
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>About</th>
                   <th></th>
                 </tr>
                </thead>
                <?php
                  $conn = new mysqli($servername, $username, $password, $dbname);
                   $patientId = isset($_SESSION['patient_id']) ? $_SESSION['patient_id'] : null; // Ασφαλής ανάκτηση του patient_id
                   if ($patientId === null)
                   {
                       echo "<script>alert('Παρακαλώ συνδεθείτε για να δείτε τα ραντεβού σας.');</script>";
                       exit;
                   }

                   $sql = "SELECT a.appointment_id, d.name, d.surname, a.appointment_date, a.about 
                    FROM appointments a
                    JOIN doctors d ON a.doctor_id = d.doctor_id
                    WHERE a.patient_id = ?";
                   
                   $stmt = $conn->prepare($sql);
                   $stmt->bind_param("i", $patientId);
                   $stmt->execute();
                   $result = $stmt->get_result();
                   if($result->num_rows > 0)
                   {
                       while($row = $result->fetch_assoc())
                       {
                           echo "<tr>
                                   <td>{$row['appointment_id']}</td>
                                   <td>Dr. {$row['name']} {$row['surname']}</td>
                                   <td>{$row['appointment_date']}</td>
                                   <td>{$row['about']}</td>
                                   <td>
                                     <td>
                                       <form method='POST' action=''>
                                       <input type='hidden' name='appointment_id' value='{$row['appointment_id']}'>
                                       <button type='submit' name='cancel_appointment'>Remove Appointment</button>
                                       </form>
                                      <button type='button' class='open-modal' data-appointment-id='{$row['appointment_id']}'>Update Appointment</button>
                                    </td>
  
                                   </form>
                                   </td>
                               </tr>";
                       }
                   }
                   else 
                   {
                       echo "<tr><td colspan='5'>Δεν βρέθηκαν ραντεβού</td></tr>";
                   }
                   
                   $stmt->close();
                   $conn->close();
                ?>
            </table>
        </div>
       
          <!-- HTML Code για το Modal -->
              <div id="calendar-modal" class="modal">
    <span class="close">&times;</span>
    <div class="modal-content">
        <h2>Update Appointment</h2>
        <form method="POST" action="">
            <input type="hidden" name="appointment_id" id="appointment-id">
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" name="appointment_date" id="appointment_date" required><br><br>
            <label for="about">About:</label>
            <input type="text" name="about" id="about" required><br><br>
            <button type="submit" name="update_appointment">Update</button>
        </form>
    </div>
</div>

        <?php
           if (isset($_POST['cancel_appointment']))
           {
              $conn = new mysqli($servername, $username, $password, $dbname);

             if ($conn->connect_error) 
             {
             
                die("Connection failed: " . $conn->connect_error);
             }
             
            $appointmentId = $_POST['appointment_id'];
            $sql = "DELETE FROM appointments WHERE appointment_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $appointmentId);
            $stmt->execute();
            if($stmt->affected_rows > 0)
            {
                echo "<script>alert('Το ραντεβού ακυρώθηκε με επιτυχία');</script>";
    
            }
            else 
            {
                 echo "<script>alert('Σφάλμα κατά την ακύρωση του ραντεβού');</script>";
                 
            }
            $stmt->close();
            $conn->close();
          }
          
         if (isset($_POST['book_appointment']))
         {
            $conn = new mysqli($servername, $username, $password, $dbname);

             if ($conn->connect_error)
             {
                die("Connection failed: " . $conn->connect_error);
             }

            $doctorId = $_POST["doctor_id"];
            $patientId = $_SESSION['patient_id']; // Assuming patient ID is stored in session
            $appointmentDate = $_POST["appointment_date"];
            $about = $_POST["about"];
            $sql = "SELECT COUNT(*) as count FROM appointments WHERE doctor_id = ? AND appointment_date = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $doctorId, $appointmentDate);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            
            if($count > 0)
            {
                echo "<script>alert('Υπάρχει ήδη ραντεβού για αυτήν την ημερομηνία.');</script>";
            }
            else
            {
                 $sql = "INSERT INTO appointments (doctor_id, patient_id, appointment_date, about) VALUES (?, ?, ?, ?)";
                 $stmt = $conn->prepare($sql);
                 $stmt->bind_param("iiss", $doctorId, $patientId, $appointmentDate, $about);
                 $stmt->execute();
                 if ($stmt->affected_rows > 0)
                 {
                   echo "<script>alert('Το ραντεβού κλείστηκε με επιτυχία');</script>";
                 }
                 else 
                 {
                 
                   echo "<script>alert('Σφάλμα κατά την κλείσιμο του ραντεβού');</script>";
                 }
                $stmt->close();
            }
           $conn->close();
         }
         
        ?>
    </body>
    <script>
       document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("calendar-modal");
    const span = document.getElementsByClassName("close")[0];
    const buttons = document.getElementsByClassName("open-modal");

    Array.from(buttons).forEach(button => {
        button.onclick = function() {
            const appointmentId = this.getAttribute("data-appointment-id");
            document.getElementById("appointment-id").value = appointmentId;
            modal.style.display = "block";
        }
    });

    if (span) {
        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
});


                
        </script>
    </html> 
    
