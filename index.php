<?php
$host = "database-1.c70sos6cgu5d.ap-south-1.rds.amazonaws.com";   // RDS database endpoint url
$user = "admin";                         // database user name
$pass = "Suyog12345";                   // password
$dbname = "testdb";                      // db name

// Connect
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert sample data
if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully<br>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="post">
  Name: <input type="text" name="name"><br>
  Email: <input type="text" name="email"><br>
  <input type="submit" value="Save">
</form>

<h3>Users List:</h3>
<?php
$result = $conn->query("SELECT * FROM users");
while($row = $result->fetch_assoc()){
    echo $row['id'] . " - " . $row['name'] . " - " . $row['email'] . "<br>";
}
$conn->close();
?>

