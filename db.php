<?php 

if(!isset($_GET['dbname'])) {
    echo "No db found.";
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "backup-tool";

try {
        echo "<h1> Database:"  . $_GET['dbname'];
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT TABLE_NAME 
        FROM INFORMATION_SCHEMA.TABLES
        WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='".$_GET['dbname']."'");
        $stmt->execute();
        $result = $stmt->fetchall();
        foreach($result as $table) {
            echo "<h3>" . $table[0] . "</h3>";
        }

    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }

?>


