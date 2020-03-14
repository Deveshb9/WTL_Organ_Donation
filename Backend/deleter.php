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


$organpart = $_POST['cas'];
$bld = $_POST['bld'];

$sql = "SELECT * FROM donor where organpart='$organpart' and bloodgp='$bld' UNION SELECT * FROM acceptor where organpart='$organpart' and bloodgp='$bld' limit 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
        echo  "<center><br><br><br><br><b>Organ:".$row["Organpart"]."<br>Bloodgroup:".$row["Bloodgp"]."<br>Donor Name:".$row["Name"]."<br></center>";
    }
	$sql1 = "DELETE a.*, b.* 
			FROM donor a 
			LEFT JOIN acceptor b 
			ON b.organpart = a.organpart 
			WHERE a.organpart = '$organpart'";	
	$result1 = $conn->query($sql1);
	if ($result1 === TRUE) {
    echo  "<center><br>Deleted record successfully</center>";
	$flag=1;
	} else {
		echo  "Error: " . $sql1 . "<br>" . $conn->error;
		$flag=0;
	}
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	echo "<center><br><br><br><br><b>You are not on the top of priority list<br></b></center>";
}

$conn->close();
?> 

<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
<br>
<br>
<center><a href="loginf.html">Click here to go back to main page</a>
</body>
</html>                                                        
