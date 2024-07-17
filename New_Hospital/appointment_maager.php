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
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if (isset($_POST['cancel_appointment'])) 
    {
        $appointmentId = $_POST["appointment_id"];
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
    }
    
    if (isset($_POST['update_appointment']))
    {
        if (isset($_POST["appointment_id"]) && isset($_POST["appointment_date"]))
        {
            $appointmentId = $_POST["appointment_id"];
            $appointmentDate = $_POST["appointment_date"];
            
            $sql = "SELECT COUNT(*) as count FROM appointments WHERE appointment_id != ? AND appointment_date = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $appointmentId, $appointmentDate);
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
                $sql = "UPDATE appointments SET appointment_date = ? WHERE appointment_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $appointmentDate, $appointmentId);
                $stmt->execute();
                if($stmt->affected_rows > 0 )
                {
                    echo "<script>alert('Η ημερομηνία του ραντεβού ενημερώθηκε με επιτυχία');</script>";
                    
                }
                else
                {
                    echo "<script>alert('Σφάλμα κατά την ενημέρωση της ημερομηνίας του ραντεβού');</script>";
                }
                $stmt->close();
            }
        }
        else
        {
            echo "<script>alert('Σφάλμα: Λείπουν απαιτούμενα πεδία.');</script>";
        }
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Appointment Managment</title>
        <style>
           body
           {
               background: url('doctor-motivation-b5wjlwe5wjikoj7t.jpg');
               background-size: cover;
               font-family: Arial,sans-serif;
           }
           
           .container
           {
               background-color: white;
               margin: 50px auto;
               padding: 20px;
               max-width: 800px;
               box-shadow: 0 0 10px rgba(0,0,0,0.1);
               
           }
           
           .back
           {
               background: #4CAF50;
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
           .close:hover, .close:focus
           {
               color: black;
               text-decoration: none;
               cursor: pointer;
           }
           
           .top-right
           {
               display: flex;
               justify-content: space-between;
               align-items: center;
               margin-bottom: 20px;
           }
           
           .green-button
           {
               background-color:  #4CAF50;
               color: white;
               padding: 10px 20px;
               text-decoration: none;
               border-radius: 4px;
           }
            </style>
    </head>
    <body>
        <div class="container">
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
            <h1>All Appointments</h1>
            
            <table>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>About</th>
                    <th>Actions</th>
                </tr>  
                </thead>
                <tbody>
                 <?php
                    $sql = "SELECT a.appointment_id, p.name as patient_name, p.surname as patient_surname, 
                        d.name as doctor_name, d.surname as doctor_surname, a.appointment_date, a.about 
                        FROM appointments a
                        JOIN patients p ON a.patient_id = p.patient_id
                        JOIN doctors d ON a.doctor_id = d.doctor_id";
                    
                    $result = $conn->query($sql);
                    if($result->num_rows > 0)
                    {
                        while ($row = $result->fetch_assoc()) 
                        {
                               echo "<tr>
                                        <td>{$row['appointment_id']}</td>
                                        <td>{$row['patient_name']} {$row['patient_surname']}</td>
                                        <td>Dr. {$row['doctor_name']} {$row['doctor_surname']}</td>
                                        <td>{$row['appointment_date']}</td>
                                        <td>{$row['about']}</td>
                                     <td>
                                       <form method='POST' action=''>
                                          <input type='hidden' name='appointment_id' value='{$row['appointment_id']}'>
                                          <button type='submit' name='cancel_appointment'>Remove</button>
                                       </form>
                                       <button type='button' class='open-modal' data-appointment-id='{$row['appointment_id']}'>Update</button>
                                     </td>
                                   </tr>";
                        }
                    }
                    else 
                    {
                        echo "<tr><td colspan='6'>Δεν βρέθηκαν ραντεβού</td></tr>";
                    
                    }
                    $conn->close();
                    
                 ?>
                </tbody>
            </table>
        </div>
        <div id="calendar-modal" class="modal">
            <span class="close">&times;</span>
            <div class="modal-content">
                <h2>Update Appointment</h2>
                <form method="POST" action="">
                    <input type="hidden" name="appointment_id" id="appointment-id">
                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" name="appointment_date" id="appointment_date"> 
                    <label for="about">About:</label>
                    <input type="text" name="about" id="about" required><br><br><br> 
                    <button type="submit" name="update_appointment">Update</button>  
                </form>
            </div>
        </div>
        <script>
document.addEventListener("DOMContentLoaded", function()
{
    const modal = document.getElementById("calendar-modal");
    const span = document.getElementsByClassName("close")[0];
    const buttons = document.getElementsByClassName("open-modal");
    
    Array.from(buttons).forEach(button => 
    {
        button.addEventListener("click", function()
        {
            const appointmentId = this.getAttribute("data-appointment-id");
            const appointmentDate = this.getAttribute("data-appointment-date");
            const appointmentAbout = this.getAttribute("data-appointment-about");

            document.getElementById("appointment-id").value = appointmentId;
            document.getElementById("appointment_date").value = appointmentDate;
            document.getElementById("about").value = appointmentAbout;
            
            modal.style.display = "block";
        });
    });
    
    if(span)
    {
        span.onclick = function()
        {
            modal.style.display = "none";
        }
        
    }
    
    window.onclick = function(event)
    {
        if(event.target == modal)
        {
            modal.style.display = "none";
        }
    }
});

                    
            </script>
    </body>
</html>
