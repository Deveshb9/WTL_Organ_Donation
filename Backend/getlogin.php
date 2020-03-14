 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "organ";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$pass1 = $_POST['pass'];

$sql = mysqli_query($conn,"select name from registered where username='$username' and password='$pass1' ");

if (mysqli_num_rows($sql) == 1) {
    echo "Login Sucessfull!!";
} else {
    echo "Error: Incorrect password/username";
	$conn->error;
}
$conn->close();
?> 