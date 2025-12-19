<!-- get dATA FROM form and  send data to database by post then action where data getit -->

<!-- data base code -->

<!-- CREATE DATABASE simple_db;

USE simple_db;

CREATE TABLE visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100),
    message TEXT,
    visit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); -->


<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'simple_db';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO visitors (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Data submitted successfully! ✅<br>";
        echo "Name: " . $name . "<br>";
        echo "Email: " . $email . "<br>";
        echo "Message: " . $message . "<br><br>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

echo "<h2>Visitors List:</h2>";
$result = mysqli_query($conn, "SELECT * FROM visitors ORDER BY visit_date DESC");

while ($row = mysqli_fetch_assoc($result)) {
    echo "Name: " . $row['name'] . "<br>";
    echo "Email: " . $row['email'] . "<br>";
    echo "Message: " . $row['message'] . "<br>";
    echo "Date: " . $row['visit_date'] . "<br>";
    echo "-------------------<br><br>";
}

mysqli_close($conn);
?>