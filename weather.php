<?php
//connect to the  weather data from database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "WeatherApp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//retrieve data
$city = "Rotherham, GB"; // Example city name

$sql = "SELECT * FROM weather_data WHERE city = '$city' ORDER BY timestamp DESC LIMIT 7";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// Output data of each row
while($row = $result->fetch_assoc()) {
    echo "Timestamp: " . $row["timestamp"]. " - Temperature: " . $row["temperature"]. " - Humidity: " . $row["humidity"]. "<br>";
}
} else {
    echo "0 results";
}

$conn->close();

//storing the data in database
$city = "Nottingham"; // Example city name
$timestamp = time();
$temperature = 23.5; // Example temperature value
$humidity = 65.4; // Example humidity value

$sql = "INSERT INTO weather_data (city, timestamp, temperature, humidity) VALUES ('$city', '$timestamp', '$temperature', '$humidity')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>