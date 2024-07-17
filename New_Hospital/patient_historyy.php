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

if (isset($_POST['submit_history'])) {
    $patientId = $_SESSION['patient_id'];
    $doctorId = 1; // Προσαρμόστε το doctor_id ανάλογα με την εφαρμογή σας
    $historyText = $_POST['history_text'];
    $historyDate = date('Y-m-d');
    $about = ""; // Προεπιλεγμένη τιμή για το πεδίο about

    $sql = "INSERT INTO appointments (patient_id, doctor_id, patient_input, appointment_date, about) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisss", $patientId, $doctorId, $historyText, $historyDate, $about);
    if ($stmt->execute()) {
        echo "<script>alert('Το ιστορικό καταχωρήθηκε με επιτυχία');</script>";
    } else {
        echo "<script>alert('Σφάλμα κατά την καταχώρηση του ιστορικού');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Patient History</title>
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
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='index_10.php';">Back to Profile</button>
        <h1>Patient History</h1>
        <div class="history-form">
            <form method="POST" action="">
                <label for="history_text">History:</label><br>
                <textarea name="history_text" id="history_text" rows="4" cols="50" required></textarea><br><br>
                <button type="submit" name="submit_history">Submit</button>
            </form>
        </div>
        <h2>History Records</h2>
        <table class="history-list">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>History</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $patientId = $_SESSION['patient_id']; 
                $sql = "SELECT p.name as patient_name, p.surname as patient_surname, a.patient_input, a.appointment_date 
                        FROM appointments a
                        JOIN patients p ON a.patient_id = p.patient_id
                        WHERE a.patient_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $patientId);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['patient_name']}</td>
                                <td>{$row['patient_surname']}</td>
                                <td>{$row['patient_input']}</td>
                                <td>{$row['appointment_date']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No history records found</td></tr>";
                }
                $stmt->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
