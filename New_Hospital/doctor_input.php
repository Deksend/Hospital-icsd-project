ι<!DOCTYPE html>
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

if (isset($_POST['submit_note'])) {
    $appointmentId = $_POST['appointment_id'];
    $doctorNote = $_POST['doctor_note'];

    $sql = "UPDATE appointments SET doctor_notes = ? WHERE appointment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $doctorNote, $appointmentId);
    if ($stmt->execute()) {
        echo "<script>alert('Η σημείωση καταχωρήθηκε με επιτυχία');</script>";
    } else {
        echo "<script>alert('Σφάλμα κατά την καταχώρηση της σημείωσης');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Doctor's Patient History</title>
    <style>
        body {
            background: url('doctor-motivation-b5wjlwe5wjikoj7t.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: white;
            margin: 50px auto;
            padding: 20px;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .back-button {
            background: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .back-button:hover {
            background-color: #45a049;
        }
        .history-form {
            margin-bottom: 20px;
        }
        .history-list {
            width: 100%;
            border-collapse: collapse;
        }
        .history-list th, .history-list td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .edit-button {
            background: #f0ad4e;
            color: white;
            padding: 5px;
            border: none;
            cursor: pointer;
        }
        .edit-button:hover {
            background-color: #ec971f;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='index_7.php';">Back to Profile</button>
        <h1>Patient History</h1>
        <h2>History Records</h2>
        <table class="history-list">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>History</th>
                    <th>Doctor's Note</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT a.appointment_id, p.name as patient_name, p.surname as patient_surname, a.patient_input, a.doctor_notes, a.appointment_date 
                        FROM appointments a
                        JOIN patients p ON a.patient_id = p.patient_id";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['patient_name']}</td>
                                <td>{$row['patient_surname']}</td>
                                <td>{$row['patient_input']}</td>
                                <td>{$row['doctor_notes']}</td>
                                <td>{$row['appointment_date']}</td>
                                <td><button class='edit-button' data-appointment-id='{$row['appointment_id']}'>Edit</button></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No history records found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Doctor's Note</h2>
            <form method="POST" action="">
                <input type="hidden" name="appointment_id" id="appointment-id">
                <label for="doctor_note">Doctor's Note:</label><br>
                <textarea name="doctor_note" id="doctor-note" rows="4" cols="50" required></textarea><br><br>
                <button type="submit" name="submit_note">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("edit-modal");
            const span = document.getElementsByClassName("close")[0];
            const buttons = document.getElementsByClassName("edit-button");

            Array.from(buttons).forEach(button => {
                button.addEventListener("click", function() {
                    const appointmentId = this.getAttribute("data-appointment-id");
                    document.getElementById("appointment-id").value = appointmentId;
                    modal.style.display = "block";
                });
            });

            span.onclick = function() {
                modal.style.display = "none";
            };

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        });
    </script>
</body>
</html>

